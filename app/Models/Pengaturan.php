<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table ='pengaturans';
    protected $fillable = [
        // Utamma
        'foto_utama',
        'judul_utama',
        'sub_judul',
        'deskripsi_judul',
        // About Section
        'foto_about',
        'judul_about',
        'text_about',
        // Stats Data
        'tahun_berpengalaman',
        'tenaga_pengajar',
        'murid_aktiv',
        'alumni_penerimaBeasiswa',
        // link Medsos
        'link_fb',
        'link_wa',
        'link_instagram',
        'link_youtube',
        // informasi Kontak
        'alamat',
        'no_wa',
        'email',
        'jam_operasional',
    ];
}
  