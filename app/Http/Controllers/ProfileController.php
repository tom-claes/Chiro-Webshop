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

        $request->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'bio' => ['string', 'max:10000'],
            'birthdate' => ['required', 'date'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg' ,'max:2048'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        if ($request->hasFile('img')) {
            $imagePath = 'storage/' . $request->file('img')->store('IMG', 'public');
        } else {
            $imagePath = 'IMG\default-profile-picture.png';
        }

        Auth::user()->update(['img' => $imagePath]);

        $user->update([
            'lastname' => $request->input('lastname'),
            'firstname' => $request->input('firstname'),
            'username' => $request->input('username'),
            'bio' => $request->input('bio'),
            'birthdate' => $request->input('birthdate'),
            'img' => $imagePath,
            'email' => $request->input('email'),
        ]);


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
