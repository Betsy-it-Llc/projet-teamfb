@extends('layouts.appwithtailwind')
@section('content')

    <main class="sm:mt-6 lg:mt-8 mt-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center">
        <!-- Hero Section  -->
        <section class="mx-auto ">

            <div class="">
                <h1 class="text-3xl text-center font-bold text-gray-900 dark:text-white">Projet {{ $nom_type }}</h1>
                <form action="{{ route('creation.etape4.post') }}" method="POST">
                    @csrf
                    <p>M’afficher en tant que participant / rester anonyme</p>
                    </div>


                    <div>
                        <label for="info_contributeur" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">
                        Informations envoyées aux contributeurs</label>
                        <p>Rédigez un court message à présenter à vos contributeurs et sur leur mail de confirmation.</p>

                        <input type="text" name="info_contributeur" id="info_contributeur"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="" >
                    </div>
                    <div class="my-4"></div> <!-- Ajoutez cette ligne pour créer un espace -->
                    <div class="container__btton flex justify-between">
                        <button type="submit">
                            <a href="#" class="text-white bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Étape précédente</a>
                        </button>
                         <button type="submit" class="text-white bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Étape suivante</button>
                    </div>

                </form>
            </div>

        </section>
     

@endsection