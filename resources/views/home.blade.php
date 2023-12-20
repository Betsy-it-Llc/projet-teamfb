@extends('layouts.navadmin')

@section('content')

<div style="width : 100%">
    <h2 style="text-align : center">Bonjour {{Auth::user()->name}}, vous êtes connectés</h2>
    <br>
    <h3 style="text-align : center">Tu veux faire quoi?</h3>
    <br><br>
</div>

<div class="row" style="font-size : 15px">

    <div class="col-sm-4 mb-3">
        <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title" style="text-align : center">Je veux voir</h5>
            <br>
            <ul style="list-style : none">
                <li> <a href="/get_campagne_encours"> Campagne en cours <strong>Ok</strong></li>
                <li> <a href="/get_campagne_terminee"> Campagne terminée <strong>Ok</strong></li>
                <li> <a href="/get_campagne_archivee"> Campagne archivée <strong>Ok</strong></li>
                <li> <a href="/get_campagne_planifiee"> Campagne planifiée <strong>Ok</strong></li>
                <li> <a href="/get_campagne_idee"> Campagne idée <strong>Ok</strong></li>
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
            <li><a href="{{ route('campagnes.create')}}">Créer une campagne <strong>Ok</strong></a></li>
            <li><a href="{{ route('groupes.index')}}">Recherche nouveaux groupes <strong>Ok</strong></a></li>
            <li><a href="{{ route('segementations.create')}}">Créer une nouvelle segmentation <strong>Ok</strong></a></li>
            <li><a href="{{ route('postmeres.create')}}">Créer des posts <strong>Ok</strong></a></li>
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
            <li><a href="{{ route('campagnes.index')}}">Campagne Terminée <strong>Ok</strong></a></li>
            <li><a href="{{ route('segements')}}">Les segements <strong>Ok</strong></a></li>
            <li><a href="{{ route('postmeres.index')}}">Les posts <strong>Ok</strong></a></li>
            <li><a href="{{ route('groupes.index')}}">Les groupes <strong>Ok</strong></a></li>
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
            <li><a href="/campagnesdashboard">Analyser les compagnes <strong>Ok</strong></a></li>
            <li><a href="/segmentsdashboard">Analyser les segments <strong>Ok</strong></a></li>
            <li><a href="/dashboardpostmere">Analyser les posts <strong>Ok</strong></a></li>
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
            <li><a href="">Les posts d'une campagne</a></li>
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
            <li><a href="{{ route('segements')}}">Analyser les segements <strong>Ok</strong></a></li>
            <li><a href="{{ route('segements')}}">Comparer les segements <strong>Ok</strong></a></li>
            <li><a href="{{ route('segements')}}">Scorer les segements <strong>Ok</strong></a></li>
            <li><a href="{{ route('segements')}}">Comparer les segements et posts <strong>Ok</strong></a></li>
            </ul>
        </div>
        </div>
    </div>
</div>

@endsection
