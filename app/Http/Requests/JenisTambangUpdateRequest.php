<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisTambangUpdateRequest extends FormRequest
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
             'id'   => 'required|exists:jenis_tambang,id',
             'jenis' => 'required|min:5|max:100|unique:jenis_tambang,jenis,' . $this->id
         ];
     }

     public function messages(){
       return [
         'id.required' => 'Jenis tambang tidak dipilih.',
         'id.exists' => 'Jenis tambang tidak ada pada database.',
         'jenis.required' => 'Jenis tambang harus diisi.',
         'jenis.min' => 'Jenis tambang harus diisi minimal 5 karakter.',
         'jenis.max' => 'Jenis tambang harus diisi maksimal 100 karakter.',
         'jenis.unique' => 'Jenis tambang sudah ada.'
       ];
     }
}
