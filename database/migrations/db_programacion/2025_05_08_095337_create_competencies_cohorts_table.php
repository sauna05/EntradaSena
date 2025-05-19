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
        Schema::create('competencies_cohorts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_competence')->constrained('competencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_cohort')->constrained('cohorts')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencies_cohorts');
    }
};
