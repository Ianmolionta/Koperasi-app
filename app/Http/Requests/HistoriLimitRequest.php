<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HistoriLimitRequest extends FormRequest
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
            'limit_sebelumnya' => 'required',
            'limit_baru' => 'required',
            'perubahan' => 'required',
            'alasan' => 'required',
            'tanggal_berlaku' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'limit_sebelumnya.required' => 'Limit Sebelumnya wajib diisi.',
            'limit_baru.required' => 'Limit Baru wajib diisi.',
            'perubahan.required' => 'Perubahan wajib diisi.',
            'tanggal_berlaku.required' => 'Tanggal Berlaku wajib diisi.'
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
