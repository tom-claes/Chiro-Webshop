<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product_category;
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

    public function categories(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('site.admin.categories');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Product_category::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }

    public function clothingitems(Request $request)
    {
        if ($request->isMethod('get'))
        {
            $categories = Product_category::orderBy('name')->get();
    
            return view('site.admin.clothingitems', compact('categories'));
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'size_sort' => ['required', 'in:Kinderen,Volwassenen'],
            'category' => ['required', 'exists:product_categories,id'],
            'img' => ['required', 'image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);
        
        $imagePath = $request->file('img')->store('img');

        Auth::user()->update(['img' => $imagePath]);
    
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'size_sort' => $request->size_sort,
            'category' => $request->category,
            'img' => $imagePath,
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', `Het item genaamd "$product->name" werd succesvol aangemaakt!`);
    }
}
