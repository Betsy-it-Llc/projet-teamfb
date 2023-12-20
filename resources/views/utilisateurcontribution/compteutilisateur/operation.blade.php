@extends('layouts.appwithtailwind')

@section('content')


<div>
    <div>
        <main>
            <header class="header-maj">
                <h1 class="h1-maj">
                    mes operations
                </h1>
            </header>
            <div class="flex items-center justify-center mt-2 md:mt-20 space-x-8">
                <div class="text-center">
                    @if ($soldeContact !== null)
                    <p class="text-3xl text-black font-bold mb-1">{{ $soldeContact }}€</p>
                    @else
                    <p class="text-3xl text-black font-bold mb-1">0€</p>
                    @endif
                    <p class="text-lg text-black">Llc</p>
                </div>
                <div class="text-center">
                    <p class="text-5xl text-black font-bold mb-1">{{ $montantAvoir }}€</p>
                    <p class="text-lg text-black">Avoir</p>
                </div>
                <div class="text-center mt-5">
                    <p class="text-3xl text-black font-bold mb-1">{{$montantTotalCagnottes}}€<a href="{{ route('utilisateur.cagnotte') }}" class="text-gray-950 italic text-xs relative top-3">Voir</a></p>
                    <p class="text-lg text-black">Cagnotte</p> 
                    <p class="text-base text-black ml-16">Réel Total</p>
                </div>
            </div>
            <div class="button-utiliser">
                <p class="text-xl  text-gray-900 md:text-xl dark:text-black mt-1">Liste des <p class="text-2xl ml-2 text-black font-bold"> Opérations</p></p>
            </div>

                <div class="overflow-x-auto pl-10 pr-4">
                    <table class="table">
                      <!-- head -->
                      <thead>
                        <tr>
                          <th class="text-nom-colonne-tableau">Date</th>
                          <th class="text-nom-colonne-tableau">Opération</th>
                          <th class="text-nom-colonne-tableau">Montant</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($transactions as $transaction)
                        <tr class="">
                          <td>{{ date('d-m-Y', strtotime($transaction->date_transaction)) }}</td>
                          <td>{{ $transaction->type}}</td>
                          <td>{{ $transaction->montant}}€</td>
                        </tr>  
                        @endforeach
                      </tbody>
                    </table>
                  </div>

        </main>
    </div>
</div>


@endsection


