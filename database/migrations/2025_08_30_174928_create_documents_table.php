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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained('demandes')->onDelete('cascade');
            $table->foreignId('type_document_id')->constrained('types_documents')->onDelete('cascade');
            $table->string('chemin_fichier')->nullable();
            $table->enum('statut', [
                    'en_attente',   // pour les docs stagiaires
                    'en_cours',
                    'valide',
                    'refuse',
                    'non_disponible', // pour les docs générés
                    'disponible'
            ])->default('en_attente');
            $table->date('date_upload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
