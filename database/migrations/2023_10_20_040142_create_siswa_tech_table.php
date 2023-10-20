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
        Schema::create('siswa_tech', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('tech_id');

            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('tech_id')->references('id')->on('tech_stack');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa_tech', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['tech_id']);
        });
        Schema::dropIfExists('siswa_tech');
    }
};
