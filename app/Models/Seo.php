<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seos';

    protected $guarded = [];

    public function getSeoImgAttribute(){

         $document_path = 'featured_image';
        if($this->featured_image != '' && \Storage::exists($document_path.'/'.$this->featured_image)){
            if(app()->environment() == 'local'){
                return asset('storage/'.$document_path.'/'.$this->featured_image);
            }else{
                return secure_asset('storage/'.$document_path.'/'.$this->featured_image);
            }
        }else{
            return "";
        }
    }

    public function getTitleAttribute($value)
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

    public function getMetaDesAttribute($value)
    {
        $locale = app()->getLocale();

        $title_arr = json_decode($value, true);

        if(isset($title_arr[$locale]) && $title_arr[$locale] != ''){
            return $title_arr[$locale];
        }

        return $title_arr['en'];
    }
}
