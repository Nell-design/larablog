<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des articles publiés de {{ $user->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto grid gap-8 mt-8">
        <!-- Articles -->
        @foreach ($articles as $article)
            <div
                class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    {{-- image --}}
                    <div class="md:w-1/3">
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                            class="w-full h-48 md:h-full object-cover rounded-t-xl md:rounded-l-xl md:rounded-tr-none transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="md:w-2/3 p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center mb-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400 mr-2">
                                    Publié le {{ $article->created_at->format('d/m/Y') }} par
                                </span>
                                <a href="{{ route('public.index', $article->user_id) }}"
                                    class="text-indigo-600 dark:text-indigo-300 font-semibold hover:underline">
                                    {{ $article->user->name }}
                                </a>
                            </div>
                            {{-- categories --}}
                            <div class="mb-2">
                                @foreach ($article->categories as $category)
                                    <span
                                        class="inline-block bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-200 shadow-sm text-xs px-3 py-1 rounded-full mr-1 mb-1">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                            {{-- Titre et contenu --}}
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-2">{{ $article->title }}
                            </h2>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ Str::limit($article->content, 80) }}</p>
                        </div>
                        <div  class="flex flex-row md:flex-row items-center justify-between mt-4">
                            <a href="{{ route('public.show', [$article->user_id, $article->id]) }}"
                                class="inline-block px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition-colors duration-200">
                                Lire la suite
                            </a>
                            <!-- Bouton Like et compteur -->
                            <div class="flex items-center mb-8">
                                <form action="{{ route('articles.like', $article->id) }}" method="POST"
                                    class="mr-2">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                        💖 Like
                                    </button>
                                </form>
                                <span class="text-gray-700 font-semibold">
                                    {{ $article->likes }} like{{ $article->likes > 1 ? 's' : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-guest-layout>