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
        Schema::create('pokemon_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pokemon_id')->constrained('pokemons')->onDelete('cascade');
            $table->string('field_name', 255);
            $table->enum('field_type', ['text', 'number', 'date']);
            $table->string('field_value', 255)->nullable();
            $table->string('field_format', 255)->nullable();
            $table->timestamps();

            $table->unique(['pokemon_id', 'field_name'], 'unique_field_per_pokemon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_fields');
    }
};
