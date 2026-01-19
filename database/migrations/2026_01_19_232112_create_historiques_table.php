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
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrateur_id') ->constrained('administrateurs')->onDelete('cascade');
            $table->foreignId('etudiant_id')->nullable()->constrained('etudiants')->onDelete('set null');
            $table->string('action');
            $table->text('description')->nullable();
            $table->string('adresse_ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};
