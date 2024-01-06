<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Size;
use App\Models\Size_sort;
use App\Models\Cart_item;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function category(Request $request, $categoryId)
    {
        //haalt alle kledingstukken op die in de categorie zitten van de pagina die je hebt gekozen
        $products = Product::where('category', $categoryId)->with('sizeSort')->get();
        $category = Product_category::where('id', $categoryId)->first();
        
        return view('site.shop.product_category', ['category' => $category, 'products' => $products]);
    }

    public function product(Request $request, $productId)
    {
        $product = Product::where('id', $productId)->with('sizeSort', 'sizes')->first();
        
        return view('site.shop.product', compact('product'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $cart = $request->session()->get('cart', []);

            // Check if the product is already in the cart
            foreach ($cart as &$item) {
                if ($item['product_id'] == $productId && $item['size_id'] == $request->size) {
                    // Increase the quantity and update the price
                    $item['quantity']++;
                    $item['price'] = $product->price * $item['quantity'];
                    $request->session()->put('cart', $cart);

                    return back()->with('success', 'Het item is toegevoegd aan uw winkelwagen');
                }
            }

            // If the product is not in the cart, add it
            $item = [
                'product_id' => $productId,
                'size_id' => $request->size,
                'price' => $product->price,
                'quantity' => 1,
            ];

            $cart[] = $item;
            $request->session()->put('cart', $cart);
        }

        return back()->with('success', 'Het item is toegevoegd aan uw winkelwagen');
    }

    public function RemoveFromCart(Request $request, $productId)
    {
        // Get the cart from the session
        $cart = $request->session()->get('cart', []);

        // Filter out the items with the specified product ID
        $cart = array_values(array_filter($cart, function ($item) use ($productId) {
            return $item['product_id'] != $productId;
        }));

        // Put the updated cart back in the session
        $request->session()->put('cart', $cart);

        // Redirect back with a success message
        return back()->with('success', 'Het item is verwijderd uit uw winkelwagen');
    }

    public function cart(Request $request)
    {
        $cart = [];
        $totalPrice = 0;

        /*if (Auth::check()) {
            // User is logged in, get cart items from database
            $cart = Cart_item::where('user_id', auth()->user()->id)->get();

            // Calculate the total price
            foreach ($cart as $item) {
                $totalPrice += $item->price * $item->quantity;
            }
        } else {*/
            // User is not logged in, get cart items from session
            $cart = $request->session()->get('cart', []);

            // Fetch product names, size names, size sorts and calculate the total price
            foreach ($cart as &$item) {
                $product = Product::find($item['product_id']);
                $size = Size::find($item['size_id']);
                $size_sort = Size_sort::find($size ? $size->size_sort : null);

                $item['product_name'] = $product ? $product->name : 'Product not found';
                $item['size_name'] = $size ? $size->size : 'Size not found';
                $item['size_sort_name'] = $size_sort ? $size_sort->name : 'Size sort not found';
                $item['img'] = $product ? $product->img : 'Geen afbeelding gevonden';

                $totalPrice += $item['price'] * $item['quantity'];
            }
        //}

        // Pass the cart and the total price to the view
        return view('site.shop.cart', ['cart' => $cart, 'totalPrice' => $totalPrice]);
    }
}
