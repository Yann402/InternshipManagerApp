<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'password',
        'role',
        'formation',
        'niveau_etude',
        'telephone',
        'adresse',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean'
        ];
    }

    // Un stagiaire soumet plusieurs demandes :
    public function demandes(): HasMany{
        return $this->hasMany(Demande::class, 'user_id');
    }

    // Un user (admin, responsable) peut être acteur dans l’historique
    public function historiques(): HasMany
    {
        return $this->hasMany(HistoriqueDemande::class, 'acteur_id');
    }

        // Si tu utilises "responsable_id" sur Service :
    public function serviceResponsable(): HasOne
    {
        return $this->hasOne(Service::class, 'responsable_id');
    }

    // Helpers rapides de rôle
    public function isAdmin(): bool        { return $this->role === 'admin'; }
    public function isResponsable(): bool  { return $this->role === 'responsable'; }
    public function isStagiaire(): bool    { return $this->role === 'stagiaire'; }

}
