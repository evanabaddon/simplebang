<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonasiKreditUpdateRequest extends FormRequest
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
         return  [
             'id' => 'required|integer|exists:csr_out_donasi,id',
             'judul' => 'required|string|min:10|max:255',
             'catatan' => 'required|string|min:1|max:65000',
             'donasi' => 'nullable|array',
             'donasi.csr_id' => 'nullable|array',
             'donasi.csr_id.*' => 'nullable|integer|exists:csr_donasi,csr_id',
             'donasi.jumlah' => 'nullable|array',
             'donasi.jumlah.*' => 'nullable|integer|min:1|max:2147483647',
             'donasi.keterangan' => 'nullable|array',
             'donasi.keterangan.*' => 'nullable|string|min:1|max:255',
             'total' => 'nullable|array',
             'total.jumlah' => 'nullable|array',
             'total.jumlah.*.*' => 'nullable|integer|min:1|max:2147483647'

         ];




     }

     public function messages(){
       return [
         'id.*' => 'Penggunaan donasi tidak valid.',
         'judul.required' => 'Judul penggunaan donasi harus diisi.',
         'judul.string' => 'Judul penggunaan donasi tidak valid.',
         'judul.min' => 'Judul penggunaan donasi harus diisi minimal 10 karakter.',
         'judul.max' => 'Judul penggunaan donasi harus diisi maksimal 255 karakter.',
         'catatan.required' => 'Catatan penggunaan donasi harus diisi.',
         'catatan.string' => 'Catatan penggunaan donasi tidak valid.',
         'catatan.min' => 'Catatan penggunaan donasi harus diisi minimal 1 karakter.',
         'catatan.max' => 'Catatan penggunaan donasi harus diisi maksimal 65000 karakter.',
         'donasi.array' => 'Rincian kredit tidak valid.',
         'donasi.csr_id.array' => 'Rincian kredit tidak valid.',
         'donasi.csr_id.*.integer' => 'Sumber donasi tidak valid.',
         'donasi.csr_id.*.exists' => 'Sumber donasi tidak valid.',
         'donasi.jumlah.array' => 'Jumlah kredit tidak valid',
         'donasi.jumlah.*.integer' => 'Jumlah kredit tidak valid.',
         'donasi.jumlah.*.min' => 'Jumlah kredit minimal Rp. 1',
         'donasi.jumlah.*.max' => 'Jumlah kredit maksimal  Rp. 2.147.483.647',
         'donasi.keterangan.array' => 'Keterangan kredit tidak valid.' ,
         'donasi.keterangan.*.string' => 'Keterangan kredit tidak valid.',
         'donasi.keterangan.*.min' => 'Keterangan kredit harus diisi minimal 1 karakter.',
         'donasi.keterangan.*.max' => 'keterangan kredit harus diisi maksimal 255 karakter',
         'total.jumlah.*.*.integer' => 'Jumlah kredit tidak valid.',
         'total.jumlah.*.*.min' => 'Jumlah kredit minimal Rp. 1',
         'total.jumlah.*.*.max' => 'Jumlah kredit maksimal Rp. 2.147.483.647'
       ];
     }
}
