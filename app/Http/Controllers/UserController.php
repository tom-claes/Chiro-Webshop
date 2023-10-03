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

    public function update()
    {
        $request->validate([
            'bio' => ['required', 'string', 'max:1000'],
            'residence' => ['required', 'string', 'max:85'],
            'language' => ['required', 'max:50'],
            'pet' => ['string', 'max:42'],
            'hobby' => ['string', 'max:50'],
            'interest' => ['string', 'max:255'],
            'toy' => ['string', 'max:255'],
            'food' => ['string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
