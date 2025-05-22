<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiswaRequest extends FormRequest
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
            'nis' => [
            'required',
            'size:7',
            Rule::unique('siswas')->ignore($this->route('siswa'))],
            'nama_siswa' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
        ];
    }
    public function messages(): array
    {
        return [
            'nis.required' => 'NIS wajib diisi',
            'nis.size' => 'NIS harus terdiri dari 7 karakter',
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain',
            
            'nama_siswa.required' => 'Nama siswa wajib diisi',
            'nama_siswa.string' => 'Nama siswa harus berupa teks',
            'nama_siswa.max' => 'Nama siswa maksimal 255 karakter',
            
            'jk.required' => 'Jenis kelamin wajib dipilih',
            'jk.in' => 'Jenis kelamin harus L atau P',
            
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tempat_lahir.string' => 'Tempat lahir harus berupa teks',
            'tempat_lahir.max' => 'Tempat lahir maksimal 100 karakter',
            
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            
            'kelas_id.required' => 'Kelas wajib dipilih',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid',
        ];
    }

}
