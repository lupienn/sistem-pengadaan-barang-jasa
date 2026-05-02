<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePesertaRequest extends FormRequest
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
            'nama_peserta' => ['required', 'string', 'max:255'],
            'ttl' => ['required', 'string', 'max:255'],
            'usia' => ['required', 'integer', 'min:1'],
            'jenis_kelamin' => ['required', 'string', 'in:L,P'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:255'],
            'nama_ortu' => ['required', 'string', 'max:255'],
            'hp_ortu' => ['required', 'string', 'max:20'],
            'nama_official' => ['required', 'string', 'max:255'],
            'hp_official' => ['required', 'string', 'max:20'],
            'tema_pidato' => ['required', 'string', 'max:1000'],
        ];
    }
}
