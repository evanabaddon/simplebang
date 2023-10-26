<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsrOutDonasiKreditDonasiUpdateRequest extends FormRequest
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
            "id" => "required|integer|exists:csr_out_donasi_kredit,id",
            "csr_id" => "required|integer|exists:csr,id",
            "jumlah" => "required|integer|min:1|max:2147483647",
            "keterangan" => "required|string|min:1|max:65000"
        ];
    }

    public function messages(){
      return [
          "id.required" => 'Kredit donasi tidak valid.',
          "id.integer" => 'Kredit donasi tidak valid.',
          "id.exists" => 'Kredit donasi tidak valid.',
          "csr_id.required" => "Asal donasi CSR tidak valid.",
          "csr_id.integer" => "Asal donasi CSR tidak valid.",
          "csr_id.exists" => "Asal donasi tidak valid.",
          "jumlah.required" => "Jumlah penggunaan donasi harus diisi.",
          "jumlah.integer" => "Jumlah donasi tidak valid.",
          "jumlah.min" => "Jumlah donasi minimal Rp. 1",
          "jumlah.max" => "Jumlah donasi maksimal Rp. 2.147.483.647."
      ];
    }
}
