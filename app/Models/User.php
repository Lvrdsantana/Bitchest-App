<?php

namespace App\Models;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Balance;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'temporary_password',
        'balance_eur'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Détermine si l'utilisateur est un administrateur.
     *
     * @return bool
     */
    public function isAdmin()
{
    // Vérifie si un admin avec cet e-mail existe dans la table admins
    return Admin::where('email', $this->email)->exists();
}

public function balance()
{
    return $this->hasOne(Wallet::class);
}
 // Relation avec les transactions
 public function transactions()
 {
     return $this->hasMany(Transaction::class, 'user_id', 'user_id');
 }

 // Relation avec le portefeuille
 public function wallet()
 {
     return $this->hasMany(Wallet::class, 'user_id', 'user_id');
 }
}