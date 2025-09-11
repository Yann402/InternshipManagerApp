<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function PHPSTORM_META\type;

class TypeDocument extends Model
{
    protected $table = 'types_documents';
    protected $fillable = ['libelle','obligatoire','fourni_par', 'type_fichier']; 
    // fourni_par: 'stagiaire'|'responsable'

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'type_document_id');
    
    }
}