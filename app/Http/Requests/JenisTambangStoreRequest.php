<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisTambangStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'jenis' => 'required|min:5|max:100|unique:jenis_tambang,jenis'
        ];
    }

    public function messages(){
      return [
        'jenis.required' => 'Jenis tambang harus diisi.',
        'jenis.min' => 'Jenis tambang harus diisi minimal 5 karakter.',
        'jenis.max' => 'Jenis tambang harus diisi maksimal 100 karakter.',
        'jenis.unique' => 'Jenis tambang sudah ada.'
      ];
    }
}
