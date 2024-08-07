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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('video_url')->nullable();
            $table->string('github_repo_url')->nullable();
            $table->string('tools_used')->nullable();
            $table->string('programming_language_used')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('video_url');
            $table->dropColumn('github_repo_url');
            $table->dropColumn('tools_used');
            $table->dropColumn('programming_language_used');
        });
    }
};
