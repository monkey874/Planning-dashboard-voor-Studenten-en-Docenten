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
            $table->text('omschrijving');
            $table->date('datum');
            $table->dateTime('starttijd');
            $table->dateTime('eindtijd');
            $table->enum('type', ['les', 'toets', 'activiteit', 'overig'])->default('les');
            $table->integer('aangemaakt_door');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('activiteiten');
    }
};
