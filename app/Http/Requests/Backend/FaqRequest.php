<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
        if(isset($this->faq)){

    return [
              'title' => 'required|min:5|max:500',
              'slug' => 'required|min:5|max:500|unique:faqs,slug,'.$this->faq,
              'description' => 'required|min:5|max:5000',
              'page_type' => 'required', 
        ];
        }else{

    return [
            'title' => 'required|min:5|max:500',
            'slug' => 'required|min:5|max:500|unique:faqs,slug',
            'description' => 'required|min:5|max:5000',
            'page_type' => 'required',            
        ];
        }

    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [			
            'title'=>'Question',
            'description'=>'Answer',
        ];
    }
}
