<?php

namespace App\Http\Requests;

use App\Models\Siswa;
use Illuminate\Foundation\Http\FormRequest;

class SiswaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * 
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
            'nisn' => 'required|max:10|string|unique:siswa',
            'nis' => 'required|max:8|string|unique:siswa',
            'nama' => 'required|max:35|string',
            'id_kelas' => 'required|integer',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:13',
            'id_spp' => 'required|integer'
        ];
    }

    public function attributes()
    {
        return [
            'id_kelas' => 'kelas',
            'id_spp' => 'spp'
        ];
    }

    public function messages()
    {
        return Siswa::message;
    }
}
