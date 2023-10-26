<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'nik' => 'required|numeric|digits:16|unique:users,nik',
            'nama' => 'required|min:3|max:100',
            'alamat' => 'required|min:5|max:300',
            'email' => 'required|max:100|email|unique:users,email',
            'no_telepon' => 'required|numeric|max_digits:13',
            'role_id' => 'required|exists:role,id',
            'username' => 'required|min:5|max:20|alpha_num|unique:auth,username',
            'password' => 'required|min:8|confirmed'

        ];
    }

    public function messages()
    {
      return [
          'nik.required' => 'NIK harus diisi.',
          'nik.numeric' => 'NIK harus angka.',
          'nik.digits' => 'NIK harus 16 digit.',
          'nik.unique' => 'NIK telah terpakai.',
          'nama.required' => 'Nama harus diisi.',
          'nama.min' => 'Nama hanya boleh diisi minimal 3 karakter.',
          'nama.max' => 'Nama hanya boleh diisi maksimal 100 karakter.',
          'alamat.min' => 'Alamat hanya boleh diisi minimal 5 karakter.',
          'alamat.required' => 'Alamat harus diisi.',
          'alamat.max' => 'Alamat hanya boleh diisi maksimal 300 karakter.',
          'email.required' => 'Email harus diisi.',
          'email.max' => 'Email hanya boleh diisi maksimal 100 karakter.',
          'email.unique' => 'Email telah terpakai.',
          'email.email' => 'Email tidak valid.',
          'no_telepon.required' => 'Nomor telepon harus diisi',
          'no_telepon.numeric' => 'Nomor telepon hanya boleh angka.',
          'no_telepon.max_digits' => 'Nomor telepon hanya boleh diisi maksimal 13 digit.',
          'role_id.required' => 'Hak akses harus dipilih',
          'role_id.exists' => 'Hak akses tidak diketahui',
          'username.required' => 'Username harus diisi.',
          'username.min' => 'Username hanya boleh diisi minimal 5 karakter.',
          'username.max' => 'Username hanya boleh diisi maksimal 20 karakter.',
          'username.alpha_num' => 'Username hanya boleh diisi dengan huruf dan angka.',
          'username.unique' => 'Username telah terpakai.',
          'password.required' => 'Password harus diisi.',
          'password.min' => 'Password hanya boleh diisi minimal 8 karakter.',
          'password.confirmed' => 'Password tidak sama.'

      ];
    }
}
