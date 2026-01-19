<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StatusRisikoUmkmRequest extends FormRequest
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
            'status' => 'required',
            'hari_keterlambatan' => 'required',
            'tanggal_penetapan' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status wajib diisi.',
            'hari_keterlambatan.required' => 'Hari Keterlambatan wajib diisi.',
            'tanggal_penetapan.required' => 'Tanggal Penetapan wajib diisi.'
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
