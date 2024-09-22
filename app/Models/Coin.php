<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coins';

    protected $guarded = []; 

    protected $appends = ['image_url'];


    public function getImageUrlAttribute()
    {
    	if(file_exists(public_path('assets/frontend/images/coins').'/'.strtolower($this->symbol).'.png')){
    		if(app()->environment() == 'local'){
    			return asset('assets/frontend/images/coins/'.strtolower($this->symbol).'.png');
    		}else{
    			return secure_asset('assets/frontend/images/coins/'.strtolower($this->symbol).'.png');
    		}

    	}elseif(file_exists(public_path('assets/frontend/images/coins').'/'.strtolower($this->symbol).'.svg')){
            if(app()->environment() == 'local'){
                return asset('assets/frontend/images/coins/'.strtolower($this->symbol).'.svg');
            }else{
                return secure_asset('assets/frontend/images/coins/'.strtolower($this->symbol).'.svg');
            }

        }elseif($this->icon != ''){
    		return $this->icon;
    		
    	}else{
    		return "";
    	}
    }
}
