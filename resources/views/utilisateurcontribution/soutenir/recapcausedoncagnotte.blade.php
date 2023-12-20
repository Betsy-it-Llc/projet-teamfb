@extends('layouts.appwithtailwind')

@section('content')


        
        <header class="header-maj">
            <h1 class="h1-maj">
                Soutenir
            </h1>
            <h2 class="font-sans text-2xl font-bold text-slate-800 tel:text-2xl telL:text-2xl md:text-2xl">Validation</h2>
        </header>
    
        <p class="text-4xl font-sans font-bold text-black text-center tel:text-xl xl:text-2xl relative tel:top-7 xl:pb-8">Don Cagnotte</p>
        <div class="grid grid-cols-1 grid-rows-6 gap-4 relative tel:top-16 xl:top-10">
            <p class="text-xl tel:text-lg text-center font-sans text-black relative tel:pb-6 tel:pt-3 xl:pb-3 xl:pt-2">Don vers cagnotte expérience</p>
            <div class="bg-gray-200 rounded-md 4 2xl:h-14 relative 2xl:bottom-32 ml-10 mr-5 mt-20">
                <div class="grid grid-cols-2 grid-rows-1 gap-1 text-center">
                    <p class="text-base font-sans font-bold text-left text-slate-800 relative tel:ml-36 tel:top-3 telL:top-0 md:left-10 md:top-1 lg:top-3 xl:left-28 xl:top-2 lg:left-36 2xl:left-24">{{$cagnotteTransferee->titre}}</p>
                    <p class="text-base font-sans text-slate-800 text-right relative tel:ml-24 tel:top-7 tel:right-3 tel telL:top-3 telL:pr-5 md:left-5 md:top-3 lg:top-3 xl:left-0 xl:pr-4 xl:top-3 lg:left-0 lg:pr-4 2xl:-left-5">{{$cagnotteTransferee->montant_actuel}}€</p>
                </div>
                <div class="w-28 tel:w-24 xl:w-52 xl:pl-5 lg:w-40 px-3 rounded-md bg-gray-50 border h-6 text-left relative tel:bottom-5 tel:left-5 telL:left-5 telL:bottom-8 md:bottom-7 md:mt-2 lg:bottom-3 xl:left-2 xl:bottom-8 xl:mt-2 2xl:bottom-5">
                    <p class="text-base font-sans text-black">Lier</p>
                </div>
            </div>
            <div class="relative 2xl:bottom-20">
                <p class="text-xl font-sans text-black text-center tel:pb-2 tel:pt-3 lg:pb-3 xl:pb-3 xl:pt-2 2xl:pt-0 2xl:pb-2">à bien été liée à</p>
            </div>
            <div class="bg-gray-200 rounded-md 4 2xl:h-14 relative 2xl:bottom-32 ml-10 mr-5">
                <div class="grid grid-cols-2 grid-rows-1 gap-1 text-center">
                    <p class="text-base font-sans font-bold text-right text-slate-800 relative tel:ml-36 tel:top-7 md:left-10 md:top-3 lg:top-3 xl:left-10 xl:top-3 lg:left-2 2xl:left-20 2xl:text-left ">{{$cagnotte->titre}}</p>
                    <p class="text-base font-sans text-slate-800 text-right relative tel:right-3 tel:top-7 telL:top-6 telL:pr-5 md:left-5 md:top-3 lg:top-3 xl:left-0 xl:pr-4 xl:top-3 lg:left-0 lg:pr-4 2xl:-left-5">{{$cagnotte->montant_actuel}}€</p>
                </div>
                <div class="w-40 tel:w-28 md:w-40 xl:w-52 lg:w-40 xl:pl-5 px-3 rounded-md bg-gray-50 border h-6 text-left relative tel:bottom-3 tel:left-5 md:bottom-3 lg:bottom-3 xl:bottom-3 xl:left-2">
                    <p class="text-base font-sans text-black">Nouveau détenteur</p>
                </div>
            </div>
            <div class="relative 2xl:bottom-40">
                <div class="bg-gray-100 rounded-md  h-36 ml-10 mr-4">
                    <p class="text-xl font-sans text-slate-800 text-center xl:pt-2">Votre don a bien été validé</p>
                    <p class="text-xl font-sans text-slate-800 text-center relative tel:top-14 xl:top-12">nouveau</p>
                    <p class="text-xl font-bold font-sans text-slate-800 text-center relative tel:top-14 xl:top-12">Montant Cagnotte {{$cagnotteTransferee->montant_actuel}}€</p>
                </div>
            </div>
        </div>
        <div class="text-center relative 2xl:bottom-36">
            <button> <a href="{{ route('utilisateur.soutenircause') }}" class="button-back">Retour</a></button>
        </div>


@endsection
@section('scripts')




