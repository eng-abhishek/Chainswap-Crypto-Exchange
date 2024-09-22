<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
// use Captcha;

class CheckAffiliateUserRequest extends FormRequest
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
        $rules = [
            'partner_id' => 'required|string|exists:users,name',
        ];

        return $rules;
    }

     
     public function messages() {
        return [
            'partner_id.exists'=>'Oop`s please enter valid partner Id !',
        ];
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
