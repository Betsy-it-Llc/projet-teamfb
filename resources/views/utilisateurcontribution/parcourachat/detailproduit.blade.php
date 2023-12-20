@extends('layouts.appwithtailwind')

@section('content')
<div class="flex flex-col items-center h-screen">
    <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white mt-10 mb-4">Détail du produit</h1>
    <div class="mb-4">
    </div>
    <div class="grid grid-cols-1 gap-4">
        <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-4">
            <div class="flex items-start">
                <img class="h-30 w-75 object-contain rounded-lg" src="https://picsum.photos/seed/picsum/300/150" alt="Image de votre pack">
                <div class="ml-4">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$produitsService->nom_produit}}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Date: {{ strftime('%Y-%m-%d', strtotime($produitsService->date_creation)) }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Description: {{$produitsService->description}}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Detail:</p>

                    <!-- Formulaire pour choisir la quantité -->
                    <form method="POST" action="{{ route('utilisateur.addToCartProduitFromForm') }}">
                        @csrf
                        <input type="hidden" name="produit_id" value="{{ $produitsService->id_produit }}">

                        <div class="mb-3">
                            <label for="quantity" class="block text-gray-700 dark:text-gray-400">Quantité :</label>
                            <select id="quantity" name="quantity" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
                                @for ($i = 1; $i <= 100; $i++)
                                    <option value="{{ $i }}" data-prix="{{ $i * $produitsService->prix }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Prix : <span id="prix">{{ $produitsService->prix }}</span> €</p>

                        <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover-bg-blue-800 focus-ring-4 focus-outline-none focus-ring-blue-300 dark-bg-blue-600 dark-hover-bg-blue-700 dark-focus-ring-blue-800">
                            Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantiteSelect = document.getElementById('quantity');
        const prixProduitElement = document.getElementById('prix');
    
        quantiteSelect.addEventListener('change', function () {
            const selectedOption = quantiteSelect.options[quantiteSelect.selectedIndex];
            const nouveauPrix = selectedOption.getAttribute('data-prix');
            prixProduitElement.textContent = nouveauPrix + ' €';
        });
    });
    </script>