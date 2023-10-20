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
        Schema::create('project_siswa', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('project_id');

            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('project_id')->references('id')->on('project');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_siswa', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['project_id']);
        });
        Schema::dropIfExists('project_siswa');
    }
};
