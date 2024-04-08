<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\CryptoMonnaie;

class UserController extends Controller
{
    /**
     * Traitement des données du formulaire de création d'utilisateur.
     */ /**
     * Affiche la liste des utilisateurs.
     */
    public function showUsers()
    {
        // Récupérez la liste des utilisateurs depuis la base de données
        $users = User::all();

        // Passez les données des utilisateurs à la vue
        return view('admin', ['users' => $users]);
    }
    public function createUser(Request $request)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
        ]);

        // Générez un mot de passe temporaire
        $temporaryPassword = Str::random(10);

        // Créez un nouvel utilisateur avec les informations fournies
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($temporaryPassword), // Remplissez le champ 'password' avec un mot de passe temporaire crypté
            'temporary_password' => $temporaryPassword,
            'balance_eur' => 500,
        ]);

        // Redirigez l'utilisateur vers une de gestion des utilisateurs
        return redirect()->route('admin')->with('success', 'Utilisateur créé avec succès !');
    }
    public function edit(User $user)
    {
        return view('edit_user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'Utilisateur supprimé avec succès !');
    }
    // edition pour le dashboad admin

    public function admindestroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin')->with('success', 'Utilisateur supprimé avec succès !');
    }
    public function adminedit(User $user)
    {
        return view('edit_user', ['user' => $user]);
    }
    public function adminupdate(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);

        return redirect()->route('admin')->with('success', 'Utilisateur mis à jour avec succès !');
    }


    public function showUserAccount()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Récupérer le solde de l'utilisateur
        $balance_eur = $user->balance_eur;

        // Passer les données à la vue
        return view('UserAccount')->with('balance_eur', $balance_eur);
        // Récupérer les devises depuis la base de données
        $currencies = CryptoMonnaie::all(); // Vous pouvez ajuster cette requête selon vos besoins

        // Passer les données à la vue
        return view('UserAccount', compact('balance_eur', 'currencies'));
    }
}
