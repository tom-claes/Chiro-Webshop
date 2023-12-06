<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;


// Route::get('', [::class, ''])->name('');


//AUTHENTICATION
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () { return view('site.shop.homepage');})->name('home');

/* SHOP PAGES */
Route::prefix('shop/')->name('shop.')->group(function () {

    Route::get('{categoryId}', [ShopController::class, 'category'])->middleware('guest')->name('category');

    Route::get('/product', function () {
        return view('site.shop.product');
    })->name('product');

    Route::get('/basket', function () {
        return view('site.shop.basket');
    })->name('basket');
});
/* END SHOP PAGES */

/* SUPORT PAGES */
Route::prefix('support/')->name('support.')->group(function () {

    Route::get('nieuws', [SupportController::class, 'news'])->name('news');

    Route::get('faq/categoriën', [SupportController::class, 'faqCategory'])->name('faq.category');

    Route::get('faq/{itemId}', [SupportController::class, 'faq'])->name('faq');

    Route::match(['get', 'post'], 'contact', [SupportController::class, 'contact'])->name('contact');

    Route::match(['get', 'post'], 'user/{userId}', [SupportController::class, 'userpage'])->name('userpage');
    
});
/* END SUPORT PAGES */

/* ADMIN PAGES */
Route::prefix('admin/')->name('admin.')->group(function () {
    Route::match(['get', 'post'], '/', [AdminController::class, 'login'])->middleware('guest')->name('login');

    Route::get('dashboard', function () {
        return view('site.admin.dashboard');
    })->name('dashboard');

    Route::get('bestellingen', function () {
        return view('site.admin.orders');
    })->name('orders');

    Route::post('catalogus/categorien', [AdminController::class, 'categories'])->name('category');

    Route::post('catalogys/kledingsstukken', [AdminController::class, 'clothingitems'])->name('clothingitems');

    Route::get('catalogus', [AdminController::class, 'catalogus'])->name('catalogus');

    Route::get('faq', [AdminController::class, 'faq'])->name('faq');

    Route::post('faq/post/category', [AdminController::class, 'postFaqCategory'])->name('faq.post.category');

    Route::post('faq/post/item', [AdminController::class, 'postFaqItem'])->name('faq.post.item');

    Route::match(['get', 'post'], 'news', [AdminController::class, 'news'])->name('news');

    Route::match(['get', 'post'], 'contact', [AdminController::class, 'contact'])->name('contact');

    Route::match(['get', 'post'], 'users', [AdminController::class, 'users'])->name('users');
});
/* END ADMIN PAGES */


require __DIR__.'/auth.php';

