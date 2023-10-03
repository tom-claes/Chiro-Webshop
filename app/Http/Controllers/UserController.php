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

    public function update(Request $request)
    {
        $request->validate([
            'bio' => ['required', 'max:1000'],
            'residence' => ['required', 'max:85'],
            'language' => ['required', 'max:50'],
            'pet' => ['max:42'],
            'hobby' => ['max:50'],
            'interest' => ['max:255'],
            'toy' => ['max:255'],
            'food' => ['max:255'],
        ]);

        if($request->pet){
            $get_pet = Pet::where('pet', $pet)->first();
            
            if($get_pet){
                $pet = $get_pet
            }
            else{
                $pet = Pet::create([
                    'pet' => $request->pet,
                ]);
            }
        };

        if($request->residence){
            $residence = Residence::create([
                'residence' => $request->residence,
            ]);

            $get_residence = Residence::where('residence', $residence)->first();
            
            if($get_residence){
                $residence = $get_residence
            }
            else{
                $residence = Pet::create([
                    'pet' => $request->pet,
                ]);
            }
        };

        if($request->hobby){
            $hobby = Hobby::create([
                'hobby' => $request->hobby,
            ]);
        };

        if($request->language){
            $language = Language::create([
                'language' => $request->language,
            ]);
        };

        $user = User::create([
            'bio' => $request->bio,
            'interest' => $request->interest,
            'toy' => $request->toy,
            'food' => $request->food,
        ]);
    }
}
