<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect('/login'); // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
        }

        // Vérifier si l'utilisateur est un administrateur
        if (!auth()->user()->isAdmin()) {
            abort(403); // Retourner une erreur 403 (Accès interdit) si l'utilisateur n'est pas un administrateur
        }

        return $next($request);
    }
}
