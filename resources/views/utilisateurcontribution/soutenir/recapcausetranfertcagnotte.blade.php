
@extends('layouts.appwithtailwind')

@section('content')



        <header class="header-maj">
            <h1 class="h1-maj">
                Validation 
            </h1>
            <h2 class="font-sans text-2xl font-bold text-slate-800 tel:text-2xl telL:text-2xl md:text-2xl">transférer</h2>
        </header>

        <div class="grid grid-cols-1 grid-rows-2 gap-0.5 relative xl:top-8">
            <p class="text-xl tel:text-lg telL:text-lg lg:text-xl font-sans text-black text-center tel:pt-4 lg:pt-8 xl:top">Votre Cagnotte a bien été transféré</p>
            <p class="text-xl tel:text-lg telL:text-lg lg:text-xl font-sans text-black text-center tel:pb-6 xl:pb-3 lg:pb-3">Vers</p>
        </div>
        <div class="tel:ml-5 telL:ml-16 relative md:left-10 lg:left-20 xl:pt-5 xl:left-1">
            <div class="bg-gray-100 tel:w-72 tel:h-36 telL:w-72 telL:h-36 telxl:w-96 telxl:h-40 xl:w-96 xl:h-40 2xl:w-3/4 2xl:h-40 md:w-96 md:h-40 text-center rounded-md border border-gray-200">
                <div class="flex">
                    <div class="bg-gray-300 w-28 h-20 tel:w-20 tel:h-16 xl:w-36 relative mt-3 ml-5"></div>
                    <div>
                        <div class="grid grid-cols-1 grid-rows-3 gap-1">
                            <p class="text-base font-sans font-bold text-black text-left relative tel:ml-2 telxl:top-2 md:mr-16 lg:mr-24 xl:mr-7 2xl:mr-16">{{$cagnotte->titre}}</p>
                            <p class="text-sm font-sans text-slate-800 text-left relative tel:ml-2 tel:bottom-2 telxl:top-5 xl:top-2 md:top-5 md:mr-16 lg:mr-16 xl:mr-7 2xl:mr-16">DateDate: {{ $projet->date_creation->format('d-m-Y') }}</p>
                            <p class="text-sm font-sans text-slate-800 text-left relative tel:ml-2 tel:bottom-2 telxl:top-5 xl:top-0 md:top-5 md:mr-16 lg:mr-16 xl:mr-7 2xl:mr-16">Type: {{ $projet->types_Projet->valeur }}</p>
                            <p class="text-xl tel:text-sm md:text-lg font-bold font-sans text-slate-800 text-left relative xl:top-0 tel:bottom-2 tel:ml-10 telxl:top-7 telxl:left-28 sm:top-7 sm:left-20 md:top-5 md:left-10 xl:left-0 tel:mr-7 md:mr-24 lg:mr-16 xl:mr-10 2xl:top-0 2xl:left-14 2xl:mr-16">{{$projet->nom}}</p>
                        </div>
                    </div>
                </div>
                <div class="tel:pt-1 tel:pl-2 pt-3">
                    <button class="hover:bg-gray-400 bg-gray-300 rounded-md text-center h-5 pl-3 pr-2 relative tel:bottom-9 tel:left-2 telL:left-2 telL:bottom-12 telxl:top-0 xl:-top-10 2xl:-top-8 md:-top-5 lg:bottom-16 lg:left-5 float-left">
                        <p class="text-xs font-sans text-black tel:text-xs lg:text-xs xl:text-sm 2xl:text-sm">Voir la page</p>
                    </button>
                </div>
            </div>
        </div>
        <div class="ml-10 text-left">
            <p class="text-xl font-bold text-center font-sans text-black tel:pt-10 md:pb-5">Merci pour votre don</p>
            <p class="text-base  font-sans text-black">Votre nouveau solde réel de votre compte cagnotte est de {{ $cagnotteTransferee->montant_actuel }}€ le solde cumulé est de {{$montantTotalContributions }}€</p>
        </div>
        <div class="text-center pt-20 relative tel:pt-10 md:pb-5 xl:top-5 xl:right-3">
            <button> <a href="{{ route('utilisateur.soutenircause') }}" class="button-back ">Retour</a></button>
        </div>


 
@endsection


