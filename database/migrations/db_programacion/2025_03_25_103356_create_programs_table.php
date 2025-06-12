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
        Schema::connection('db_programacion')->create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_level')->constrained('program_level')->onUpdate('cascade')->onDelete('cascade');
            $table->string('program_code');
            $table->string('program_version');
            $table->string('name');
            $table->foreignId('instructor_id')->constrained('instructors')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
