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
        Schema::create('activiteiten', function (Blueprint $table) {
            $table->id();
            $table->string('titel');
            $table->text('omschrijving')->nullable();
            $table->date('datum');
            $table->time('starttijd');
            $table->time('eindtijd');
            $table->string('locatie');
            $table->enum('type', ['les', 'toets', 'activiteit', 'overig'])->default('les');
            $table->foreignId('aangemaakt_door')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->index('datum');
            $table->index(['datum', 'starttijd']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activiteiten');
    }
};
