<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    public function up()
    {
        Schema::create('Wallets', function (Blueprint $table) {
            $table->id('wallet_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('crypto_id');
            $table->decimal('quantity', 20, 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Wallets');
    }
}
