<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BibitStoreRequest extends FormRequest
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
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
            'jenis' => 'required|string|max:100|unique:bibit,jenis'
        ];
    }

    public function messages(){
      return [
        'logo.image' => 'Logo harus gambar.',
        'logo.mimes' => 'Extensi ditolak :).',
        'jenis.required' => 'Jenis bibit harus diisi.',
        'jenis.string' => 'Jenis bibit tidak valid.',
        'jenis.max' => 'Jenis bibit harus diisi maksimal 100 karakter.',
        'jenis.unique' => 'Jenis bibit sudah ada.'
      ];
    }
}
