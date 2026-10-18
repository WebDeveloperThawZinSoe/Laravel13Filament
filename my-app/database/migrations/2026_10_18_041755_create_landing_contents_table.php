<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section', 50)->index();      // brand, hero, stats, services, steps, promotions, testimonials, agent, contact, footer
            $table->string('item_key', 100)->index();    // unique key per item (e.g., 'site_name', 'btn_primary')
            $table->string('title', 255)->nullable();    // main text / name
            $table->string('subtitle', 255)->nullable(); // sub text
            $table->text('content')->nullable();         // long text / description
            $table->string('image_url', 500)->nullable(); // for logo, images
            $table->string('link_url', 500)->nullable();  // for buttons / links
            $table->string('link_text', 100)->nullable(); // button label
            $table->string('icon', 100)->nullable();      // fontawesome class or emoji
            $table->string('value', 100)->nullable();     // stat value, promo value, rating
            $table->string('extra_value', 100)->nullable(); // "+", "%", badge, avatar letter
            $table->integer('sort_order')->default(0)->index(); // ordering within section
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['section', 'item_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_contents');
    }
};