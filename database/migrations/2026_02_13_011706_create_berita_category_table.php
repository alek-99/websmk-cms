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
        Schema::create('berita_category', function (Blueprint $table) {
            $table->foreignId('berita_id')->constrained()->cascadeOnDelete();
            $table->foreignId('berita_category_id')->constrained('berita_categories')->cascadeOnDelete();
            $table->primary(['berita_id', 'berita_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_category');
    }
};
