<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Créer un article
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('articles.store') }}" class="py-12">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Input de titre de l'article -->
                    <label for="title" class="block text-gray-700 mb-2">Titre de l'article</label>
                    <input type="text" name="title" id="title" placeholder="Titre de l'article"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ old('title') }}">
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                {{-- cat --}}
                <div class="p-6 pt-0 text-gray-900">
                    <label class="block text-gray-700 mb-2">Catégories</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($categories as $category)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    class="rounded border-gray-300"
                                    {{ is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : '' }}>
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('categories')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="p-6 pt-0 text-gray-900">
                    <!-- Contenu de l'article -->
                    <label for="content" class="block text-gray-700 mb-2">Contenu de l'article</label>
                    <textarea rows="15" name="content" id="content" placeholder="Contenu de l'article"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="p-6 text-gray-900 flex items-center">
                    <!-- Action sur le formulaire -->
                    <div class="grow">
                        <input type="checkbox" name="draft" id="draft"
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            {{ old('draft') ? 'checked' : '' }}>
                        <label for="draft">Article en brouillon</label>
                    </div>
                    <div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Créer l'article
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
