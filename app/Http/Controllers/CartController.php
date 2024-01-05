<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function view(Request $request)
    {
        dd('test');
        return view('site.shop.basket');
    }
}
