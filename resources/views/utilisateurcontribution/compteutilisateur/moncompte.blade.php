@extends('layouts.appwithtailwind')

@section('content')

 


<main>
    <header class="header-maj">
        <h1 class="h1-maj">
            mon compte
        </h1>
    </header>
    <div class="flex items-center justify-center mt-2 md:mt-20 space-x-12">
        <div class="text-center">
            @if ($soldeContact !== null)
            <p class="text-3xl text-black font-bold mb-1">{{ $soldeContact }}€</p>
            @else
            <p class="text-3xl text-black font-bold mb-1">0€</p>
            @endif
            <p class="text-lg text-black">Llc</p>
        </div>
        <div class="text-center">
            <p class="text-4xl text-black font-bold mb-1">{{$montantTotalContributions}}€</p>
            <p class="text-lg text-black">Cagnotte</p>
            <a href="{{ route('utilisateur.choixcagnotte') }}" class="text-base italic text-gray-700">Transférer</a>
        </div>
        <div class="text-center">
            <p class="text-3xl text-black font-bold mb-1">{{ $montantAvoir }}€</p>
            <p class="text-lg text-black">Avoir</p>
        </div>
    </div>

    <div class="flex flex-col items-center mt-12 mb-12">
        @hasrole('Contact Cause')
        <a href="{{ route('utilisateur.restitution') }}" class="text-center text-lg text-gray-900 md:text-xl lg:text-xl dark:text-black">Obtenir un versement</a>
        @endhasrole
        <a href="{{ route('utilisateur.pack') }}" class="text-center text-lg text-gray-900 md:text-xl lg:text-xl dark:text-black">Découvrir les Packs et Offres d’expérience</a>
        <a href="{{ route('utilisateur.soutenirprojet') }}" class="text-center text-lg text-gray-900 md:text-xl lg:text-xl dark:text-black">Soutenir un projet, une cause, une expérience</a>
    </div>

    <div class="flex items-center justify-center space-x-2 md:space-x-5">
        <div class="text-center">
            <p class="text-xs text-gray-900 telL:text-sm md:text-lg lg:text-lg dark:text-black">Cagnottes</p>
            <p class="text-xl font-bold text-gray-900 md:text-xl dark:text-black mb-1">{{$nombreTotalCagnottes}}</p>
        </div>
        <div class="text-center">
            <p class="text-xs text-gray-900 telL:text-sm md:text-lg lg:text-lg dark:text-black">Expériences</p>
            <p class="text-xl font-bold text-gray-900 md:text-xl dark:text-black mb-1">{{$nombreTotalExperiences}}</p>
        </div>
        <div class="text-center">
            <p class="text-xs text-gray-900 telL:text-sm md:text-lg lg:text-lg dark:text-black">Contributeurs</p>
            <p class="text-xl font-bold text-gray-900 md:text-xl dark:text-black mb-1">{{$nombreContributeursTotal}}<a href="{{ route('utilisateur.contribution.contributeur') }}" class="text-gray-400 italic text-xs relative top-3">Voir</a></p>
        </div>
        <div class="text-center">
            <p class="text-xs text-gray-900 telL:text-sm md:text-lg lg:text-lg dark:text-black">Contributions</p>
            <p class="text-xl font-bold text-gray-900 md:text-xl dark:text-black mb-1">{{$nombreTotalContributions}}<a href="{{ route('utilisateur.contribution.suivipaiement') }}" class="text-gray-400 italic text-xs relative top-3">Voir</a></p>
        </div>
    </div>

    <div class="text-center mt-12 mb-3 flex justify-center">
        <p class="text-xl mb-4 text-gray-900 md:text-xl dark:text-black mt-1">Liste des <p class="text-2xl ml-2 text-black font-bold"> Opérations</p></p>
    </div>

    <div class="flex items-center justify-center space-x-16 font-bold">
        <p class="text-1xl text-gray-900 md:text-xl dark:text-black">Montant</p>
        <p class="text-1xl text-gray-900 md:text-xl dark:text-black">Opération</p>
        <p class="text-1xl text-gray-900 md:text-xl dark:text-black">Date</p>
    </div>
    <div class="flex justify-center mt-4">
        <div class="card w-96 h-20 md:h-28 bg-gray-200 text-black">
            <div class="grid grid-cols-3 grid-rows-4 gap-2">
                @foreach ($transactions->sortByDesc('date_transaction')->take(3) as $transaction)
                <p class="text-sm text-center md:text-lg">{{ $transaction->montant }}€</p>
                <p class="text-sm text-center md:text-lg">{{ $transaction->type }}</p>
                <p class="text-sm text-right md:text-lg mr-2">{{ date('d-m-Y', strtotime($transaction->date_transaction)) }}</p>
                @endforeach
            </div>
        </div>    
    </div>

    <div class="button-envoi-message ">
        <button class="btn">
        <a href="{{ route('utilisateur.operation') }}">
            <p class="text-button-message">Voir plus d'opérations</p>
        </a>
        </button>
    </div>
</main> 




 
@endsection








      
     
    
       <!-- <p class="text-4xl font-bold mb-1">{{$montantTotalCagnottes}}€</p> 
        <p class="text-lg">Montant Réel</p>-->
   
   
