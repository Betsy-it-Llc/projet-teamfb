@extends('layouts.appwithtailwind')

@section('content')
    <div class="flex flex-col items-center h-screen">
        <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white mt-10 mb-4">Paiement</h1>
        <div class="mb-4">
            <p class="text-4xl font-bold">Total <span class="text-6xl font-bold">{{$totalMontant}}€</span></p>
        </div>

        <form method="GET" action="{{ route('utilisateur.payachat',['id_panier'=>$id_panier]) }}">
            @csrf

            <input type="hidden" name="totalCagnotte" value="{{$totalCagnotte}}">
            <input type="hidden" name="somme" value="{{$totalMontant}}">
            <input type="hidden" name="cagnottes" value="{{json_encode($cagnottes)}}">

            <div class="flex flex-col items-center border p-4 rounded-lg w-96">
                <h2 class="text-xl font-semibold">Choix Méthode Paiement</h2>
                <p class="font-semibold text-2xl">Montant disponible:</p>
                <select name="methode_paiement" class="mt-2 text-center">
                    <option value="">Votre méthode de paiement</option>
                    <option value="cagnotte">Cagnotte - {{$totalCagnotte}}€</option>
                    <option value="compte-llc">Compte Llc - {{$compte->solde}}€</option>
                    <option value="par-carte">Par carte</option>
                </select>
            </div>

            <h2 class="text-2xl font-bold mt-4">Validez votre achat</h2>
            <button type="submit" class="bg-blue-500 text-white font-semibold rounded-lg py-2 px-4 mt-2 hover:bg-blue-700">Valider</button>
    </div>


@endsection







