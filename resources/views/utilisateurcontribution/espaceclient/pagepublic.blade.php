@extends('layouts.navadmin')

@section('content')

<div class="liens-container">



<p style="font-weight: bold;">Login / Connexion </p>
    <a href="{{ route('utilisateur.connection') }}" style="font-weight: bold; display: block;">connection (ok)</a>
    <a href="{{ route('utilisateur.inscription') }}" style="font-weight: bold; display: block;">inscription (ok)</a>
    <a href="{{ route('utilisateur.motdepasseoublie') }}" style="font-weight: bold; display: block;">mot de passe oublie (ok)</a>
    <a href="{{ route('utilisateur.showconfirm') }}" style="font-weight: bold; display: block;">confirmation d'envoi (ok)</a>
    <a href="{{ route('utilisateur.typechoice') }}" style="font-weight: bold; display: block;">type d'inscription (ok (manque le lien vers organisme))</a>

    <p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;">Page Affichage </p>
    <a href="{{ route('utilisateur.affichage.experience') }}" style="font-weight: bold; display: block;">Page Expérience (ok) </a> 
    <a href="{{ route('utilisateur.affichage.cause') }}" style="font-weight: bold; display: block;">Page Cause ( route ok ) </a> 
    <a href="{{ route('utilisateur.affichage.projet') }}" style="font-weight: bold; display: block;">Page Projet ( route ok ) </a> 
    <a href="{{ route('utilisateur.affichage.cagnotte') }}" style="font-weight: bold; display: block;">Page Cagnotte ( route ok ) </a> 
    <a href="{{ route('utilisateur.affichage.experimentateur') }}" style="font-weight: bold; display: block;">Page Experimentateur( route ok ) </a> 


    <p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;">Page projet</p>

    <a href="#" style="font-weight: bold; display: block;">Page Projet Expérience</a>
    <a href="#" style="font-weight: bold; display: block;">Page Projet Cagnotte</a>
    <a href="#" style="font-weight: bold; display: block;">Page Utilisateur/ Contributeur</a> 

    <p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;">Page recherche </p>

    <a href="{{ route('utilisateur.searchcause') }}" style="font-weight: bold; display: block;">Recherche Cause (ok  )</a>
    <a href="{{ route('utilisateur.searchorganisation') }}" style="font-weight: bold; display: block;">Recherche Organisation (ok )</a>
    <a href="{{ route('utilisateur.searchprojet') }}" style="font-weight: bold; display: block;">Recherche Projets (ok Dynamiser (manque recherche et filtre))</a>
    <a href="{{ route('utilisateur.searchexperience') }}" style="font-weight: bold; display: block;">Recherche Experiences (ok Dynamiser (manque recherche et filtre))</a> 
    
    <p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;">Page accueil </p>
    <a href="#" style="font-weight: bold; display: block;">Page acceuil cause  </a>
    <a href="#" style="font-weight: bold; display: block;">Page acceuil Organisation  </a>
    <a href="#" style="font-weight: bold; display: block;">Page acceuil expérience  </a>
    <a href="#" style="font-weight: bold; display: block;">Page acceuil projet expérience </a>
    <a href="#" style="font-weight: bold; display: block;">Page acceuil Projet Cagnotte </a> 
    <a href="#" style="font-weight: bold; display: block;">Page acceuil Projet</a> 

{{-- JM --}}
<p>------------------------------------------------------------------------</p> 

<p style="font-weight: bold;">Cause </p>
    <a href="{{ route('utilisateur.causeinscription') }}" style="font-weight: bold; display: block;">cause inscription (ok)</a>
    <a href="{{ route('utilisateur.causeconfirmation') }}" style="font-weight: bold; display: block;">cause confirmation inscription (ok)</a>

</div>

@endsection