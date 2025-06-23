<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Category;



class UserController extends Controller
{
    public function create()
    {
        // On récupère toutes les catégories
        $categories = Category::all();

        // On retourne la vue de création d'article avec les catégories
        return view('articles.create', compact('categories'));
    }

public function store(Request $request)
{
    // Validation des données du formulaire
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'draft' => 'nullable',
        'categories' => 'nullable|array',
        'categories.*' => 'exists:categories,id',
    ]);

    // Créateur de l'article (auteur)
    $validated['user_id'] = Auth::user()->id;

    // Gestion du draft
    $validated['draft'] = isset($validated['draft']) ? 1 : 0;

    // On crée l'article
    $article = Article::create($validated); // $Article est l'objet article nouvellement créé

    // Synchronise les catégories sélectionnées (ou vide si aucune)
    $categories = $request->input('categories', []);
    $article->categories()->sync($categories);

    // On redirige l'utilisateur vers la liste des articles
    return redirect()->route('dashboard')->with('success', 'Article créé avec succès !');
}

public function index()
{
    // On récupère l'utilisateur connecté.
    $user = Auth::user();

    $articles = Article::where('user_id', $user->id)
     ->where('draft', 0) // On récupère uniquement les articles publiés
    ->latest() // On récupère les articles les plus récents
    ->get(); // On récupère les articles de l'utilisateur

      // Brouillons
    $drafts = Article::where('user_id', $user->id)
        ->where('draft', 1)
        ->latest()
        ->get();

    // On retourne la vue.
    return view('dashboard', [
        'articles' => $articles,
        'drafts' => $drafts
    ]);
}

public function edit(Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }
    $categories = Category::all();
    // On retourne la vue avec l'article
    return view('articles.edit', [
        'article' => $article,
        'categories' => $categories
    ]);
}

public function update(Request $request, Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }

    //  On récupère les données du formulaire
    $data = $request->only(['title', 'content', 'draft']);

    // Gestion du draft
    $data['draft'] = isset($data['draft']) ? 1 : 0;

    // On met à jour l'article
    $article->update($data);
    // Synchronise les catégories sélectionnées
if ($request->has('categories')) {
    $article->categories()->sync($request->input('categories'));
} else {
    $article->categories()->sync([]); // Si aucune catégorie sélectionnée
}

    // On redirige l'utilisateur vers la liste des articles (avec un flash)
    return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
}


// On peut aussi ajouter une méthode destroy pour supprimer un article
// Si on veut supprimer un article, on peut décommenter la méthode suivante


 public function remove(Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }

    // On supprime l'article
    $article->delete();

     // On redirige l'utilisateur vers la liste des articles (avec un flash)
     return redirect()->route('dashboard')->with('success', 'Article supprimé !');
 }

public function like(Article $article)
{
    $article->increment('likes');
    return back();
}

}