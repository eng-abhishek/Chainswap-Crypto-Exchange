<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->string('symbol',225)->nullable();
            $table->string('disabled',500)->nullable();
            $table->text('icon',500)->nullable();
            $table->string('font')->nullable();
            $table->string('has_extra',500)->nullable();
            $table->string('extra_name',225)->nullable();
            $table->string('explorer',500)->nullable();
            $table->string('not_available',225)->nullable();
            $table->string('coin_name',225)->nullable();
            $table->text('coin_desc')->nullable()->comment('admin will add');
            $table->string('coinranking_uuid',225)->nullable();
            $table->text('networks')->nullable();
            $table->string('min_amount',225)->nullable();
            $table->text('multi')->nullable();
            $table->string('coin_whitepaper_url',225)->nullable()->comment('admin will add');
            $table->string('coin_officialsite_url',225)->nullable()->comment('admin will add');
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
        Schema::dropIfExists('coins');
    }
}
