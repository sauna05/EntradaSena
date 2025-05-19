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
        //migracion jormada
        Schema::connection('db_programacion')->create('cohort_times', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Mañana, Tarde, Noche
            // $table->time('start_time');
            // $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cohort_times');
    }
};
