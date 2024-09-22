<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    protected $guarded = [];

    public function obj_user_order()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function get_from_symbol(){
        return $this->hasOne(Coin::class,'symbol','from_currency');
    }

    public function get_to_symbol(){
        return $this->hasOne(Coin::class,'symbol','to_currency');
    }

    public function referral_order(){
        return $this->hasOne(ReferralCommission::class);
    }
}
