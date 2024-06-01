<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_complet_auteur',
        'contenu',
        'article_id'
    ];


    // Permet de recuperer l'article du commentaire
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
