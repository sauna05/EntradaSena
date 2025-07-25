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
        Schema::create('people_days_available', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_person')->constrained('people')->onUpdate('cascade');
            $table->foreignId('id_day_available')->constrained('days_available')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people_days_avaliable');
    }
};
