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

            // Check if the quantity of each item is not higher than the stock
        foreach ($cart as $item) {
            // haalt de stock op van het product in de database
            $pivot = DB::table('product_size_pivot')
                        ->where('product_id', $item['product_id'])
                        ->where('size_id', $item['size_id'])
                        ->first();

            // If the quantity exceeds the stock, redirect back to the cart
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
        
        try {
            Notification::route('mail', $request->email)->notify(new PurchaseConfirmation($details));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        // verwijderd de cart data uit de session storage
        $request->session()->forget('cart');

        return redirect()->route('checkout.order.placed', ['order_nr' => $order->order_nr]);

    }

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

        // Fetch product names, size names, size sorts and calculate the total price
        foreach ($cart as $key => &$item) {
            $product = Product::find($item['product_id']);
            $size = Size::find($item['size_id']);
            $size_sort = Size_sort::find($size ? $size->size_sort : null);

            $item['product_name'] = $product ? $product->name : 'Product niet gevonden';
            $item['size_name'] = $size ? $size->size : 'Maat niet gevonden';
            $item['size_sort_name'] = $size_sort ? $size_sort->name : 'Maat soort niet gevonden';
            $item['img'] = $product ? $product->img : 'Geen afbeelding gevonden';

            // Fetch the stock for the product and size from the pivot table
            $stock = $product->sizes()->where('size_id', $size->id)->first()->pivot->stock;

            // Check if the quantity is smaller or the same as the stock
            if ($item['quantity'] > $stock) {
                // Set the quantity to the stock
                $item['quantity'] = $stock;

                // If the quantity is 0, remove the item from the cart
            if ($item['quantity'] == 0) {
                unset($cart[$key]);
                continue;
            }

                // Flash an error message to the session
                $request->session()->flash('error', 'Het aantal van sommige items is aangepast door veranderingen in stock!');
            }

            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Put the updated cart back in the session
        $request->session()->put('cart', $cart);

        // Pass the cart and the total price to the view
        return view('site.shop.cart', ['cart' => $cart, 'totalPrice' => $totalPrice]);
    }

    public function addToCart(Request $request, $productId)
    {
        // Get the product from the database
        $product = Product::find($productId);

        // Get the size from the request
        $size = $request->input('size');

        // Fetch the stock for the product and size from the pivot table
        $stock = $product->sizes()->where('size_id', $size)->first()->pivot->stock;

        // Create a unique key for this product-size combination
        $key = $productId . '-' . $size;

        // Get the cart from the session
        $cart = $request->session()->get('cart', []);

        // Check if the item already exists in the cart
        if (isset($cart[$key])) {
            // Check if the quantity is smaller or the same as the stock
            if ($cart[$key]['quantity'] + 1 > $stock) {
                // Redirect back with an error message
                return back()->with('error', 'Er zijn niet genoeg stuks in stock om dit toe te voegen!');
            }

            // Increment the quantity
            $cart[$key]['quantity']++;
        } else {
            // Check if the stock is at least 1
            if ($stock < 1) {
                // Redirect back with an error message
                return back()->with('error', 'Het product is niet meer in stock!');
            }

            // Add the product to the cart
            $cart[$key] = [
                'product_id' => $productId,
                'product_img' => $product->img,
                'product_name' => $product->name,
                'size_id' => $size,
                'size_sort' => $product->size_sort,
                'price' => $product->price,
                'quantity' => 1,
                // Add any other product details you need
            ];
        }

        // Put the updated cart back in the session
        $request->session()->put('cart', $cart);

        // Redirect back with a success message
        return back()->with('success', 'Het product is toegevoegd aan uw winkelwagen');
    }

    public function RemoveFromCart(Request $request, $productId, $size)
    {
         // Create a unique key for this product-size combination
        $key = $productId . '-' . $size;

        // Get the cart from the session
        $cart = $request->session()->get('cart', []);

        // Check if the item exists in the cart
        if (isset($cart[$key])) {
            // Remove the item from the cart
            unset($cart[$key]);
        }

        // Put the updated cart back in the session
        $request->session()->put('cart', $cart);

        // Redirect back with a success message
        return back()->with('remove', 'Het item is verwijderd uit uw winkelwagen');

    }
}
