<?php

namespace App\Http\Requests;

use App\Models\Spp;
use Illuminate\Foundation\Http\FormRequest;

class SppStoreRequest extends FormRequest
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
            'tahun' => 'required|integer|unique:spp',
            'nominal' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'tahun' => 'tahun spp',
            'nominal' => 'nominal spp'
        ];
    }

    public function messages()
    {
        return Spp::message;
    }
}
