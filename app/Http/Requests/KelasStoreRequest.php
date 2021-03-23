<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Kelas;

class KelasStoreRequest extends FormRequest
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
            'nama_kelas' => 'required|max:10|string|unique:kelas',
            'kompetensi_keahlian' => 'required|max:50|string',
        ];
    }

    public function attributes()
    {
        return [
            'nama_kelas' => 'nama kelas',
            'kompetensi_keahlian' => 'kompetensi keahlian'
        ];
    }

    public function messages()
    {
        return Kelas::message;
    }
}
