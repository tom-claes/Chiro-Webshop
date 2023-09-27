<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscoveryController extends Controller
{
    //Shows discovery page
    public function show()
    {
        return view('site.discovery');
    }

    // Show discoverySettings page
    public function settings()
    {
        return view('site.discoverySettings');
    }
}
