<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'classification' => 'required|in:pengaduan,aspirasi,informasi',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'kategori' => 'nullable|string',
            'lampiran.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'anonim' => 'nullable|boolean',
            'rahasia' => 'nullable|boolean',
        ];
    }
}
