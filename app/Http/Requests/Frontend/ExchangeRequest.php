<?php

namespace App\Http\Requests\Frontend;

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
        return [
             'to_address' => 'required',
             'from_amount' => 'required|numeric',
             'receive_network' => 'sometimes|required',
             'send_network' => 'sometimes|required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [			
            'receive_network' => 'network to',
            'send_network' => 'network from',
        ];
    }

    public function messages() {
        return [            
            'receive_network.required' => 'Please select network',
            'send_network.required' => 'Please select network',
        ];
    }

}
