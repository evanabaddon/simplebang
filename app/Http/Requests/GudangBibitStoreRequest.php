<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GudangBibitStoreRequest extends FormRequest
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
          'nama' => 'required|min:3|max:100|unique:gudang_bibit,nama',
          'alamat' => 'required|max:200',
          'no_telepon' => 'required|numeric|max_digits:14',
          'latitude' => 'required|numeric',
          'longitude' => 'required|numeric',
        ];
    }

    public function messages(){
      return [
          'nama.required' => 'Nama gudang harus diisi.',
          'nama.min' => 'Nama gudang harus diisi minimal 3 karakter.',
          'nama.max' => 'Nama gudang harus diisi maksimal 100 karakter.',
          'nama.unique' => 'Nama gudang telah terpakai.',
          'alamat.required' => 'Alamat gudang harus diisi.',
          'alamat.max' => 'Alamat gudang harus diisi maksimal 200 karakter.',
          'no_telepon.required' => 'Nomor telepon gudang harus diisi.',
          'no_telepon.numeric' => 'Nomor telepon tidak valid.',
          'no_telepon.max_digits' => 'Nomor telepon gudang harus diisi maksimal 14 digit.',
          'latitude.required' => 'Latitude harus diisi.',
          'latitude.numeric' => 'Latitude tidak valid.',
          'longitude.required' => 'Longitude harus diisi.',
          'longitude.numeric' => 'Longitude tidak valid.'
      ];
    }
}
