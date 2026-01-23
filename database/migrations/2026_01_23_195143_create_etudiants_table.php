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
Schema::create('etudiants', function (Blueprint $table) {
    $table->id();
    $table->string('ine', 20)->unique();
    $table->string('nom', 100);
    $table->string('prenom', 100);
    $table->foreignId('filiere_id')->constrained()->cascadeOnDelete();
    $table->foreignId('niveau_id')->constrained()->cascadeOnDelete();
    $table->foreignId('annee_id')
          ->constrained('annees_academiques')
          ->cascadeOnDelete();
    $table->string('photo')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
