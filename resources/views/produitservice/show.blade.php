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
<head>
<title>{{ $dbs[0]->nom_produit }} </title>
<link rel="shortcut icon" href="https://www.mesfairepart.com/66011-large_default/faire-part-mariage-original-disque-style-vinyle-belarto-yes-we-do-728018.jpg" />
</head>
<div id="affichage_droite" class="container">
        <center>
            <b style="margin-bottom :20px;font-size:2.5rem;">Info Produits & Services</b>
        </center>

        <!-- ------------------statut -------------------- -->
        <div class="profile-header" >
            <!-- laisser ca pour l'&ffichage du switch -->
            <div  id="id_statut" style="border:4px solid black;background-color:#888888;width:70px;height:26px;float:left ;border-radius:25px; cursor:pointer;">
            </div>
            <div style="padding:0 62rem 0 0;width:40%;position:start;"><b style="font-size:1.5em;color:#333333">{{$dbs[0]->statut}}</b></div>
        </div>
        <!-- --------------- statut --------------- -->
        <form method="post">
            @csrf
            @method('DELETE')
            <div style="margin-left:0px; ">
                <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                            href="{{ route('produitservice.edit', $dbs[0]->id_produit) }}">
                            <i style="color : green;"     class="fas fa-edit fa-lg"></i>
                </a>
                <button formaction="{{ route('produitservice.destroy', $dbs[0]->id_produit) }}"
                    style="background:none ; border : none;" type="submit" class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete ?')">
                    <i style="color : red" class="fas fa-trash fa-lg"></i>
                </button>
                <!-- -------------btn prix------------- -->
                <div class="btn btn-light" onclick="liste_prix()"> Liste prix </div>
                <div class="btn btn-light" onclick="new_prix()"> Ajout nouveau prix </div>
                <form method="post" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button formaction="{{ route('produitservice.archiver', $dbs[0]->id_produit) }}" class="btn btn-secondary" type="submit"
                        onclick="return confirm('Are you sure you want to archive this product?')">
                        Archiver
                    </button>
                </form>
                <!-- -------------btn prix------------- -->
            </div>  
        </form>

        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                            @isset($image_du_produit)
                                <table style="background-image:url({{$image_du_produit}});background-position: start;background-repeat:no-repeat;background-size: contain;width:100%;height:300px ">
                            @else
                                <table style="background-image:url(https://cdn.pixabay.com/photo/2012/04/10/23/44/question-27106_640.png);background-position: start;background-repeat:no-repeat;background-size: contain;width:100%;height:300px ">
                            @endisset
                            
                                </table>
                                <form class="my-2" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="image_produit">Selectionnez une image :</label>
                                    <input type="file" id="image_produit" name="image_produit">
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
                                @if(session('success_image_delete'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success_image_delete') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <table style="background-image:url(https://lvshopping.fr/wp-content/uploads/2020/10/decoration-murale-horloge-ou-miroir-vintage-disque-vinyle-decoupe-33T-100-fait-main-modele-plongee-plongeur-marine-sport.png);background-position: start;background-repeat:no-repeat;background-size: contain;width:100%;height:300px ">
                                </table>
                                
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                        <table class="table table-profile">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;"  colspan="2"> Nom  {{$dbs[0]->categorie}} : {{$dbs[0]->nom_produit}}  </th>
                                    </tr>
                                    <tr style="font-size:1rem;">
                                       <td style="padding:0 0 0.5rem 0;"><b> Id : {{$dbs[0]->id_produit}} </b></td>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <tr>
                                        <td class="field">Nom: </td>
                                        <td class="value">
                                        {{$dbs[0]->nom_produit}}
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- @dd($defaultPrice) --}}
                                        <td class="field">Prix: </td>
                                        <td class="value">
                                        {{$defaultPrice->prix}}€
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="field" >Catégorie:</td>
                                        <td class="value" >
                                        {{$dbs[0]->categorie}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Statut Prix :</td>
                                        <td>{{$statutPrix->statut}}</td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    <table class="table table-profile">
                                    <tr>
                                        <td class="field"><b>Abstract: </b></td>
                                        
                                    </tr>
                                    <tr style="float:left ;border-radius:10px">
                                        <td style="text-align: justify;padding:0.5rem"> {{$dbs[0]->abstract}} </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="field"><b>Description {{$dbs[0]->categorie}} :</b></td>
                                        
                                    </tr>
                                    <tr style="float:left ;border-radius:10px">
                                        
                                        <td style="text-align: justify;padding:1rem"> <pre style="white-space: pre-line; text-align:left; margin:0; width: 100%; ">{{ $dbs[0]->description }}</pre></td>
                                    </tr>
                                
                                   
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <br>
                </div><!-- /.modal -->
                <div class="col-md-4 ">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                                                  
                            <table class="table table-profile" >
                                <tbody >
                                    
                               
                                    <tr>
                                        <td class="field" style="width:50%;margin-top:10px;padding:0.5rem 0 0 0">Date de création :</td>
                                        <td class="value" style="padding:0.5rem 0 0 0">
                                        {{ Carbon\Carbon::parse($dbs[0]->date_creation )->format('Y m d')}}</td>
                    
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="field" style="width:40%;padding: 0"> Stock :  </td>
                                        <td class="value">
                                            <b style="padding: 0; margin-left: -17px;">{{$dbs[0]->stock}} {{$dbs[0]->categorie}}</b>
                                            <i style="cursor:pointer; color: #e6ac00; margin-left: 10px;" onclick="openStockProduit({{ $dbs[0]->id_produit }}, '{{ $dbs[0]->stock }}')" class="fas fa-edit"></i>
                                        </td>
                                    <tr>
                                        <td class="field" style="padding: 0">Nombre d'achats :</td>
                                        <td class="value" style="padding: 0">
                                            @if($totalQuantite == 0)
                                            0
                                            @endif
                                         {{$totalQuantite}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="padding: 0">Total revenu :</td>
                                        <td class="value" style="padding: 0">
                                           
                                        {{$totalQuantite * $dbs[0]->prix}}€
                                                                           </td>
                                    </tr>
                                   
                                    
                                </tbody>
                                                                 
                            </table>
                            
                        
                    </div>
                    <br>
                </div><!-- /.modal -->
            </div>
        </div>
    </div>
</div>


</div>

</div>

{{-- @dd($allPrices) --}}
<div id="liste_prix" class="my_card" style="display:none">
    <form action="/produitservice.statutprix" method="POST">
        @csrf
        <h3 style="text-align:center; margin-bottom:15px">La liste des prix</h3>
        <input type="hidden" name="id_produit" value="{{ $dbs[0]->id_produit}}">
        <select name="allPricesId" id="allPrices"> 
            @foreach($allPrices as $prices)
            <option value="{{$prices->id_liste_prix}}">ID:{{$prices->id_liste_prix}} - Prix : {{$prices->prix}} - Statut : {{$prices->statut}}</option>
            @endforeach
        </select>
        <select name="statutPrix" id="statutPrix">
            <option value="actif">Actif</option>
            <option value="inactif">Inactif</option>
            <option value="Par Défaut">Par Défaut</option> 
        </select>
        <div class="mes_btn">
            <div class="btn btn-danger my-button" onclick="close_liste_prix()">Fermer</div>
            <button class="btn  btn-success" type="submit">Envoyer</button>
        </div>
        
        
    </form>
</div>
<div id="new_prix" class="my_card"  style="display:none;">
    <form action="/produitservice.addnewprice" method="POST" style="display: block;">
        @csrf
        <h3 style="text-align:center; margin-bottom:15px">Ajouter un nouveau prix</h3>
        <input type="hidden" name="id_produit" value="{{ $dbs[0]->id_produit }}">
        <input type="texte" name="nouveauPrix" placeholder="Nouveau Prix">
        <select name="statutPrix" id="statutPrix">
            <option value="actif">Actif</option>
            <option value="inactif">Inactif</option>
            <option value="Par Défaut">Par Défaut</option> 
        </select>
        <div class="mes_btn">
            <div class="btn btn-danger my-button" onclick="close_new_prix()">Fermer</div>
            <button class="btn btn-success" type="submit">Créer Nouveau Prix</button>
        </div>
    </form>
</div>

<!-- davy -->
<div class="my_card2" id="div_card" style="display:none">
    <form action="{{ route('produitservice.modif_stock') }}" method="POST" class="my-form">
        @csrf
        <h4 class="my_heading">Modification du stock</h4>
        <input type="hidden" id="id_produit" name="id_produit" value="{{ $dbs[0]->id_produit}}"> 
        <textarea class="form-control my-textarea" name="stock" id="stock" cols="30" rows="5"> {{ $dbs[0]->stock }} </textarea>
        <div class="div_boutons">
            <button class="btn btn-info my-button" type="submit">Modifier</button>
            <div onclick="closeStockProduit()" class="btn btn-danger my-button">Annuler</div>
        </div>
    </form>
</div>

<script>
    
        function openStockProduit(id_produit, stock) {
    if (document.getElementById("div_card").style.display === "none") {
        document.getElementById("id_produit").value = id_produit;
        document.getElementById("stock").value = stock;
        document.getElementById("div_card").style.display = "block";
    }
}

    function closeStockProduit() {
        document.getElementById("div_card").style.display = "none";
    }
</script>

<!-- --- -->
<script>
    function liste_prix(){
        var liste_prix = document.getElementById('liste_prix');
        liste_prix.style.display = "flex";
    }
    function close_liste_prix(){
        var liste_prix = document.getElementById('liste_prix');
        liste_prix.style.display = "none";
    }
    function new_prix(){
        var new_prix = document.getElementById('new_prix');
        new_prix.style.display = "flex";
    }
    function close_new_prix(){
        var new_prix = document.getElementById('new_prix');
        new_prix.style.display = "none";
    }
</script>
<style>
    .my_card {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width: 50%;
        height: 25vh;
        background-color: #DEDEDE;
        justify-content: center;
        align-items: center;
        border: 2px black solid;
        border-radius: 10px;
    }
    .mes_btn{
        margin-top: 25px;
        display: flex;
        justify-content: space-evenly;
    }
</style>

<!-- davy -->
<style>
    .my_card2 {
        position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    width: 500px;
    background-color: #DEDEDE;
    padding: 30px;
    }
    .mes_btn{
        margin-top: 25px;
        display: flex;
        justify-content: space-evenly;
    }
</style>
<!-- ---- -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        id_produit = "{{$dbs[0]->id_produit}}";
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
        if ("{{ $dbs[0]->statut }}" === 'actif') {
            divElement.style.float = 'right';
            statut_change_to = 'inactif';
            statut_css = 'left';
        }else if("{{$dbs[0]->statut}}"=== 'inactif') {
            divElement.style.float = 'left';
            statut_change_to = 'actif';
            statut_css = 'right';
        }    
       
        // Ajouter la div à l'élément parent
        parentElement.appendChild(divElement);

        //  lors du click sur la div changer de statut
        parentElement.onclick = function (){
            $.ajax({
                url: '/produitservice.change_statut/' + id_produit +'/'+ statut_change_to,
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

<STYLE>
   
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
        font-size:25px;
        color: black;
        padding-bottom: 1rem;
        padding-top: 0;
    }

    .table.table-profile td {
        
        border-color: red;
        font-size:12px;
        padding: 0 0 0 1rem;
       
       
    }

    .table.table-profile tbody+thead>tr>th {
        padding-top: 1.5625rem;
        border:none;
      
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

#M53{
background-color: #747474;
}
</style>

@endsection
