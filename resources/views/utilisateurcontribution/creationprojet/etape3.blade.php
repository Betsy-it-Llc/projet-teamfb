@extends('layouts.appwithtailwind')
@section('content')

<main class="sm:mt-6 lg:mt-8 mt-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center">
    <!-- Hero Section  -->
    <section class="mx-auto">
        <div class="mx-auto max-w-[60%]">
            <h1 class="text-3xl text-center font-bold text-gray-900 dark:text-white">Présentation du projet / Description détaillée</h1>

            <form class="space-y-6" action="{{ route('creation.etape3.post') }}" method="POST">
                @csrf
                <div class="flex my-3">
                    <p>Lancer une collecte c’est écrire une histoire permettant à chacun(e) de comprendre votre point de départ. C’est ici que vous devez présenter votre projet et répondre aux premières questions des internautes : qu’est-ce que c’est ?</p>
                </div>
                <textarea name="description_detaille" id="description_detaille" class="w-full p-2 border rounded-lg" rows="4" placeholder="Saisissez votre texte ici"></textarea>

                @if ($nom_type !== 'Expérience')
                <h2 class="font-bold">Bénéficiaires finaux de votre collecte (obligatoire)</h2>
                <p>Qui sont les bénéficiaires des sommes collectées?</p>
                <input type="text" name="projetName" id="email"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                       placeholder="" required>

                <label for="localisation" class="block mb-2 text-xl font-bold font-medium text-gray-900 dark:text-white">Localisation du projet (obligatoire)</label>
                <input type="text" name="localisation" id="localisation"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                       placeholder="" required>
                <label for="porteurs" class="block mb-2 text-xl font-bold font-medium text-gray-900 dark:text-white">Porteurs du projet</label>
                <input type="text" name="porteurs" id="porteurs"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                       placeholder="" required>
                @endif

                <div class="container__btton flex justify-between">
                    <button type="submit"
                            class="text-white bg-gray-500 hover-bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Etape précédente
                    </button>
                    <button type="submit"
                            class="text-white bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover-bg-blue-700 dark:focus:ring-blue-800">
                        Etape Suivante
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection
