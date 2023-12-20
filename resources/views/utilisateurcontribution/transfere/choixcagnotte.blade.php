@extends('layouts.appwithtailwind')
@section('content')
  


              <main>
                  <header class="header-maj">
                      <h1 class="h1-maj">
                          Mon compte
                      </h1>
                      <h2 class="text-lg md:text-3xl tel:text-xl font-bold ml-8">
                          Transfert
                      </h2>
                  </header>

                  <div class="text-right">
                    <span class="somme-cagnotte-disponible">
                        {{ $montantTotalCagnottes }}€
                    </span>
                    <span class="text-montant-disponible">
                        Montant disponible
                    </span>
                    <span>
                        <a href="{{ route('utilisateur.restitution') }}">
                            Utiliser
                            <img class="w-5 inline mr-4" src="{{ asset('img/plus.png') }}" alt="plus">
                        </a>
                    </span>
                </div>

                  <div class="flex justify-center">
                      <span class="text-lg pb-4">
                          Choisissez Vos Cagnotte
                      </span>
                  </div>

                  <form id="transfertForm" method="POST" action="{{ route('utilisateur.choixcagnotteid') }}">
                      @csrf
                      <div class="grid grid-cols-3 grid-rows-1">
                          <div class="col-span-1">
                            @foreach ($cagnottes as $cagnotte)
                            <div  class=" cagnotte-container bg-gray-300 rounded-md w-44 h-20 telL:w-56 telL:h-10 telxl:w-80 telxl:h-10 sm:w-96 sm:h-10 lg:w-80 lg:h-10 xl:w-64 xl:h-10 1xl:w-72 1xl:h-10 2xl:w-96 2xl:h-10 md:w-72 md:h-10 ml-10 mt-4 relative">
                            <label class="cagnotte-label block cursor-pointer ">
                                
                                    <div class="pt-2 pl-2">
                                        <div class="w-28 h-12 telL:w-40 telL:h-6 telxl:w-60 telxl:h-6 sm:w-52 sm:h-6 md:w-48 md:h-6 px-2 rounded-lg bg-gray-50 border text-left">
                                            <span class="text-base font-sans  text-black text-left">
                                                {{$cagnotte->titre}}
                                            </span>
                                        </div>
                                        <div class="flex justify-end absolute top-0 right-0 pt-2 pr-2">
                                            <span class="text-base font-sans text-black">
                                                {{$cagnotte->montant_actuel}}€
                                            </span>
                                            <input  type="checkbox" class="check-cagnotte hidden" name="cagnotte_ids[]" value="{{$cagnotte->id_cagnotte}}">
                                        </div>
                                    </div>
                                
                            </label>
                        </div>
                        @endforeach
                              <div class="pt-10">
                                  <div class="totalcagnotte relative ml-10">
                                      <div class="pt-2 pl-2">
                                        <div class="w-28 h-12 telL:w-40 telL:h-6 telxl:w-60 telxl:h-6 sm:w-52 sm:h-6 md:w-48 md:h-6 px-2 rounded-lg bg-gray-50 border text-left">
                                              <span class="text-sm sm:text-base font-sans text-black text-left">
                                                  Toute Mes Cagnottes
                                              </span>
                                          </div>
                                          <div class="flex justify-end absolute top-0 right-0 pt-2 pr-2">
                                              <span class="text-base font-bold font-sans text-black">
                                                {{$montantTotalContributions}}€
                                              </span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="flex justify-end items-center col-span-2">
                            <button type="submit" class="bg-green-100 button mr-4" >
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </div>
                                <span class="text-sm flex justify-center">
                                    Transférer
                                </span>
                            </button>
                        </div>                      
                      </div>
                  </form>
              </main>


@endsection



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner tous les éléments avec la classe check-cagnotte
        var inputElements = document.querySelectorAll('.check-cagnotte');

        // Ajouter un écouteur d'événements pour chaque élément
        inputElements.forEach(function(inputElement) {
            // Sélectionner l'élément div parent
            var divElement = inputElement.closest('.cagnotte-container');

            // Ajouter un écouteur d'événements pour l'événement change
            inputElement.addEventListener('change', function(event) {
                // Vérifier si la case est cochée
                if (event.target.checked) {
                    // Si la case est cochée, retirer la classe bg-gray-300 et ajouter la classe bg-green-100 à l'élément div
                    divElement.classList.replace('bg-gray-300', 'bg-green-100');
                } else {
                    // Si la case est décochée, retirer la classe bg-green-100 et ajouter la classe bg-gray-300 à l'élément div
                    divElement.classList.replace('bg-green-100', 'bg-gray-300');
                }
            });
        });
    });
</script>
    


 
  

     