<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenanamanUpdateRequest extends FormRequest
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
            'judul' => 'required|string|min:4|max:100|unique:csr_out,judul,' . $this->csr_out_id ,
            'tambang_id' => 'required|int|exists:tambang,id',
            'tanggal' => 'required|date',
            'luas' => 'required|int',
            'foto' => 'nullable|array',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
            'bibit_id' => 'nullable|array',
            'bibit_id.*' => 'nullable|int|exists:bibit,id', 
            'csr_id' => 'nullable|array',
            'csr_id.*' => 'nullable|int|exists:csr,id', 
            'gudang_bibit' => 'nullable|array',
            'gudang_bibit.*' => 'nullable|int|exists:gudang_bibit,id', 
            'jumlah' => 'nullable|array',
            'jumlah.*' => 'nullable|int|min:1'
        ];
    }

    public function messages(){
        return [
            'judul.required' => 'Judul penanaman harus diisi.', 
            'judul.string' => 'Judul penanaman tidak valid.' , 
            'judul.min' => 'Judul penanaman minimal 4 karakter.',
            'judul.max' => 'Judul penanaman maksimal 100 karakter.', 
            'judul.unique' => 'Judul penanaman sudah ada.',
            'tambang_id.required' => 'Tambang harus dipilih.', 
            'tambang_id.int' => 'Tambang tidak valid.', 
            'tambang_id.exists' => 'Tambang tidak valid.',
            'tanggal.required' => 'Tanggal penanaman harus diisi.', 
            'tanngal.date' => 'Tanggal penanaman tidak valid.',
            'luas.required' => 'Luas area penanaman harus diisi.', 
            'luas.int' => 'Luas area penanaman tidak valid.', 
            'foto.required' => 'Foto kegiatan penanaman harus diupload.', 
            'foto.array' => 'Foto tidak valid.' , 
            'foto.*.required' => 'Foto kegiatan penanaman harus diupload.',
            'foto.*.mimes' => 'Foto kegiatan penanaman tidak valid.', 
            'bibit_id.required' => 'Bibit pohon yang ditanam harus dipilih.',
            'bibit_id.array' => 'Bibit pohon tidak valid.', 
            'bibit_id.*.required' => 'Bibit pohon yang ditanam harus dipilih.',
            'bibit_id.*.int' => 'Bibit pohon  tidak valid.',
            'bibit_id.*.exists' => 'Bibit pohon tidak valid.', 
            'csr_id.required' => 'CSR bibit pohon harus dipilih',
            'csr_id.array' => 'CSR bibit pohon tidak valid.',
            'csr_id.*.required' => 'CSR bibit pohon harus dipilih',
            'csr_id.*.int' => 'CSR bibit pohon tidak valid.', 
            'csr_id.*.exists' => 'CSR bibit pohon tidak valid.',
            'gudang_bibit.required'=> 'Gudang bibit harus dipilih.',
            'gudang_bibit.array' => 'Gudang bibit tidak valid.',
            'gudang_bibit.*.required' => 'Gudang bibit harus dipilih', 
            'gudang_bibit.*.int' => 'Gudang bibit tidak valid.', 
            'gudang_bibit.*.exists' => 'Gudang bibit tidak valid.', 
            'jumlah.required' => 'Jumlah bibit harus diisi.', 
            'jumlah.array' => 'Jumlah bibit tidak valid.',
            'jumlah.*.required' => 'Jumlah bibit harus diisi.', 
            'jumlah.*.int' => 'Jumlah bibit tidak valid.', 
            'jumlah.*.min' => 'Jumlah bibit minam 1 bibit.' 
        ];
    }
}
