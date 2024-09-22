<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('from_currency',25);
            $table->string('to_currency',25);
            $table->text('from_address');
            $table->text('to_address');
            $table->text('refund_address')->nullable();
            $table->enum('rate_mode',['flat','dynamic'])->default('flat');
            $table->string('actual_orderid');
            $table->string('orderid');
            $table->string('rate')->nullable();
            $table->string('svc_fee')->nullable();
            $table->string('svc_fee_override')->nullable(); 
            $table->string('network_fee')->nullable();
            $table->string('from_amount_received')->nullable();
            $table->string('wallet_pool')->nullable();
            $table->string('ref')->nullable();
            $table->string('state')->nullable();
            $table->string('state_error')->nullable();
            $table->enum('fee_option',['s','m','f'])->default('f');
            $table->string('max_input')->nullable();
            $table->string('min_input')->nullable();
            $table->string('from_amount')->nullable();
            $table->string('to_amount')->nullable();

            $table->string('final_amount')->nullable();
            $table->string('hash_in')->nullable();
            $table->string('hash_out')->nullable();
            $table->string('return_extra_id')->nullable();
            $table->string('deposit_extra_id')->nullable();

            $table->string('referral_id')->nullable();
            $table->string('aggregation',25)->nullable();
            $table->string('transaction_id_received')->nullable();
            $table->string('refund_private_key')->nullable();
            $table->string('transaction_id_sent')->nullable();
            $table->string('networks_from')->nullable();
            $table->string('networks_to')->nullable();
            $table->string('order_generated_from');
            $table->enum('order_type',['direct','api','referral'])->default('direct');
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
        Schema::dropIfExists('orders');
    }
}
