<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Size;

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

    public function addToBasket(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'size' => 'required|exists:sizes,id',
        ]);

        // Get the size from the request
        $size = Size::find($request->size);

        // Check if the size is in stock
        if ($size->pivot->stock > 0) {
            // Add the product to the basket
            // This depends on how you're handling the basket. 
            // For example, if you're using sessions to store the basket:
            $basket = session()->get('basket', []);
            $basket[] = ['product_id' => $product->id, 'size_id' => $size->id];
            session()->put('basket', $basket);

            // Decrease the stock
            $size->pivot->stock--;
            $size->pivot->save();

            return redirect()->back()->with('success', 'Product added to basket');
        } else {
            return redirect()->back()->with('error', 'This size is out of stock');
        }
    }
}
