<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
// use Captcha;

class RedeemAmountRequest extends FormRequest
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
            'redeem_btc_address' => 'required|string|min:20',
        ];

        return $rules;
    }

     
     public function messages() {
        return [
            'redeem_btc_address.required'=>'Please enter valid btc wallet address.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [            
          'redeem_btc_address'=>'wallet btc address',
        ];
    }
}
