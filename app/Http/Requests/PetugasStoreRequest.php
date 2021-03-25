<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Petugas;

class PetugasStoreRequest extends FormRequest
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
            'nama_petugas' => 'required|max:35|string',
            'username' => 'required|max:25|string|unique:petugas',
            'password' => 'required|max:32|string',
            'level' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'nama_petugas' => 'nama petugas',
        ];
    }

    public function messages()
    {
        return Petugas::message;
    }
}
