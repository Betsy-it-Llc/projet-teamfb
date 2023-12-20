@extends('layouts.appwithtailwind')

@section('content')

        <div class="text-left relative tel:ml-9 tel:mt-7 xl:left-10 xl:bottom-3">
            <h1 class="text-4xl tel:text-xl telL:text-2xl md:text-3xl lg:text-4xl font-sans font-bold text-slate-800">SOUTENIR</h1>
        </div>
        <div class="grid grid-cols-1 grid-rows-2 gap-0.5 relative tel:ml-8 tel:mt-2 xl:left-10 xl:bottom-3">
            <p class="text-base font-sans font-bold text-black text-left">Lier cagnotte</p>
            <p class="text-base font-sans text-black text-left">ipsum dolor sit amet sectetu.</p>
        </div>
        <p class="text-xl font-sans text-black text-center tel:text-lg relative tel:top-7 xl:pb-16">Lier ma Cagnotte</p>
        <div class="grid grid-cols-1 grid-rows-7 gap-4 relative tel:top-16 xl:top-10">
            <p class="text-xl text-center font-sans text-black">Votre cagnotte expérience</p>
            <div class="bg-gray-200 rounded-md telL:h-12 sm:w-3/4 sm:left-12 md:w-3/4 md:h-14 xl:w-3/4 relative md:left-24 xl:left-20">
                <div class="grid grid-cols-2 grid-rows-1 gap-1 text-center">
                    <p class="text-base font-sans font-bold text-left text-slate-800 relative tel:ml-36 tel:top-7 telL:top-0 md:left-10 md:top-1 lg:top-3 xl:left-28 xl:top-2 lg:left-36 2xl:left-24 2xl:top-4">{{$cagnotteTransferee->titre}}</</p>
                    <p class="text-base font-sans text-slate-800 text-right relative tel:ml-24 tel:top-7 tel telL:top-3 telL:pr-5 md:left-5 md:top-3 lg:top-3 xl:left-0 xl:pr-4 xl:top-3 lg:left-0 lg:pr-4 2xl:-left-5">{{$cagnotteTransferee->montant_actuel}}€</p>
                </div>
                <div class="w-28 tel:w-24 xl:w-52 xl:pl-5 lg:w-40 px-3 rounded-md bg-gray-50 border h-6 text-left relative tel:bottom-3 tel:left-5 telL:left-5 telL:bottom-8 md:bottom-7 lg:bottom-3 xl:left-2 xl:bottom-3 2xl:bottom-2">
                    <p class="text-base font-sans text-black">Lier</p>
                </div>  
            </div>
            <p class="text-xl font-sans text-black text-center tel:pb-2 tel:pt-3 lg:pb-3 xl:pb-3 xl:pt-2">à bien été liée à</p>
            <div class="bg-gray-200 rounded-md sm:w-3/4 sm:left-12 md:w-3/4 xl:w-3/4 2xl:w-3/4 2xl:h-14 relative md:left-24 xl:left-20">
                <div class="grid grid-cols-2 grid-rows-1 gap-1 text-center mr-2">
                    <p class="text-base font-sans font-bold text-left text-slate-800 relative tel:ml-36 tel:top-7 md:left-10 md:top-3 lg:top-3 xl:left-10 xl:top-3 lg:left-2 2xl:left-20">{{$cagnotte->titre}}</p>
                    <p class="text-base font-sans text-slate-800 text-right relative tel:ml-24 tel:top-7 telL:top-6 telL:pr-5 md:left-5 md:top-3 lg:top-3 xl:left-0 xl:pr-4 xl:top-3 lg:left-0 lg:pr-4 2xl:-left-5">{{$cagnotte->montant_actuel}}€</p>
                </div>
                <div class="w-40 tel:w-28 md:w-40 xl:w-52 lg:w-40 xl:pl-5 px-3 rounded-md bg-gray-50 border h-6 text-left relative tel:bottom-3 tel:left-5 md:bottom-3 lg:bottom-3 xl:bottom-3 xl:left-2 2xl:bottom-2">
                    <p class="text-base font-sans text-black">Nouveau détenteur</p>
                </div>
            </div>
            <p class="text-xl font-sans text-black text-center tel:pb-6 tel:pt-3 xl:pb-3 xl:pt-2">pour la période</p>
            <div class="bg-gray-100 rounded-md w-3/5 h-20 relative tel:left-9 tel:w-64 telL:left-20 sm:left-20 sm:w-80 md:w-80 md:left-32 lg:w-96 lg:left-52 xl:left-40">
                <div class="grid grid-cols-2 grid-rows-2 gap-1 text-center relative tel:left-5 tel:top-3 xl:top-3 xl:left-6">
                    <p class="text-sm font-sans text-slate-800 text-center">Date de début:</p>
                    <p class="text-sm font-sans text-slate-800 text-left">{{ $formattedDateStart }}</p>
                    <p class="text-sm font-sans text-slate-800 text-center relative tel:right-3 xl:right-3">Date de fin:</p>
                    <p class="text-sm font-sans text-slate-800 text-left">{{$formattedDatesEnd ?? 'Non déterminé'}}</p>
                </div>
            </div>
            <div class="text-center mt-10">
                <button> <a href="{{ route('utilisateur.soutenircause') }}" class="button-back">Retour</a></button>
            </div>
        </div>


@endsection


