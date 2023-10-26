<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BibitUpdateRequest extends FormRequest
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
            'id' => 'required|exists:bibit,id',
             'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
             'jenis' => 'required|string|max:100|unique:bibit,jenis,' . $this->id
         ];
     }

     public function messages(){
       return [
         'id.required' => 'Anda tidak memilih bibit.',
         'id.exists' => 'Data bibit tidak ada.',
         'logo.image' => 'Logo harus gambar.',
         'logo.mimes' => 'Extensi ditolak :).',
         'jenis.unique' => 'Jenis bibit sudah ada.',
         'jenis.required' => 'Jenis bibit harus diisi.',
         'jenis.string' => 'Jenis bibit tidak valid.',
         'jenis.max' => 'Jenis bibit harus diisi maksimal 100 karakter.'
       ];
     }
}
