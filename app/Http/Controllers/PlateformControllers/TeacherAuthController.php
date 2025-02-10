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
        ], [
            'email.required' => 'L\'email est requis',
            'email.email' => 'Veuillez entrer un email valide',
            'password.required' => 'Le mot de passe est requis'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // L'authentification a réussi
            $request->session()->regenerate();
            return redirect()->intended(route('frontend.index'))
                           ->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'email' => 'Ces identifiants sont invalides.'
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.login')
                        ->with('success', 'Déconnexion réussie.');
    }


}
