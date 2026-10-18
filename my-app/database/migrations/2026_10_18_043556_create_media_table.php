<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            // Original file info
            $table->string('name');                          // Display name (e.g. "Hero Banner")
            $table->string('file_name');                     // Stored filename on disk
            $table->string('mime_type', 100);                // image/png, video/mp4, etc.
            $table->string('extension', 20);                 // png, jpg, mp4
            $table->string('disk', 50)->default('public');   // storage disk
            $table->string('path', 500);                     // storage path
            $table->string('url', 1000);                     // public URL (for quick copy)

            $table->unsignedBigInteger('size')->default(0);  // bytes

            // Media type — used for filtering & rendering
            $table->enum('type', ['image', 'video', 'audio', 'document', 'other'])
                  ->default('image')
                  ->index();

            // Optional dimensions (images/videos)
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('duration')->nullable(); // seconds (video/audio)

            // Organisation
            $table->string('collection', 100)->nullable()->index(); // e.g. "hero", "services", "promotions"
            $table->string('alt_text', 255)->nullable();            // SEO alt text
            $table->text('description')->nullable();

            // Metadata
            $table->json('meta')->nullable();                // any extra info (original name, EXIF, etc.)
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();

            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Index for quick lookups
            $table->index(['type', 'collection']);
            $table->index(['mime_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};