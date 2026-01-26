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

            // 🔐 TOKEN PUBLIC POUR QR CODE
            $table->string('token')->unique();

            // ✅ NUMÉRO DE CARTE
            $table->string('numero')->unique();

            // 🔗 Lien avec l’étudiant
            $table->foreignId('etudiant_id')->constrained()->cascadeOnDelete();

            $table->date('date_creation');
            $table->date('date_expiration');

            $table->enum('statut', ['active', 'expiree', 'suspendue'])
                  ->default('active');

            // (optionnel mais tu l'avais déjà)
            $table->string('qr_code')->unique();

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
