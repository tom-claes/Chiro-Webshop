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
use App\Models\Order;


class AdminController extends Controller
{

    // deze functie toont admin Bestellingen pagina en zorgt ook voor de zoekfunctie op die pagina
    public function orders(Request $request)
    {
        $search = $request->query('search');
        $orders = Order::when($search, function ($query, $search) {
            return $query->where('order_nr', 'like', "%{$search}%")
                         ->orWhere('firstname', 'like', "%{$search}%")
                         ->orWhere('lastname', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->get();
        
        return view('site.admin.orders', compact('orders'));
    }

    // deze functie verwijderd een bestelling op aanvraag van de admin
    public function deleteOrder($orderNr)
    {
        // zoek de bestelling op basis van het order_nr
        $order = Order::where('order_nr', $orderNr)->first();
    
        // als de bestelling bestaat verwijder deze dan
        if ($order) {
            $order->delete();
            return back()->with('success', 'Order is verwijderd');
        }

        // als de bestelling niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }


    // deze functies toont de catalogus pagina en haalt categorien en size_sort op voor de dropdowns in de forms
    public function catalogus(){
        $categories = Product_category::with('products')->get();
        $size_sorts = Size_sort::all();

        return view('site.admin.clothingitems', compact('categories','size_sorts'));
    }

    // deze functie maakt nieuwe categorien aan voor de kledingsstukken
    public function categories(Request $request)
    {
        // validdert de naam van de categorie
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // maakt de categorie aan
        $category = Product_category::create([
            'name' => $request->name,
        ]);

        // stuurt de admin terug naar de catalogus pagina met een success message
        return redirect()
            ->route('admin.catalogus')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }

    // deze functie haalt de pagina op waarmee je de categorie van een kledingsstuk kan aanpassen en voert ook aanpassingen uit
    public function editCategories(Request $request, $categoryId)
    {
        // haalt de categorie op die aangepast moet worden
        $category = Product_category::find($categoryId);

        // als de pagina opgevraagd wordt dan wordt de pagina getoont met de info van de categorie die is opgevraagd
        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.product_category', compact('category'));
        }

        // slaat de huidige naam van de categorie op voor de succes boodschap
        $currentCategory = $category->name;

        // valideert de nieuwe naam van de categorie
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // update de naam van de categorie
        $category->update([
            'name' => $request->name,
        ]);

        // stuurt de admin terug naar de catalogus pagina met een success message
        return redirect()
            ->route('admin.catalogus')
            ->with('success', `De categorie genaamd "$currentCategory" werd succesvol aangepast naar "$category->name"!`);
    }

    // verwijderd een categorie op aanvraag van de admin
    public function deleteProductCategory($categoryId)
    {
        // haalt de categorie op die verwijderd moet worden
        $category = Product_category::find($categoryId);

        // als de categorie bestaat verwijder deze dan
        if ($category) {
            $category->delete();
            return back()->with('success', 'Product categorie is verwijderd');
        }

        // als de categorie niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }

    // deze functie maakt nieuwe kledingsstukken aan
    public function clothingitems(Request $request)
    {
        // valideert de data van het form om een kledingsstuk aan te maken
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'size_sort' => ['required', 'exists:size_sorts,id'],
            'category' => ['required', 'exists:product_categories,id'],
            'price' => ['required', 'numeric'],
            'img' => ['required', 'image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);

        // roept functie addImage op waardoor afbeelding kan toegevoegd worden aan het kledingsstuk
        $imagePath = $this->addImage($request);
    
        // maakt het kledingsstuk aan
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'size_sort' => $request->size_sort,
            'category' => $request->category,
            'price' => $request->price,
            'img' => $imagePath,
        ]);

        // stuurt de admin terug naar de catalogus pagina met een success message
        return redirect()
            ->route('admin.catalogus')
            ->with('success', `Het item genaamd "$product->name" werd succesvol aangemaakt!`);
    }

    // deze functie haalt de pagina op waarmee je de kledingsstukken kan aanpassen en voert ook aanpassingen uit
    public function editClothingitems(Request $request, $clothingItemId)
    {
        // haalt het kledingsstuk op dat aangepast moet worden
        $product = Product::find($clothingItemId);

        // haalt de categorien en size_sorts op voor de dropdowns in het form en stuurt deze mee naar de view
        if ($request->isMethod('get'))
        {
            $categories = Product_category::with('products')->get();
            $size_sorts = Size_sort::all();

            return view('site.admin.edit.product', compact('product', 'categories', 'size_sorts'));
        }

        // valideert de data om het kledingsstuk aan te passen
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'size_sort' => ['required', 'exists:size_sorts,id'],
            'category' => ['required', 'exists:product_categories,id'],
            'price' => ['required', 'numeric'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);

        // roept de functie updateImage aan waardoor de afbeelding kan aangepast worden als dat nodig is
        $imagePath = $this->updateImage($request, $product);

        // update het kledingsstuk
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'size_sort' => $request->size_sort,
            'category' => $request->category,
            'price' => $request->price,
            'img' => $imagePath,
        ]);

        // stuurt de admin terug naar de catalogus pagina met een success message
        return redirect()
            ->route('admin.catalogus')
            ->with('success', 'Het product "' . $product->name . '" is succesvol aangepast');
    }

    // deze functie verwijdert een kledingsstuk op aanvraag van de admin
    public function deleteProduct($productId)
    {
        // haalt het kledingsstuk op dat verwijderd moet worden
        $product = Product::find($productId);

        // als het kledingsstuk bestaat verwijder deze dan
        if ($product) {
            $this->deleteImage($product);
            $product->delete();
            return back()->with('success', 'Product is verwijderd');
        }

        // als het kledingsstuk niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }

    // deze functie toont de faq pagina en haalt de categorien en faq items op
    public function faq()
    {
        $faqCategories = Faq_category::with('faq')->get();

        return view('site.admin.faq', compact('faqCategories'));
    }

    // deze functie maakt nieuwe faq categorien aan
    public function postFaqCategory(Request $request)
    {
        // valideert de naam van de categorie
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // maakt de categorie aan
        $category = Faq_category::create([
            'name' => $request->name,
        ]);

        // stuurt de admin terug naar de faq pagina met een success message
        return redirect()
            ->route('admin.faq')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }

    // deze functie maakt nieuwe faq item aan
    public function postFaqItem(Request $request)
    {
        // valideert de data om een faq item aan te maken
        $request->validate([
            'category' => ['required', 'exists:faq_categories,id'],
            'question' => ['required', 'string', 'max:255'], // blijkbaar max lengte van Quora vraag
            'answer' => ['required', 'string', 'max:10000'] // blijkbaar max lengte van Quora antwoord
        ]);

        // maakt het faq item aan
        $category = Faq::create([
            'category' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        // stuurt de admin terug naar de faq pagina met een success message
        return redirect()
            ->route('admin.faq')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }

    // deze functie haalt de pagina op waarmee je de faq items kan aanpassen en voert ook aanpassingen uit
    public function editFaqItem(Request $request, $faqId)
    {
        // haalt het faq item op dat aangepast moet worden
        $faqItem = Faq::find($faqId);
        // haalt de categorien op voor de dropdown in het form en stuurt deze mee naar de view
        $faqCategories = Faq_category::with('faq')->get();

        // als de pagina opgevraagd wordt dan wordt de pagina getoont met de info van het faq item dat is opgevraagd
        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.faq', compact('faqItem', 'faqCategories'));
        }

        // valideert de data om het faq item aan te passen
        $request->validate([
            'category' => ['required', 'exists:faq_categories,id'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:10000']
        ]);

        // update het faq item
        $faqItem->update([
            'category' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        // stuurt de admin terug naar de faq pagina met een success message
        return redirect()
            ->route('admin.faq')
            ->with('success', `De faq is succesvol aangepast!`);
    }

    // deze functie haalt de pagina op waarmee je de faq categorie kan aanpassen en voert ook aanpassingen uit
    public function editFaqCategory(Request $request, $faqCategoryId)
    {
        // haalt de faq categorie op die aangepast moet worden
        $faqCategory = Faq_category::find($faqCategoryId);

        // als de pagina opgevraagd wordt dan wordt de pagina getoont met de info van de faq categorie die is opgevraagd
        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.faq_category', compact('faqCategory'));
        }

        // valideert de data om de faq categorie aan te passen
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // update de faq categorie
        $faqCategory->update([
            'name' => $request->name,
        ]);

        // stuurt de admin terug naar de faq pagina met een success message
        return redirect()
            ->route('admin.faq')
            ->with('success', `De categorie genaamd "$faqCategory->name" werd succesvol aangepast!`);
    }

    // verwijderd een faq item op aanvraag van de admin
    public function deleteFaqItem($faqItemId)
    {
        // haalt het faq item op dat verwijderd moet worden
        $faqItem = Faq::find($faqItemId);

        // als het faq item bestaat verwijder deze dan
        if ($faqItem) {
            $faqItem->delete();
            return back()->with('success', 'FAQ item is verwijderd');
        }

        // als het faq item niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }

    // verwijderd een faq categorie op aanvraag van de admin
    public function deleteFaqCategory($faqCategoryId)
    {
        // haalt de faq categorie op die verwijderd moet worden
        $faqCategory = Faq_category::find($faqCategoryId);

        // als de faq categorie bestaat verwijder deze dan
        if ($faqCategory) {
            $faqCategory->delete();
            return back()->with('success', 'FAQ categorie is verwijderd');
        }

        // als de faq categorie niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }

    // deze functie toont de nieuws pagina en haalt de nieuws items op
    public function news(Request $request)
    {
        // haalt de nieuws items op en stuurt deze mee naar de view
        if ($request->isMethod('get'))
        {
            $news = Latest_news::latest()->get();
            return view('site.admin.news', compact('news'));
        }

        // valideert de data om een nieuws item aan te maken
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['string', 'max:10000'],
            'img' => ['image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);
        
        // roept de functie addImage aan waardoor de afbeelding kan toegevoegd worden
        $imagePath = $this->addImage($request);
    
        // maakt het nieuws item aan
        $news = Latest_news::create([
            'title' => $request->title,
            'content' => $request->content,
            'img' => $imagePath,
        ]);

        // stuurt de admin terug naar de nieuws pagina met een success message
        return redirect()
            ->route('admin.news')
            ->with('success', `Het item genaamd "$news->name" werd succesvol aangemaakt!`);
    }

    // deze functie haalt de pagina op waarmee je de nieuws items kan aanpassen en voert ook aanpassingen uit
    public function updateNewsItem(Request $request, $newsId)
    {
        // haalt het nieuws item op dat aangepast moet worden
        $news = Latest_news::find($newsId);

        // als de pagina opgevraagd wordt dan wordt de pagina getoont met de info van het nieuws item dat is opgevraagd
        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.news', compact('news'));
        }

        // valideert de data om het nieuws item aan te passen
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['string', 'max:10000'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg' ,'max:2048']
        ]);

        // roept de functie updateImage aan waardoor de afbeelding kan aangepast worden als dat nodig is
        $imagePath = $this->updateImage($request, $news);

        // update het nieuws item
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'img' => $imagePath,
        ]);

        // stuurt de admin terug naar de nieuws pagina met een success message
        return redirect()
            ->route('admin.news')
            ->with('success', 'Het nieuws item "' . $news->title . '" is succesvol aangepast');
    }

    // verwijderd een nieuws item op aanvraag van de admin
    public function deleteNewsItem($newsId)
    {
        // haalt het nieuws item op dat verwijderd moet worden
        $news = Latest_news::find($newsId);

        // als het nieuws item bestaat verwijder deze dan
        if ($news) {
            $this->deleteImage($news);
            $news->delete();
            return back()->with('success', 'Nieuws item is verwijderd');
        }

        // als het nieuws item niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }

    // deze functie toont de contact pagina en haalt de contactformulieren op en zorgt voor de zoekfunctie op deze pagina
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

    // verwijderd een contactformulier op aanvraag van de admin
    public function deleteContactform($contactFormId)
    {
        // haalt het contactformulier op dat verwijderd moet worden
        $contactForm = Contact_form::find($contactFormId);

        // als het contactformulier bestaat verwijder deze dan
        if ($contactForm) {
            $contactForm->delete();
            return back()->with('success', 'Contactform is verwijderd');
        }

        // als het contactformulier niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }

    // deze functie toont de gebruikers pagina en zorgt voor de zoekfunctie op deze pagina
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

    // deze functie toont de maat pagina en haalt de maat categorien en maten op
    public function size()
    {
        // haalt de maat categorien en maten op en stuurt deze mee naar de view
        $size_sorts = Size_sort::all();

        return view ('site.admin.size', compact('size_sorts'));
    }

    // deze functie verwijdert een maat op aanvraag van de admin
    public function deleteSize($sizeId)
    {
        // haalt de maat op die verwijderd moet worden
        $size = Size::find($sizeId);

        // als de maat bestaat verwijder deze dan
        if ($size) {
            $size->delete();
            return back()->with('success', 'Maat is verwijderd');
        }

        // als de maat niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }

    // deze functie haalt de pagina op waarmee je de maat kan aanpassen en voert ook aanpassingen uit
    public function editSize(Request $request, $sizeId)
    {
        // haalt de maat op die aangepast moet worden
        $size = Size::find($sizeId);

        // als de pagina opgevraagd wordt dan wordt de pagina getoont met de info van de maat die is opgevraagd
        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.size', compact('size'));
        }

        // valideert de data om de maat aan te passen
        $request->validate([
            'size' => ['required', 'string', 'max:255'],
        ]);

        // update de maat
        $size->update([
            'size' => $request->size,
        ]);

        // stuurt de admin terug naar de maat pagina met een success message
        return redirect()
            ->route('admin.size')
            ->with('success', 'De maat is succesvol aangepast');
    }

    // deze functie maakt nieuwe maat categorien aan
    public function sizeSort(Request $request)
    {
        // valideert de data om een maat categorie aan te maken
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
        ]);
    
        // maakt de maat categorie aan
        $size_sort = Size_sort::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        // stuurt de admin terug naar de maat pagina met een success message
        return redirect()
            ->route('admin.size')
            ->with('success', `De maat categorie: $size_sort->name is aangemaakt`);
    }

    // deze functie haalt de pagina op waarmee je de maat categorie kan aanpassen en voert ook aanpassingen uit
    public function editSizeSort(Request $request, $sizeSortId)
    {
        // haalt de maat categorie op die aangepast moet worden
        $size_sort = Size_sort::find($sizeSortId);

        // als de pagina opgevraagd wordt dan wordt de pagina getoont met de info van de maat categorie die is opgevraagd
        if ($request->isMethod('get'))
        {
            return view('site.admin.edit.size_sort', compact('size_sort'));
        }

        // valideert de data om de maat categorie aan te passen
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
        ]);

        // update de maat categorie
        $size_sort->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        // stuurt de admin terug naar de maat pagina met een success message
        return redirect()
            ->route('admin.size')
            ->with('success', 'De maat categorie is succesvol aangepast');
    }

    // verwijderd een maat categorie op aanvraag van de admin
    public function deleteSizeSort($sizeSortId)
    {
        // haalt de maat categorie op die verwijderd moet worden
        $size_sort = Size_sort::find($sizeSortId);

        // als de maat categorie bestaat verwijder deze dan
        if ($size_sort) {
            $size_sort->delete();
            return back()->with('success', 'Maat categorie is verwijderd');
        }

        // als de maat categorie niet bestaat geef dan een error
        return back()->with('error', 'Deze actie is mislukt');
    }

    // deze functie maakt nieuwe maten aan
    public function sizeSize(Request $request)
    {
        // valideert de data om een maat aan te maken
        $request->validate([
            'size_sort' => ['required', 'exists:size_sorts,id'],
            'size' => ['required', 'string', 'max:255'],
        ]);
    
        // maakt de maat aan
        $size = Size::create([
            'size_sort' => $request->size_sort,
            'size' => $request->size,
        ]);

        // stuurt de admin terug naar de maat pagina met een success message
        return redirect()
            ->route('admin.size')
            ->with('success', `De maat: $size->size is aangemaakt`);
    }

    // deze functie haalt de pagina op waarmee je het kledingstuk kan kiezen waarvan je de stock wilt aanpassen
    public function stocks()
    {
        // haalt de kledingstukken op en stuurt deze mee naar de view met de nodige data
        $products = Product::with('sizes', 'sizeSort')->get();
            
        return view('site.admin.stocks', compact('products'));
    }

    // deze functie haalt de pagina op waarmee je de stock kan aanpassen en voert ook aanpassingen uit
    public function stock(Request $request, $productId)
    {  
        // haalt het kledingstuk op waarvan je de stock wilt aanpassen en stuurt deze mee naar de view met de nodige data
        $product = Product::where('id', $productId)->with('sizes', 'sizeSort')->first();
            
        return view('site.admin.stock', compact('product'));
    }

    // deze functie past de stock aan van een kledingstuk
    public function updateStock(Request $request, $productId, $sizeId)
    {  
        // valideert de data om de stock aan te passen
        $validatedData = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        // haalt het kledingstuk op waarvan je de stock wilt aanpassen
        $product = Product::find($productId);

        // update de stock van het kledingstuk in de pivot tabel
        $product->sizes()->updateExistingPivot($sizeId, ['stock' => $request->stock]);

        return redirect()->back()->with('success', 'Stock updated successfully');
    }

    // deze functie toont de pagina waarop je de gebruiker kan bekijken
    public function view_user(Request $request, $userId)
    {
        // haalt de gebruiker op die bekeken moet worden
        $user = User::where('id', $userId)->first();

        return view('site.admin.view_user', compact('user'));
    }

    // deze functie maakt een gebruiker admin
    public function make_admin(Request $request, $userId)
    {
        // haalt de gebruiker op die admin moet worden aan de hand van het id
        $user = User::where('id', $userId)->first();

        // update de gebruiker naar admin
        $user->update(['admin' => true]);

        return redirect()->back()->with('success', $user->firstname . ' ' . $user->lastname . ' is nu een Admin');
    }

    // deze functie maakt een admin een gewone gebruiker
    public function remove_admin(Request $request, $userId)
    {
         // haalt de gebruiker op die geen admin meer moet zijn aan de hand van het id
        $user = User::where('id', $userId)->first();

        // update de gebruiker naar niet-admin
        $user->update(['admin' => false]);

        return redirect()->back()->with('remove', $user->firstname . ' ' . $user->lastname . ' is geen Admin meer');
    }

    // deze functie voegt een afbeelding toe aan een model
    public function addImage(Request $request)
    {
        // voeg de nieuwe afbeelding toe
        $imagePath = $request->file('img')->store('IMG', 'public');
        $imagePath = 'storage/' . $imagePath;

        Auth::user()->update(['img' => $imagePath]);

        // geef het pad van de afbeelding terug
        return $imagePath;
    }

    // deze functie past een afbeelding aan van een model
    public function updateImage(Request $request, $model)
    {
        // als er een afbeelding is geupload dan wordt deze toegevoegd aan het model
        if ($request->hasFile('img')) {
            // verwijder de oude afbeelding als de instantie een afbeelding heeft
            if ($model->img) {
                $oldImagePath = str_replace('storage/', '', $model->img);
                Storage::disk('public')->delete($oldImagePath);
            }
    
            // voeg de nieuwe afbeelding toe
            $imagePath = $request->file('img')->store('IMG', 'public');
            $imagePath = 'storage/' . $imagePath;
    
        } else {
            // als er geen afbeelding is geupload dan wordt de oude afbeelding behouden
            $imagePath = $model->img;
        }
    
        // update de afbeelding van het model
        $model->update([
            'img' => $imagePath,
        ]);
    
        // geef het pad van de afbeelding terug
        return $imagePath;
    }

    // deze functie verwijdert een afbeelding van een model
    public function deleteImage($model)
    {
        // als de instantie een afbeelding heeft voer de code uit
        if ($model->img) {
            // verwijder de afbeelding
            $oldImagePath = str_replace('storage/', '', $model->img);
            Storage::disk('public')->delete($oldImagePath);
        }
    }



}
