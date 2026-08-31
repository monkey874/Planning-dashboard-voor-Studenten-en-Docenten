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
        Schema::create('activiteit_klas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activiteit_id')->constrained('activiteiten')->cascadeOnDelete();
            $table->foreignId('klas_id')->constrained('klassen')->cascadeOnDelete();

            $table->unique(['activiteit_id', 'klas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activiteit_klas');
    }
};
