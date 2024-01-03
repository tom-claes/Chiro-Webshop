<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function view(Request $request)
    {
        return view('site.shop.cart');
    }
}
