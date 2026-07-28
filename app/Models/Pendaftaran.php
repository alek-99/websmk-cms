<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'no_pendaftaran',
        // DATA SISWA
        'nisn', 'nik', 'nama_lengkap', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat', 'no_hp', 'email',
        // DATA SEKOLAH ASAL
        'asal_sekolah', 'npsn_sekolah', 'nilai_rata_rata',
        // DATA ORANG TUA
        'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'no_hp_ortu',
        // BERKAS
        'foto', 'scan_kk', 'scan_akta', 'scan_ijazah',
        // STATUS
        'status',
    ];

    protected $casts = [
        'tanggal_lahir'  => 'date',
        'nilai_rata_rata' => 'decimal:2',
    ];

    /**
     * Generate nomor pendaftaran otomatis: PSB-YYYY-0001
     */
    public static function generateNoPendaftaran(): string
    {
        $prefix = 'PSB-' . date('Y') . '-';
        $last   = self::where('no_pendaftaran', 'like', $prefix . '%')
                      ->orderBy('no_pendaftaran', 'desc')
                      ->first();

        $number = $last
            ? ((int) substr($last->no_pendaftaran, strlen($prefix))) + 1
            : 1;

        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /** Bootstrap color name untuk badge status */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'menunggu'     => 'warning',
            'diverifikasi' => 'info',
            'diterima'     => 'success',
            'ditolak'      => 'danger',
            default        => 'secondary',
        };
    }

    /** Label status dalam Bahasa Indonesia */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu'     => 'Menunggu',
            'diverifikasi' => 'Diverifikasi',
            'diterima'     => 'Diterima',
            'ditolak'      => 'Ditolak',
            default        => ucfirst($this->status),
        };
    }
}