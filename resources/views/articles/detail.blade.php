<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Détail de : {{ $article->nom}}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 font-italic">{{ $article->nom }}</h1>
            </div>
        </div>
    </div>
    <br><br>
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    {{ $article->nom }}
                </h3>

                <div class="blog-post">
                    <p class="blog-post-meta">January 1, 2014 by <a href="#">Samba</a></p>

                    <p> {{ $article->description }} </p>

                </div><!-- /.blog-post -->
            </div><!-- /.blog-main -->

            <aside class="col-md-4 blog-sidebar">
                <div class="p-3 mb-3 bg-light rounded">
                    <h4 class="font-italic">About</h4>
                    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>
                <div class="row">
                    <div class="col">
                        <nav class="blog-pagination">
                            <a class="btn btn-outline-primary" href="/articles">Accueil</a>
                            <a class="btn btn-outline-secondary " href="/articles/partager">Partager</a>
                            <a class="btn btn-outline-secondary " href="/articles/modifier/{{$article->id}}">modifier</a>
                            <a class="btn btn-outline-secondary " href="/articles/supprimer/{{$article->id}}" class="btn-danger">supprimer</a>
                        </nav>
                    </div>
                </div>

            </aside><!-- /.blog-sidebar -->
            <hr class="my-5">
        </div><!-- /.row -->

        <section class="liste-commentaires">
            <div class="row">
                <div class="col">
                    <h3> <i class="fa-solid fa-comments"></i> Vos commentaires </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <ol class="list-group list-group-numbered">
                        @foreach ($commentaires as $commentaire )
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ $commentaire->nom_complet_auteur}}</div>
                                {{ $commentaire->contenu}}
                                <a href="/commentaires/supprimer/{{ $commentaire->id }}" class="danger" style="color:red">Supprimer</a>
                                <a href="/articles/{{ $article->id }}/commentaires/{{ $commentaire->id }}" class="danger" style="">modifier</a>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
                <div class="col-5">
                    <form action="/commentaires/sauvegarder" method="POST">
                        @csrf
                        <input type="hidden" name="article_id" value="{{$article->id}}">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Présentez vous ! </label>
                            @if ($commentaire_to_edit != Null)
                                <input type="hidden" name="commentaire_id" value="{{$commentaire_to_edit->id}}">
                                <input type="text" class="form-control @error('nom_complet_auteur') is-invalid @enderror" id="nom" name="nom_complet_auteur" value="{{ $commentaire_to_edit->nom_complet_auteur }}">                                
                            @else
                                <input type="text" class="form-control @error('nom_complet_auteur') is-invalid @enderror" id="nom" name="nom_complet_auteur" value="{{ old('nom_complet_auteur') }}">
                            @endif
                            @error('nom_complet_auteur')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contenu" class="form-label">Laissez nous un mot ! </label>
                            @if ($commentaire_to_edit != Null)
                                <textarea class="form-control  @error('contenu') is-invalid @enderror" id="contenu" name="contenu">{{ $commentaire_to_edit->contenu }}</textarea>
                            @else
                                <textarea class="form-control  @error('contenu') is-invalid @enderror" id="contenu" name="contenu">{{ old('contenu') }}</textarea>
                            @endif
                            <!-- -->
                            @error('contenu')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-secondary">Envoyer</button>
                    </form>
                </div>
            </div>
        </section>



    </main><!-- /.container -->

    <footer class="blog-footer">

    </footer>

</body>

</html>
