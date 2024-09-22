<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\Godex;

class ReferralCommission extends Model
{

  protected $table = 'referral_commessions';

  protected $guarded = [];


  public static function convertCryptoToBTC($cryptoSymbol,$amount){

  try {
    
    $godex = new Godex;
    
    $raw_coin_info = $godex->get_info(strtoupper($cryptoSymbol),'BTC',$amount);
    
    if($raw_coin_info['status_code'] == 200){

    $min_amount = $raw_coin_info['data']->min_amount;
        
    $coin_info = $godex->get_info(strtoupper($cryptoSymbol),'BTC',$min_amount);
    if($coin_info['status_code']== 200){
      
    return $converted_amount = round($coin_info['data']->rate*$amount,8);

    }else{
      return null;
    }
    }else{
       return null;
    }
  }catch (Exception $e) {
  echo "Error: {$e->getMessage()}"; 
  return null; 
}
}

public function order(){
 return $this->hasOne(Order::class,'id','order_id');
}

public function user(){
 return $this->hasOne(\App\User::class,'id','user_id');
}

}
