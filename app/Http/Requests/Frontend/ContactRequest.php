<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
// use Captcha;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'order_id' => 'nullable|exists:orders,orderid',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];

        return $rules;
    }

     
     public function messages() {
        return [            
           'g-recaptcha-response.required' => 'Please verify that you are not a robot',
           'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin',
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
