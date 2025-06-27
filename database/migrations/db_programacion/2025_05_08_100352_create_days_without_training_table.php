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
        Schema::create('days_without_training', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique(); // la fecha que se marcará como no laborable
            $table->string('reason'); // motivo: festivo, mantenimiento, evento, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days_without_training');
    }
};
