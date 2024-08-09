<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Social;
use App\Models\Project;
use App\Models\Portfolio;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function view(Request $request): View
    {
        $user = auth()->user()->load('projects', 'socials');
    
        return view('profile.view', [
            'user' => $user,
            'projects' => $user->projects,
            'socials' => $user->socials,
        ]);
    }
    
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
    
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
    
        $user->fill($request->validated());
    
        $user->phone_number = $request->input('phone_number');
        $user->location = $request->input('location');
    
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        $user->save();
    
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

    public function show($userId)
    {
        $user = User::findOrFail($userId); 
        $socials = Social::where('user_id', $userId)->first();
        $portfolio = Portfolio::where('user_id', $userId)->first();
        $alumniUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'alumni');
        })->get();
    
        if (!$alumniUsers->contains($user)) {
            abort(403, 'Unauthorized Action.');
        }
    
        return view('profile.show', [
            'user' => $user,
            'projects' => $user->projects,
            'socials' => $socials,
            'portfolio' => $portfolio,
        ]);
    }
      
}
