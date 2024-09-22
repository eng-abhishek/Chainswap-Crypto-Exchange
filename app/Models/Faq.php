<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faqs';

    protected $guarded = [];

    public function getTitleAttribute($value)
    {
        $locale = app()->getLocale();

        $title_arr = json_decode($value, true);

        if(isset($title_arr[$locale]) && $title_arr[$locale] != ''){
            return $title_arr[$locale];
        }

        return $title_arr['en'];
    }

    public function getDescriptionAttribute($value)
    {
        $locale = app()->getLocale();

        $title_arr = json_decode($value, true);

        if(isset($title_arr[$locale]) && $title_arr[$locale] != ''){
            return $title_arr[$locale];
        }

        return $title_arr['en'];
    }

}
