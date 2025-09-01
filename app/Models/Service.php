<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['nom_service','division_id','responsable_id'];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    // Responsable = un utilisateur (role=responsable)
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function demandes(): HasMany
    {
        return $this->hasMany(Demande::class, 'service_id');
    }
    
    public function admin(): BelongsTo
    {
    return $this->belongsTo(User::class, 'admin_id');
    }
}
