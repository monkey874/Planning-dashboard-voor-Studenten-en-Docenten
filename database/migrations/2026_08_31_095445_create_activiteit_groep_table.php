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
        Schema::create('activiteit_groep', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activiteit_id')->constrained('activiteiten')->cascadeOnDelete();
            $table->foreignId('groep_id')->constrained('groepen')->cascadeOnDelete();

            //$table->unique(['activiteit_id', 'groep_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activiteit_groep');
    }
};
