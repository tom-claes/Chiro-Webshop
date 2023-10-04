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


        // MAKING VARIABLES ACCESIBLE OUTSIDE IF
        $pet = null;
        $residence = null;
        $hobby = null;
        $language = null;


        // IF FIELDS ARE NOT EMPTY
        if($request->pet){
            $get_pet = Pet::where('pet', $request->pet)->first();
            
            if($get_pet){
                $pet = $get_pet;
            }
            else{
                $pet = Pet::create([
                    'pet' => $request->pet,
                ]);
            }
        };

        if($request->residence){
            $get_residence = Residence::where('residence', $request->residence)->first();
            
            if($get_residence){
                $residence = $get_residence;
            }
            else{
                $residence = Residence::create([
                    'residence' => $request->residence,
                ]);
            }
        };

        if($request->hobby){
            $get_hobby = Hobby::where('hobby', $request->hobby)->first();
            
            if($get_hobby){
                $hobby = $get_hobby;
            }
            else{
                $hobby = Hobby::create([
                    'hobby' => $request->hobby,
                ]);
            }
        };

        if($request->language){
            $get_language = Language::where('language', $request->language)->first();
            
            if($get_language){
                $language = $get_language;
            }
            else{
                $language = Language::create([
                    'language' => $request->language,
                ]);
            }
        };

        // MAKING USER_INFO

        // haal authenticatiegegevens van user op
        $userID = auth()->user()->id;

        // kijk of deze user al user_info heeft => geeft boolean terug
        $has_user_info = User_Info::where('id', $userID)->exists();



        // als de user al user info heeft => updaten
        if($has_user_info){
            $has_user_info->bio = $request->bio;
            $has_user_info->interest = $request->interest;
            $has_user_info->toy = $request->toy;
            $has_user_info->food = $request->food;
            $has_user_info->pet = $pet;
            $has_user_info->hobby = $hobby;
            $has_user_info->residence = $residence;
            $has_user_info->language = $language;

        }
        // als de user nog geen info heeft => maak user_info aan
        else{
            $user_info = User_Info::create([
                'id' => auth()->user()->id,
                'bio' => $request->bio,
                'interest' => $request->interest,
                'toy' => $request->toy,
                'food' => $request->food,
                'pet' => $pet,
                'hobby' => $hobby,
                'residence' => $residence,
                'language' => $language
            ]);
        }

        return redirect()
            ->route('user.update');
            //->with('success', 'Course has been deleted!');
    }
}
