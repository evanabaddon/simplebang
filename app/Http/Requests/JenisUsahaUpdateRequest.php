<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisUsahaUpdateRequest extends FormRequest
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
             'id' => 'required|exists:jenis_usaha,id',
             'jenis' => 'required|string|min:5|max:100|unique:jenis_usaha,jenis,' . $this->id
         ];
     }

     public function messages(){
         return [
             'id.required' => 'Jenis usaha tidak ada.',
             'id.exists' => 'jenis usaha tidak ada.',
             'jenis.required' => 'Jenis usaha harus diisi.',
             'jenis.string' => 'Jenis usaha tidak valid.',
             'jenis.min' => 'Jenis usaha harus diisi minimal 5 karakter.',
             'jenis.max' => 'Jenis usaha harus diisi maksimal 100 karakter.',
             'jenis.unique' => 'Jenis usaha sudah ada.'
         ];
     }
}
