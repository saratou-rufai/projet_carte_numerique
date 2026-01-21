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
        Schema::create('cartes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->unique()->constrained('etudiants')->onDelete('cascade');
            $table->string('numero_carte')->unique();
            $table->string('qr_code')->unique();
            $table->enum('statut', ['active', 'suspendue', 'expiree'])->default('active');
            $table->date('date_creation');
            $table->date('date_expiration');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartes');
    }
};
