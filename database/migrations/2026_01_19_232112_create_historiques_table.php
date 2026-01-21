<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // L'étudiant peut être nul si l'action ne le concerne pas directement
            $table->foreignId('etudiant_id')->nullable()->constrained('etudiants')->onDelete('set null');

            $table->string('action'); 
            $table->text('description')->nullable();
            $table->string('adresse_ip', 45)->nullable(); // 45 caractères pour supporter l'IPv6
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};
