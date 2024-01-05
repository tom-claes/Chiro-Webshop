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

        return view('site.admin.clothingitems', compact('categories','size_sorts'));
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

    public function editCategories(Request $request, $categoryId)
    {
        $category = Product_category::find($categoryId);

        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.product_category', compact('category'));
        }

        $currentCategory = $category->name;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.catalogus')
            ->with('success', `De categorie genaamd "$currentCategory" werd succesvol aangepast naar "$category->name"!`);
    }

    public function deleteProductCategory($categoryId)
    {
        $category = Product_category::find($categoryId);

        if ($category) {
            $category->delete();
            return back()->with('success', 'Product categorie is verwijderd');
        }

        return back()->with('error', 'Deze actie is mislukt');
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

    public function editClothingitems(Request $request, $clothingItemId)
    {
        $product = Product::find($clothingItemId);

        if ($request->isMethod('get'))
        {
            $categories = Product_category::with('products')->get();
            $size_sorts = Size_sort::all();

            return view('site.admin.edit.product', compact('product', 'categories', 'size_sorts'));
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'size_sort' => ['required', 'exists:size_sorts,id'],
            'category' => ['required', 'exists:product_categories,id'],
            'price' => ['required', 'numeric'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);

        if ($request->hasFile('img')) {
            // Delete the previous image if it exists
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
    
            $imagePath = $request->file('img')->store('IMG', 'public');
        } else {
            $imagePath = $product->img;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'size_sort' => $request->size_sort,
            'category' => $request->category,
            'price' => $request->price,
            'img' => $imagePath,
        ]);

        return redirect()
            ->route('admin.catalogus')
            ->with('success', 'Het product "' . $product->name . '" is succesvol aangepast');
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $product->delete();
            return back()->with('success', 'Product is verwijderd');
        }

        return back()->with('error', 'Deze actie is mislukt');
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

    public function deleteFaqItem($faqItemId)
    {
        $faqItem = Faq::find($faqItemId);

        if ($faqItem) {
            $faqItem->delete();
            return back()->with('success', 'FAQ item is verwijderd');
        }

        return back()->with('error', 'Deze actie is mislukt');
    }

    public function deleteFaqCategory($faqCategoryId)
    {
        $faqCategory = Faq_category::find($faqCategoryId);

        if ($faqCategory) {
            $faqCategory->delete();
            return back()->with('success', 'FAQ categorie is verwijderd');
        }

        return back()->with('error', 'Deze actie is mislukt');
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

    public function deleteNewsItem($newsId)
    {
        $news = Latest_news::find($newsId);

        if ($news) {
            $news->delete();
            return back()->with('success', 'Nieuws item is verwijderd');
        }

        return back()->with('error', 'Deze actie is mislukt');
    }

    public function contact(Request $request)
    {
        $search = $request->query('search');
        $contactForms = Contact_form::when($search, function ($query, $search) {
            return $query->where('firstname', 'like', "%{$search}%")
                         ->orWhere('lastname', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('subject', 'like', "%{$search}%");
        })->get();
        return view('site.admin.contact', compact('contactForms'));
    }

    public function deleteContactform($contactFormId)
    {
        $contactForm = Contact_form::find($contactFormId);

        if ($contactForm) {
            $contactForm->delete();
            return back()->with('success', 'Contactform is verwijderd');
        }

        return back()->with('error', 'Deze actie is mislukt');
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

    public function deleteSize($sizeId)
    {
        $size = Size::find($sizeId);

        if ($size) {
            $size->delete();
            return back()->with('success', 'Maat is verwijderd');
        }

        return back()->with('error', 'Deze actie is mislukt');
    }

    public function editSize(Request $request, $sizeId)
    {
        $size = Size::find($sizeId);

        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.size', compact('size'));
        }

        $request->validate([
            'size' => ['required', 'string', 'max:255'],
        ]);

        $size->update([
            'size' => $request->size,
        ]);

        return redirect()
            ->route('admin.size')
            ->with('success', 'De maat is succesvol aangepast');
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

    public function editSizeSort(Request $request, $sizeSortId)
    {
        $size_sort = Size_sort::find($sizeSortId);

        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.size_sort', compact('size_sort'));
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $size_sort->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.size')
            ->with('success', 'De maat categorie is succesvol aangepast');
    }

    public function deleteSizeSort($sizeSortId)
    {
        $size_sort = Size_sort::find($sizeSortId);

        if ($size_sort) {
            $size_sort->delete();
            return back()->with('success', 'Maat categorie is verwijderd');
        }

        return back()->with('error', 'Deze actie is mislukt');
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
