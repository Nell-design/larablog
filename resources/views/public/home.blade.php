@extends('layouts.app')

@section('title', 'Accueil - Mon Blog')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Bienvenue sur Mon site de Blog</h1>
        <p class="lead">
            Rejoignez une communauté dynamique où vous pouvez créer un compte, publier vos propres articles, liker et commenter ceux des autres, et bien plus encore !
        </p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-success mt-3 mx-2">Créer un compte</a>
            <a href="{{ route('login') }}" class="btn btn-outline-primary mt-3 mx-2">Se connecter</a>
        @else
            <a href="{{ route('articles.create') }}" class="btn btn-primary mt-3">Écrire un nouvel article</a>
        @endguest
    </div>

    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Derniers articles</h2>
            @forelse($articles as $article)
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">
                            <a href="{{ route('articles.store', $article) }}">{{ $article->title }}</a>
                        </h3>
                        <p class="card-text">{{ Str::limit($article->content, 150) }}</p>
                        <div class="mb-2">
                            <span class="badge bg-info">{{ $article->category->name ?? 'Sans catégorie' }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <form action="{{ route('articles.like', $article) }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-heart"></i> {{ $article->likes_count ?? 0 }}
                                </button>
                            </form>
                            <a href="{{ route('articles.store', $article) }}#comments" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-chat"></i> {{ $article->comments_count ?? 0 }} Commentaires
                            </a>
                        </div>
                        <small class="text-muted">
                            Publié le {{ $article->created_at->format('d/m/Y') }} par {{ $article->user->name ?? 'Auteur inconnu' }}
                        </small>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">Aucun article pour le moment. Soyez le premier à en publier un !</div>
            @endforelse

            <div class="d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        </div>
        <div class="col-md-4">
            <h2>À propos</h2>
            <p>
                Ce blog est un espace où chaque membre peut partager ses connaissances, ses expériences et ses passions autour du développement web, de la programmation, de la technologie et de la vie quotidienne d’un développeur.
            </p>
            <h3>Fonctionnalités principales</h3>
            <ul>
                <li>Créer un compte et personnaliser votre profil</li>
                <li>Publier, éditer et supprimer vos articles</li>
                <li>Liker et commenter les articles des autres membres</li>
                <li>Suivre vos auteurs préférés</li>
                <li>Recevoir des notifications sur les nouveaux commentaires et likes</li>
            </ul>
            <h3>Catégories populaires</h3>
            <ul>
                <li><a href="{{ route('categories.show', ['category' => 'technologie']) }}">Technologie</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'sport']) }}">Sport</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'jeux-video']) }}">Jeux vidéo</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'cinema']) }}">Cinéma</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'musique']) }}">Musique</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'ia']) }}">IA</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'developpement']) }}">Développement</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'informatique']) }}">Informatique</a></li>
            </ul>
            <h3>Suivez-nous</h3>
            <a href="#" class="btn btn-outline-dark btn-sm">Twitter</a>
            <a href="#" class="btn btn-outline-dark btn-sm">GitHub</a>
            <a href="#" class="btn btn-outline-dark btn-sm">LinkedIn</a>
        </div>
    </div>

    <section class="my-5">
        <h2 class="text-center mb-4">Pourquoi rejoindre notre communauté ?</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <i class="bi bi-lightbulb display-4"></i>
                <h4>Partage & Inspiration</h4>
                <p>Publiez vos idées, inspirez les autres et découvrez des articles variés écrits par des passionnés comme vous.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-code-slash display-4"></i>
                <h4>Tutoriels & Astuces</h4>
                <p>Apprenez de nouvelles technologies grâce à des tutoriels détaillés et des conseils pratiques partagés par la communauté.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-people display-4"></i>
                <h4>Interaction & Communauté</h4>
                <p>Commentez, likez, échangez avec d’autres membres et développez votre réseau professionnel et plus encore.</p>
            </div>
        </div>
    </section>

    <section class="my-5">
        <h2 class="text-center mb-4">Comment ça marche ?</h2>
        <div class="row">
            <div class="col-md-3 text-center">
                <i class="bi bi-person-plus display-5"></i>
                <h5>1. Inscrivez-vous</h5>
                <p>Créez un compte gratuitement pour accéder à toutes les fonctionnalités.</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="bi bi-pencil-square display-5"></i>
                <h5>2. Publiez</h5>
                <p>Rédigez et partagez vos articles, tutoriels ou expériences.</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="bi bi-heart display-5"></i>
                <h5>3. Likez & Commentez</h5>
                <p>Exprimez votre soutien et échangez avec les auteurs.</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="bi bi-trophy display-5"></i>
                <h5>4. Gagnez en visibilité</h5>
                <p>Devenez un membre actif et faites-vous remarquer dans la communauté.</p>
            </div>
        </div>
    </section>

    <section class="my-5">
        <h2 class="text-center mb-4">Témoignages de membres</h2>
        <div class="row">
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p>“Grâce à ce blog, j’ai pu partager mes projets et recevoir des retours constructifs de développeurs du monde entier.”</p>
                    <footer class="blockquote-footer">Sarah, Développeuse web</footer>
                </blockquote>
            </div>
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p>“La communauté est très active et bienveillante. J’ai appris énormément grâce aux articles et aux discussions.”</p>
                    <footer class="blockquote-footer">Yann, Étudiant en informatique</footer>
                </blockquote>
            </div>
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p>“Publier sur ce blog m’a permis de me faire connaître et de trouver de nouvelles opportunités professionnelles.”</p>
                    <footer class="blockquote-footer">Aminata, Freelance</footer>
                </blockquote>
            </div>
        </div>
    </section>
</div>
@endsection
