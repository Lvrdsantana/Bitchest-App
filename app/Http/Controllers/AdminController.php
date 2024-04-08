<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function editAdmin()
    {
        // Récupérer l'administrateur actuellement authentifié
        $admin = Auth::guard('admin')->user();
        
        // Passer les données de l'administrateur à la vue
        return view('editadmin', ['admin' => $admin]);
    }

    /**
     * Met à jour les données de l'administrateur.
     */
    public function update(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . (Auth::guard('admin')->user() ? Auth::guard('admin')->user()->admin_id : 'NULL') . ',admin_id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Récupérer l'administrateur actuellement authentifié
        $admin = Auth::guard('admin')->user();

        // Mettre à jour l-es données de l'administrateur
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        // Rediriger avec un message de succès
        return Redirect::route('admin')->with('edit sucess');
    }

}
