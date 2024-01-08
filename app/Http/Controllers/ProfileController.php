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
use Illuminate\Support\Facades\Storage;


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
            // Delete de vorige afbeelding uit de storage als er 1 inzit
            if ($user->img && !str_starts_with($user->img, 'IMG/')) {
                $oldImagePath = str_replace('storage/', '', $user->img);
                Storage::disk('public')->delete($oldImagePath);
            }
    
            $imagePath = $request->file('img')->store('IMG', 'public');
            $imagePath = 'storage/' . $imagePath;
    
        } else {
            $imagePath = $user->img;
        }

        $updateData = [
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'username' => $request->username,
            'bio' => $request->bio,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
            'img' => $imagePath,
        ];
    
    
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

        if ($user->img && !str_starts_with($user->img, 'IMG/')) {
            $oldImagePath = str_replace('storage/', '', $user->img);
            Storage::disk('public')->delete($oldImagePath);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
