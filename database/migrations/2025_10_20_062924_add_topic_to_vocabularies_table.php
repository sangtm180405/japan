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
        Schema::table('vocabularies', function (Blueprint $table) {
            $table->string('topic')->nullable()->index()->after('vietnamese');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vocabularies', function (Blueprint $table) {
            if (Schema::hasColumn('vocabularies', 'topic')) {
                $table->dropIndex(['topic']);
                $table->dropColumn('topic');
            }
        });
    }
};
