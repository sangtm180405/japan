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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'multiple_choice', 'fill_blank', 'translation', 'listening'
            $table->text('question');
            $table->json('options')->nullable(); // For multiple choice questions
            $table->string('correct_answer');
            $table->text('explanation')->nullable();
            $table->string('audio_file')->nullable();
            $table->integer('points')->default(1);
            $table->integer('difficulty_level')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
