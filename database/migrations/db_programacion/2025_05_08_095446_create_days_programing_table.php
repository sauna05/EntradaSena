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
        Schema::create('days_programing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programming_id')->constrained('programming')->onDelete('cascade');
            $table->foreignId('day_id')->constrained('days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days_programing');
    }
};
