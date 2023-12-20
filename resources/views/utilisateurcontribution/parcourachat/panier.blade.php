@extends('layouts.appwithtailwind')

@section('content')
<div class="flex flex-col items-center h-screen">
    <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white mt-10 mb-4">Panier</h1>
    <div class="mb-4">
        <ul class="flex justify-center space-x-20">
            <li><a href="{{ route('utilisateur.pack') }}" class="text-gray-700 hover:text-blue-700 active-menu">Achat Expérience</a></li>
        </ul>
    </div>
    <div class="grid grid-cols-1 gap-4">
        @foreach($listItem as $item)
            <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-4">
                @if($item['objet'] instanceof App\Models\experienceApp\Pack)
                    <div class="flex items-start">
                        <img class="h-30 w-75 object-contain rounded-lg" src="https://picsum.photos/seed/picsum/300/150" alt="Image de votre pack">
                        <div class="ml-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $item['objet']->nom }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Nombres de personnes : {{ $item['item']->nb_participants }}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Nombres de titres : {{ $item['item']->nb_titres }}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $item['montant'] }}€</p>
                            <form action="{{ route('panier.supprimerPack', ['pack_experience' => $item['objet']->id_pack, 'facture' => $item['num_facture']]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-500 hover:text-red-700">Retirer du panier</button>
                            </form>
                            <form action="{{ route('panier.modifierQuantitePersonnes', ['facture' => $item['num_facture'], 'pack' => $item['objet']->id_pack]) }}" method="post">
                                @csrf
                                @method('put')
                                <label for="nb_participants">Nombre de personnes :</label>
                                <input type="number" id="nb_participants" name="nb_participants" value="{{ $item['item']->nb_participants }}">
                                <button type="submit" class="text-blue-500 hover:text-blue-700">Enregistrer</button>
                            </form>
                            <form action="{{ route('panier.modifierQuantiteTitres', ['facture' => $item['num_facture'], 'pack' => $item['objet']->id_pack]) }}" method="post">
                                @csrf
                                @method('put')
                                <label for="nb_titres">Nombre de titres :</label>
                                <input type="number" id="nb_titres" name="nb_titres" value="{{ $item['item']->nb_titres }}">
                                <button type="submit" class="text-blue-500 hover:text-blue-700">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                @endif
                @if($item['objet'] instanceof App\Models\experienceApp\ProduitService)
                    <div class="flex items-start">
                        <img class="h-30 w-75 object-contain rounded-lg" src="https://picsum.photos/seed/picsum/300/150" alt="Image de votre produit">
                        <div class="ml-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $item['objet']->nom_produit }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $item['montant'] }}€</p>
                            <form action="{{ route('panier.supprimerProduit', ['produit' => $item['objet'], 'facture' => $item['num_facture']]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-500 hover:text-red-700">Retirer du panier</button>
                            </form>
                            <form action="{{ route('panier.modifierQuantiteProduit', ['facture' => $item['num_facture'], 'produit' => $item['objet']->id_produit]) }}" method="post">
                                @csrf
                                @method('put')
                                <label for="quantity"> Quantité :</label>
                                <input type="number" id="quantity" name="quantity" value="{{ $item['item']->quantity }}">
                                <button type="submit" class="text-blue-500 hover:text-blue-700">Enregistrer</button>
                            </form>

                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-4" style="margin-left: 23rem;">
        <div class="flex justify-between">
            <span class="text-2xl font-bold text-gray-900 dark:text-white">Total:</span>
            <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalMontant }}€</span>
        </div>
        <a href="{{ route('utilisateur.paiement', ['id_panier' => $id_panier]) }}" class="block text-center text-white bg-blue-700 py-2 px-4 rounded-lg hover:bg-blue-800 focus-ring-4 focus-outline-none focus-ring-blue-300 dark-bg-blue-600 dark-hover-bg-blue-700 dark-focus-ring-blue-800 mt-4">
            Acheter
        </a>
        <form action="{{ route('panier.supprimerTout', ['facture'  => $item['num_facture']]) }}
            " method="post" class="mt-4">
            @csrf
            @method('delete')
            <button type="submit" class="text-red-500 hover:text-red-700">Supprimer le panier</button>
        </form>
    </div>
</div>
@endsection
