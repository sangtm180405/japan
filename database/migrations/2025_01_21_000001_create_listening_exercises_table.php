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
        Schema::create('listening_exercises', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('level'); // JLPT level (1-5)
            $table->string('audio_file'); // Path to audio file
            $table->text('transcript'); // Full transcript in Japanese
            $table->text('transcript_romaji')->nullable(); // Romaji version
            $table->text('transcript_english')->nullable(); // English translation
            $table->text('transcript_vietnamese')->nullable(); // Vietnamese translation
            $table->integer('duration'); // Audio duration in seconds
            $table->integer('difficulty_level')->default(1); // 1-5 difficulty
            $table->json('questions'); // Array of questions
            $table->json('correct_answers'); // Array of correct answers
            $table->integer('points')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listening_exercises');
    }
};
