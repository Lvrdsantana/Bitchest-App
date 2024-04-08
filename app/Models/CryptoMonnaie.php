<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoMonnaie extends Model
{
    protected $table = 'CryptoMonnaies';

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'crypto_id');
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'crypto_id');
    }
}
