<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentaireController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index']);

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'detail'])->where('id', '[0-9]+')->name('detail');
Route::get('/articles/{id}/commentaires/{id_commentaire}', [ArticleController::class, 'detail'])->where('id', '[0-9]+')->name('detail');
Route::get('/articles/partager', [ArticleController::class, 'partager']);
Route::post('/articles/sauvegarde', [ArticleController::class, 'sauvegarde']);
Route::get('/articles/modifier/{id}', [ArticleController::class, 'modifier']);
Route::post('/articles/ecrire', [ArticleController::class, 'ecrire']);
Route::get('/articles/supprimer/{id}', [ArticleController::class, 'supprimer']);

Route::post('/commentaires/sauvegarder', [CommentaireController::class, 'sauvegarder']);
Route::get('/commentaires/supprimer/{id}', [CommentaireController::class, 'supprimer']);
