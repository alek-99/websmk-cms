<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // DATA SISWA
            'nisn' => 'required|digits:10|unique:pendaftarans,nisn',
            'nik' => 'required|digits:16|unique:pendaftarans,nik',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',

            // SEKOLAH
            'asal_sekolah' => 'required|string|max:255',
            'npsn_sekolah' => 'nullable|string|max:20',
            'nilai_rata_rata' => 'nullable|numeric|min:0|max:100',

            // ORANG TUA
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_hp_ortu' => 'required|string|max:15',

            // FILE
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'scan_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'scan_akta' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'scan_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            // STATUS
            'status' => 'nullable|in:menunggu,diverifikasi,diterima,ditolak',
        ];
    }
}