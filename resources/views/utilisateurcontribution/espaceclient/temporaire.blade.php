@extends('layouts.navadmin')

@section('content')

<div class="liens-container">
   
<a href="{{ route('utilisateur.compte' ) }}" style="font-weight: bold; display: block;">Mon Comptes ( ok dynamiser )</a>
<a href="{{ route('utilisateur.operation' ) }}" style="font-weight: bold; display: block;">Mes Operations (  ok  dynamiser)</a>
<a href="{{ route('utilisateur.compte.experience' ) }}" style="font-weight: bold; display: block;"> Mes experiences ( route ok )</a>
<a href="{{ route('utilisateur.cagnotte' ) }}" style="font-weight: bold; color: #0000FF; display: block;">Mes cagnottes (ok  Dynamiser)</a>
<a href="{{ route('utilisateur.compte.projet' ) }}" style="font-weight: bold; display: block;">Mes projet ( route ok )</a>
<a href="{{ route('utilisateur.compte.causeprojet') }}" style="font-weight: bold; display: block;"> Mes Cause Projet ( route ok )</a>
<a href="{{ route('utilisateur.information') }}" style="font-weight: bold; display: block;">information (ok  Dynamiser)</a>
<a href="{{ route('utilisateur.securite') }}" style="font-weight: bold; display: block;">securité (ok dynamiser)</a>
<a href="{{ route('utilisateur.identite') }}" style="font-weight: bold; display: block;">Document d'identité (ok dynamiser)</a> 
<a href="{{ route('utilisateur.droit') }}" style="font-weight: bold; display: block;">droit (ok)</a>
<a href="{{ route('utilisateur.parametre') }}" style="font-weight: bold; display: block;">paramtre (ok dynamiser)</a>
<a href="{{ route('utilisateur.notif') }}" style="font-weight: bold; display: block;">Notif(ok dynamiser)</a>

<p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;">Parcour creation de projet experience </p>
    <a href="{{ route('creation.type') }}" style="font-weight: bold; color:	#8A2BE2; display: block;">Creation de projet (ok Dynamiser)</a> 
    <a href="#" style="font-weight: bold; color:	#EE82EE; display: block;">etape 2(ok Dynamiser)</a>
    <a href="#" style="font-weight: bold; color:	#EE82EE; display: block;">etape 3(ok Dynamiser)</a>
    <a href="#" style="font-weight: bold; color:	#EE82EE; display: block;">etape 4(ok Dynamiser)</a> 
    <a href="#" style="font-weight: bold; color:	#EE82EE; display: block;">etape 5(ok Dynamiser)</a> 

    <p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;">Parcour achat experience </p>
<a href="{{ route('utilisateur.produitpack') }}" style="font-weight: bold; color: #008000; display: block;">Produit et pack ( ok Dynamiser )</a> 
<a href="{{ route('utilisateur.pack') }}" style="font-weight: bold; color:	#008000; display: block;">Pack ( ok Dynamiser )</a>
<a href="{{ route('utilisateur.experience') }}" style="font-weight:  bold; color: #008000; display: block;">Experience ( ok Dynamiser )</a>
<a href="#" style="font-weight: bold; color: 	#32CD32; display: block;">Afficher pack (ok  Dynamiser)</a>
<a href="#" style="font-weight: bold; color: 	#32CD32; display: block;">Afficher produit (ok Dynamiser)</a>
<a href="#" style="font-weight: bold; color: 	#32CD32; display: block;">Panier ( ok Dynamiser )</a> 
<a href="#" style="font-weight: bold; color: 	#32CD32; display: block;">Choix du paiement ( ok Dynamiser )</a> 
<a href="#" style="font-weight: bold; color: 	#32CD32; display: block;">Validation de l'achat (  ok Dynamiser )</a> 

<p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;"> Soutenir </p>

<a href="{{ route('utilisateur.soutenircause') }}" style="font-weight: bold; display: block;">Soutenir une Cause (ok  )</a>
<a href="{{ route('utilisateur.soutenirorganisation') }}" style="font-weight: bold; display: block;">Soutenir une organisation (ok )</a>
<a href="{{ route('utilisateur.soutenirprojet') }}" style="font-weight: bold; display: block;">Soutenir un  Projets (ok Dynamiser (manque filtre))</a>
<a href="{{ route('utilisateur.soutenirexperience') }}" style="font-weight: bold; display: block;">Soutenir une Experiences (ok Dynamiser (manque  filtre))</a>

<p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;">Restitution </p>
<a href="#" style="font-weight: bold; color: #00BFFF; display: block;">Contribution Cagnotte (Mamoudou Dynamiser)</a> 
<a href="{{ route('utilisateur.contribution.suivipaiement') }}" style="font-weight: bold; display: block;">Contribution de tout les projet (Davy Dynamiser)</a> 
<a href="{{ route('utilisateur.restitution') }}" style="font-weight: bold; display: block;">Restitution (ok Dynamiser)</a>
<a href="{{ route('utilisateur.restituion.validation') }}" style="font-weight: bold; display: block;">Validation (ok Dynamiser)</a> 
<a href="{{ route('utilisateur.recuperation') }}" style="font-weight: bold; display: block;">recuperation (ok )</a> 

<p>------------------------------------------------------------------------</p> 
<p style="font-weight: bold;">transfere </p>
<a href="{{ route('utilisateur.choixcagnotte') }}" style="font-weight: bold; color:#8B0000; display: block;">Choix de la cagnotte (ok Dynamiser)</a>
<a href="#" style="font-weight: bold; color:	#CD5C5C; display: block;">Transfert (ok Dynamiser) </a> 
<a href="#" style="font-weight: bold; color:	#CD5C5C; display: block;">Validation du Transfere (ok Dynamiser)</a> 



 


  





</div>






@endsection
















