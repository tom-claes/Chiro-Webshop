<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product_category;
use App\Models\Faq_category;
use App\Models\Faq;
use App\Models\Product;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('site.admin.login');
        }

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials['admin'] = true;

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();

            return redirect()->route('admin.dashboard')->with('success', 'You are logged in as an admin!');
        }

        return redirect()->route('admin.login')->with('error', 'Your credentials are incorrect');
    }

    public function catalogus(){
        $categories = Product_category::orderBy('name')->get();
    
        return view('site.admin.clothingitems', compact('categories'));
    }

    public function categories(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Product_category::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.category')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }

    public function clothingitems(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'size_sort' => ['required', 'in:Kinderen,Volwassenen'],
            'category' => ['required', 'exists:product_categories,id'],
            'price' => ['required', 'numeric'],
            'img' => ['required', 'image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);
        
        $imagePath = $request->file('img')->store('IMG', 'public');


        Auth::user()->update(['img' => $imagePath]);
    
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'size_sort' => $request->size_sort,
            'category' => $request->category,
            'price' => $request->price,
            'img' => $imagePath,
        ]);

        return redirect()
            ->route('admin.clothingitems')
            ->with('success', `Het item genaamd "$product->name" werd succesvol aangemaakt!`);
    }

    public function faq()
    {
        $categories = Faq_category::all();

        return view('site.admin.faq', compact('categories'));
    }


    public function postFaqCategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Faq_category::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.faq_categories')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }


    public function postFaqItem(Request $request)
    {
        $request->validate([
            'category' => ['required', 'exists:faq_categories,id'],
            'question' => ['required', 'string', 'max:255'], // blijkbaar max lengte van Quora vraag
            'answer' => ['required', 'string', 'max:10000'] // blijkbaar max lengte van Quora antwoord
        ]);

        

        $category = Faq::create([
            'categroy' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return redirect()
            ->route('admin.faq_categories')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }
}
