<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Demande extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'encadrant_id',
        'date_soumission',
        'statut', 'entreprise_id', 
        'motif_refus'
    ];

    // Selon ta correspondance actuelle :
    // en_attente ↔ soumis | en_cours ↔ en_cours | refuse ↔ refusé | valide ↔ encadrant_assigne
    public const STATUTS = ['en_attente','en_cours','refusé','validée'];

    public function stagiaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function encadrant(): BelongsTo
    {
        return $this->belongsTo(Encadrant::class, 'encadrant_id');
    }

    public function entreprise()
    {
    return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'demande_id');
    }

    public function historiques(): HasMany
    {
        return $this->hasMany(HistoriqueDemande::class, 'demande_id');
    }

    // Helpers de transition + écriture d'historique
    public function marquerEnCours(User $acteur): void
    {
        $this->update(['statut' => 'en_cours']);
        $this->historiques()->create([
            'acteur_id'   => $acteur->id,
            'action'      => 'en_cours',
            'date_action' => now(),
        ]);
    }

    public function refuser(User $acteur, ?string $commentaire = null): void
    {
        $this->update(['statut' => 'refusé']);
        $this->historiques()->create([
            'acteur_id'   => $acteur->id,
            'action'      => 'refusé',
            'commentaire' => $commentaire,
            'date_action' => now(),
        ]);
    }

    // Décision : chez toi "valide" = encadrant assigné
    public function assignerEncadrant(Encadrant $encadrant, User $acteur): void
    {
        $this->update([
            'encadrant_id' => $encadrant->id,
            'statut'       => 'validé',
        ]);
        $this->historiques()->create([
            'acteur_id'   => $acteur->id,
            'action'      => 'encadrant_assigné',
            'date_action' => now(),
        ]);
    }
}
