<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('from_coin_symbol')->nullable();
            $table->string('to_coin_symbol')->nullable();
            $table->text('from_coin_des')->nullable();
            $table->text('to_coin_des')->nullable();
            $table->string('from_coin_whitepaper_url')->nullable();
            $table->string('to_coin_whitepaper_url')->nullable();
            $table->string('from_coin_officialsite_url')->nullable();
            $table->string('to_coin_officialsite_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
