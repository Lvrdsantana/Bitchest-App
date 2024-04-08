<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoMonnaiesTable extends Migration
{
    public function up()
    {
        Schema::create('CryptoMonnaies', function (Blueprint $table) {
            $table->id('crypto_id');
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('CryptoMonnaies');
    }
}
