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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();

            // Hero Section
            $table->string('foto_utama');
            $table->string('judul_utama');
            $table->string('sub_judul');
            $table->string('deskripsi_judul');
            // About
            $table->string('foto_about');
            $table->string('judul_about');
            $table->text('text_about');
            // Statistik Data
            $table->integer('tahun_berpengalaman');
            $table->integer('tenaga_pengajar');
            $table->integer('murid_aktiv');
            $table->integer('alumni_penerimaBeasiswa');
            // Link medsos
            $table->string('link_fb');
            $table->string('link_wa');
            $table->string('link_instagram');
            $table->string('link_youtube');
            // kontak 
            $table->string('alamat');
            $table->string('no_wa');
            $table->string('email');
            $table->string('jam_operasional');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
