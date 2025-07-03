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
        Schema::connection('db_programacion')->create('competencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('speciality_id')
                ->constrained('specialities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->integer('duration_hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('db_programacion')->dropIfExists('competencies');
    }
};