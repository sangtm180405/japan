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
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('course_type'); // 'free', 'premium', 'n5', 'n4', 'n3', 'n2', 'n1'
            $table->string('status')->default('active'); // 'active', 'expired', 'cancelled'
            $table->timestamp('enrolled_at')->useCurrent();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'course_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_enrollments');
    }
};
