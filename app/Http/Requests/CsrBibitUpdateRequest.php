<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsrBibitUpdateRequest extends FormRequest
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
             //
             'id' => 'required|exists:csr,id',
             'judul' => 'required|max:100',
             'perusahaan_id' => 'required|integer|exists:perusahaan,id',
             'tanggal' => 'required|date',
             'catatan' => 'nullable|max:200',
             'bibit.jenis' => 'nullable|array',
             'bibit.jumlah' => 'nullable|array',
             'bibit.gudang_bibit_id' => 'nullable|array',
             'bibit.jenis.*' => 'nullable|integer|exists:bibit,id',
             'bibit.jumlah.*' => 'nullable|integer|min:1|max:2147483647',
             'bibit.gudang_bibit_id.*' => 'nullable|integer|exists:gudang_bibit,id'
         ];
     }

     public function messages(){

       return [
         'id.required' => 'CSR tidak valid.',
         'id.exists' => 'CSR tidak valid.',
         'judul.required' => 'Judul CSR harus diisi.',
         'judul.max' => 'Judul CSR harus diisi maksimal 100 karakter.',
         'perusahaan_id.required' => 'Perusahaan harus diisi.',
         'perusahaan_id.integer' =>  'Perusahaan tidak valid.',
         'perusahaan.exists' => 'Perusahaan tidak valid.',
         'tanggal.required' => 'Tanggal CSR harus diisi.',
         'tanggal.date' => 'Tanggal tidak valid.',
         'catatan.max' => 'Catatan harus diisi maksimal 200 karakter.',
         'bibit.jenis.*' => 'Bibit harus dipilih.',
         'bibit.jumlah.*' => 'Jumlah bibit harus diisi.',
         'bibit.jenis.array' => 'Bibit harus dipilih.',
         'bibit.jumlah.array' => 'Jumlah bibit tidak valid.',
         'bibit.jumlah.*.min' => 'Jumlah bibit minimal satu.',
         'bibit.gudang_bibit_id.array' => 'Gudang bibit harus dipilih.',
         'bibit.gudang_bibit_id.*.integer' => 'Gudang bibit tidak valid.',
         'bibit.gudang_bibit_id.*.exists' => 'Gudang bibit tidak valid.'
       ];
     }
}
