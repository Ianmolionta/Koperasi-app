<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PeminjamanRequest extends FormRequest
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
            'jumlah_pinjaman' => 'required',
            'sisa_pinjaman' => 'required',
            'tanggal_pengajuan' => 'required',
            'tanggal_disetujui' => 'required',
            'batas_pengembalian' => 'required',
            'status' => 'required',
            'catatan' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'jumlah_pinjaman.required' => 'Jumlah Pinjaman wajib diisi.',
            'sisa_pinjaman.required' => 'Sisa Pinjaman wajib diisi.',
            'tanggal_pengajuan.required' => 'Tanggal Pengajuan wajib diisi.',
            'tanggal_disetujui.required' => 'Tanggal Disetujui wajib diisi.',
            'batas_pengembalian.required' => 'Batas Pengembalian wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'catatan.required' => 'Catatan wajib diisi.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'not validate',
            'message' => 'check your validation',
            'data' => $validator->errors()
        ]));
    }
}
