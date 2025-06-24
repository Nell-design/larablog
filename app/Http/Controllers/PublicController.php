<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(User $user)
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('user_id', $user->id)
        ->where('draft', 0)
        ->get();

        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user
        ]);
    }

    public function show(User $user, Article $article)
    {
        // $user est l'utilisateur de l'article

        if ($article->user_id !== $user->id || $article->draft == 1) {
            // Si l'article n'appartient pas à l'utilisateur ou s'il est en brouillon, on redirige vers la page d'accueil
            return redirect()
                ->route('public.index', ['user' => $user])
                ->with('error', 'Article non trouvé ou non publié.');
        }

        // Affiche la vue avec l'article et l'utilisateur
        return view('public.show', [
            'user' => $user,
            'article' => $article
        ]);
    }
}
