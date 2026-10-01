<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([           // Validate the users
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create($validated);       // store it in the users table
        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([           // Validate the users
            'name' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate(); // Secure environment for the authenticated user.

            return redirect()->route('home');
        }
        throw ValidationException::withMessages([
            'credentials' => 'Sorry, Incorrect credentials',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate(); // Removes all the data related with the session.
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
