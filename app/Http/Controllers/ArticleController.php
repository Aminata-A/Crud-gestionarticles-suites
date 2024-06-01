<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use PDO;

class ArticleController extends Controller
{
    public function index(){

        $articles = Article::paginate(12); //récupération des donnees
        // $articles = Article::paginate(12); //récupération des donnees
        return view('articles.index', ['articles' => $articles]);
    }

    public function detail($id, $id_commentaire = Null)
    {
        // SELECT * From articles where id= id
        // $article = Article::findOrFail($id);

        $article = Article::find($id);

        if (empty($article)) {
            return redirect('/');
        }

        // SELECT * From Commentaires where article_id = id
        //$commentaires = Commentaire::where('article_id', '=', $id)->get();

        $commentaires = $article->commentaires;
        $commentaire_to_edit = Null;
        if($id_commentaire != Null){
            $commentaire_to_edit = Commentaire::find($id_commentaire);
        }

        return view('articles.detail', [
            'article' => $article,
            'commentaires' => $commentaires,
            'commentaire_to_edit' => $commentaire_to_edit,
        ]);

        //  Article::all() => Select * from articles;
        //  Article::find() => Select * from articles where id = id

    }

    public function partager()
    {
        return view('articles.partager');
    }

    public function sauvegarde(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required',
            'a_la_une' => 'required',
            'url_image' => 'required',
        ]);

        Article::create($request->all());


        // $article = new Article();
        // $article->nom = $request->nom_article;
        // $article->description = $request->description;
        // $article->url_image = $request->url_image_article;
        // $article->a_la_une = false;
        // $article->save();


        return redirect('/articles');
        // Article::create();
    }
    public function modifier($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.modifier', compact('article'));
    }

    public function ecrire(Request $request)
    {
        
        
        $article = Article::findOrFail($request->id);
        $article->nom = $request->input('nom');
        $article->description = $request->input('description');
        $article->url_image = $request->input('url_image');
        $article->a_la_une = $request->has('a_la_une');
    
        $article->update();
    
        return redirect('/articles');
        // $request->validate([
        //     'nom' => 'required|max:255',
        //     'description' => 'required',
        //     'a_la_une' => 'required',
        //     'url_image' => 'required',
        // ]);

        // Article::update($request->all());


        // $article = new Article();
        // $article->nom = $request->nom_article;
        // $article->description = $request->description;
        // $article->url_image = $request->url_image_article;
        // $article->a_la_une = false;
        // $article->save();


        //return redirect('/articles');
        // Article::create();
    }

    public function supprimer($id){
        $article = Article::findOrFail($id);
        // Supprimer les commentaires associés
        $article->commentaires()->delete();

        // Supprimer l'article
        $article->delete();

        return redirect('/articles')->with('success', 'Article et ses commentaires supprimés avec succès.');
    }
 


    
}
