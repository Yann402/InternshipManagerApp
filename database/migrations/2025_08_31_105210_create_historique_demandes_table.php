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
        Schema::create('historique_demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained('demandes')->onDelete('cascade');
            $table->foreignId('acteur_id')->constrained('users')->onDelete('cascade');
            $table->enum('action', [
                'soumis', 'en_cours', 'refusé', 'encadrant_assigné']);
            $table->text('commentaire')->nullable();
            $table->timestamp('date_action')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_demandes');
    }
};
