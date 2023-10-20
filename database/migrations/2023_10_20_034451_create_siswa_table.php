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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 15);
            $table->text('avatar')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->string('telepon', 15)->nullable();
            $table->string('whatsapp', 15)->nullable();
            $table->string('mail', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('x', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('tiktok', 255)->nullable();
            $table->string('github', 255)->nullable();

            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('jurusan_id')->references('id')->on('jurusan');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['jurusan_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('siswa');
    }
};
