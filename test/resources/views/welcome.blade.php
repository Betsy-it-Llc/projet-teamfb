@extends('layouts.navadmin')
  
@section('content')

<div style="width : 100%">
    <h2 style="text-align : center">Bonjour la, vous êtes connectés</h2>
    <br>
    <h3 style="text-align : center">Tu veux faire quoi?</h3>
    <br><br>
</div>

<div class="row">

    <div class="col-sm-4 mb-3">
        <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title" style="text-align : center">Je veux voir</h5>
            <br>
            <ul style="list-style : none">
            <li><a href="">Compagne En Cours</a></li>
            <li><a href="">Compagne Terminé</a></li>
            <li><a href="">Compagne Prévue</a></li>
            <li><a href="">Compagne En Idéation</a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="col-sm-4 mb-3">
        <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title" style="text-align : center">Je veux créer</h5>
            <br>
            <ul style="list-style : none">
            <li><a href="{{ route('campagnes.create'}}">Créer une compagne</a></li>
            <li><a href="">Recherche nouveaux groupes</a></li>
            <li><a href="">Créer une nouvelle segmentation</a></li>
            <li><a href="">Créer des posts</a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="col-sm-4 mb-3">
        <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title" style="text-align : center">Je veux comparer</h5>
            <br>
            <ul style="list-style : none">
            <li><a href="">Compagne Terminée</a></li>
            <li><a href="">Les segements</a></li>
            <li><a href="">Les posts</a></li>
            <li><a href="">Les groupes</a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="col-sm-4 mb-3">
        <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title" style="text-align : center">Je veux analyser</h5>
            <br>
            <ul style="list-style : none">
            <li><a href="">Analyser les compagnes</a></li>
            <li><a href="">Analyser les segments</a></li>
            <li><a href="">Analyser les posts</a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="col-sm-4 mb-3">
        <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title" style="text-align : center">Je veux relever</h5>
            <br>
            <ul style="list-style : none">
            <li><a href="">Les data générales des groupes</a></li>
            <li><a href="">Les posts d'une compagne</a></li>
            <li><a href="">Insights page FB Lalachante</a></li>
            <li><a href="">Insight site Google Lalachante</a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="col-sm-4 mb-3">
        <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title" style="text-align : center">Je veux ségmenter</h5>
            <br>
            <ul style="list-style : none">
            <li><a href="{{ route('segements.index'}}">Analyser les segements</a></li>
            <li><a href="{{ route('segements.index'}}">Comparer les segements</a></li>
            <li><a href="{{ route('segements.index'}}">Scorer les segements</a></li>
            <li><a href="{{ route('segements.index'}}">Comparer les segements et posts</a></li>
            </ul>
        </div>
        </div>
    </div>
</div>

@endsection