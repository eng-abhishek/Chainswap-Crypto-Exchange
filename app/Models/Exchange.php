<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = "exchanges";
    protected $guarded = [];

    public function get_from_symbol(){
        return $this->hasOne(Coin::class,'symbol','from_coin_symbol');
    }

    public function get_to_symbol(){
        return $this->hasOne(Coin::class,'symbol','to_coin_symbol');
    }

    public function getMetaTitleAttribute($value)
    {
        $locale = app()->getLocale();
        
        if(!empty($value)){

        $title_arr = json_decode($value, true);

        if(isset($title_arr[$locale]) && $title_arr[$locale] != ''){
            return $title_arr[$locale];
        }

        return $title_arr['en'];

        }else{

       return '';
        
        }
    }

    public function getMetaDescriptionAttribute($value)
    {
        $locale = app()->getLocale();
        
        if(!empty($value)){

        $title_arr = json_decode($value, true);

        if(isset($title_arr[$locale]) && $title_arr[$locale] != ''){
            return $title_arr[$locale];
        }

        return $title_arr['en'];

        }else{
         return '';
        }
    }

}