<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['nom_division', 'admin_id'];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'division_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
