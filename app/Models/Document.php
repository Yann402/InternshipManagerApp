<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'demande_id',
        'type_document_id',
        'chemin_fichier',
        'statut',
        'date_upload'
    ];

    // Statuts définis
    const STATUTS_STAGIAIRE = ['en_attente', 'en_cours', 'valide', 'refuse'];
    const STATUTS_RESPONSABLE = ['non_disponible', 'disponible'];

    public function demande(): BelongsTo
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }

    public function typeDocument(): BelongsTo
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }

    // Helpers
    public function isFromStagiaire(): bool
    {
        return $this->type && $this->type->fourni_par === 'stagiaire';
    }

    public function isFromService(): bool
    {
        return $this->type && $this->type->fourni_par === 'responsable';
    }
}

