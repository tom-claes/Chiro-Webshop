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
}
