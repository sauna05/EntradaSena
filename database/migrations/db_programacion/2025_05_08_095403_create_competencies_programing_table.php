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
        Schema::create('competencies_programing', function (Blueprint $table) {
            $table->id();

            $table->foreignId('program_id')->constrained('programs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('competency_id')->constrained('competencies')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencies_programing');
    }
};
