<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UmkmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_umkm' => 'required',
            'nama_pemilik' => 'required',
            'no_ktp' => 'required|max:16',
            'no_kk' => 'required|max:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat_pemilik' => 'required',
            'alamat_usaha' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_umkm.required' => 'Nama UMKM wajib diisi.',
            'nama_pemilik.required' => 'Nama Pemilik wajib diisi.',
            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'no_ktp.max' => 'Nomor KTP tidak boleh lebih dari 16.',
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'no_kk.max' => 'Nomor KK tidak boleh lebih dari 16.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'alamat_pemilik.required' => 'Alamat Pemilik wajib diisi.',
            'alamat_usaha.required' => 'Alamat Usaha wajib diisi.',
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'not validate',
            'message' => 'check your validation',
            'data' => $validator->errors()
        ]));
    }
}
