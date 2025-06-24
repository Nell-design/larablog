<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (session('status') === 'Auth')
        <div x-data="{ show: true, progress: 0 }" x-init="let interval = setInterval(() => {
            if (progress < 100) progress += 2;
            else {
                show = false;
                clearInterval(interval);
            }
        }, 40);" x-show="show"
            class="relative bg-gradient-to-r from-green-400 to-green-600 text-white p-4 rounded-lg mt-6 mb-6 max-w-7xl mx-auto text-center shadow-lg overflow-hidden">
            <div class="flex items-center justify-center space-x-2">
                <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-semibold text-lg">Bienvenue, vous êtes connecté !</span>
            </div>
            <div class="absolute left-0 bottom-0 h-1 bg-green-800/30 w-full">
                <div class="h-1 bg-white/80 transition-all duration-75" :style="'width: ' + progress + '%'"></div>
            </div>
        </div>
    @endif

    <!-- Message flash -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 max-w-7xl mx-auto text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
            {{ session('error') }}
        </div>
    @endif

    <div class="text-center mt-6 mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Mes articles
        </h2>
        <p class="text-gray-600 mb-4 dark:text-gray-400">Vous pouvez consulter et gérer vos articles publiés et
            brouillons ici.</p>
    </div>

    {{-- Articles publiés --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto mt-4">
        @forelse ($articles as $article)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col justify-between">

                <div>
                    {{-- categories --}}
                    <div class="mb-2">
                        @foreach ($article->categories as $category)
                            <span
                                class="inline-block bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-200 shadow-sm text-xs px-3 py-1 rounded-full mr-1 mb-1">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">{{ $article->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit($article->content, 80) }}</p>
                    <a href="{{ route('public.show', ['user' => $article->user_id, 'article' => $article->id]) }}"
                        class="text-gray-600 hover:underline font-semibold">
                        Lire plus
                    </a>




<p class="text-gray-500 text-xs mb-1">
    Créé le {{ $article->created_at->format('d/m/Y H:i') }}
    <br>
    Modifié le {{ $article->updated_at->format('d/m/Y H:i') }}
</p>




                </div>
                <div class="flex justify-between items-center mt-4 space-x-4">
                    <a href="{{ route('articles.edit', $article->id) }}"
                        class="flex items-center text-blue-500 hover:bg-blue-100 hover:text-blue-700 px-2 py-1 rounded transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 4H7.2c-1.12 0-1.68 0-2.108.218a2 2 0 0 0-.874.874C4 5.52 4 6.08 4 7.2v9.6c0 1.12 0 1.68.218 2.108a2 2 0 0 0 .874.874c.427.218.987.218 2.105.218h9.606c1.118 0 1.677 0 2.104-.218c.377-.192.683-.498.875-.874c.218-.428.218-.987.218-2.105V14m-4-9l-6 6v3h3l6-6m-3-3l3-3l3 3l-3 3m-3-3l3 3" />
                        </svg>
                        <span class="ml-1">Modifier</span>
                    </a>
                    <a href="{{ route('articles.remove', $article->id) }}"
                        onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')"
                        class="flex items-center text-red-500 hover:bg-red-100 hover:text-red-700 px-2 py-1 rounded transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M9.774 5L3.758 3.94l.174-.986a.5.5 0 0 1 .58-.405L18.411 5h.088h-.087l1.855.327a.5.5 0 0 1 .406.58l-.174.984l-2.09-.368l-.8 13.594A2 2 0 0 1 15.615 22H8.386a2 2 0 0 1-1.997-1.883L5.59 6.5h12.69zH5.5zM9 9l.5 9H11l-.4-9zm4.5 0l-.5 9h1.5l.5-9zm-2.646-7.871l3.94.694a.5.5 0 0 1 .405.58l-.174.984l-4.924-.868l.174-.985a.5.5 0 0 1 .58-.405z" />
                        </svg>
                        <span class="ml-1">Supprimer</span>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500 dark:text-gray-400">Aucun article publié.</div>
        @endforelse
    </div>

    {{-- Brouillons --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto  mt-8">
        @forelse ($drafts as $article)
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col justify-between border-l-4 border-yellow-400">
                <div>
                    <span class="inline-block bg-yellow-400 text-white text-xs px-2 py-1 rounded mb-2">Brouillon</span>
                    {{-- categories --}}
                    <div class="mb-2">
                        @foreach ($article->categories as $category)
                            <span
                                class="inline-block bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-200 shadow-sm text-xs px-3 py-1 rounded-full mr-1 mb-1">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">{{ $article->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit($article->content, 30) }}</p>
                </div>
                <div class="flex justify-between items-center mt-4 space-x-4">
                    <a href="{{ route('articles.edit', $article->id) }}"
                        class="flex items-center text-blue-500 hover:bg-blue-100 hover:text-blue-700 px-2 py-1 rounded transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 4H7.2c-1.12 0-1.68 0-2.108.218a2 2 0 0 0-.874.874C4 5.52 4 6.08 4 7.2v9.6c0 1.12 0 1.68.218 2.108a2 2 0 0 0 .874.874c.427.218.987.218 2.105.218h9.606c1.118 0 1.677 0 2.104-.218c.377-.192.683-.498.875-.874c.218-.428.218-.987.218-2.105V14m-4-9l-6 6v3h3l6-6m-3-3l3-3l3 3l-3 3m-3-3l3 3" />
                        </svg>
                        <span class="ml-1">Modifier</span>
                    </a>
                    <a href="{{ route('articles.remove', $article->id) }}"
                        onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')"
                        class="flex items-center text-red-500 hover:bg-red-100 hover:text-red-700 px-2 py-1 rounded transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M9.774 5L3.758 3.94l.174-.986a.5.5 0 0 1 .58-.405L18.411 5h.088h-.087l1.855.327a.5.5 0 0 1 .406.58l-.174.984l-2.09-.368l-.8 13.594A2 2 0 0 1 15.615 22H8.386a2 2 0 0 1-1.997-1.883L5.59 6.5h12.69zH5.5zM9 9l.5 9H11l-.4-9zm4.5 0l-.5 9h1.5l.5-9zm-2.646-7.871l3.94.694a.5.5 0 0 1 .405.58l-.174.984l-4.924-.868l.174-.985a.5.5 0 0 1 .58-.405z" />
                        </svg>
                        <span class="ml-1">Supprimer</span>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500 dark:text-gray-400">Aucun brouillon.</div>
        @endforelse
    </div>
</x-app-layout>
