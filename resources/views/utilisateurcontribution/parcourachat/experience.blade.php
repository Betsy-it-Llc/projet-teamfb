@extends('layouts.appwithtailwind')

@section('content')
<div class="flex flex-col items-center h-screen">
    <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white mt-10 mb-4">Pack & Expérience</h1>
    <div class="mb-4">
        <ul class="flex justify-center space-x-20"> <!-- Espacement augmenté -->
            <li><a href="{{route('utilisateur.pack')}}" class="text-gray-700 hover:text-blue-700 ">Expérience</a></li>
            <li class="ml-auto"><a href="{{route('utilisateur.experience')}}" class="text-gray-700 hover:text-blue-700 active-menu">Autres Produits</a></li>
        </ul>
    </div>
    <div class="grid grid-cols-1 gap-4">
        @foreach ($produitsService as $produitsService)
        <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-4">
            <a href="{{ route('utilisateur.detailproduitservice', ['id_produit' => $produitsService->id_produit]) }}">
                <div class="flex items-start"> <!-- Utilisez 'items-start' pour aligner l'image en haut -->
                    @if ($produitsService->getFirstMedia('Images/image_produit')!==null)
                        <div class="h-[150px] w-[300px] rounded-lg items-center">
                            <img class="h-[150px] w-[300px] object-cover rounded-lg" src="{{$produitsService->getFirstMedia('Images/image_produit')->getUrl()}}" alt="Image de votre pack">
                        </div>
                    @else
                        <img class="h-[150px] w-[300px] object-contain rounded-lg" src="https://picsum.photos/seed/picsum/300/150" alt="Image de votre pack">
                    @endif
                    <div class="ml-4"> <!-- Marge à gauche pour séparer l'image du contenu -->
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$produitsService->nom_produit}}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$produitsService->description}}</p>
                        <p class="mb-3 font-bold text-black-900 dark:text-gray-400">{{$produitsService->prix}}€</p>
                        <a href="{{ route('utilisateur.addtocart', ['item' => $produitsService->id_produit, 'type' => 'App\Models\experienceApp\ProduitService', 'nb_participants'=>1,'nb_titres'=>1,'quantity'=>1]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover-bg-blue-800 focus-ring-4 focus-outline-none focus-ring-blue-300 dark-bg-blue-600 dark-hover-bg-blue-700 dark-focus-ring-blue-800">
                            Ajouter au panier
                        </a>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
