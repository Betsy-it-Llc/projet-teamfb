@extends('layouts.appwithtailwind')

@section('content')
<div class="flex flex-col items-center h-screen">
    <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white mt-10 mb-4">Recap Achat</h1>
    <div class="mb-4">
        <p class="text-1xl ">Votre achat a bien été validé </p>
    </div>


    <div class="mb-4 mt-5">
        <h2 class="text-4xl font-bold">Vos achats</h2>
    </div>
    <div class="flex flex-col items-center border p-4 rounded-lg w-96">
        <ul class="mt-2 text-center">
            @foreach($produitsDuPanier as $produit)
                <li class="text-black font-semibold">
                    <div class="flex justify-between">
                        <span class="text-left font-bold">{{ $produit->produit->nom_produit }} :</span>
                        <span class="text-2xl font-semibold ml-5">{{ $produit->produit->prix * $produit->quantity }}€</span>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <span class="text-left text-sm">Quantité :</span>
                        <span class="text-sm font-semibold ml-2">{{ $produit->quantity }}</span>
                    </div>
                </li>
            @endforeach
            @foreach($packsDuPanier as $pack)
                <li class="text-black font-semibold">
                    <div class="flex justify-between">
                        <span class="text-left font-bold">{{ $pack->pack->nom}} :</span>
                        <span class="text-2xl font-semibold ml-5">{{ $pack->montant }}€</span>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <span class="text-left text-sm">Nombre de participants :</span>
                        <span class="text-sm font-semibold ml-2">{{ $pack->nb_participants }}</span>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <span class="text-left text-sm">Nombre de titres :</span>
                        <span class="text-sm font-semibold ml-2">{{ $pack->nb_titres }}</span>
                    </div>
                </li>
            @endforeach
            <div>
                <h3 style="font-size: 20px; font-weight: bold;">Montant total de l'achat</h3>
                <p style="font-size: 18px; font-weight: bold;">{{ $totalDuPanier }}€</p>
            </div>
        </ul>
    </div>
    
    


    <div class="flex flex-col items-center border p-4 rounded-lg w-96 mt-5">
        <h2 class="text-4xl font-bold">Vos Comptes</h2>
        <p class=" text-2xl">Montant disponible:</p>

        <ul class="mt-2 text-center">      
            <li class="text-black font-semibold">
                <div class="flex justify-between">
                    <span class="text-left font-bold">Cagnotte:</span>
                    <span class="text-2xl font-semibold ml-5">{{$totalCagnottes}}€</span>
                </div>
            </li>
            <li class="text-black font-semibold ">
                <div class="flex justify-between">
                    <span class="text-left font-bold">Compte llc : </span>
                    <span class="text-2xl font-semibold ml-5">{{$compte}}€</span>
                </div>
            </li>
        </ul>
    </div>



@endsection
