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

            $table->foreignId('id_program')->constrained('programs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_instructor')->constrained('instructors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_competencie')->constrained('competencies')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('hours_duration');
            $table->integer('scheduled_hours');

            $table->boolean('iniciada'); // true o false si está iniciada

            $table->date('start_date');
            $table->date('end_date');

            $table->time('start_time');
            $table->time('end_time');

            $table->string('programmed_by'); // sin espacios

            $table->boolean('evaluated')->default(false); // por defecto: no evaluada

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
