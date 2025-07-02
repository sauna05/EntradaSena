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

            // Relaciones
            $table->foreignId('id_cohort')->constrained('cohorts')->onDelete('cascade');
            $table->foreignId('id_instructor')->constrained('instructors')->onDelete('cascade');
            $table->foreignId('id_competencie')->constrained('competencies')->onDelete('cascade');
            $table->foreignId('id_classroom')->constrained('classrooms')->onDelete('cascade');

            // Control de horas
            $table->integer('hours_duration');
            $table->integer('scheduled_hours');
            $table->enum('status', [
                'pendiente',       // Antes de la fecha de inicio
                'en_ejecucion',    // Durante el rango de fechas
                'finalizada_evaluada',
                'finalizada_no_evaluada',
                'reprogramada'
            ])->default('pendiente');
            // Fechas y tiempos
            //fecha inicio y fecha fin
            $table->date('start_date');
            $table->date('end_date');
            //hora inicio y hora fin
            $table->time('start_time');
            $table->time('end_time');

            // Estado de programación
            $table->enum('statu_programming', ['sin_registrar', 'ok'])->default('sin_registrar');

            // Notificaciones (versión corregida)
            $table->boolean('termination_notice')->default(false)->comment('Indica si se envió el aviso');
            $table->timestamp('date_of_termination_notice')->nullable()->comment('Fecha y hora exacta del aviso');

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
