@extends('layouts.appwithtailwind')

@section('content')
<div class="flex flex-col items-center h-screen">
    <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white mt-10 mb-4">Detail du Pack</h1>
    <div class="mb-4">

    </div>
    <div class="grid grid-cols-1 gap-4">
        <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-4">
          
                <div class="flex items-start"> <!-- Utilisez 'items-start' pour aligner l'image en haut -->
                    <img class="h-30 w-75 object-contain rounded-lg" src="https://picsum.photos/seed/picsum/300/150" alt="Image de votre pack">
                    <div class="ml-4"> <!-- Marge à gauche pour séparer l'image du contenu -->
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$pack->nom}}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Date: {{ strftime('%Y-%m-%d', strtotime($pack->date_creation)) }}</p>
                        <form action="{{ route('utilisateur.addToCartPackFromForm') }}" method="POST">
                            @csrf 
                        
                            <!-- Ajoutez un champ caché pour stocker l'ID du pack -->
                            <input type="hidden" name="pack_id" value="{{ $pack->id_pack }}">
                        
                            <div class="mb-3">
                                <label for="nombre_personnes" class="block text-gray-700 dark:text-gray-400">Nombre de personnes :</label>
                                <select id="nombre_personnes" name="nombre_personnes" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
                                    <option value="1">1</option>
                                    @for ($i = 2; $i <= 100; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        
                            <div class="mb-3">
                                <label for="nombre_titres" class="block text-gray-700 dark:text-gray-400">Nombre de titres :</label>
                                <select id="nombre_titres" name="nombre_titres" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
                                    <option value="1">1</option>
                                    @for ($i = 2; $i <= 100; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        
                            <div class="mb-3">
                                <p class="font-normal text-gray-700 dark:text-gray-400">Description: {{ $pack->description }}</p>
                                <p class="font-normal text-gray-700 dark:text-gray-400">Detail:</p>
                                <p id="prix_pack" data-prix-initial="{{ $pack->prix }}" class="font-normal text-gray-700 dark:text-gray-400">{{ $pack->prix }} €</p>
                            </div>
                        
                            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover-bg-blue-800 focus-ring-4 focus-outline-none focus-ring-blue-300 dark-bg-blue-600 dark-hover-bg-blue-700 dark-focus-ring-blue-800">
                                Ajouter au panier
                            </button>
                        </form>
                  
                    </div>
                </div>
                
        </div>
    </div>

    
</div>


@endsection









