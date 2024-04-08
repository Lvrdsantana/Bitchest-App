<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
   /**
     * Affiche la vue de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gère une demande d'authentification entrante.
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Tentative de connexion pour les administrateurs
        if (Auth::guard('admin')->attempt($credentials)) {
            // L'authentification a réussi, rediriger vers le tableau de bord de l'administrateur
            return redirect()->intended('admin');
        }
    
        // Tentative de connexion pour les utilisateurs normaux
        if (Auth::attempt($credentials)) {
            // L'authentification a réussi, rediriger vers le tableau de bord de l'utilisateur
            return redirect()->intended('dashboard');
        }
    
        // Si l'authentification échoue pour les deux, rediriger de nouveau vers le formulaire de connexion
        // avec un message d'erreur.
        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }
    /**
     * Détruit une session authentifiée.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function logout(Request $request)
{
    Auth::guard('web')->logout(); // Déconnexion de la garde 'web'
    Auth::guard('admin')->logout(); // Déconnexion de la garde 'admin'

    $request->session()->invalidate(); // Invalide la session
    $request->session()->regenerateToken(); // Régénère le token CSRF

    return redirect('/'); // Redirige vers la page d'accueil
}
}
