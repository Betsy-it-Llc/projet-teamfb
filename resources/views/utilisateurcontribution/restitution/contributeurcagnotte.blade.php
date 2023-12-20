
@extends('layouts.appwithtailwind')

@section('content')


<header class="header-min">
    <h1 class="h1-min">Contributeurs</h1>
</header>

    <p class="text-lg font-sans text-gray-400 text-center relative sm:right-10 md:left-7 lg:left-10">Cagnotte </p>

    <div class="text-right">
        <span class="somme-cagnotte-disponible">
            {{$montantTotal}}€
        </span>
        <span class="text-montant-disponible">
            Montant disponible
        </span>
        <span>
            <h4 class="text-montant-disponible font-bold"> {{$nombreContributeursUniques}} </h4>
            <p class="text-montant-disponible">Contributeurs </p>
        </span>
    </div>

    <button class="button-utiliser">
        <img class="w-5" src="{{ asset('img/flecheD.png') }}" alt="fleche vers la droite">
        <p class="text-button-utiliser">Utiliser la cagnotte</p>
    </button>
    
    <div class="overflow-x-auto pl-10 pr-4">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th class="text-nom-colonne-tableau">Contribution</th>
              <th class="text-nom-colonne-tableau">Contributeur</th>
              <th class="text-nom-colonne-tableau">Nrb Contributions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($donneesContributeurs as $contributeur)
            <tr class="">
              <td>{{ $contributeur['montantTotal'] }}€</td>
              <td>{{ $contributeur['nom'] }}</td>
              <td>{{ $contributeur['nrbContributions'] }}</td>
            </tr>  
            @endforeach
          </tbody>
        </table>
      </div>

    <div class="button-envoi-message ">
        <button class="btn">
            <p class="text-button-message">Envoyer un message</p>
        </button>
    </div>


    @endsection
