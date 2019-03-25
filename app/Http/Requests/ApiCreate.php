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
            'url' => 'required_without:ip|sometimes|nullable|unique:url_api_enabled|url'
            ,'ip' => 'required_without:url|sometimes|nullable|ip'
            ,'key' => 'required|max:255'
            ,'secret' => 'required|max:255'
            ,'enabled' => 'required|boolean'
        ];
    }

    public function messages(){
        return [
            'url.required_without' => __('api.validation.url.required_without')
            ,'url.url' => __('api.validation.url.url')
            ,'url.unique' => __('api.validation.url.unique')
            ,'ip.required_without' => __('api.validation.ip.required_without')
            ,'ip.ip' => __('api.validation.ip.ip')
            ,'key.required' => __('api.validation.key.required')
            ,'key.max' => __('api.validation.key.max')
            ,'secret.required' => __('api.validation.secret.required')
            ,'secret.max' => __('api.validation.secret.max')
        ];
    }
}
