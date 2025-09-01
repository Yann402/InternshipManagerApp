<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueDemande extends Model
{
    protected $table = 'historique_demandes';

    protected $fillable = ['demande_id','acteur_id','action','commentaire','date_action'];

    // Actions retenues (propre et sans doublon)
    public const ACTIONS = [
        'soumis', 'en_cours', 'refusé', 'encadrant_assigné'
    ];

    public function demande(): BelongsTo
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }

    public function acteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'acteur_id');
    }
    
}
