<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class TrustedByRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(isset($this->trusted_logo)){

        $rules = [
            'alt' => 'required',
            'url' => 'required',
                 ];

        }else{

        $rules = [
            'image' => 'required',
            'alt' => 'required',
            'url' => 'required',
                 ];
        }
        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [
         'url'=>'url',

        ];
    }

    public function messages() {
        return [
         // 'redirect_url.url'=>'please enter valid url',

        ];
    }

}
