<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //Show profile Page
    public function show()
    {
        $user = auth()->user();
        return view('site.user', ['user' => $user]);
    }

}
