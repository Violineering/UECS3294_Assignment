<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Get fresh user data from database
            $user = User::where('email', $credentials['email'])->first();
            
            if (!$user) {
                Auth::logout();
                return back()->withErrors(['email' => 'User not found']);
            }

            // Changed to boolean check to match your model casting
            if ($user->is_admin === true) {  // or simply if ($user->is_admin)
                return redirect()->route('admin.bookManaging')
                    ->with('success', 'Welcome back, Administrator!');
            }
            
            // Regular user
            return redirect()->intended('/')
                ->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('status', 'You have been logged out.');
    }
}