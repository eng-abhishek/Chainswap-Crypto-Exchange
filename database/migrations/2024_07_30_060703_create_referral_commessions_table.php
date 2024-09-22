<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralCommessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_commessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->float('exchange_amount',0);
            $table->float('exchange_amount_in_btc',0)->nullable();
            $table->string('from_coin');
            $table->string('to_coin');
            $table->string('order_id',225);
            $table->float('commission_rate',0);
            $table->float('commission_amount',0)->nullable();
            $table->float('commission_amount_in_btc',0)->nullable();
            $table->enum('payment_status',['payable','pending','paid'])->default('payable');
            $table->text('txn_has')->nullable();
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
        Schema::dropIfExists('referral_commessions');
    }
}
