<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function sauvegarder(Request $request)
    {
        $request->validate([
            'nom_complet_auteur' => 'required|max:10',
            'contenu' => 'required|max:255',
            'article_id' => 'required|exists:articles,id',
        ]);

        $commentaire_id = $request->input('commentaire_id');
        if($commentaire_id == null){
            $commentaire = new Commentaire();
        } else {
            $commentaire = Commentaire::find($commentaire_id);
        }
        $commentaire->nom_complet_auteur = $request->nom_complet_auteur;
        $commentaire->contenu = $request->contenu;
        $commentaire->article_id = $request->article_id;
        $commentaire->save();
        return redirect('/articles/'.$commentaire->article_id);
    }

    public function supprimer($id){
        $commentaire = Commentaire::findorfail($id);
        $commentaire->delete(); 
        return redirect()->back();
    }
}
