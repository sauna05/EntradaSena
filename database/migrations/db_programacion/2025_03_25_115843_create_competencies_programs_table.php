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
        Schema::connection('db_programacion')->create('competencies_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_program')->constrained('programs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_competence')->constrained('competencies')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencies_programs');
    }
};
