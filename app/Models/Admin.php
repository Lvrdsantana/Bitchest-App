<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins'; // Nom de la table dans la base de données
    protected $primaryKey = 'admin_id';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email', // Assurez-vous d'inclure tous les champs que vous souhaitez pouvoir assigner massivement
        'password', // Incluez le mot de passe si vous gérez l'authentification des administrateurs séparément
        'name'
    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Cachez le mot de passe lors de la conversion du modèle en tableau ou JSON
    ];
}