@extends('layouts.navadmin')
@section('content')

<head>
    <title>{{ $contribution->contact->prenom }} {{ $contribution->contact->nom}} </title>
    <link rel="shortcut icon"
        href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU" />
</head>
<div class="container" style="width:100%;margin:0">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
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
    <div id="content" class="content p-0">
        <div class="profile-header">
            <center>
                <b ><span style="  margin-bottom :20px;font-size:2.5rem;">{{ $contribution->nomExperience() }} </span></b>
            </center>

        </div>
        <br>
      
        <td>
            <div class="profile-header-name">
                <b style="font-size: 2.3em;">
                    Projet : <span style="font-weight: normal; font-size: 0.9em;">{{ $contribution->cagnotte->projet->nom }}</span>
                    Type : <span style="font-weight: normal; font-size: 0.9em;">{{ $contribution->cagnotte->projet->types_Projet->valeur }}</span>
                   
                    Catégorie : <span style="font-weight: normal; font-size: 0.9em;">
                        {{ $contribution->cagnotte->categorie->nom }}
                    </span>
                </b>
            </div>
        </td>
        <br>

<!-- --------------------- Info Contact ------------------- -->
<div class="profile-container">
    <div class="row row-space-20">

        <div class="col-md-4 hidden-xs hidden-sm" style="max-width:25%">
            <div class="tab-content p-0">
                <div class="tab-pane active show" id="profile-about">
                    <table class="table table-profile">
                        <thead>
                            <tr style="padding:0;">
                                <th style="padding:0;" colspan="2">Info Contact </th>
                            </tr>
                            <tr style="font-size:1rem;">
                                <td style="padding:0 0 0.5rem 0;"><b> Id : {{ $contribution->id_contact }}</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="field">Nom: </td>
                                <td class="value">
                                    {{ $contribution->contact->nom }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Prenom: </td>
                                <td class="value">
                                    {{ $contribution->contact->prenom }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Email:</td>
                                <td class="value">
                                    {{ $contribution->contact->email }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Tel: </td>
                                <td class="value">
                                    {{ $contribution->contact->tel }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Adresse: </td>
                                <td class="value">
                                    {{ $contribution->contact->adresse }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Code Postale: </td>
                                <td class="value">
                                    {{ $contribution->contact->code_postal }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Ville : </td>
                                <td class="value">
                                    {{ $contribution->contact->ville }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field" style="width:50%">Numero CSE : </td>
                                <td class="value">
                                    {{ $contribution->contact->num_cse }}
                                </td>
                            </tr>


                        </tbody>
                    </table>

<!-- --------------------- Organisation ------------------- -->
                    <table class="table table-profile" style="margin-top:30px; margin-left: 550px">
                        <thead>
                            <tr style="padding:0;">
                                <th style="padding:0;" colspan="2">Organisation : <span style="font-weight:normal; font-size: 0.9em; ">Blablabla</span></th>
                            </tr>


                        </thead>
                    </table>
                </div>
            </div>
        </div>
     
<!-- --------------------- Montant------------------- -->

        <div class="col-md-4 " style="max-width:25%">
            <div class="tab-content p-0">
                <div class="tab-pane active show" id="profile-about" style="margin-left:0px;">
                    <table class="table table-profile">
                        <thead>
                            <tr style="padding:0;">
                                <th style="padding:0 0 0 0;" colspan="2">Montant: <span style="font-weight:normal; font-size: 0.9em;">{{ $contribution->montant }} euros</span></th>
                            </tr>

                            <tr style="padding:0;">
                                <th style="padding:0 0 0 0;" colspan="2">Frais : <span style="font-weight:normal; font-size: 0.9em;">50 euros</span></th>
                            </tr>

                        </thead>
                    </table>         
            
                    
<!-- --------------------- Date heure lien ------------------- -->
        
<table class="table table-profile"style="margin-top:-90px; margin-left: 300px">
    <thead>
        <tr style="padding:0;">
            <th style="padding:0;" colspan="2">Heure : <span style="font-weight:normal; font-size: 0.9em;">{{ $contribution->getHeureContributionFormattedAttribute() }}</span> </th>
        </tr>
        <tr style="padding:0;">
            <th style="padding:0;" colspan="2"> Date : <span style="font-weight:normal; font-size: 0.9em;">{{ $contribution->getDateContributionFormatted() }}</span> </th>
        </tr>
                            <tr style="padding:0;">
                                <th style="padding:0;" colspan="2">
                                    Lien : <a href="#">
                                        <span style="font-size: 0.9em; font-weight: normal; color:red">Experience</span>
                                    </a>
                                </th>
                            </tr>
                            

                        </thead>
                       
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- --------------------- Message ------------------- -->
        
    <table class="table table-profile"style="margin-top:-90px; margin-left: 0px">
        <thead>
            <tr style="padding:0;">
                <th style="padding:0;" colspan="2">Message: <span style="font-weight:normal; font-size: 0.9em;">{{ $contribution->message }}</span> </th>               

        </thead>
       
    </table>

</div>
</div>
</div>
</div>
   

<style>
    body {
        background: #eaeaea;
    }


    .profile-info-list {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    .friend-list,
    .img-grid-list {
        margin: -1px;
        list-style-type: none;
    }

    .profile-info-list>li.title {
        font-size: 0.625rem;
        font-weight: 700;
        color: #8a8a8f;
        padding: 0 0 0.3125rem;
    }

    .profile-info-list>li+li.title {
        padding-top: 1.5625rem;
    }

    .profile-info-list>li {
        padding: 0.625rem 0;
    }

    .profile-info-list>li .field {
        font-weight: 700;
    }

    .profile-info-list>li .value {
        color: #666;

    }

    .profile-info-list>li.img-list a {
        display: inline-block;
    }

    .profile-header-name {
    text-align: center;
}

    .profile-info-list>li.img-list a img {
        max-width: 2.25rem;
        -webkit-border-radius: 2.5rem;
        -moz-border-radius: 2.5rem;
        border-radius: 2.5rem;
    }

    .coming-soon-cover img,
    .email-detail-attachment .email-attachment .document-file img,
    .email-sender-img img,
    .friend-list .friend-img img,
    .profile-header-img img {
        max-width: 100%;
    }

    .table.table-profile th {
        border: none;
        font-size: 25px;
        color: black;
        padding-bottom: 1rem;
        padding-top: 0;
    }

    .table.table-profile td {

        border-color: #c8c7cc;
        font-size: 12px;
        padding: 0 0 0 1rem;


    }

    .table.table-profile tbody+thead>tr>th {
        padding-top: 1.5625rem;

    }

    .table.table-profile .field {
        color: #666;
        font-weight: 600;
        width: 25%;
        text-align: right;

    }

    .table.table-profile .value {
        font-weight: 500;
    }

    .profile-header {
        position: relative;
        overflow: hidden;
    }

    .profile-header .profile-header-cover {
        background: url(https://www.digitalacademy.fr/wp-content/uploads/2021/10/loei-thailand-may-10-2017-hand-holding-samsung-s8-with-mobi-1230x310.jpg) center no-repeat;
        background-size: 100% auto;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    .profile-header .profile-header-cover:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0, rgba(0, 0, 0, 0.85) 100%);
    }

    .profile-header .profile-header-content,
    .profile-header .profile-header-tab,
    .profile-header-img,
    body .fc-icon {
        position: relative;
    }

    .profile-header .profile-header-tab {
        background: #fff;
        list-style-type: none;
        margin: -1.25rem 0 0;
        padding: 0 0 0 8.75rem;
        border-bottom: 1px solid #c8c7cc;
        white-space: nowrap;
    }

    .profile-header .profile-header-tab>li {
        display: inline-block;
        margin: 0;
    }

    .profile-header .profile-header-tab>li>a {
        display: block;
        color: #000;
        line-height: 1.25rem;
        padding: 0.625rem 1.25rem;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.75rem;
        border: none;
    }

    .profile-header .profile-header-tab>li.active>a,
    .profile-header .profile-header-tab>li>a.active {
        color: #007aff;
    }

    .profile-header .profile-header-content:after,
    .profile-header .profile-header-content:before {
        content: "";
        display: table;
        clear: both;
    }

    .profile-header .profile-header-content {
        color: #fff;
        padding: 1.25rem;
    }

    body .fc th a,
    body .fc-ltr .fc-basic-view .fc-day-top .fc-day-number,
    body .fc-widget-header a {
        color: #000;
    }

    .profile-header-img {
        float: left;
        width: 7.5rem;
        height: 7.5rem;
        overflow: hidden;
        z-index: 10;
        margin: 0 1.25rem -1.25rem 0;
        padding: 0.1875rem;
        -webkit-border-radius: 0.25rem;
        -moz-border-radius: 0.25rem;
        border-radius: 0.25rem;
        background: #fff;
    }

    .profile-header-info h4 {
        font-weight: 500;
        margin-bottom: 0.3125rem;
    }

    .profile-container {
        padding: 1.5625rem;
    }

    @media (max-width: 967px) {
        .profile-header-img {
            width: 5.625rem;
            height: 5.625rem;
            margin: 0;
        }

        .profile-header-info {
            margin-left: 6.5625rem;
            padding-bottom: 0.9375rem;
        }

        .profile-header .profile-header-tab {
            padding-left: 0;
        }
    }


    .table.table-profile td {
        border: none;

    }

    .table.table-profile tbody+thead>tr>th {
        padding-top: 1rem;
    }

    .table.table-profile .field {
        color: #666;
        font-weight: 600;
        width: 30%;
        text-align: left;
    }

    .table.table-profile .value {
        font-weight: 250;

    }

 

    #pageSubmenu10 {
        visibility: visible;
        display: block;
    }

    #pageSubmenu17 {
        visibility: visible;
        display: block;
    }

    #pageSubmenu18 {
        visibility: visible;
        display: block;
    }

    #M52 {
        background-color: #747474;
    }
</style>



@endsection
