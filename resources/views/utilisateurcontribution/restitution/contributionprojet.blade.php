
@extends('layouts.appwithtailwind')

@section('content')

    <header class="header-min">
        <h1 class="h1-min">Contributions</h1>
    </header>
    <p class="text-lg font-sans text-gray-400 text-center relative sm:right-10 md:left-7 lg:left-10">Cagnotte</p>

    <div class="text-right">
        <span class="somme-cagnotte-disponible">
            {{$cagnotte->montant_actuel}}€
        </span>
        <span class="text-montant-disponible">
            Montant disponible
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
              <th class="text-nom-colonne-tableau">Projet</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($contributions as $contribution)
            <tr class="">
              <td>{{ $contribution->montant }}€</td>
              <td>{{ $contribution->contact->nom }}{{ $contribution->contact->prenom }}</td>
              <td>{{ $contribution->cagnotte->projet->nom }}</td>
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
