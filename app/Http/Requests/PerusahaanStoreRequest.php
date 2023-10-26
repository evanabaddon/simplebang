<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerusahaanStoreRequest extends FormRequest
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
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
            'nama' => 'required|string|min:3|max:100|unique:perusahaan,nama',
            'jenis_usaha_id' => 'required|exists:jenis_usaha,id',
            'alamat' => 'required|string|max:200',
            'email' => 'required|email|max:100',
            'no_telepon' => 'required|numeric|max_digits:14',
            'nama_pemilik' => 'required|min:3|max:100',
            'alamat_pemilik' => 'required|max:100',
            'email_pemilik' => 'required|email|max:100',
            'telepon_pemilik' => 'required|numeric|max_digits:14'
        ];
    }

    public function messages(){
      return [
        'logo.image' => 'Logo harus gambar.',
        'logo.mimes' => 'Extensi ditolak :).',
        'nama.required' => 'Nama perusahaan harus diisi.',
        'nama.string' => 'Nama perusahaan tidak valid.',
        'nama.max' => 'Nama perusahaan harus diisi maksimal 100 karakter',
        'nama.min' => 'Nama perusahaan harus diisi minimal 3 karakter',
        'nama.unique' => 'Nama perusahaan sudah ada.',
        'jenis_usaha_id.requried' => 'Jenis usaha harus dipilih.',
        'jenis_usaha.exists' => 'Jenis usaha tidak ada.',
        'alamat.required' => 'Alamat usaha harus diisi.',
        'alamat.string' => 'Alamat usaha tidak valid.',
        'alamat.max' => 'Alamat usaha harus diisi maksimal 200 karakter.',
        'email.required' => 'Email usaha harus diisi.',
        'email.email' => 'Email usaha tidak valid.',
        'email.max' => 'Email usaha harus diisi maksimal 100 karakter.',
        'no_telepon.required' => 'Nomor telepon usaha harus diisi.',
        'no_telepon.numeric' => 'Nomor telepon usaha tidak valid.',
        'no_telepon.max_digits' => 'Nomor telepon usaha harus diisi maksimal 14 digit.',
        'nama_pemilik.requried' => 'Nama pemilik usaha harus diisi.',
        'nama_pemilik.min' => 'Nama pemilik usaha harus diisi minimal 3 karakter.',
        'nama_pemilik.max' => 'Nama pemilik usaha harus diisi maksimal 100 karakter.',
        'alamat_pemilik.required' => 'Alamat pemilik usaha harus diisi.',
        'alamat_pemilik.max' => 'Alamat pemilik harus diisi maksimal 100 karakter.',
        'email_pemilik.required' => 'Email pemilik harus diisi.',
        'email_pemilik.email' => 'Email pemilik tidak valid.',
        'email_pemilik.max' => 'Email pemilik harus diisi maksimal 100 karakter.',
        'telepon_pemilik.required' => 'Telepon pemilik harus diisi.',
        'telepon_pemilik.numeric' => 'Telepon pemilik tidak valid.',
        'telepon_pemilik.max_digits' => 'Telepon pemilik harus diisi maksimal 14 digit.'
      ];
    }
}
