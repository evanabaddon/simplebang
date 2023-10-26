<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambangStoreRequest extends FormRequest
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
            'nama' => 'required|min:5|max:100|unique:tambang,nama',
            'jenis_tambang_id' => 'required|integer|exists:jenis_tambang,id',
            'alamat' => 'required|max:100',
            'luas' => 'required|numeric|max_digits:10',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'nama_pemilik' => 'required|min:3|max:100',
            'alamat_pemilik' => 'required|max:100',
            'email_pemilik' => 'required|email|max:100',
            'telepon_pemilik' => 'required|numeric|max_digits:14',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
        ];
    }

    public function messages(){
        return [
          'nama.required' => 'Nama tambang harus diisi.',
          'nama.min' => 'Nama tambang harus diisi minimal 5 karakter.',
          'nama.max' => 'Nama tambang harus diisi maksimal 100 karakter.',
          'nama.unique' => 'Data tambang dengan nama tersebut sudah ada.',
          'jenis_tambang_id.required' => 'Jenis tambang harus dipilih.',
          'jenis_tambang_id.integer' => 'Jenis tambang harus angka.',
          'jenis_tambang.exists' => 'Jenis tambang tidak tersedia.',
          'alamat.required' => 'Alamat tambang harus diisi.',
          'alamat.max' => 'Alamat tambang harus diisi maksimal 100 karakter.',
          'luas.required' => 'Luas tambang harus diisi.',
          'luas.numeric' => 'Luas tambang tidak valid.',
          'luas.max_digits' => 'Luas tambang harus diisi maksimal 10 digit.',
          'latitude.required' => 'Latitude harus diisi.',
          'latitude.numeric' => 'Latitude tidak valid.',
          'longitude.requried' => 'Longitude harus diisi.',
          'longitude.numeric' => 'Longitude tidak valid.',
          'nama_pemilik.required' => 'Nama pemilik tambang harus diisi.',
          'nama_pemilik.min' => 'Nama pemilik tambang harus diisi minimal 3 karakter.',
          'nama_pemilik.max' => 'Nama pemilik tambang harus diisi maksimal 100 karakter.',
          'alamat_pemilik.required' => 'Alamat pemilik tambang harus diisi.',
          'alamat_pemilik.max' => 'Alamat pemilik tambang harus diisi maksimal 100 karakter.',
          'email_pemilik.required' => 'Email pemilik tambang harus diisi.',
          'email_pemilik.email' => 'Email pemilik tambang tidak valid.',
          'email_pemilik.max' => 'Email pemilik tambang harus diisi maksimal 100 karakter.',
          'telepon_pemilik.required' => 'Telepon pemilik tambang harus diisi.',
          'telepon_pemilik.numeric' => 'Telepon pemilik tambang tidak valid.',
          'telepon_pemilik.max_digits' => 'Telepon pemilik tambang harus diisi maksimal 14 karakter',
          'foto.*.image' => 'Foto tambang tidak valid.',
          'foto.*.mimes'   => 'Extensi tidak diizinkan :).'

        ];
    }
}
