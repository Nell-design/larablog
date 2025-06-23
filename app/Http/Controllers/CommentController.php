<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Pour gérer l'authentification
use App\Models\Comment;               // Modèle Commentaire
use App\Models\Article;               // Modèle Article
use Illuminate\Http\Request;          // Pour récupérer les données du formulaire

class CommentController extends Controller
{
    // Méthode pour enregistrer un nouveau commentaire
    public function store(Request $request)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            // Si non connecté, redirige vers la page de connexion avec un message d'erreur
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour commenter.');
        }

        // Crée un nouveau commentaire
        // $comment = new Comment();
        // $comment->content = $request->input('content');         // Récupère le contenu du commentaire depuis le formulaire
        // $comment->user_id = Auth::id();                         // Associe le commentaire à l'utilisateur connecté
        // $comment->article_id = $request->input('article_id');   // Associe le commentaire à l'article concerné
        // $comment->save();

        Comment::create([
            'content' => $request->input('content'),
            'article_id' => $request->input('article_id'),
            'user_id' => Auth::user()->id
        ]);


        // Redirige vers la page de l'article avec un message de succès
        return redirect()->route('public.show', [
            'user' => Auth::user()->id,
            'article' => $request->input('article_id')
        ])->with('success', 'Commentaire ajouté avec succès !');
    }
}