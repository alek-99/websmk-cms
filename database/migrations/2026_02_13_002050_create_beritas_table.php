<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
             $table->foreignId('editor_id')->nullable()->constrained('users')->nullOnDelete();
            // Konten Utama
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->string('reading_time')->nullable();
            $table->longText('content');

            // Media
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt')->nullable();

            // SEO Core
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // Advanced SEO
            $table->string('canonical_url')->nullable();
            $table->string('robots')->default('index, follow');
            $table->json('structured_data')->nullable(); // JSON-LD

            // Open Graph & Social
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            // Twitter Card
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();

            // Publishing
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
             $table->timestamp('scheduled_at')->nullable();
            $table->boolean('is_featured')->default(false);

            // Statistik
            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Indexing Optimization
            $table->index(['status','published_at']);
            $table->index('slug');
            $table->index('views');
            $table->fullText(['title','content']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
