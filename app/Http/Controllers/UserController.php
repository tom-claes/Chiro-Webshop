<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_Info;
use App\Models\Hobby;
use App\Models\Residence;
use App\Models\Pet;
use App\Models\Language;


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

        $pet = Pet::create([
            'pet' => $request->pet,
        ]);

        $residence = Residence::create([
            'residence' => $request->residence,
        ]);

        $hobby = Hobby::create([
            'hobby' => $request->hobby,
        ]);

        $language = Language::create([
            'language' => $request->language,
        ]);

        $user = User::create([
            'bio' => $request->bio,
            'interest' => $request->interest,
            'toy' => $request->toy,
            'food' => $request->food,
        ]);
    }
}
