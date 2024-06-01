<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'url_image',
        'a_la_une'
    ];

    // Permet de recuperer tous les commentaires lié a une article
    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class);
    }
}
