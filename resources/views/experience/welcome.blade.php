@extends('layouts.app')
@section('content')

<h1>Bienvenue {{ $con->nom }} {{ $con->prenom }}. </h1>
<h2>Vous etez bien inscrits à l'experience {{ $exp->nom_experience }} graçe au numéro {{ $exp->numero_experience }}</h2>
    {{-- Ajout des messages personnalisés 'success' --}}
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

 {{-- Ajout des messages personnalisés 'error' --}}
 @if (session()->has('error'))
     <div class="alert alert-danger">
        {{ session()->get('error') }}
     </div>
@endif
@endsection