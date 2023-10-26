<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsrBibitDaftarUpdateRequest extends FormRequest
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
            'id' => 'required|exists:csr_bibit,id',
            'bibit_id' => 'required|exists:bibit,id',
            'gudang_bibit_id' => 'required|exists:gudang_bibit,id',
            'jumlah' => 'required|integer|min:1|max:2147483647'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Daftar tidak dipilih.',
            'id.exists' => 'Daftar tidak valid.',
            'bibit_id.required' => 'Jenis bibit tidak dipilih.',
            'bibit_id.exists' => 'Jenis bibit tidak valid.',
            'gudang_bibit_id.required' => 'Gudang bibit tidak dipilih.',
            'gudang_bibit_id.exists' => 'Gudang bibit tidak valid.',
            'jumlah.required' => 'Jumlah bibit harus diisi.',
            'jumlah.integer' => 'Jumlah bibit tidak valid.',
            'jumlah.min' => 'Jumlah bibit minimal 1.'
        ];
    }
}
