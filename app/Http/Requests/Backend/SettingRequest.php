<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
             //'exch_referral_id' => 'required|min:2|max:100',
             'godex_referral_id' => 'required|min:2|max:100',
             'coinranking_api_key' => 'required|min:2|max:300',
             //'user_api_type' => 'required|min:2|max:100',
            ];

        return $rules;
    }

    /**
 * Get custom attributes for validator errors.
 *
 * @return array
 */
    public function attributes()
    {
        return [
            'user_api_type' => 'Please select anyone api'
        ];
    }
}
