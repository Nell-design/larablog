<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 mb-4 mt-4 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 text-center dark:text-gray-100">
                    {{ __('You are connected!') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Message flash -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 max-w-7xl mx-auto text-center">
            {{ session('success') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
            {{ session('error') }}
        </div>
    @endif


    <div class="text-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Article list
        </h2>
        <p class="text-gray-600 mb-4 dark:text-gray-400">You can view and manage your published articles here.</p>
    </div>

    <!-- Articles -->
    @foreach ($articles as $article)
        <div class="bg-gray-800 flex justify-between p-6 text-white max-w-7xl  mx-auto overflow-hidden shadow-sm sm:rounded-lg mt-4">
            <div>
                <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                <p class="text-gray-500">{{ substr($article->content, 0, 30) }}...</p>
            </div>

            <div class="flex flex-end justify-end  space-x-4">
                <div class="">
                    <a href="{{ route('articles.edit', $article->id) }}" class="text-blue-500 hover:text-blue-700"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 4H7.2c-1.12 0-1.68 0-2.108.218a2 2 0 0 0-.874.874C4 5.52 4 6.08 4 7.2v9.6c0 1.12 0 1.68.218 2.108a2 2 0 0 0 .874.874c.427.218.987.218 2.105.218h9.606c1.118 0 1.677 0 2.104-.218c.377-.192.683-.498.875-.874c.218-.428.218-.987.218-2.105V14m-4-9l-6 6v3h3l6-6m-3-3l3-3l3 3l-3 3m-3-3l3 3" />
                        </svg> </a>
                </div>
                <div class="">
                    <a href="{{ route('articles.remove', $article->id) }}" class="text-red-500 hover:text-red-700"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M9.774 5L3.758 3.94l.174-.986a.5.5 0 0 1 .58-.405L18.411 5h.088h-.087l1.855.327a.5.5 0 0 1 .406.58l-.174.984l-2.09-.368l-.8 13.594A2 2 0 0 1 15.615 22H8.386a2 2 0 0 1-1.997-1.883L5.59 6.5h12.69zH5.5zM9 9l.5 9H11l-.4-9zm4.5 0l-.5 9h1.5l.5-9zm-2.646-7.871l3.94.694a.5.5 0 0 1 .405.58l-.174.984l-4.924-.868l.174-.985a.5.5 0 0 1 .58-.405z" />
                        </svg></a>
                </div>
            </div>


        </div>
    @endforeach

</x-app-layout>
