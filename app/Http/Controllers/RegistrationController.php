<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Signup');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'max:254', 'unique:App\Models\User'],
            'password' => ['required', 'confirmed', Password::min(8)->max(254)->letters()->numbers()->symbols()],
        ]);

        User::create($attributes);

        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Error occurred signing up. Please try again.',
            ]);
        }

        request()->session()->regenerate();

        return redirect(route('welcome'));
    }
}
