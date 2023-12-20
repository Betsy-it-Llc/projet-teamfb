@extends('layouts.appwithtailwind')

@section('content')

        

            <header class="header-maj">
                <h1 class="h1-maj">
                    cagnotte
                </h1>
            </header>
            <p class="text-lg font-serif text-gray-400 text-center ">Créer un projet</p>

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


           
            <div class="grid grid-cols-3 grid-rows-1 gap-1 text-center mb-10 tel:ml-0 telL:ml-0 sm:pl-16 ml-32">
                <button class="hover:border-b-2 hover:border-gray-900 text-center pb-1">
                    <p class="text-xl font-sans text-slate-800 sm:float-left">Expériences</p>
                </button>
                <button class="hover:border-b-2 hover:border-gray-900 text-center pb-1">
                    <p class="text-xl font-sans text-slate-800 sm:float-left">Soutenir</p>
                </button>
                <button class="hover:border-b-2 hover:border-gray-900 text-center pb-1">
                    <p class="text-xl font-sans text-slate-800 sm:float-left">Contribués</p>
                </button>
            </div>

            <div class="mx-5 auto">
            @foreach ($cagnottes as $cagnotte)
            <livewire:card :var1="$cagnotte" :var2="$nombreContributeursParCagnotte" />
            @endforeach
        </div>
        
        
        
        
          
          
       {{-- <article style="min-height:200px;max-width:80%;margin:10% 10% auto;" class="rounded-xl border-2 border-gray-100 bg-white sm:h-54 ">
                <a style="" href="{{ route('utilisateur.contribution', [ 'idCagnotte' => $cagnotte->id_cagnotte]) }}">
                <div class="flex items-start gap-2 p-4 sm:p-6 lg:p-8">
                <div style="gap:10px" class="sm:flex sm:flex-col ">
                    <div style="height: 150px" class="bg-gray-50 sm:w-40 sm:h-24 md:w-40 md:h-24 rounded-lg relative sm:left-2 sm:top-2 flex flex-col items-center justify-center">
                        <img class="w-4 mx-auto relative sm:float-right md:left-1 sm:top-8 md:top-8" src="{{ asset('img/plus.png') }}" alt="plus">
                        <p class="text-xs font-sans text-slate-800 text-center relative sm:left-1 sm:top-8">Utiliser</p>
                    </div>
                
                    <div style="" class="p-4">
                        <h2 class="font-mono font-extrabold text-black">{{$cagnotte->titre}}</h2>
                        <p class="text-xl font-sans text-black">{{ $nombreContributeursParCagnotte[$cagnotte->id_cagnotte] }}  Contributeurs</p>
                        <div style="gap:20px " class="flex md:flex md:flex:col text-base font-sans text-black ">
                            <p style="" class="">Date: {{ date('d-m-Y', strtotime($cagnotte->projet->date_creation)) }}</p>
                            <p class="">{{$cagnotte->montant_actuel}}€</p>
                        </div>
                        <p class="text-base font-sans text-black ">{{ $cagnotte->projet->types_projet->valeur }}</p>
                    </div>
                </div>
                </div>
                </a>
              </article> --}}
              



              {{-- ancien code 
              <article style="min-height:200px;max-width:80%;margin:10% 10% auto;" class="rounded-xl border-2 border-gray-100 bg-white sm:h-54 ">
                <a style="" href="{{ route('utilisateur.contribution', [ 'idCagnotte' => $cagnotte->id_cagnotte]) }}">
                <div class="flex items-start gap-2 p-4 sm:p-6 lg:p-8">
                <div style="gap:10px" class="sm:flex sm:flex-col ">
                    <div style="height: 150px" class="bg-gray-50 sm:w-40 sm:h-24 md:w-40 md:h-24 rounded-lg relative sm:left-2 sm:top-2 flex flex-col items-center justify-center">
                        <img class="w-4 mx-auto relative sm:float-right md:left-1 sm:top-8 md:top-8" src="{{ asset('img/plus.png') }}" alt="plus">
                        <p class="text-xs font-sans text-slate-800 text-center relative sm:left-1 sm:top-8">Utiliser</p>
                    </div>
                
                    <div style="" class="p-4">
                        <h2 class="font-mono font-extrabold text-black">{{$cagnotte->titre}}</h2>
                        <p class="text-xl font-sans text-black">{{ $nombreContributeursParCagnotte[$cagnotte->id_cagnotte] }}  Contributeurs</p>
                        <div style="gap:20px " class="flex md:flex md:flex:col text-base font-sans text-black ">
                            <p style="" class="">Date: {{ date('d-m-Y', strtotime($cagnotte->projet->date_creation)) }}</p>
                            <p class="">{{$cagnotte->montant_actuel}}€</p>
                        </div>
                        <p class="text-base font-sans text-black ">{{ $cagnotte->projet->types_projet->valeur }}</p>
                    </div>
                </div>
                </div>
                </a>
              </article> --}}
          
          


@endsection






