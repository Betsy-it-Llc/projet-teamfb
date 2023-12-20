


@extends('layouts.appwithtailwind')
@section('content')


        <div class="grid grid-cols-1 grid-rows-2 gap-0.5 pl-5 relative">
            <h1 class="text-6xl font-sans font-bold text-slate-800 tel:text-2xl telL:text-2xl telM:text-4xl md:text-4xl">RECHERCHE</h1>
            <p class="text-xl telM:text-3xl font-sans font-bold text-black text-left relative 2xl:left-36">Projet</p>
        </div>
        <div class="grid grid-cols-3 grid-rows-1 gap-1 text-center tel:mt-3 telL:ml-10 telM:ml-20 telM:mt-10 sm:left-10 md:left-16 md:bottom-8 lg:top-0 md:pt-5 sm:pb-2">
            <button class="hover:border-b-2 w-16 hover:border-gray-900 text-center pb-1">
                <a href="{{route('utilisateur.searchcause')}}" class="  text-xl font-sans text-black sm:float-left">Cause</a>
            </button>
            <button class="hover:border-b-2 w-28 hover:border-gray-900 text-center pb-1 relative tel:right-5">
                <a href="{{route('utilisateur.searchexperience')}}" class="  text-xl font-sans text-black sm:float-left">Expérience</a>
            </button>
            <button class="hover:border-b-2 w-16 hover:border-gray-900 text-center pb-1">
                <a a href="{{route('utilisateur.searchprojet')}}" class="text-xl font-sans text-black sm:float-left">Projet</a>
            </button>
        </div>
        <form action="{{ route('utilisateur.searchprojet') }}" method="GET">
            @csrf
        <div class="grid grid-cols-3 grid-rows-1 gap-4">
            
                <div class="relative left-20 top-7">
                    <input type="search" name="searchQuery" placeholder="une cause solidaire" class="w-64 tel:w-40 tel:float-right tel:pl-8 telL:w-48 telM:w-52 p-2 border border-gray-500 rounded-md focus:outline-none focus:border-blue-500">
                    <div class="inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 relative tel:bottom-7 tel:right-16 telL:hidden telL:bottom-7 telM:bottom-7 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.2-5.2"></path>
                            <circle cx="10" cy="10" r="8"></circle>
                        </svg>
                    </div>
                </div>
                <div class="relative left-28 top-8 tel:hidden telL:hidden telM:hidden sm:flex lg:flex xl:flex 2xl:flex">
                    <img class="w-8 h-6" src="{{ asset('img/parametre.png') }}" alt="">
                </div>
                <div class="float-right relative tel:float-right tel:left-20 sm:left-0 top-8 right-10">
                    <button>
                        <p class="text-xl tel:text-xs font-sans text-black w-32 telM:w-40 pt-2 pb-2 rounded-md bg-gray-300">Recherche</p>
                    </button>

                </div>
          
        </div>
    </form>
    @foreach ($projets as $projet)
        <div class="pt-10 tel:pl-5 telL:pl-12 telM:pl-12 telM:pt-5 md:pl-24 2xl:pl-28">
           
            <div class="bg-transparent border border-gray-300 relative tel:w-72 telL:w-80 telM:w-96 md:w-96 tel:top-8 2xl:w-3/4 h-60 text-center rounded-sm">
                <div class="flex">
                    <div class="bg-gray-300 rounded-md w-52 h-32 tel:w-28 telM:w-36 relative mt-10 ml-5"></div>
                    <div class="relative right-3">
                        <div class="grid grid-cols-1 grid-rows-3 gap-1 relative left-3">
                            <p class="text-2xl tel:text-lg 2xl:text-lg font-sans font-bold text-black text-left relative 2xl:top-1 2xl:right-14">{{$projet->nom}}</p>
                            <p class="text-lg font-sans font-bold text-black text-left relative">Lorem ipsum</p>
                            <div class="grid grid-cols-2 grid-rows-1 gap-1 relative right-5">
                                <p class="text-xl font-sans font-bold text-slate-800 text-right tel:text-xl lg:text-xl xl:text-xl 2xl:text-xl"> @foreach ($projet->cagnottes as $cagnotte)
                                    {{ $cagnotte->montant_actuel }}€
                                    @if (!$loop->last) 
                                        <!-- Si ce n'est pas la dernière cagnotte, affichez une virgule -->
                                        ,
                                    @endif
                                @endforeach</p>
                                <p class="text-sm font-sans text-slate-800 text-left relative tel:text-xs tel:top-2 lg:text-sm xl:text-sm 2xl:text-sm 2xl:top-2">Récoltés</p>
                            </div>
                            <div class="relative telM:top-2 2xl:top-5">
                                <p class="text-sm font-sans text-black text-left">Date: {{ date('d-m-Y', strtotime($projet->date_creation)) }}</p>
                                <p class="text-sm font-sans text-black text-left">Type Projet: {{ $projet->typeProjet->valeur }}</p>
                            </div>
                        </div>
                        <button id="heartButton" class="relative focus:outline-none tel:left-12 tel:bottom-6 telM:left-24 lg:bottom-5 lg:left-10 float-right">
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
                    </div>
                </div>
                <div class="grid grid-cols-2 grid-rows-1 gap-4 relative top-3">
                    <button class="hover:bg-gray-400 bg-gray-300 rounded-md text-center w-32 tel:w-20 telL:w-20 telM:w-32 h-8 float-left relative tel:left-5 telM:bottom-2 2xl:left-10">
                        <p class="text-xs font-sans text-black">Voir la page</p>
                    </button>
                    <button class="hover:bg-gray-400 bg-gray-300 rounded-md text-center w-32 tel:w-20 telL:w-20 telM:w-32 h-8 float-left relative tel:left-5 telM:bottom-2 2xl:left-2">
                        <a href="{{ route('utilisateur.recapsoutenir', ['id_projet' => $projet->id_projet]) }}" class="text-xs font-sans text-black">Soutenir</a>
                    </button>
                </div>
            </div>
        


        </div>
        @endforeach

        


    @endsection

