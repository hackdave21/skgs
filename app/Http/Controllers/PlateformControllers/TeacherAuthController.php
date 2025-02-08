<?php

namespace App\Http\Controllers\PlateformControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherAuthController extends Controller
{

  /**
     * Affiche le formulaire de connexion des enseignants.
     */
    public function showLoginForm()
    {
        return view('frontend.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('platform.dashboard')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }

    /**
     * Déconnecte l'enseignant.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('teacher.login')->with('success', 'Logged out successfully.');
    }


}
