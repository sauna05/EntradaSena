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
        Schema::connection('db_programacion')->create('cohorts', function (Blueprint $table) {
            $table->id();
            $table->integer('number_cohort')->unique();
            $table->foreignId('id_program')->constrained('programs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_time')->constrained('cohort_times')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_town')->constrained('towns')->onUpdate('cascade')->onDelete('cascade');

            // Solo fechas generales de la ficha
            $table->date('start_date');
            $table->date('end_date');

            $table->integer('enrolled_quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cohorts');
    }
};
