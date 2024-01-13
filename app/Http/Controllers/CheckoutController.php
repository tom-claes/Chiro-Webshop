<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Size;
use App\Models\Size_sort;
use App\Models\Cart_item;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PurchaseConfirmation;



class CheckoutController extends Controller
{
    // pagina waar je details van aankoop invult en waar je de aankoop plaatst en de mail met de aankoop verzend
    public function viewDetails(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('site.shop.view_details');
        }

        // valideer de user input van de koper gegevens
        $validatedData = $request->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'digits:10','regex:/^([0-9\s\-\+\(\)]*)$/'],
            'street' => ['required', 'string', 'max:255'],
            'streetnr' => ['required', 'numeric', 'digits_between:1,10'],
            'zip' => ['required', 'numeric',  'digits:4'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        // maak een uniek ordernummer aan die nog niet bestaat in de database
        do {
            $ordernr = Str::random(10);
        } while (Order::where('order_nr', $ordernr)->exists());

        // haalt de cart data uit de session storage om deze te gebruiken in de order_products tabel
        $cart = $request->session()->get('cart', []);

        // controleert of de hoeveelheid van een product niet groter is dan de stock
        foreach ($cart as $item) {
            // haalt de stock op van het product in de database
            $pivot = DB::table('product_size_pivot')
                        ->where('product_id', $item['product_id'])
                        ->where('size_id', $item['size_id'])
                        ->first();

            // Als de hoeveelheid van een product groter is dan de stock, redirect naar de cart pagina met een error message
            if ($item['quantity'] > $pivot->stock) {
                return redirect()->route('checkout.view.cart')->with('error', 'De hoeveelheid van een bepaald product is is niet meer in stock!');
            }
        }

        // berekent totale prijs van alle items
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // maak een order aan met de gegevens van de koper
        $order = Order::create([
            'order_nr' => $ordernr,
            'total_price' => $totalPrice,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'street' => $request->street,
            'streetnr' => $request->streetnr,
            'zip' => $request->zip,
            'city' => $request->city,
        ]);     
        
        foreach ($cart as $item) {
            // haalt de stock op van het product in de database
            $pivot = DB::table('product_size_pivot')
                        ->where('product_id', $item['product_id'])
                        ->where('size_id', $item['size_id'])
                        ->first();
        
            // verlaagt stock met het aantal gekochte producten
            $newStock = $pivot->stock - $item['quantity'];
        
            // Update de stock in de database
            DB::table('product_size_pivot')
                ->where('product_id', $item['product_id'])
                ->where('size_id', $item['size_id'])
                ->update(['stock' => $newStock]);
        
            // maakt een nieuwe order_products aan met de gegevens van de bestelling
            $order->products()->attach($item['product_id'], [
                'order_nr' => $order->order_nr,
                'size_id' => $item['size_id'],
                'quantity' => $item['quantity'],
                'created_at' => now(),
            ]);
        } 

        // maakt een array aan met de gegevens van de bestelling om te gebruiken in de mail
        $details = [
            'Bestel Nummer' => $ordernr,
            'Totaal' => $totalPrice,
        ];
        
        $cart = $request->session()->get('cart');
        
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            $size = Size::find($item['size_id']);
        
            $details['Producten'][] = [
                'Afbeelding' => $product->img,
                'Naam' => $product->name,
                'Aantal' => $item['quantity'],
                'Maat' => $size->size . ' (' . $product->sizeSort->name . ')',
            ];
        }
        
        // stuurt een mail naar de koper met de gegevens van de bestelling
        try {
            Notification::route('mail', $request->email)->notify(new PurchaseConfirmation($details));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        // verwijderd de cart data uit de session storage
        $request->session()->forget('cart');

        return redirect()->route('checkout.order.placed', ['order_nr' => $order->order_nr]);

    }

    // pagina waar je de geplaatste bestelling ziet
    public function orderPlaced(Request $request, $order_nr)
    {
        $order = Order::with('products')->where('order_nr', $request->order_nr)->first();

        $order_products = DB::table('order_products')
                            ->where('order_nr', $request->order_nr)
                            ->get();

        return view('site.shop.order_placed', ['order' => $order, 'order_products' => $order_products]);
    }

    public function viewCart(Request $request)
    {
        $cart = [];
        $totalPrice = 0;

        $cart = $request->session()->get('cart', []);

        // haalt op voor elk item in de cart de product naam, size naam, size sort naam en afbeelding en berekent de totale prijs van alle items
        foreach ($cart as $key => &$item) {
            $product = Product::find($item['product_id']);
            $size = Size::find($item['size_id']);
            $size_sort = Size_sort::find($size ? $size->size_sort : null);

            $item['product_name'] = $product ? $product->name : 'Product niet gevonden';
            $item['size_name'] = $size ? $size->size : 'Maat niet gevonden';
            $item['size_sort_name'] = $size_sort ? $size_sort->name : 'Maat soort niet gevonden';
            $item['img'] = $product ? $product->img : 'Geen afbeelding gevonden';

            // haalt stock op van het product en de maat in de database
            $stock = $product->sizes()->where('size_id', $size->id)->first()->pivot->stock;

            // controleert of de hoeveelheid van een product niet groter is dan de stock
            if ($item['quantity'] > $stock) {
                // zet de hoeveelheid van het item gelijk aan de stock
                $item['quantity'] = $stock;

                // als de hoeveelheid 0 is, verwijder het item uit de cart
            if ($item['quantity'] == 0) {
                unset($cart[$key]);
                continue;
            }

                // flash een error message
                $request->session()->flash('error', 'Het aantal van sommige items is aangepast door veranderingen in stock!');
            }

            // berekent de totale prijs van alle items
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // plaatst de geupdated cart data terug in de session storage
        $request->session()->put('cart', $cart);

        // return de cart pagina met de cart data en de totale prijs
        return view('site.shop.cart', ['cart' => $cart, 'totalPrice' => $totalPrice]);
    }

    public function addToCart(Request $request, $productId)
    {
        // haalt het product op uit de database
        $product = Product::find($productId);

        // haalt de size op uit de request
        $size = $request->input('size');

        // haalt de stock op van het product en de maat in de database
        $stock = $product->sizes()->where('size_id', $size)->first()->pivot->stock;

        // maak een unieke key aan voor dit product-size combinatie
        $key = $productId . '-' . $size;

        // haalt de cart data op uit de session storage
        $cart = $request->session()->get('cart', []);

        // controleert of het item al bestaat in de cart
        if (isset($cart[$key])) {
            // controleert of de hoeveelheid van een product niet groter is dan de stock
            if ($cart[$key]['quantity'] + 1 > $stock) {
                // redirect terug met een error message
                return back()->with('error', 'Er zijn niet genoeg stuks in stock om dit toe te voegen!');
            }

            // verhoog de hoeveelheid van het item met 1
            $cart[$key]['quantity']++;
        } else {
            // controleert of stock kleiner is dan 1
            if ($stock < 1) {
                // redirect terug met een error message
                return back()->with('error', 'Het product is niet meer in stock!');
            }

            // voeg het item toe aan de cart
            $cart[$key] = [
                'product_id' => $productId,
                'product_img' => $product->img,
                'product_name' => $product->name,
                'size_id' => $size,
                'size_sort' => $product->size_sort,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        // plaatst de geupdate cart data terug in de session storage
        $request->session()->put('cart', $cart);

        // redirect terug naar de cart pagina met een success message
        return back()->with('success', 'Het product is toegevoegd aan uw winkelwagen');
    }

    public function RemoveFromCart(Request $request, $productId, $size)
    {
         // maak een unieke key aan voor dit product-size combinatie
        $key = $productId . '-' . $size;

        // haalt de cart data op uit de session storage
        $cart = $request->session()->get('cart', []);

        // controleert of het item bestaat in de cart
        if (isset($cart[$key])) {
            // verwijderd het item uit de cart
            unset($cart[$key]);
        }

        // plaatst de cart data terug in de session storage
        $request->session()->put('cart', $cart);

        // redirect terug naar de cart pagina met een success message
        return back()->with('remove', 'Het item is verwijderd uit uw winkelwagen');

    }
}
