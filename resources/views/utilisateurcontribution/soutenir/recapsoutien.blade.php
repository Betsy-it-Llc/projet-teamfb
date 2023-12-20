@extends('layouts.appwithtailwind')

@section('content')

    

        <header class="header-min">
            <h1 class="h1-min">Soutenir</h1>
        </header>
        <div class="grid grid-cols-1 grid-rows-2 gap-0.5">
            <p class="text-lg font-serif font-bold text-black text-center tel:text-base sm:text-xl lg:text-lg xl:text-lg 2xl:text-lg">Vous souhaitez soutenir</p>
            <p class="text-base font-sans text-black text-center relative tel:right-16 tel:text-xs md:right-24 lg:right-20 lg:text-sm xl:left-0 xl:text-sm 2xl:text-sm">{{$cagnotte->titre}}</p>
        </div>
        <div class="flex items-center justify-center text-center">
            <div class="bg-white h-52 tel:w-72 telL:w-96 sm:w-10/12 sm:h-52 md:w-3/4 lg:w-3/4 xl:w-3/5 xl:h-56 2xl:w-3/5 text-center relative tel:top-20 rounded-md border border-gray-200 ml-2">
            <div class="flex">
                <div class="bg-gray-300 w-28 h-36 telL:w-28 sm:w-40 sm:h-32 md:w-40 md:h-36 xl:w-32 xl:h-40 relative mt-3 ml-2"></div>
                <div class="tel:mt-3 relative">
                    <p class="text-base font-sans font-bold text-black text-center relative tel:text-sm tel:right-8 lg:text-base xl:text-left xl:left-4 xl:text-base 2xl:text-base">{{$cagnotte->titre}}</p>
                    <p class="text-base font-sans text-black text-center relative tel:text-xs tel:top-0 tel:left-2 lg:text-left lg:text-sm lg:right-5 xl:text-sm 2xl:text-sm">{{ $projet->description_courte }}.</p>
                    <div class="grid grid-cols-2 grid-rows-1 gap-1 relative tel:top-6 tel:right-8">
                        <p class="text-2xl font-sans font-bold text-slate-800 text-right tel:text-xl lg:text-xl xl:text-xl 2xl:text-xl">{{$cagnotte->montant_actuel}}€</p>
                        <p class="text-sm font-sans text-slate-800 text-left relative tel:text-xs tel:top-2 lg:text-sm xl:text-sm 2xl:text-sm">Récoltés</p>
                    </div>
                    <p class="text-sm font-sans text-slate-800 text-center relative tel:text-xs tel:top-8 tel:right-5 telL:right-8 lg:text-sm xl:text-sm 2xl:text-sm">Date: {{ $projet->date_creation->format('d m Y') }}</p>
                    <p class="text-sm font-sans text-slate-800 text-center relative tel:text-xs tel:top-10 tel:right-0 telL:left-1 lg:text-sm xl:top-10 xl:left-6 xl:text-sm 2xl:text-sm">Type: {{ $projet->types_Projet->valeur }}</p>
                    <button id="heartButton" class="relative focus:outline-none tel:right-1 tel:bottom-5 telL:left-20 telL:top-2 sm:left-14 md:left-16 md:top-4 lg:left-20 lg:top-3 xl:left-20 xl:top-3 2xl:left-32 float-right">
                        <span class="heart text-3xl text-gray-400 transition duration-300 transform hover:scale-110 active:text-red-500 active:scale-100">&hearts;</span>
                    </button>
                    <script>
                        const heartButton = document.getElementById('heartButton');
                        const heart = heartButton.querySelector('.heart');
                        let isFilled = false;

                        heartButton.addEventListener('click', () => {
                            isFilled = !isFilled;
                            if (isFilled) {
                                heart.classList.add('heart-filled');
                            } else {
                                heart.classList.remove('heart-filled');
                            }
                        });
                    </script>
                    <button class="hover:bg-gray-400 bg-gray-300 pl-2 pr-1 rounded-md text-center float-right relative tel:right-14 tel:top-14">
                        <p class="text-sm font-sans text-black tel:text-xs lg:text-sm xl:text-sm 2xl:text-sm">Voir la page</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
        <div class="text-center">
            <a href="{{ route('utilisateur.choixsoutien', ['id_projet' => $projet->id_projet]) }}" class="bg-gray-300 text-black px-10 py-2 rounded hover:bg-gray-400 transition duration-300 ease-in-out relative sm:px-8 tel:top-36 lg:px-10 xl:px-12 inline-block">
                Je soutiens
            </a>
        </div>
        

<div>
@endsection