@extends('layouts.navadmin')
@section('content')

<head>
    <title>Cagnotte Experience </title>
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
    <div id="content" class="content p-0" style="min-height: 30vh;">
        <div class="profile-header">
            <center>
                <b style="margin-bottom :20px;font-size:2.5rem;">Info Cagnotte</b>
            </center>

        </div>
        <br>
        
    <td>
        <div class="profile-container">
            <b style="font-size:2.3em;">{{$cagnotte->titre}}</b>
            <table>
                <tr>
                    <td style="text-align:left;width:40%"><b>Catégorie:</b></td>
                    <td style="text-align:center">{{$cagnotte->categorie->nom}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;width:40%"><b>Type:</b></td>
                    <td style="text-align:center">{{$cagnotte->projet->types_Projet->valeur}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;width:40%"><b>Montant Cible:</b></td>
                    <td style="text-align:center">{{$cagnotte->projet->objectif_financier}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;width:40%"><b>Début:</b></td>
                    <td style="text-align:center">{{ date('Y-m-d', strtotime($cagnotte->projet->date_creation)) }}</td>
                </tr>
                <tr>
                    <td style="text-align:left;width:40%"><b>Fin:</b></td>
                    <td style="text-align:center">
                        @if (!empty($cagnotte->projet->date_fin) && $cagnotte->projet->date_fin != '0000-00-00')
                            {{ date('Y-m-d', strtotime($cagnotte->projet->date_fin)) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        


    <!-- --------------------- Type et Description------------------- -->
    <td>
        <div class="profile-header-name;" style= "margin-left: 400px; margin-top:-165px">
            <table>
                
                
                <tr>
                    <td style="text-align:left;width:40%"><b style="font-size:2.3em;">Type: <span style="font-weight:normal; font-size: 0.9em;">{{$cagnotte->projet->types_Projet->valeur}}</span> </b></td>

                </tr>
                <td style="text-align: left; width: 40%; word-wrap: break-word; max-width: 160px; ">
                    <b style="font-size: 2.3em; margin-bottom: 10px;">Description: </b>
                    <span style="font-weight: normal; font-size: 1.2em; display: inline-block; max-width: 100%;">
                        {{$cagnotte->projet->description_courte}}
                    </span>
                </td>
                
            </table>
    </td>
    </table>
</div>

</table>

<!-- ---------------------  solde ------------------- -->
<td>
    <div class="profile-header-name;" style= "margin-left: 150px; margin-top: -130px ">
        <table>
            
            
            <tr>
                <td style="text-align:right;width:40%"><b style="font-size:2.3em;">Solde: <span style="font-weight:normal; font-size: 0.9em;">{{$cagnotte->montant_actuel}} euros</span> </b></td>

            </tr>
        </table>
</td>
</table>
</div>

</table>

<!-- ---------------------  Paiement ------------------- -->
<td>
    <div class="profile-header-name;" style= "margin-left: 900px; margin-top: 25spx">
        <table>
            
            
            <tr>
                <td style="text-align:left;width:40%"><b style="font-size:2.3em;">Paiement </b></td>

            </tr>
            <tr>
                <td style="text-align:left;width:40%"><b>Global: </b></td>
                <td style="text-align:left">xxxx xxxx</td>

            </tr>
            <tr>
                <td style="text-align:left;width:40%"><b>Frais :</b></td>
        
                    <td style="text-align:left">xxxx xxxx
              
            </tr>
            <tr>
                <td style="text-align:left;width:40%"><b>Marge : </b></td>
                <td style="text-align:left">xxxx xxxx</td>
            </tr>
            <tr>
                <td style="text-align:left;width:40%"><b>Restitution: </b></td>
                <td style="text-align:left">xxxx xxxx</td>
            </tr>
            <tr>
                <td style="text-align:left;width:40%"><b>Avoir : </b></td>
                <td style="text-align:left">xxxx xxxx</td>
            </tr>
            
        </table>
</td>
</table>
</div>
</div>

<!-- --------------------- Info Responsable ------------------- -->
<div class="profile-container">
    <div class="row row-space-20">

        <div class="col-md-4 hidden-xs hidden-sm" style="max-width:25%">
            <div class="tab-content p-0">
                <div class="tab-pane active show" id="profile-about">
                    <table class="table table-profile">
                        <thead>
                            <tr style="padding:0;">
                                <th style="padding:0;" colspan="2">Info Responsable </th>
                            </tr>
                            <tr style="font-size:1rem;">
                                <td style="padding:0 0 0.5rem 0;"><b> Id : {{ $cagnotte->contacts->first()->id_contact }}</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="field">Nom </td>
                                <td class="value">
                                    {{ $cagnotte->contacts->first()->nom }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Prenom </td>
                                <td class="value">
                                    {{ $cagnotte->contacts->first()->prenom }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Email</td>
                                <td class="value">
                                    {{ $cagnotte->contacts->first()->email }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Tel </td>
                                <td class="value">
                                    {{ $cagnotte->contacts->first()->tel }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Adresse </td>
                                <td class="value">
                                    {{ $cagnotte->contacts->first()->adresse }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Code Postale </td>
                                <td class="value">
                                    {{ $cagnotte->contacts->first()->code_postal}}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Ville  </td>
                                <td class="value">
                                    {{ $cagnotte->contacts->first()->ville }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field" style="width:50%">Organisation  </td>
                                <td class="value">
                                   
                                </td>
                            </tr>


                        </tbody>
                    </table>

<!-- --------------------- Contributions ------------------- -->
                     <table class="table table-profile" style="margin-top:30px;">
                        <thead>
                            <tr style="padding:0;">
                                <th style="padding:0;" colspan="2">Contribution </th>
                            </tr>


                        </thead>
                    </table>
                    <table style="margin-top:30px;margin-left:0px;width:90%">
                        <tbody>
                            @foreach ($cagnotte->contributions as $contribution)
                                
                            <tr>
                                <td><b style="margin-right:0px">Date :</b></td>
                                <td style="margin-right:20px">{{ $contribution->getDateContributionFormatted() }}</td>
                            </tr>
                            @endforeach


                        </tbody>

                    </table>

                </div>
            </div>
        </div>     


        
<!-- --------------------- Contribution------------------- -->
        <div class="col-md-4 " style="max-width:60%">
            <div class="tab-content p-0">
                <div class="tab-pane active show" id="profile-about" style="margin-left:75px;">
                    <table class="table table-profile">
                        <thead>
                            <tr style="padding:0;">
                                <th style="padding:0 0 0 0;" colspan="2">Contribution et Experience</th>
                            </tr>

                        </thead>
                    </table>

                    <table style="width: 150%;margin-left:0;">
                        <tbody>
                            
                            <tr>
                                <td><b style="margin-right:20px">id Contributeur</b></td>
                                <td><b style="margin-right:20px">Contributeur</b></td>
                                <td><b style="margin-right:20px">Exp</b></td>
                                <td><b style="margin-right:20px">Lien</b></td>
                                <td><b style="margin-right:20px">Montant</b></td>
                                <td><b style="margin-right:20px">Date</b></td>
                                <td><b style="">Strip</b></td>
                            </tr>
                            @foreach ($cagnotte->contributions as $contribution)
                            <tr>
                                <td>{{ $contribution->contact->id_contact }}</td>
                                <td>{{ $contribution->contact->nom }} {{ $contribution->contact->prenom }}</td>
                                <td>{{ $contribution->cagnotte->experience->nom_experience }}</td>
                                <td><b style="color:red"><a
                                    href="#">GO</a></b>
                                </td>  
                                <td>{{ $contribution->montant }}</td> 
                                <td>{{ $contribution->getDateContributionFormatted() }}</td>
                                <td><b style="color:red"><a
                                    href="#">GO</a></b>
                            </td>   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
            
                    
<!-- --------------------- Evenements ------------------- -->
        
                    <table class="table table-profile"style="margin-top:-90px; margin-left: 600px">
                        <thead>
                            <tr style="padding:0;">
                                <th style="padding:0;" colspan="2">Evenements </th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td>

                                    <div class="history-tl-container" style="line-height:1.5em; min-width:920px; ">

                                        <ul class="tl">

                                           
                                            <li class="tl-item" ng-repeat="item in retailer_history"
                                                style="padding:0 0 3rem 2rem">
                                                <div class="timestamp"
                                                    style="padding:0 3rem 0 0;font-size:1em;color:#333333; width:130px;">
                                                    Commentaire <br>
                                                    Like <br>
                                                    Partage <br>
                                                </div>
                                                <div class="item-title"
                                                    style="padding:0 3rem 0 0;font-size:0.7em;color:#333333;width:200px">
                                                    <b>10 <br>
                                                        10 <br>
                                                        10 <br>
                                                    </div>

                                            </li>

                                        </ul>


                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </div>
            
    <!-- --------------------- Commenatire ------------------- -->
    <form method="post">
        @csrf
        @method('DELETE')
    <table class="table table-profile"style="margin-top:-160px; margin-left:300px">
        <thead>
            <tr style="padding:0;">
                <th style="padding:0;" colspan="2">Commentaires </th>
            </tr>
            <tbody>
                <tr>
                    <td>
            
                        <div class="history-tl-container" style="line-height:1.5em; min-width:920px; ">
                          
                          
                                <tr style="border-radius:10px;margin-bottom:10px">
                                    <td style="text-align: justify;padding:0.5rem">
                                        <b >date</b>
                                        <i style="cursor:pointer; margin-left: 10px; color : #e6ac00" onclick="openUpdateDescripton()" class="fas fa-edit"></i>
                                         <form action="/reservationclient.destroyinteraction/" method="POST" style="display: inline;">
                                 @csrf
                                     @method('DELETE')
                                    <button style="background-color : #FAFAFA ; border : #fff; font-size:0.85rem; margin-left:0px"
                                        type="submit" class="btn btn-danger"
                                            onclick="return confirm('Vous êtes sûrs de vouloir supprimer cette intéraction ?')">
                                        <i style="color : #cc3300" class="fas fa-trash"></i>
                                     </button>
                                </form>
                                    <br>texte
                                    </td>
                                </tr>
                                                    
                        </div>
                    </td>
                </tr>
            </tbody>
                                  
    </table>
    </div>
</div>
</form>
   




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

    @media (max-width: 767px) {
        .profile-header .profile-header-cover {
            background-position: top;
        }

        .profile-header-img {
            width: 3.75rem;
            height: 3.75rem;
            margin: 0;
        }

        .profile-header-info {
            margin-left: 4.6875rem;
            padding-bottom: 0.9375rem;
        }

        .profile-header-info h4 {
            margin: 0 0 0.3125rem;
        }

        .profile-header .profile-header-tab {
            white-space: nowrap;
            overflow: scroll;
            padding: 0;
        }

        .profile-container {
            padding: 0.9375rem 0.9375rem 3.6875rem;
        }

        .friend-list>li {
            float: none;
            width: auto;
        }
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
        padding-top: 1rem;
    }

    .profile-info-list>li {
        padding: 0.6rem 0;
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

    .friend-list {
        padding: 0;
    }

    .friend-list>li {
        float: left;
        width: 40%;
    }

    .friend-list>li>a {
        display: block;
        text-decoration: none;
        color: #000;
        padding: 0.625rem;
        margin: 1px;
        background: #fff;
    }

    .friend-list>li>a:after,
    .friend-list>li>a:before {
        content: "";
        display: table;
        clear: both;
    }

    .friend-list .friend-img {
        float: left;
        width: 3rem;
        height: 3rem;
        overflow: hidden;
        background: #efeff4;
    }

    .friend-list .friend-info {
        margin-left: 3.625rem;
    }

    .friend-list .friend-info h4 {
        margin: 0.3125rem 0;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .friend-list .friend-info p {
        color: #666;
        margin: 0;
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

<style>
   

    .timeline {
        border-left: 1px solid hsl(0, 0%, 90%);
        position: relative;
        list-style: none;
    }

    .timeline .timeline-item {
        position: relative;
    }

    .timeline .timeline-item:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline .timeline-item:after {
        background-color: hsl(0, 0%, 90%);
        left: -38px;
        border-radius: 50%;
        height: 11px;
        width: 11px;
        content: "";
    }

    .history-tl-container ul.tl {

        padding: 0.5rem;
        display: inline-block;

    }

    .history-tl-container ul.tl li {
        list-style: none;

        margin-left: 120px;

        /*background: rgba(255,255,0,0.1);*/
        border-left: 3px solid black;
        padding: 10px 0 50px 30px;
        position: relative;
    }

    .history-tl-container ul.tl li:last-child {
        border-left: 0;
    }

    .history-tl-container ul.tl li::before {
        position: absolute;
        left: -11px;
        top: -5px;
        content: " ";
        border: 8px solid rgba(255, 255, 255, 0.74);
        border-radius: 1000%;
        background: blue;
        height: 20px;
        width: 20px;


    }

    .history-tl-container ul.tl li:hover::before {
        border-color: #258CC7;

    }

    ul.tl li .item-title {}

    ul.tl li .item-detail {
        color: rgba(0, 0, 0, 0.5);
        font-size: 12px;
    }

    ul.tl li .timestamp {
        color: #8D8D8D;
        position: absolute;
        width: 100px;
        left: -50%;
        text-align: right;
        font-size: 12px;
    }

    #dash {

        font-size: 0.9em;

        text-align: center;

    }

 
    ul.tl li .item-title {}

    ul.tl li .item-detail {
        color: rgba(0, 0, 0, 0.5);
        font-size: 12px;
    }

    ul.tl li .timestamp {
        color: #8D8D8D;
        position: absolute;
        width: 100px;
        left: -50%;
        text-align: right;
        font-size: 12px;
    }
</style>

@endsection
