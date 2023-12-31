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
        $faqCategories = Faq_category::with('faq')->get();

        return view('site.admin.faq', compact('faqCategories'));
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
            'img' => ['image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);
        
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('IMG', 'public');
        } else {
            $imagePath = null;
        }

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
        $search = request()->query('search');
        $users = collect();
    
        if ($search) {
            $users = User::where('firstname', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->get();
        }
    
        return view('site.admin.users', ['users' => $users]);
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

    public function stocks()
    {
        $products = Product::with('sizes', 'sizeSort')->get();
            
        return view('site.admin.stocks', compact('products'));
    }

    public function stock(Request $request, $productId)
    {  
        $product = Product::where('id', $productId)->with('sizes', 'sizeSort')->first();
            
        return view('site.admin.stock', compact('product'));
    }

    public function updateStock(Request $request, $productId, $sizeId)
    {  
        // Validate the request data
        $validatedData = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        // Get the product with the given id
        $product = Product::find($productId);

        // Update the stock in the pivot table
        $product->sizes()->updateExistingPivot($sizeId, ['stock' => $request->stock]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Stock updated successfully');
    }

    public function view_user(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();

        return view('site.admin.view_user', compact('user'));
    }

    public function make_admin(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();

        $user->update(['admin' => true]);

        return redirect()->back()->with('success', $user->firstname . ' ' . $user->lastname . ' is nu een Admin');
    }

    public function remove_admin(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();

        $user->update(['admin' => false]);

        return redirect()->back()->with('remove', $user->firstname . ' ' . $user->lastname . ' is geen Admin meer');
    }
}
