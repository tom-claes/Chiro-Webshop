<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


//AUTHENTICATION
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/* SHOP PAGES */
Route::get('/', function () {
    return view('site.shop.homepage');
})->name('home');

Route::get('/product+category', function () {
    return view('site.shop.product_category');
})->name('product_category');

Route::get('/product', function () {
    return view('site.shop.product');
})->name('product');

Route::get('/basket', function () {
    return view('site.shop.basket');
})->name('basket');
/* END SHOP PAGES */

/* SUPORT PAGES */
Route::get('/contact', function () {
    return view('site.support.contact');
})->name('contact');
Route::get('/faq+category', function () {
    return view('site.support.faq_category');
})->name('faq_category');
Route::get('/faq', function () {
    return view('site.support.faq');
})->name('faq');
Route::get('/user', function () {
    return view('site.support.my_userpage');
})->name('userpage');
Route::get('/news', function () {
    return view('site.support.news');
})->name('news');

/* END SUPORT PAGES */



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

