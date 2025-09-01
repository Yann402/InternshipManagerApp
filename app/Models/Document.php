<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'demande_id','type_document_id','chemin_fichier','statut','date_upload'
    ];

    // Regroupe tous les états possibles que tu as définis
    public const STATUTS = [
        'non_fourni','fourni','vérifié','refusé', // côté stagiaire
        'non_généré','généré'                     // côté service (puis verifie/refuse réutilisés)
    ];

        public function demande(): BelongsTo
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }

    // Aide : savoir si le doc est attendu du stagiaire ou du service
    public function isFromStagiaire(): bool
    {
        return optional($this->type)->fourni_par === 'stagiaire';
    }

    public function isFromService(): bool
    {
        return optional($this->type)->fourni_par === 'responsable';
    }
}
