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
        Schema::connection('db_programacion')->create('instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_person')->constrained('people')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_status')->constrained('instructor_status')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_link_type')->constrained('link_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_speciality')->constrained('specialities')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('assigned_hours');
            $table->integer('months_contract');
            $table->integer('hours_day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
