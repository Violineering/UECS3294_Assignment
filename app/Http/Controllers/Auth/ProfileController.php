<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
            
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'sometimes|boolean',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
        
        // Only validate password if any password field is filled
        if ($request->filled('current_password') || $request->filled('new_password')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);
            
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect']);
            }
            
            $validated['password'] = Hash::make($request->new_password);
        }
        
        // Profile image handling
        if ($request->remove_image) {
            Storage::delete($user->profile_image);
            $validated['profile_image'] = null;
        } elseif ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_pic', 'public');
            $validated['profile_image'] = $path;
        }
        
        $user->update($validated);
        
        return back()->with('success', 'Profile updated successfully!');
    }
}