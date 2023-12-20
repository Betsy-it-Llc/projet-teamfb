@extends('layouts.appwithtailwind')

@section('content')
<div class="flex justify-center  h-screen mt-10">
    <div class="text-left">
        <h1 class="text-4xl font-bold mb-8"> Parametre</h1>

        <a href="{{ route('utilisateur.information') }}" class="block text-4xl font-bold mb-4">Information</a>
        <a href="{{ route('utilisateur.securite') }}" class="block text-4xl font-bold mb-4">Sécurité</a>
        <a href="{{ route('utilisateur.identite') }}" class="block text-4xl font-bold mb-4">Document d'identité</a>
        <a href="{{ route('utilisateur.notif') }}" class="block text-4xl font-bold mb-4">Notif</a>
        @if(auth()->check() && auth()->user()->hasRole('Cause'))
    <a href="{{ route('utilisateur.droit') }}" class="block text-4xl font-bold mb-4">Ajout administrateur</a>
        @endif

        

    </div>
</div>

@endsection