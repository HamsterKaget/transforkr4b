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
        Schema::create('project_tech', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tech_id');
            $table->unsignedBigInteger('project_id');

            $table->foreign('tech_id')->references('id')->on('tech_stack');
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
        Schema::table('project_tech', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['tech_id']);
            $table->dropForeign(['project_id']);
        });
        Schema::dropIfExists('project_tech');
    }
};
