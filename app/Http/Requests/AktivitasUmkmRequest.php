<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AktivitasUmkmRequest extends FormRequest
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
            'periode_catur_wulan' => 'required',
            'aktivitas' => 'required',
            'permasalahan' => 'required',
            'tanggal_aktivitas' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'periode_catur_wulan.required' => 'Periode Catur Wulan wajib diisi.',
            'aktivitas.required' => 'Aktivitas wajib diisi.',
            'permasalahan.required' => 'Permasalahan wajib diisi.',
            'tanggal_aktivitas.required' => 'Tanggal Pelaporan wajib diisi.'
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
