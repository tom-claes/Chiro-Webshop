<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('site.admin.login');
        }

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials['admin'] = true;

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();

            return redirect()->route('admin.dashboard')->with('success', 'You are logged in as an admin!');
        }

        return redirect()->route('admin.login')->with('error', 'Your credentials are incorrect');
    }
}
