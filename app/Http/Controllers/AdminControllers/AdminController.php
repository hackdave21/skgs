<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   // Afficher le formulaire de connexion
   public function showLoginForm()
   {
       // Vérification si déjà connecté
       if (Auth::check()) {
           return redirect()->route('admin.dashboard')->with('success', 'You are already logged in.');
       }

       return view('admin.auth.login');
   }

   // Traitement de la connexion
   public function login(Request $request)
   {
       // Validation avec messages personnalisés
       $request->validate([
           'email' => 'required|email',
           'password' => 'required',
       ], [
           'email.required' => 'L\'adresse email est obligatoire.',
           'email.email' => 'Veuillez fournir une adresse email valide.',
           'password.required' => 'Le mot de passe est obligatoire.'
       ]);

       // Tentative de connexion
       if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect()->route('admin.dashboard')->with('success', 'Login successful.');
       }

       return back()->withErrors([
           'email' => 'Les informations d\'identification ne sont pas correctes.',
       ])->withInput();
   }

   // Déconnexion
   public function logout()
   {
       Auth::logout();
       return redirect()->route('admin.login')->with('success', 'You have been logged out.');
   }
}
