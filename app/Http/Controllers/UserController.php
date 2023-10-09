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
        $user_info = User_Info::where('user_id', $user->id)->first();
        return view('site.user', ['user' => $user, 'user_info' => $user_info]);

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

        // haal authenticatiegegevens van user op
        $user = auth()->user();

        // kijk of deze user al user_info heeft => geeft boolean terug
        $user_info = User_Info::where('id', $user->id)->first();


        if ($user_info) {
            $residence = Residence::firstOrCreate(['residence' => $request->residence]);
            $user_info->residence()->sync([$residence->residence]);

            $language = Language::firstOrCreate(['language' => $request->language]);
            $user_info->language()->sync([$language->language]);
            
            if($request->pet != null){
                $pet = Pet::firstOrCreate(['pet' => $request->pet]);
                $user_info->pet()->sync([$pet->pet]);
            }

            if($request->hobby != null){
                $hobby = Hobby::firstOrCreate(['hobby' => $request->hobby]);
                $user_info->hobby()->sync([$hobby->hobby]);
            }
        }

        
        // als de user al user info heeft => updaten
        if($user_info){
            $user_info->update([
                'bio' => $request->bio,
                'interest' => $request->interest,
                'toy' => $request->toy,
                'food' => $request->food,
            ]);
        }
        // als de user nog geen info heeft => maak user_info aan
        else{
            $user_info = User_Info::create([
                'user_id' => auth()->user()->id,
                'bio' => $request->bio,
                'interest' => $request->interest,
                'toy' => $request->toy,
                'food' => $request->food,
            ]);
        }

        return redirect()
            ->route('user.update');
            //->with('success', 'Course has been deleted!');
    }
}
