@extends('layouts.appwithtailwind')

@section('content')
<main class="sm:mt-6 lg:mt-8 mt-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center">
    <!-- Hero Section -->
    <section class="mx-auto">
        <div>
            <h1 class="text-3xl text-center font-bold text-gray-900 dark:text-white">Projet {{ $nom_type }}</h1>
            <form class="space-y-6" action="{{ route('creation.etape2.post') }}" method="POST">
                @csrf
                <div>
                    <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du projet</label>
                    <input type="text" name="nom" id="nom"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="" required>
                </div>

                <div id="montantToggle" class="hidden">
                    <label for="objectif_financier" class="block text-sm font-medium text-gray-900 dark:text-white">Montant</label>
                    <input type="number" name="objectif_financier" id="objectif_financier" class="border rounded p-2 w-48">
                </div>

                <div class="flex justify-between">
                    <span class="text-left ml-3 text-sm font-medium text-gray-900 dark:text-gray-300 px-2">
                        Définir un montant à atteindre
                    </span>

                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" id="checkBox" value="" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-focus:ring-gray-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-700">
                        </div>
                    </label>
                </div>

                <div class="mt-0">
                    <span class="ml-3 text-sm font-medium text-gray-500 dark:text-gray-300 px-2">Vous pouvez modifier votre objectif plus tard</span>
                </div>

                <div class=" flex justify-between">
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300 px-2">Cacher le montant des participants</span>
                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-focus:ring-gray-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-700">
                        </div>
                    </label>
                </div>

                <div class="container__btton flex justify-between">
                    <button type="submit">
                        <a href="#" class="text-white bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Étape précédente</a>
                    </button>
                    <button type="submit" class="text-white bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Étape suivante</
@endsection