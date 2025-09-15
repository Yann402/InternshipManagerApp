<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entreprise extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
        'email',
        'telephone',
        'secteur'
    ];

    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class, 'entreprise_id');
    }
}
