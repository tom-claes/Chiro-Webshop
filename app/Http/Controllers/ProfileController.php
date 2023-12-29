<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        
        $rules = [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'bio' => ['string', 'max:10000'],
            'birthdate' => ['required', 'date'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ];
        
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = strtolower($file->guessExtension());
            if (in_array($extension, ['jpeg', 'JPEG', 'png', 'PNG', 'jpg', 'JPG'])) {
                $rules['img'] = ['nullable', 'image', 'max:2048'];
            } else {
                return back()->withErrors(['img' => 'The img field must be a file of type: jpeg, png, jpg.']);
            }
        }

        $updateData = [
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'username' => $request->username,
            'bio' => $request->bio,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
        ];
    
        if ($request->hasFile('img')) {
            $imagePath = 'storage/' . $request->file('img')->store('IMG', 'public');
            $updateData['img'] = $imagePath;
        }
    
        $user->update($updateData);

        
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
