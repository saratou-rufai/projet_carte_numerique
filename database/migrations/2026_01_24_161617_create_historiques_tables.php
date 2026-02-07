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
    $table->foreignId('carte_id')->constrained()->cascadeOnDelete();
    $table->enum('action', [
        'activation',
        'suspension',
        'expiration'
    ]);
    $table->string('motif')->nullable();
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

