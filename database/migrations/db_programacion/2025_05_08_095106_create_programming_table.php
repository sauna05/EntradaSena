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
        Schema::create('programming', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_cohort')->constrained('cohorts')->onDelete('cascade');
            $table->foreignId('id_instructor')->constrained('instructors')->onDelete('cascade');
            $table->foreignId('id_competencie')->constrained('competencies')->onDelete('cascade');
            $table->foreignId('id_classroom')->constrained('classrooms')->onDelete('cascade'); // <- Nueva relación

            $table->integer('hours_duration');
            $table->integer('scheduled_hours');

            $table->boolean('iniciada');
            $table->date('start_date');
            $table->date('end_date');

            $table->time('start_time');
            $table->time('end_time');
            $table->enum('statu_programming', ['sin_registrar', 'ok'])->default('sin_registrar');

            // $table->string('programmed_by');
            $table->boolean('evaluated')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programming');
    }
};
