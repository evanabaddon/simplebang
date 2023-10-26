<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsrDonasiUpdateRequest extends FormRequest
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
             'id' => 'required|exists:csr,id|exists:csr_donasi,csr_id',
             'judul' => 'required|max:100',
             'perusahaan_id' => 'required|integer|exists:perusahaan,id',
             'tanda_terima' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
             'tanggal' => 'required|date',
             'catatan' => 'nullable|max:200',
             'jumlah' => 'required|integer|min:1|max:2147483647'
         ];
     }

     public function messages(){

       return [
         'judul.required' => 'Judul CSR harus diisi.',
         'tanda_terima.image' => 'Tanda terima berupa gambar.',
         'tanda_terima.mimes' => 'Tanda terima tidak valid.',
         'judul.max' => 'Judul CSR harus diisi maksimal 100 karakter.',
         'perusahaan_id.required' => 'Perusahaan harus diisi.',
         'perusahaan_id.integer' =>  'Perusahaan tidak valid.',
         'perusahaan.exists' => 'Perusahaan tidak valid.',
         'tanggal.required' => 'Tanggal CSR harus diisi.',
         'tanggal.date' => 'Tanggal tidak valid.',
         'catatan.max' => 'Catatan harus diisi maksimal 200 karakter.',
         'jumlah.required' => 'Jumlah donasi harus diisi.',
         'jumlah.integer' => 'Jumlah donasi harus angka',
         'jumlah.min' => 'Minimal donasi adalah 1.',
         'jumlah.max' => 'Maximal donasi adalah 2147483647',
         'id.required' => 'CSR harus dipilih.',
         'id.exists' => 'CSR tidak valid.'
       ];
     }
}
