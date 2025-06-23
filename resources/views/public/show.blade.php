<x-guest-layout>
    <!-- Titre de l'article -->
    <div class="text-center mt-6">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight mb-2">
            {{ $article->title }}
        </h2>
        <!-- Catégories de l'article -->
        <div class="mb-2">
            @foreach ($article->categories as $category)
                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>
        <div class="text-gray-500 text-sm mb-4">
            Publié le {{ $article->created_at->format('d/m/Y') }} par
            <a href="{{ route('public.index', $article->user->id) }}" class="text-blue-600 underline">
                {{ $article->user->name }}
            </a>
        </div>
    </div>

    <!-- Contenu de l'article -->
    <div class="max-w-3xl mx-auto">
        <div class="p-6 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $article->content }}</p>
        </div>
    </div>

    <!-- Bouton Like et compteur -->
    {{-- <div class="flex items-center justify-center mb-8">
        <form action="{{ route('articles.like', $article->id) }}" method="POST" class="mr-2">
            @csrf
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                👍 Like
            </button>
        </form>
        <span class="text-gray-700 font-semibold">
            {{ $article->likes }} like{{ $article->likes > 1 ? 's' : '' }}
        </span>
    </div> --}}

    <!-- Bloc des commentaires -->
    <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md mt-8">
        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Commentaires</h3>

        <!-- Formulaire d'ajout de commentaire -->
        @auth
            <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                @csrf
                <textarea name="content" rows="3" class="w-full p-2 border border-gray-300 rounded-md"
                    placeholder="Ajouter un commentaire...">{{ old('content') }}</textarea>
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                @error('content')
                    <div class="text-red-600 mt-2">{{ $message }}</div>
                @enderror
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md">Commenter</button>
            </form>
        @else
            <div class="mt-6 text-red-600">
                Vous devez <a href="{{ route('login') }}" class="text-blue-600 underline">être connecté</a> pour commenter.
            </div>
        @endauth

        <!-- Liste des commentaires existants -->
        <div class="mt-4">
            @forelse ($article->comments as $comment)
                <div class="p-4 border-b border-gray-200">
                    <p class="text-gray-700">{{ $comment->content }}</p>
                    <div class="text-sm text-gray-500 mt-1">
                        Publié par
                        <a href="{{ route('public.index', $comment->user->id) }}" class="text-blue-600 underline">
                            {{ $comment->user->name }}
                        </a>
                        le {{ $comment->created_at->format('d/m/Y') }}
                    </div>
                </div>
            @empty
                <div class="text-gray-500 mt-2">Aucun commentaire pour cet article.</div>
            @endforelse
        </div>
    </x-guest-layout>