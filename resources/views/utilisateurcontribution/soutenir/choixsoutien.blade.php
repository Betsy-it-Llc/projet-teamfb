@extends('layouts.appwithtailwind')

@section('content')


        <header class="header-min">
            <h1 class="h1-min">Soutenir</h1>
        </header>
        <div class="grid grid-cols-1 grid-rows-2 gap-0.5">
            <h2 class="text-sm font-sans font-bold text-black text-left pl-10">Choix du mode de soutien</h2>
            <p class="text-sm font-sans text-black text-left relative bottom-1 pl-10">Soutenir {{$projet->nom}}</p>
        </div>
        <div class="pt-9 tel:pt-14 md:pt-20 lg:pt-10">
            <div class="relative sm:bottom-24 md:bottom-40 lg:bottom-28 4k:top-14">
                <a href="{{ route('utilisateur.causeliercagnotte', ['id_projet' => $projet->id_projet]) }}" class="block">
                    <div class="div-cadre-mode">
                        <p class="text-mode">Lier une Cagnotte Expérience</p>
                        <h2 class="text-cagnotte">Cagnotte</h2>
                    </div>
                </a>
                <div class="pt-6">
                    <a href="{{ route('utilisateur.transfertcagnotte', ['id_projet' => $projet->id_projet]) }}" class="block">
                        <div class="div-cadre-mode">
                            <p class="text-mode">Transférer une Cagnotte</p>
                            <h2 class="text-cagnotte">Cagnotte</h2>
                        </div>
                    </a>
                </div>
                <div class="pt-4">
                    <a href="{{ route('utilisateur.doncagnotte', ['id_projet' => $projet->id_projet]) }}" class="block">
                        <div class="div-cadre-mode">
                            <p class="text-mode">Faire un don</p>
                            <h2 class="text-cagnotte">Cagnotte</h2>
                        </div>
                    </a>
                </div>
            </div>
            
        </div>


@endsection
