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
        Schema::create('excursions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('excursion_categories');
            $table->foreignId('guide_id')->constrained('guides');
            $table->decimal('price', 8, 2)->default(0);
            $table->string('title');
            $table->string('slug');
            $table->string('preview_image');
            $table->string('detail_image');
            $table->text('preview_text');
            $table->text('detail_text');
            $table->json('tags')->nullable();
            $table->integer('duration_minutes')->default(0);
            $table->json('locations')->nullable();
            $table->json('language')->nullable();
            $table->integer('max_people')->default(1);
            $table->string('transport')->nullable();
            $table->boolean('isActive')->default(true);
            $table->dateTime('published_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursions');
    }
};
