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
            $table->string('title');
            $table->string('slug');
            $table->string('preview_image');
            $table->string('detail_image');
            $table->text('preview_text');
            $table->text('detail_text');
            $table->json('tags')->nullable();
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
