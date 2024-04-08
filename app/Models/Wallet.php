<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    
    protected $fillable = [
        'user_id', 'crypto_id', 'quantity' ,'balance_eur'
    ];
    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'Wallets';
    

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'user_id');
    }

    public function cryptoMonnaie()
    {
        return $this->belongsTo(CryptoMonnaie::class, 'crypto_id');
    }
  
}
