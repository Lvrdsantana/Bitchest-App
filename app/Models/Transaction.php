<?php

// Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'crypto_id', 'transaction_type', 'quantity', 'transaction_price_eur'
    ];
}

