@extends('layouts.appwithtailwind')
@section('content')



        <header class="header-maj">
            <h1 class="h1-maj">
                soutenir
            </h1>
        </header>

            <h2 class="text-xl telM:text-3xl font-sans font-bold text-black text-left relative 2xl:left-36">Cause</h2>

        <div class="grid grid-cols-3 grid-rows-1 gap-1 text-center tel:mt-3 telL:ml-10 telM:ml-20 telM:mt-10 sm:left-10 md:left-16 md:bottom-8 lg:top-0 md:pt-5 sm:pb-2">
            <button class="hover:border-b-2 w-16 hover:border-gray-900 text-center pb-1">
                <a href="{{route('utilisateur.soutenircause')}}" class="  text-xl font-sans text-black sm:float-left">Cause</a>
            </button>
            <button class="hover:border-b-2 w-28 hover:border-gray-900 text-center pb-1 relative tel:right-5">
                <a href="{{route('utilisateur.soutenirexperience')}}" class="  text-xl font-sans text-black sm:float-left">Expérience</a>
            </button>
            <button class="hover:border-b-2 w-16 hover:border-gray-900 text-center pb-1">
                <a a href="{{route('utilisateur.soutenirprojet')}}" class="text-xl font-sans text-black sm:float-left">Projet</a>
            </button>
        </div>
        <form action="{{ route('utilisateur.soutenircause') }}" method="GET">
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
        <div class="mx-5 auto">
            @foreach($causes as $cause)
                <livewire:card :var3="$cause" />
            @endforeach       
        </div>
    @endsection

