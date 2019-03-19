<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiCreate extends FormRequest
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
            //
            'url' => 'required|ip'
            ,'key' => 'required|max:255'
            ,'secret' => 'required|max:255'
            ,'enabled' => 'required|boolean'
        ];
    }

    public function messages(){
        return [
            'url.required' => __('api.validation.url.required')
            ,'url.url' => __('api.validation.url.url')
            ,'key.required' => __('api.validation.key.required')
            ,'key.max' => __('api.validation.key.max')
            ,'secret.required' => __('api.validation.secret.required')
            ,'secret.max' => __('api.validation.secret.max')
        ];
    }
}
