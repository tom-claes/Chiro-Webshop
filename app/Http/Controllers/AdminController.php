<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Models\Product_category;
use App\Models\Faq_category;
use App\Models\Faq;
use App\Models\Latest_news;
use App\Models\Product;
use App\Models\Contact_form;
use App\Models\Size;
use App\Models\Size_sort;


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
        $categories = Product_category::with('products')->get();
        $size_sorts = Size_sort::all();

        return view('site.admin.clothingitems', compact('categories'), compact('size_sorts'));
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
            ->route('admin.catalogus')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }

    public function clothingitems(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'size_sort' => ['required', 'exists:size_sorts,id'],
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
            ->route('admin.catalogus')
            ->with('success', `Het item genaamd "$product->name" werd succesvol aangemaakt!`);
    }


    public function faq()
    {
        $categories = Faq_category::with('faq')->get();

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
            ->route('admin.faq')
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
            'category' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return redirect()
            ->route('admin.faq')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }

    public function news(Request $request)
    {
        if ($request->isMethod('get'))
        {
            $news = Latest_news::latest()->get();
            return view('site.admin.news', compact('news'));
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['string', 'max:10000'],
            'img' => ['required', 'image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);
        
        $imagePath = $request->file('img')->store('IMG', 'public');


        Auth::user()->update(['img' => $imagePath]);
    
        $news = Latest_news::create([
            'title' => $request->title,
            'content' => $request->content,
            'img' => $imagePath,
        ]);

        return redirect()
            ->route('admin.news')
            ->with('success', `Het item genaamd "$news->name" werd succesvol aangemaakt!`);
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('get'))
        {
            $contact = Contact_form::latest()->get();
            return view('site.admin.contact', compact('contact'));
        }
    }

    public function users(Request $request)
    {
        if ($request->isMethod('get'))
        {
            $users = User::orderBy('lastname')->get();
            return view('site.admin.users', compact('users'));
        }
    }

    public function size()
    {
        $size_sorts = Size_sort::all();

        return view ('site.admin.size', compact('size_sorts'));
    }

    public function sizeSort(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
    
        $size_sort = Size_sort::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.size')
            ->with('success', `De maat categorie: $size_sort->name is aangemaakt`);
    }

    public function sizeSize(Request $request)
    {
        $request->validate([
            'size_sort' => ['required', 'exists:size_sorts,id'],
            'size' => ['required', 'string', 'max:255'],
        ]);
    
        $size = Size::create([
            'size_sort' => $request->size_sort,
            'size' => $request->size,
        ]);

        return redirect()
            ->route('admin.size')
            ->with('success', `De maat: $size->size is aangemaakt`);
    }

    public function stock(Request $request)
    {
        if ($request->isMethod('get'))
        {

            return view('site.admin.stock');
        }
    }
}
