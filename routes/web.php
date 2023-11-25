<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;


//AUTHENTICATION
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('site.shop.homepage');
})->name('home');

/* SHOP PAGES */
Route::prefix('shop/')->name('shop.')->group(function () {
    Route::get('/product+category/{category}', function () {
        return view('site.shop.product_category');
    })->name('product_category');

    Route::get('/product', function () {
        return view('site.shop.product');
    })->name('product');

    Route::get('/basket', function () {
        return view('site.shop.basket');
    })->name('basket');
});
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

/* ADMIN PAGES */
Route::prefix('admin/')->name('admin.')->group(function () {
    Route::match(['get', 'post'], '/', [AdminController::class, 'login'])->middleware('guest')->name('login');

    Route::get('dashboard', function () {
        return view('site.admin.dashboard');
    })->name('dashboard');

    Route::get('bestellingen', function () {
        return view('site.admin.orders');
    })->name('orders');

    Route::match(['get', 'post'], 'categoriën', [AdminController::class, 'categories'])->name('categories');

    Route::match(['get', 'post'], 'kledingstukken', [AdminController::class, 'clothingitems'])->name('clothingitems');

    Route::get('contact', function () {
        return view('site.admin.contact');
    })->name('contact');
});
/* END ADMIN PAGES */


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

