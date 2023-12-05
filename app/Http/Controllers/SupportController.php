<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function news()
    {
        return view('site.support.news');
    }
}
