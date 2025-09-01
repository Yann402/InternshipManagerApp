<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Encadrant extends Model
{
    protected $fillable = ['nom','prenom','email','telephone','specialite'];

    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class, 'encadrant_id');
    }
}
