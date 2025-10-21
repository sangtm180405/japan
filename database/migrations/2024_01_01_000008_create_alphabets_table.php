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
        Schema::create('alphabets', function (Blueprint $table) {
            $table->id();
            $table->string('character'); // Ký tự (あ, ア, 一, etc.)
            $table->string('romaji'); // Cách đọc romaji
            $table->string('type'); // hiragana, katakana, kanji, romaji
            $table->string('category')->nullable(); // Nguyên âm, phụ âm, số, etc.
            $table->text('description')->nullable(); // Mô tả
            $table->string('stroke_order')->nullable(); // Thứ tự nét vẽ (cho Kanji)
            $table->integer('difficulty_level')->default(1); // 1-5
            $table->integer('order')->default(1); // Thứ tự hiển thị
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alphabets');
    }
};
