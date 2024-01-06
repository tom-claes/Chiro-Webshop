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
        // Get the product from the database
        $product = Product::find($productId);

        // Get the size from the request
        $size = $request->input('size');

        // Create a unique key for this product-size combination
        $key = $productId . '-' . $size;

        // Get the cart from the session
        $cart = $request->session()->get('cart', []);

        // Check if the item already exists in the cart
        if (isset($cart[$key])) {
            // Increment the quantity
            $cart[$key]['quantity']++;
        } else {
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
