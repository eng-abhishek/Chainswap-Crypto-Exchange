<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trusted extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trusteds';

    protected $guarded = [];

    public function getTrustedImgAttribute(){

         $document_path = 'trust_logo';
        if($this->image != '' && \Storage::exists($document_path.'/'.$this->image)){
            if(app()->environment() == 'local'){
                return asset('storage/'.$document_path.'/'.$this->image);
            }else{
                return secure_asset('storage/'.$document_path.'/'.$this->image);
            }
        }else{
            return "";
        }
    }
}
