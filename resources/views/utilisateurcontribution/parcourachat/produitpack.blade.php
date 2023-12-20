@extends('layouts.appwithtailwind')

@section('content')
<div class="flex flex-col items-center h-screen">
    <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white mt-10 mb-10">Pack & Expérience</h1>
    <div class="grid grid-cols-2 gap-4">
        @foreach ($items as $item)
            
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="{{ $item instanceof App\Models\experienceApp\Pack ? route('utilisateur.detailpack', ['id_pack' => $item->id_pack]) : ($item instanceof App\Models\experienceApp\ProduitService ? route('utilisateur.detailproduitservice', ['id_produit' => $item->id_produit]) : '#') }}">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    @if ($item instanceof App\Models\experienceApp\Pack)
                        {{ $item->nom }}
                        <span class="text-black-900 text-xl"> - {{ $item->prix }}€</span>
                    @elseif ($item instanceof App\Models\experienceApp\ProduitService)
                        {{ $item->nom_produit }}
                        <span class="text-black-900 text-xl"> - {{ $item->prix_produit }}€</span>
                    @endif
                </h5>
                @if ($item instanceof App\Models\experienceApp\Pack && $item->getFirstMedia('image_pack')!==null )
                    <div class="h-28 w-28 flex items-center">
                        <img class="object-cover rounded-md h-28 w-100 " src="{{$item->getFirstMedia('image_pack')->getUrl()}}" alt="">
                    </div >
                @endif
                @if ($item instanceof App\Models\experienceApp\ProduitService && $item->getFirstMedia('Images/image_produit')!==null)
                    <div class="h-28 w-28 flex items-center">
                        <img class="object-cover rounded-md h-28  w-100" src="{{$item->getFirstMedia('Images/image_produit')->getUrl()}}" alt="">
                    </div>
                @endif
                
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$item->description}} </p>
            <a href="{{route('utilisateur.addtocart',['item'=>$item,'type'=>get_class($item),'nb_participants'=>1,'nb_titres'=>1,'quantity'=>1])}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover-bg-blue-800 focus-ring-4 focus-outline-none focus-ring-blue-300 dark-bg-blue-600 dark-hover-bg-blue-700 dark-focus-ring-blue-800">
                Ajouter au panier

            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection