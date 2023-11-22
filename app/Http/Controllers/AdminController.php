<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product_category;


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

    public function categories(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('site.admin.categories');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Product_category::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', `De categorie genaamd "$category->name" werd succesvol aangemaakt!`);
    }
}
