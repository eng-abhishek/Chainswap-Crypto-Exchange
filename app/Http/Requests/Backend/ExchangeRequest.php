<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRequest extends FormRequest
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
        $rules = [];

        if(!isset($this->exchange)){
            $rules = [
               'from_coin_symbol' => 'required|min:2|max:100',
               'to_coin_symbol' => 'required|min:2|max:100',
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

        ];
    }
}
