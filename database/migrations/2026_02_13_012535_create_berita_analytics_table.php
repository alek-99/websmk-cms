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
        Schema::create('berita_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('berita_id')->constrained()->cascadeOnDelete();
    $table->date('date');
    $table->unsignedInteger('views')->default(0);
    $table->unsignedInteger('unique_views')->default(0);
    $table->unsignedInteger('shares')->default(0);
    $table->decimal('avg_reading_time', 8, 2)->default(0);
    $table->json('referrers')->nullable();
    $table->timestamps();
    $table->unique(['berita_id', 'date']);
    $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_analytics');
    }
};
