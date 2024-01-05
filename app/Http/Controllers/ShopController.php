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

            $item = [
                'product_id' => $productId,
                'size_id' => $request->size,
                'price' => $product->price, // Make sure the product has a 'price' attribute
                'quantity' => 1,
            ];

            $cart[] = $item;
            $request->session()->put('cart', $cart);
        }

        return back()->with('success', 'Het item is toegevoegd aan uw winkelwagen');
 
    }

    public function RemoveFromCart(Request $request)
    {
        
    }

    public function cart(Request $request)
    {
        $cart = [];
        $totalPrice = 0;

        if (Auth::check()) {
            // User is logged in, get cart items from database
            $cart = Cart_item::where('user_id', auth()->user()->id)->get();

            // Calculate the total price
            foreach ($cart as $item) {
                $totalPrice += $item->price * $item->quantity;
            }
        } else {
            // User is not logged in, get cart items from session
            $cart = $request->session()->get('cart', []);

            // Calculate the total price
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }

        // Pass the cart and the total price to the view
        return view('site.shop.cart', ['cart' => $cart, 'totalPrice' => $totalPrice]);
        
    }
}
