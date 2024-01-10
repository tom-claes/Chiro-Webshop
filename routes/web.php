<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', function () { return view('site.shop.homepage');})->name('home');


/* AUTHENTICATION PAGES */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/* END AUTHENTICATION PAGES */

/* CHECKOUT PAGES */
Route::prefix('checkout/')->name('checkout.')->group(function () {

    Route::get('/winkelwagen', [CheckoutController::class, 'viewCart'])->name('view.cart');

    Route::match(['get', 'post'],'/gegevens', [CheckoutController::class, 'viewDetails'])->name('view.details');

    Route::get('/afrekenen', [CheckoutController::class, 'checkout'])->name('checkout');

    Route::get('bestelling+geplaatst/{order_nr}', [CheckoutController::class, 'orderPlaced'])->name('order.placed');

    Route::post('add+to+basket/{productId}', [CheckoutController::class, 'addToCart'])->name('add.toCart');

    Route::delete('remove+from+basket/{productId}/{size}', [CheckoutController::class, 'removeFromCart'])->name('remove.fromCart');


});
/* END CHECKOUT PAGES */

/* SHOP PAGES */
Route::prefix('shop/')->name('shop.')->group(function () {

    Route::get('{categoryId}', [ShopController::class, 'category'])->name('category');

    Route::get('product/{productId}', [ShopController::class, 'product'])->name('product');
});
/* END SHOP PAGES */

/* SUPORT PAGES */
Route::prefix('support/')->name('support.')->group(function () {

    Route::get('nieuws', [SupportController::class, 'news'])->name('news');

    Route::get('faq/categoriën', [SupportController::class, 'faqCategory'])->name('faq.category');

    Route::get('faq/{faqCategoryId}', [SupportController::class, 'faq'])->name('faq');

    Route::match(['get', 'post'], 'contact', [SupportController::class, 'contact'])->name('contact');

    Route::match(['get', 'post'], 'user/{userId}', [SupportController::class, 'userpage'])->name('userpage');

    Route::get('about', [SupportController::class, 'about'])->name('about');
    
});
/* END SUPORT PAGES */

/* ADMIN PAGES */
Route::prefix('admin/')->name('admin.')->middleware('auth', 'admin' )->group(function () {
    Route::match(['get', 'post'], '/', [AdminController::class, 'login'])->middleware('guest')->name('login');

    Route::get('dashboard', function () {
        return view('site.admin.dashboard');
    })->name('dashboard');

    Route::get('bestellingen', [AdminController::class, 'orders'])->name('orders');

    Route::post('catalogus/categorien', [AdminController::class, 'categories'])->name('category');

    Route::post('catalogys/kledingsstukken', [AdminController::class, 'clothingitems'])->name('clothingitems');

    Route::get('catalogus', [AdminController::class, 'catalogus'])->name('catalogus');

    Route::match(['get', 'put'], 'catalogus/edit/categorie/{categoryId}', [AdminController::class, 'editCategories'])->name('edit.category');

    Route::match(['get', 'put'], 'catalogus/edit/kledingstuk/{clothingItemId}', [AdminController::class, 'editClothingitems'])->name('edit.clothingitem');

    Route::get('faq', [AdminController::class, 'faq'])->name('faq');

    Route::post('faq/post/category', [AdminController::class, 'postFaqCategory'])->name('faq.post.category');

    Route::post('faq/post/item', [AdminController::class, 'postFaqItem'])->name('faq.post.item');

    Route::match(['get', 'put'], 'faq/edit/category/{categoryId}', [AdminController::class, 'editFaqCategory'])->name('faq.edit.category');

    Route::match(['get', 'put'], 'faq/edit/item/{faqId}', [AdminController::class, 'editFaqItem'])->name('faq.edit.item');

    Route::match(['get', 'post'], 'news', [AdminController::class, 'news'])->name('news');

    Route::match(['get', 'put'], 'news/{newsItemId}', [AdminController::class, 'updateNewsItem'])->name('update.newsitem');

    Route::get('contact', [AdminController::class, 'contact'])->name('contact');

    Route::match(['get', 'post'], 'users', [AdminController::class, 'users'])->name('users');

    Route::get('size', [AdminController::class, 'size'])->name('size');

    Route::post('size/sort', [AdminController::class, 'sizeSort'])->name('size.sort');

    Route::post('size/size', [AdminController::class, 'sizeSize'])->name('size.size');

    Route::match(['get', 'put'], 'size/edit/size/{sizeId}', [AdminController::class, 'editSize'])->name('size.edit.size');

    Route::match(['get', 'put'], 'size/edit/sort/{sizeSortId}', [AdminController::class, 'editSizeSort'])->name('size.edit.sizesort');

    Route::get('stocks', [AdminController::class, 'stocks'])->name('stocks');

    Route::get('stock/{productId}', [AdminController::class, 'stock'])->name('stock');

    Route::put('stock/{productId}/{sizeId}', [AdminController::class, 'updateStock'])->name('update.stock');

    Route::get('/stock/{id}', [AdminController::class, 'show'])->name('stock.show');

    Route::match(['get', 'post'], 'view+user/{userId}', [AdminController::class, 'view_user'])->name('view.user');

    Route::put('make+admin/{userId}', [AdminController::class, 'make_admin'])->name('make.admin');

    Route::put('remove+admin/{userId}', [AdminController::class, 'remove_admin'])->name('remove.admin');

    Route::delete('verwijder+product/{productId}', [AdminController::class, 'deleteProduct'])->name('delete.product');

    Route::delete('verwijder+contactform/{contactFormId}', [AdminController::class, 'deleteContactform'])->name('delete.contactform');

    Route::delete('niews+item/{newsItemId}', [AdminController::class, 'deleteNewsItem'])->name('delete.newsitem');

    Route::delete('verwijder+faq+item/{faqItemId}', [AdminController::class, 'deleteFaqItem'])->name('delete.faqitem');

    Route::delete('verwijder+faq+categorie/{faqCategoryId}', [AdminController::class, 'deleteFaqCategory'])->name('delete.faqcategory');

    Route::delete('verwijder+maat/{sizeId}', [AdminController::class, 'deleteSize'])->name('delete.size');

    Route::delete('verwijder+maat+categorie/{sizeSortId}', [AdminController::class, 'deleteSizeSort'])->name('delete.sizesort');

    Route::delete('verwijder+product+categorie/{categoryId}', [AdminController::class, 'deleteProductCategory'])->name('delete.productcategory');


});
/* END ADMIN PAGES */

/* EMAIL PAGES */
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
/* END EMAIL PAGES */


require __DIR__.'/auth.php';

