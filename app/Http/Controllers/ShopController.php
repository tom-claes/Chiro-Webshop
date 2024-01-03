<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Size;
use App\Models\Size_sort;
use App\Models\Cart_item;

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
        $request->validate([
            'size' => ['required', 'string', 'max:255'],
        ]);
        if (Auth::check()) {
            // User is logged in, store in database
            $item = Cart_item::create([
                'product_id' => $productId,
                'size_id' => $request->size,
                'quantity' => 1,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            // User is not logged in, store in session
            $cart = $request->session()->get('cart', []);
            $item = [
                'product_id' => $productId,
                'size_id' => $request->size,
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
        return view('site.shop.cart');
    }
}
