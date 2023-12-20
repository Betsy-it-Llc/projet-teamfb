@extends('layouts.navadmin')
@section('content')
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
    <div class="login-popup">
        <div class="form-popup" id="popupFormModif" style="background-color:#DEDEDE;width:35%;height:45%;border-radius:10px">
            <form action="{{ route('codespromo.update') }}" method="post" class="form-container">
                @csrf
                @method('put')
                <input type="hidden" id="codepromo" name="codepromo" value="{{ $code->id_code }}">
                <h2 style="margin:30px">Modification Code Promo</h2>
                <div class="form-contact" style="margin-bottom:20px">
                    <div style="float:left;margin-left:30px;margin-bottom:30px;width:120%">
                        <a href="">
                            <div
                                style="margin-bottom:20px;border:4px solid black;background-color:#888888;width:50px;height:26px;float:left;border-radius:25px;">
                                <div style="border:10px solid black;width:22px;height:12px;float:right ;border-radius:5px;">
                                </div>
                        </a>
                    </div>
                    <b style="float:left;font-size:1.7em">{{ $remise->statut}}</b>
                </div>
        </div>
        <div class="form-contact" style="margin-bottom:20px;">
            <select name="id_remise" id="pet-select"
                style="margin-left:100px;background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                @foreach ($remises as $rem)
                    @if ($code->id_remise == $rem->id_remise)
                        <option value="{{ $rem->id_remise }}"{{old('id_remise') == $rem->id_remise ? "selected" : ""}}> {{ $rem->id_remise }} - {{ $rem->nom_remise }}
                        </option>
                    @else
                        <option value="{{ $rem->id_remise }}"{{old('id_remise') == $rem->id_remise ? "selected" : ""}}> {{ $rem->id_remise }} - {{ $rem->nom_remise }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-contact" style="margin-top:20px;">
            <input type="text" name="code" class="form-control" placeholder="Code"
                value="{{old('code') ?? $code->code }}"style="width:385px;margin-left:100px;border:2px #888888  solid">
        </div>
        <div class="form-contact" style="margin-top:20px;">
            <input type="text" name="nb_utilisation" class="form-control" placeholder="Nb d'utilisation"
                value="{{old('nb_utilisation') ?? $code->nb_utilisation }}" style="width:385px;margin-left:100px;border:2px #888888  solid">
        </div>
        <button type="submit" class="btn" style="margin-top:20px;margin-right:20px;border-color:black">Modifier</button>
        <button type="button" class="btn cancel" onclick="closeFormModif()"
            style="border-color:black;margin-top:20px;margin-right:20px">Annuler</button>
        </form>
    </div>
    </div>
    <div class="container" style="margin:0">
        
        <center>
            <b style="margin-bottom :20px;font-size:2.5rem;">Info Code Promo</b>
        </center>

        <div class="profile-header" style="margin-top:60px">
            <div style="float:left;width:19%;text-align:left;font-size:1.5em;">
                <b> Id Code :</b> {{ $code->id_code }} <br>
                <b> Code :</b> {{ $code->code }} 
            </div>
            <form method="post">
                @csrf
                @method('DELETE')
                <div style="float:left;"><a style="float:left;background: none ; border : none;margin-left:10px"
                        class="btn btn-primary" href="javascript:openFormModif()"><i style="color : green;"
                            class="fas fa-edit fa-lg"></i></a>
                    <button formaction="{{ route('codespromo.destroy', ['id_remise' => $code->id_code]) }}"
                        style="background:none;float:left ; border : none;" type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete ?')"><i style="color : red"
                            class="fas fa-trash fa-lg"></i></button>
                </div>
            </form>
        </div>
            <!-- <div>
                <a href="">
                    <div style="border:4px solid black;background-color:#888888;width:50px;height:26px;float:left ;border-radius:25px;">
                        <div style="border:10px solid black;width:22px;height:12px;float:right ;border-radius:5px;"></div>
                    </div>
                </a> -->
        
        <!-- <div style="padding:0 62rem 0 0;width:40%;position:start;"><b
                style="font-size:1.5em;color:#333333">Remise : {{ $remise->statut }}</b>
        </div> -->
        <!-- ------------le statut pack ------------------------ -->
        <!-- laisser ca pour l'&ffichage du switch -->
        <div  id="id_statut" style="border:4px solid black;background-color:#888888;width:50px;height:26px;float:left ;border-radius:25px; cursor:pointer;">
        </div>
        <div style="padding:0 62rem 0 0;width:40%;position:start;"><b style="font-size:1.5em;color:#333333">{{ $code->statut_code }}</b></div>
        <!-- ------------le statut pack ------------------------ -->
    </div>


    <div class="profile-container">
        <div class="row row-space-20">
            <div class="col-md-4 hidden-xs hidden-sm" style="width-max:55%">
                <div class="tab-content p-0">
                    <div class="tab-pane active show" id="profile-about">
                        <table style="margin-bottom:-50px;width:150%;margin-top:3px">
                            <tr style="font-size:1.5em">

                                <td><b style="margin-left:25px">Début :</b></td>
                                <td style="margin-right:15px">{{ Carbon\Carbon::parse($remise->date_debut )->format('Y m d')}}</td>
                                <td><b> Expiré le :</b></td>
                                <td style="margin-right:15px">{{ Carbon\Carbon::parse($remise->date_fin )->format('Y m d')}}</td>
                            </tr>
                        </table>
                        @isset($image_de_promo)
                                <table style=";margin-bottom:30px;margin-top:50px;border-radius:5px;background-image:url({{$image_de_promo}});background-position: center;background-repeat:no-repeat;background-size: contain;width:150%;height:285px">
                            @else
                                <table style=";margin-bottom:30px;margin-top:50px;border-radius:5px;background-image:url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShGtGviR-60uvC3U4Es9qCQGOkjpLp9o-Ow3EV8cYDNtMrnlYr8TYZGCUhIA5HcDn6pAU&usqp=CAU);background-position:center;background-repeat:no-repeat;background-size: contain;width:150%;height:285px">
                            @endisset
                            
                                </table>
                                <form class="my-2" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="image_promo">Selectionnez une image :</label>
                                    <input type="file" id="image_promo" name="image_promo">
                                    <br>
                                    <button class="btn btn-primary my-3">Envoyer</button>
                                    <button name="delete_image" class="btn btn-danger my-3 mx-1">Supprimer l'image</button>
                                </form>
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session('success_image'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success_image') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                        <table style="width: 150%;">
                            <thead>
                                <tr>
                                    <th colspan="2" style="padding:0 0 1rem 0"><b style="font-size:2.5em;color:#333333">Description
                                        <div onclick="openModif()" style="background: none ; border : none;margin-left:10px" class="btn btn-primary" data-csrf-token="{{ csrf_token() }}">
                                                <i style="color : green;" class="fas fa-edit fa-lg"></i>
                                        </div>
                                    </th>
                                </tr>

                            </thead>
                            <tbody>

                                <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                    <td style="text-align: justify;padding:0.5rem">
                                    {{ $code->description }}
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-4 hidden-xs hidden-sm" style="width-max:20%">
                <div class="tab-content p-0">
                    <div class="tab-pane active show" id="profile-about">
                        <table style="margin-left:160px;width:90%">
                            <thead>
                                    <th colspan="2" style="padding:0 0 0.6rem 0;"><b
                                            style="font-size:2.5em;color:#333333">Info Remise</th>
                            </thead>

                            <tbody>

                                <tr>
                                    <td><b style="font-size:1.2em;padding:0 1rem 0 0">Type :
                                        </b>{{ $remise->type_remise }}</td>
                                </tr>
                                <tr>
                                    <td><b style="font-size:1.2em;padding:0 1rem 0 0">Taux : </b>{{ $remise->taux }}%</td>
                                </tr>
                                <tr>

                                    <td><b style="font-size:1.2em;padding:0 1rem 0 0">Montant : </b>{{ $remise->montant }}
                                        €</td>

                                </tr>
                                <tr>

                                    <td><b style="font-size:1.2em;padding:0 1rem 0 0">Nombre : </b>{{ $remise->nb_codes }}
                                        Codes</td>

                                </tr>
                                <tr>

                                    <td><b style="font-size:1.2em;padding:0 1rem 0 0">Statut : </b>{{ $remise->statut }}
                                    </td>

                                </tr>

                                <tr>

                                    <td><b style="font-size:1.2em;padding:0 1rem 0 0">Lien : </b><a
                                            href="/remises.show/{{ $remise->id_remise }}"><b style="color:red">GO</b></a>
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>
                </div>
                <br>
            </div><!-- /.modal -->
            <div class="col-md-4 ">
                <div class="tab-content p-0">
                    <div class="tab-pane active show" id="profile-about" style="width:100%">
                        <table style="margin-left:25px;width:140%">
                            <thead>
                                <tr>
                                    <th colspan="2" style="padding:0 0 0 5rem;"><b
                                            style="font-size:2.5em;color:#333333;">Articles Concernées</th>
                                    <th> <a class="btn btn-success" href="#"
                                            style="background-color:#888888;color:black;width: 60px;padding:0.3rem;font-size:0.9em;text-align: center;border:1px solid black"><b>Ajouter</b></a>
                                    </th>
                                </tr>
                            </thead>
                        </table>

                        <table style="margin-left:30px;margin-bottom:90px;margin-top:10px;width:140%;font-size:1.2em">
                            <tbody>
                                <tr>
                                    <td><b style="margin-right:30px">Id</b></td>
                                    <td><b style="margin-right:30px">Nom</b></td>
                                    <td><b style="margin-right:30px">Montant</b></td>
                                    <td><b style="margin-right:30px">Taux</b></td>
                                    <td><b style="margin-right:30px"></b></td>
                                </tr>
                                @foreach ($packsremise as $pack)
                                    <tr>
                                        <td>{{ $pack->id_pack }}</td>
                                        <td>{{ $pack->nom }}</td>
                                        <td>
                                            @if($pack->montant)
                                            {{ $pack->montant }} €
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($pack->taux)
                                            {{$pack->taux}} %
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td><a href="{{ route('packs.show', ['id_pack' => $pack->id_pack]) }}"><b
                                                    style="color:red">GO</b></a></td>
                                    </tr>
                                @endforeach
                                @foreach ($produitsremise as $prod)
                                    <tr>
                                        <td>{{ $prod->id_produit }}</td>
                                        <td>{{ $prod->nom_produit }}</td>
                                        <td>
                                            @if($prod->montant)
                                            {{ $prod->montant }} €
                                            @else 
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($prod->taux)
                                            {{$prod->taux}} %</td>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td><a href="/produitservice.show/{{ $prod->id_produit }}"><b
                                                    style="color:red">GO</b></a></td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                        <div>
                            
                        <table style="text-align:center;margin-left:-280px;margin-top:10px;width:220%;font-size:1.2em">
                            <tbody>
                                
                                <tr>
                                    <thead>
                                        <tr style="">
                                            <th colspan="2" style="padding:0 0 0 12rem;"><b
                                                    style="font-size:2em;color:#333333;">Historique</th>
        
                                        </tr>
                                    </thead>
                                    <td><b>Id facture</b></td>
                                    <td><b>Nom</b></td>
                                    <td><b>Prénom</b></td>
                                    <td><b>Date d'enregistrement</b></td>
                                    <td><b></b></td>
                                </tr>
                                @foreach ($beneficiaires as $b)
                                <tr>
                                    <td style="padding:0 3rem 0 0">{{ $b->num_facture }}</td>
                                    <td>{{ $b->nom }}</td>
                                    <td>{{ $b->prenom }}</td>
                                    
                                    <td>{{ Carbon\Carbon::parse($b->date_creation )->format('Y m d')}}</td>
                                    <td><a href="/contacts.show/{{ $b->id_contact }}"><b>GO</b></a></td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        
                    </div>

                    <div>
                        <table style="text-align:center;margin-left:-280px;margin-top:10px;width:220%;font-size:1.2em">
                            <th colspan="2" style="padding:0 0 0 12rem;"><b style="font-size:2em;color:#333333;">Code promos</th>
                            <thead>
                                <tr>
                                    <th><b>Contact id</b></th>
                                    <th><b>Contact</b></th>
                                    <th><b>Utilisations</b></th>
                                    <th><b>Statut</b></th>
                                    <th><b>Date</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact as $c)
                                    <tr>
                                        <td>{{ $c->id_contact }}</td>
                                        <td>{{ $c->nom }}</td>
                                        <td>{{ $c->prenom }}</td>
                                        <td>{{ $c->statut_code }}</td>
                                        <td>{{ Carbon\Carbon::parse($c->date_creation )->format('d/m/Y')}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        
                    </div>
                    <br>
                </div><!-- /.modal -->
            </div>
        </div>
    </div>
    </div>


    </div>

    </div>

    <script>
 document.addEventListener('DOMContentLoaded', function() {
        id_produit = "{{ $code->id_code }}";
        affiche_statut(id_produit);
    });
    function affiche_statut(id_produit){
        let statut_change_to = '';
        let statut_css = '';
        var parentElement = document.getElementById('id_statut');

        // Créer un nouvel élément div
        var divElement = document.createElement('div');
        divElement.style.border = '10px solid black';
        divElement.style.width = '22px';
        divElement.style.height = '12px';
        divElement.style.borderRadius = '5px';

        // Vérifier la condition
        if ("{{ $code->statut_code }}" === 'actif') {
            divElement.style.float = 'right';
            statut_change_to = 'inactif';
            statut_css = 'left';
        } else {
            divElement.style.float = 'left';
            statut_change_to = 'actif';
            statut_css = 'right';
        }

        // Ajouter la div à l'élément parent
        parentElement.appendChild(divElement);

        //  lors du click sur la div changer de statut
        parentElement.onclick = function (){
            $.ajax({
                url: '/codespromo.change_statut/' + id_produit +'/'+ statut_change_to,
                method: 'GET',
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    // Gérer les erreurs
                }
            });
        }
    }


</script> 
<!-- -----------popupFormModif------------ -->
    <script>
        function openFormModif() {
            document.getElementById("popupFormModif").style.display = "block";
        }

        function closeFormModif() {
            document.getElementById("popupFormModif").style.display = "none";
        }
    </script>
<!-- -----------popupFormModif------------ -->
<script>
    function openModif() {
        document.getElementById("div_card").style.display = "block";
    }

    function closeModif() {
        document.getElementById("div_card").style.display = "none";
    }
</script>
<div class="my-card" id="div_card">
    <form action="{{ route('codespromo.modif_descrip') }}" method="POST" class="my-form">
        @csrf
        <h4 class="my_heading">Modification de description</h4>
        <input type="hidden" id="id_remise" name="id_remise" value="{{ $code->id_code }}"> 
        <textarea class="form-control my-textarea" name="description" id="description" cols="30" rows="5"> {{ $code->description }} </textarea>
        <div class="div_boutons">
            <button class="btn btn-info my-button" type="submit">Modifier</button>
            <div onclick="closeModif()" class="btn btn-danger my-button">Annuler</div>
        </div>
    </form>
</div>

    <STYLE>
        .open-btn {
            display: flex;
            justify-content: flex-start;
        }

        /* Stylez et fixez le bouton sur la page */
        .open-button {
            background-color: #888888;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            opacity: 0.8;
        }

        /* Positionnez la forme Popup */
        .login-popup {
            position: center;
            text-align: center;
            z-index: 1;
            width: 80%;
        }

        /* Masquez la forme Popup */
        .form-popup {
            display: none;
            position: fixed;
            left: 55%;
            top: 25%;
            transform: translate(-45%, 5%);

        }

        /* Styles pour le conteneur de la forme */
        .form-container {
            width: 650px;
            padding: 20px;
            background-color: #DEDEDE;
            border-radius: 10px;
        }

        /* Largeur complète pour les champs de saisie */
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 22px 0;
            border: none;
            background: #eee;
        }

        /* Quand les entrées sont concentrées, faites quelque chose */
        .form-container input[type="text"]:focus,
        .form-container input[type="password"]:focus {
            background-color: #ddd;
        }

        /* Stylez le bouton de connexion */
        .form-container .btn {
            background-color: #4968e5;
            color: #fff;
            padding: ;
            border: none;
            cursor: pointer;
            width: 30%;
            margin-bottom: 0px;
            opacity: 0.8;
        }

        /* Stylez le bouton pour annuler */
        .form-container .cancel {
            background-color: #cc0000;
        }

        /* Planez les effets pour les boutons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }

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

            border-color: red;
            font-size: 12px;
            padding: 0 0 0 1rem;


        }

        .table.table-profile tbody+thead>tr>th {
            padding-top: 1.5625rem;
            border: none;

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
#pageSubmenu10{
    visibility:visible;
    display:block;
}
#pageSubmenu16{
    visibility:visible;
    display:block;
}
#pageSubmenu18{
    visibility:visible;
    display:block;
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

        #pageSubmenu16 {
            visibility: visible;
            display: block;
        }

        #M99 {
            background-color: #747474;
        }


        /* ---------------------------------- */
#div_card{
    display: none;
}
.my-card {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    width: 500px;
    background-color: #DEDEDE;
    padding: 30px;
}
.div_boutons{
    display:flex;
    justify-content: space-around;
    margin-top: 10px;
}
.my-heading{
    text-align: center;
    padding: 10px;
}
    </style>
@endsection
