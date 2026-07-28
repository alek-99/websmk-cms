<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
             // Nomor pendaftaran otomatis
            $table->string('no_pendaftaran')->unique();
            // DATA SISWA
            $table->string('nisn')->unique();
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin',['laki-laki','perempuan']); // L / P
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email')->nullable();

            // DATA SEKOLAH ASAL
            $table->string('asal_sekolah');
            $table->string('npsn_sekolah')->nullable();
            $table->decimal('nilai_rata_rata', 5, 2)->nullable();

        //    DATA ORANG TUA
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ortu');
        
            // BERKAS
            $table->string('foto')->nullable();
            $table->string('scan_kk')->nullable();
            $table->string('scan_akta')->nullable();
            $table->string('scan_ijazah')->nullable();

            // STATUS
            $table->enum('status', [
                'menunggu',
                'diverifikasi',
                'diterima',
                'ditolak'
            ])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
