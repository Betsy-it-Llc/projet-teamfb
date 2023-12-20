@extends('layouts.navadmin')
@section('content')

<head>
<div class="container" style="margin:0;width:100%" >
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
    <center>
            <b style="margin-bottom :20px;font-size:2.5rem;">Info Packs</b>
        </center>
            <table style="  margin:40px;">
            
              
            </table>    
            <div style="margin:40px 0 20px 0;text-align:left">
                <b style="font-size:3em"> Pack {{ $pack->nom }} <b style="color:green;font-size:1.3em">{{ $defaultPrice->prix }} €</b> </b>
                <b style="position:absolute">
                    <a href="/packs.edit/{{ $pack->id_pack }}">
                        <i class="fas fa-edit" style="width:20px;height:20px"></i>
                    </a>
                </b>
            </div>
        <div class="profile-header" >
        
       
        <!-- ------------le statut pack ------------------------ -->
            <!-- laisser ca pour l'&ffichage du switch -->
            <div  id="id_statut" style="border:4px solid black;background-color:#888888;width:50px;height:26px;float:left ;border-radius:25px; cursor:pointer;">
            </div>
            <div style="padding:0 62rem 0 0;width:40%;position:start;"><b style="font-size:1.5em;color:#333333">{{ $pack->statut }}</b></div>
        <!-- ------------le statut pack ------------------------ -->
        
       
        <form method="post">
            @csrf
            @method('DELETE')
            <div style="margin-left:0px">
                <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                    href="{{ route('packs.edit', $pack->id_pack) }}"><i style="color : green;"
                        class="fas fa-edit fa-lg"></i>
                </a>
                <button formaction="{{ route('packs.destroy', $pack->id_pack) }}"
                    style="background:none ; border : none;" type="submit" class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete ?')"><i
                        style="color : red" class="fas fa-trash fa-lg"></i>
                </button>
                <!-- -------------btn prix------------- -->
                <div class="btn btn-light" onclick="liste_prix()"> Liste prix </div>
                <div class="btn btn-light" onclick="new_prix()"> Ajout nouveau prix </div>
                <!-- -------------btn prix------------- -->
                <form method="post" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button formaction="{{ route('packs.archiver', $pack->id_pack) }}" class="btn btn-secondary" type="submit"
                        onclick="return confirm('Are you sure you want to archive this product?')">
                        Archiver
                    </button>
                </form>
            </div>  
        </form>
    </div>
        

        <div class="profile-container" style="width:100%">
            <div class="row row-space-20" >
                <div class="col-md-4 hidden-xs hidden-sm" style="max-width:30%">
                    <div class="tab-content p-0" >
                        <div class="tab-pane active show" id="profile-about">
                            @isset($image_du_pack)
                                    <table style=" margin-top:50px;background-image:url({{$image_du_pack}});background-repeat:no-repeat;background-size: contain;width:100%;height:300px ">
                                    </table>
                                @else
                                    <table style=" margin-top:50px;background-image:url(https://cdn.pixabay.com/photo/2012/04/10/23/44/question-27106_640.png);background-repeat:no-repeat;background-size: contain;width:100%;height:300px ">
                                    </table>
                            @endisset
                                <form class="my-2" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="image_pack">Selectionnez une image :</label>
                                    <input type="file" id="image_pack" name="image_pack">
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
                                
                        </div>
                    </div>
                </div>

                


                <div class="col-md-4 hidden-xs hidden-sm" style="max-width:24%">
                    <div class="tab-content p-0" > 
                        <div class="tab-pane active show" id="profile-about">
                        <table class="table table-profile" style="margin-top:55px;">
                                
                               
                                <tbody>
                                <tr>
                                        <td class="field"><b>id pack: </b></td>
                                        <td class="value">
                                            {{ $pack->id_pack }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Nom: </td>
                                        <td class="value">
                                            {{ $pack->nom }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Prix: </td>
                                        <td class="value">
                                        {{ $defaultPrice->prix }} €
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- @dd($statutPrix) --}}
                                        <td class="field">Statut Prix :</td>
                                        <td class="value">{{$statutPrix->statut}}</td>
                                    </tr>
                                    <tr >
                                        <td class="field" >Abstract:</td>
                                        <td class="value" >
                                            {{ $pack->abstract }}
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                    </table>
                                    <table>
                                    
                                    
                                    <tr>
                                        <td class="field" style="padding:0 0 1rem 0"><b style="margin-left:15px">Description détaillé :</b></td>
                                    </tr>
                                    <tr style="float:left ;">
                                        <td style="text-align: justify;padding:0.9rem"><pre style="white-space: pre-line; text-align:left; margin:0; width: 100%; ">{{ $pack->description }}</pre></td>
                                    </tr>
                                
                                   
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    
                    <br>
                </div>
                <div class="col-md-4 hidden-xs hidden-sm" style="max-width:23%">
                    <div class="tab-content p-0" > 
                        <div class="tab-pane active show" id="profile-about">
                        <table class="table table-profile" style="margin-top:225px;">
                                <thead>
                                    <tr>
                                        <th colspan="2" style="font-size:1.5em;color:#333333;">Produits du pack</th>
                                    </tr>
                                </thead>
                            </table>
                            <table style="margin-right:-30px;margin-top:-20px">
                            <tbody>
                            <tr>
                                <td><b style="margin-right:20px;">Total</b></td>
                                <td><b style="margin-right:20px;color:green">{{ $total }} €</b></td>
                                
                                <td><b style="margin-right:20px">Gain</b></td>
                                <td><b style="margin-right:20px;color:#333333">{{ round($gain, 2) }} %</b></td>
                                <td></td>
                                
                                </tr>
                            </tbody>
                            </table>
                            <table style="margin-left:-20px;margin-top:10px">
                                <tbody >
                                <tr>
                                <td><b style="margin-right:20px">Id</b></td>
                                <td><b style="margin-right:20px">Nom</b></td>
                                <td><b style="margin-right:20px">Quantité</b></td>
                                <td><b style="margin-right:20px">Prix</b></td>
                                <td><b style="margin-right:20px">Fiche</b></td>
                                <td><b style="margin-right:20px">Stripe</b></td>
                                
                                </tr>
                                @foreach ($produitspack as $produit)
                                <tr style="text-align:left">
                                    <td>{{ $produit->id_produit }}</td>
                                    <td>{{ $produit->nom_produit }} </td>
                                    <td style="text-align:center">{{ $produit->quantity }}</td>
                                    <td>{{ $produit->prix * $produit->quantity }} €</td>
                                    <td><a href="/produitservice.show/{{$produit->id_produit}}"><b style="color:red">GO</b></a></td>
                                    <td><a href=""><b style="color:blue">S</b></a></td>
                                    </tr>
                                @endforeach
                                @php
                                    /*
                                          <tr style="text-align:left">
                                <td>9</td>
                                <td>Vocal</td>
                                <td>60 €</td>
                                <td><a href=""><b style="color:red">GO</b></a></td>
                                <td><a href=""><b style="color:blue">S</b></a></td>
                                <td><i class="fas fa-trash" style="color:red"></i></td>
                                </tr>
                                    */
                                @endphp
                                   
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    
                    <br>
                </div>
                <div class="col-md-4 hidden-xs hidden-sm" style="max-width:23%">
                    <div class="tab-content p-0" > 
                        <div class="tab-pane active show" id="profile-about">
                        <table class="table table-profile"  style="margin-right:-190px;margin-top:-10px">
                               
                                <tbody>
                                    
                               
                                    <tr>
                                        <td class="field" style="width:60%;padding:4rem 0 0 0">Date de création :</td>
                                        <td class="value" style="padding:4rem 0 0 0;margin-left:-20px">
                                        {{ Carbon\Carbon::parse($pack->date_creation  )->format('Y m d')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width:60%;padding: 0">Date de Modification : </td>
                                        <td class="value" style="padding: 0;margin-left:-20px">
                                        21 98 1029
                                        </td>
                                    </tr>
                                 
                                    <tr>
                                        <td class="field" style="width:40%;padding: 0"> Stock :  </td>
                                        <td class="value">
                                            <b style="padding: 0; margin-left: -15px;">{{$pack->stock}}</b>
                                            <i style="cursor:pointer; color: #e6ac00; margin-left: 10px;" onclick="openStock({{ $pack->id_pack }}, '{{ $pack->stock }}')" class="fas fa-edit"></i>
                                        </td>
                                    </tr>
                                        <td class="field" style="padding: 0">Nombre d'achats :</td>
                                        <td class="value" style="padding: 0">
                                        {{ $totAchat->achat }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="padding: 0">Total revenu :</td>
                                        <td class="value" style="padding: 0">
                                        {{ $totAchat->achat * $pack->prix }} €
                                    </td>
                                    </tr>

                                   
                                    
                                </tbody>
                                                                 
                            </table>
                            <table class="table table-profile" style="margin-right:-290px;margin-top:50px">
                                <thead>
                                    <tr>
                                        <th colspan="2" style="font-size:1.5em;color:#333333;">Remises</th>
                                    </tr>
                                </thead>
                            </table>
                            
                            <table style="margin-right:-220px;">
                                <tbody >
                                    <tr>
                                        <td><b style="margin-right:20px">Nom</b></td>
                                        <td><b style="margin-right:20px">Code</b></td>
                                        <td><b style="margin-right:20px">Taux</b></td>
                                        <td><b style="margin-right:20px">nb</b></td>
                                        <td><b style="margin-right:20px">Restant</b></td>
                                        <td><b style="margin-right:20px">Lien</b></td>
                                    </tr>
                                    <!-- @foreach ($remises as $remise)
                                    <tr style="text-align:left">
                                        <td>{{ $remise->nom_remise }}</td>
                                        <td>{{ $remise->code }}</td>
                                        <td>{{ $remise->taux }}%</td>
                                        <td><b>{{ $remise->nb_utilisation }}</b></td>
                                        <td><b>{{ $remise->nb_utilisation-$remise->numRemises }}</b></td>
                                        </tr>
                                    @endforeach -->
                                    @foreach ($remise_pack as $remise)
                                    <tr style="text-align:left">
                                        <td>{{ $remise->nom_remise }}</td>
                                        <td>{{ $remise->code }}</td>
                                        <td>{{ $remise->taux }}%</td>
                                        <td>{{ $remise->nb_utilisation }}</td>
                                        <td></td>
                                        <td> <a style="color:red" href="/remises.show/{{$remise->id_remise}}">GO</a> </td>
                                    </tr>
                                    @endforeach




                                @php
                                    /*
                                           <tr style="text-align:left">
                                <td>Noel</td>
                                <td>NOEL23</td>
                                <td>60%</td>
                                <td><b>20</b></td>
                                <td><b>2</b></td>
                                </tr>
                                    */
                                @endphp
                             

                                                       
                                
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <br>
                </div><!-- /.modal -->
                <!-- /.modal -->
               
                    
            </div>
        </div>
    </div>
</div>


</div>

</div>



<div id="liste_prix" class="my_card" style="display:none">
    <form action="/packs.statutprix" method="POST">
        @csrf
        <h3 style="text-align:center; margin-bottom:15px">La liste des prix</h3>
        <input type="hidden" name="id_pack" value="{{ $pack->id_pack}}">
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
    <form action="/packs.addnewprice" method="POST" style="display: block;">
        @csrf
        <h3 style="text-align:center; margin-bottom:15px">Ajouter un nouveau prix</h3>
        <input type="hidden" name="id_pack" value="{{ $pack->id_pack }}">
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
    <form action="{{ route('pack.modif_stock') }}" method="POST" class="my-form">
        @csrf
        <h4 class="my_heading">Modification du stock</h4>
        <input type="hidden" id="id_pack" name="id_pack" value="{{ $pack->id_pack }}"> 
        <textarea class="form-control my-textarea" name="stock" id="stock" cols="30" rows="5"> {{ $pack->stock }} </textarea>
        <div class="div_boutons">
            <button class="btn btn-info my-button" type="submit">Modifier</button>
            <div onclick="closeStock()" class="btn btn-danger my-button">Annuler</div>
        </div>
    </form>
</div>

<script>
    
        function openStock(id_Pack, stock) {
    if (document.getElementById("div_card").style.display === "none") {
        document.getElementById("id_pack").value = id_Pack;
        document.getElementById("stock").value = stock;
        document.getElementById("div_card").style.display = "block";
    }
}

    function closeStock() {
        document.getElementById("div_card").style.display = "none";
    }
    // autre 
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
        id_produit = "{{ $pack->id_pack }}";
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
        if ("{{ $pack->statut }}" === 'actif') {
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
                url: '/packs.change_statut/' + id_produit +'/'+ statut_change_to,
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
#M56{
background-color: #747474;
}


#dash{
    padding:1rem;
    font-size:0.9rem;
    table-layout: fixed;
    width:120px;
    text-align:center;
    color:#101;
    border:100px;
   
    
}
</style>

@endsection
