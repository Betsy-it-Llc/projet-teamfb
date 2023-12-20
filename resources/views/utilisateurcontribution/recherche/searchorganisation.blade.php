@extends('layouts.app')

@section('content')

    <div style="display: flex; justify-content: center; background: #ffff; width: 100%; height: 100px; align-items: end;">
        <h1 style="font-weight: bolder">Recherche une organisation</h1>
    </div>
    <div style="display: flex; justify-content: center; width: 100%;">
        <a href="{{route('utilisateur.searchprojet')}}" class="menu-link " style="text-decoration: none; color: black; margin-right: 200px; font-weight: bold;">Projet</a>
        <a href="{{route('utilisateur.searchcause')}}" class="menu-link" style="text-decoration: none; color: black; margin-right: 200px; font-weight: bold;">Cause</a>
        <a href="{{route('utilisateur.searchexperience')}}" class="menu-link" style="text-decoration: none; color: black; margin-right: 200px; font-weight: bold;">Expérience</a>
        <a href="{{route('utilisateur.searchorganisation')}}" class="menu-link selected" style="text-decoration: none; color: black; font-weight: bold;">Organisation</a>
      </div>
    <div style="display: flex; flex-direction: column; width: 100%; height: 150px;">
        <!-- Section seachbar -->
        <span style="height: 50px; display: flex; justify-content: center; align-items: center;">Rechercher une organisation</span>
        <div style="display: flex; height: 45px; justify-content: center; gap: 0.7rem; width: 60%; margin: auto;">
            <div style="display: flex; border: 0.5px solid rgb(14, 126, 218); border-radius: 5px; width: 75%;">
                <div style="display: flex; justify-content: center; align-items: center; width: 10%;">
                    <i class="fa fa-search"></i>
                </div>
                <input type="search" style="display: flex; width: 100%; border: none; outline: none; border-radius: 0 5px 5px 0;" />
            </div>
            <div style="display: flex; border: 1px solid rgb(207, 203, 203); width: 6%; border-radius: 5px; justify-content: center; align-items: center;">
                <button class="btn">
                    <i class="fa fa-sliders" style="color: #0c5d58; transform: rotate(-90deg); font-size: 25px"></i>
                </button>
            </div>
            <div style="display: flex; width: 20%">
                <button class="btn" style="display: flex; width: 100%; border: none; border-radius: 5px; justify-content: center; align-items: center; background: rgb(187, 185, 185); font-weight: bolder;">Rechercher</button>
            </div>
        </div>
    </div>

    <!-- Section content projet -->
    <div style="display: flex; flex-direction: column; gap: 1rem; width: 60%; margin: auto; margin-top: 20px; border-radius: 5px;">
        <!-- Card section projet -->
        @foreach ($projetsOrganisation as $projet)
        <div class="card" style="width: 100%; height: 100%;">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <img src="noel.webp" class="card-img-top" alt="..." style="display: flex; height: 267px; border-radius: 5px;">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="">{{ $projet->nom }}</h5>
                                <p class="card-text">
                                    <strong style="font-size: 30px;">
                                        @foreach ($projet->cagnottes as $cagnotte)
                                            {{ $cagnotte->montant_actuel }}€
                                            @if (!$loop->last)
                                            <!-- Si ce n'est pas la dernière cagnotte, affichez une virgule -->
                                            ,
                                            @endif
                                        @endforeach
                                    </strong>
                                    <span>Récoltés</span>
                                </p>
                                <p class="card-text">Date : {{ $projet->date_creation->format('d-m-Y') }}</p>
                                <p class="card-text">Type Projet : Organisation</p>
                                <a href="#" class="btn btn-primary">Voir le projet</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Pagination -->
        <div class="text-center">
          {{  $projetsOrganisation->firstItem() }} - {{  $projetsOrganisation->lastItem() }} organisations sur {{  $projetsOrganisation->total() }} organisations.
      </div>
      
      <nav aria-label="Pagination">
          <ul class="pagination justify-content-center">
              <li class="page-item">
                  <a class="page-link" href="{{  $projetsOrganisation->previousPageUrl() }}" aria-label="Précédent">
                      <span aria-hidden="true">&laquo; Précédent</span>
                  </a>
              </li>
              <li class="page-item space">
                  &nbsp;
              </li>
              <li class="page-item">
                  <a class="page-link" href="{{  $projetsOrganisation->nextPageUrl() }}" aria-label="Suivant">
                      <span aria-hidden="true">Suivant &raquo;</span>
                  </a>
              </li>
          </ul>
      </nav>
</div>
@endsection
<style>
    .menu-link.selected {
    border-bottom: 2px solid #000; /* Ajoute un trait sous le lien sélectionné */
  }
  
  </style>
