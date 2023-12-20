@extends('layouts.navadmin')
@section('content')
       
<div class="container" style="margin:0">
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
            <b style="margin-bottom :20px;font-size:2.5rem;">Info Remise & Promo</b>
        </center>
<div style="margin-left:-1030px;margin-top:20px;margin-bottom:-70px"> 
        <a style="background: none ; border : none;" class="btn btn-primary"
                                    href="/remises.edit/{{$remise->id_remise}}"><i style="color : green;"
                                        class="fas fa-edit fa-lg"></i></a>
                                     <button formaction="{{ route('remises.destroy',['id_remise'=>$remise->id_remise]) }}"
                                    style="background:none ; border : none;" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : red" class="fas fa-trash fa-lg"></i></button>
        </div>

    </form>
        <div class="profile-header" style="margin-top:60px"> 
        <!-- ------------le statut pack ------------------------ -->
        <div  id="id_statut" style="border:4px solid black;background-color:#888888;width:50px;height:26px;float:left ;border-radius:25px; cursor:pointer;">
        </div>
        <div style="padding:0 62rem 0 0;width:40%;position:start;"><b style="font-size:1.5em;color:#333333">{{ $statut }}</b></div>
        
        <!-- <div style="text-align:left;font-size:1.5em;"><b style="font-size:1.5em"> {{ $remise->nom_remise }}</b> <b >  Id :</b> {{ $remise->id_remise }}</div>
        <div><a href=""><div style="border:4px solid black;background-color:#888888;width:50px;height:26px;float:left ;border-radius:25px;">
        <div  style="border:10px solid black;width:22px;height:12px;float:right ;border-radius:5px;"></div></a></div>

        </div>
        <div style="padding:0 62rem 0 0;width:40%;position:start;"><b style="font-size:1.5em;color:#333333">{{ $statut }}</b></div> -->
        <!-- ------------le statut pack ------------------------ -->
    </div>
        

        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-4 hidden-xs hidden-sm" style="width-max:55%">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                        <table style="margin-bottom:-50px;width:150%;margin-top:-29px">
                            <tr style="font-size:1.5em">
                                
                                <td><b style="margin-left:25px" >Début :</b></td><td style="margin-right:15px">{{ Carbon\Carbon::parse($remise->date_debut )->format('Y m d')}}</td>
                                <td><b > Expiré le :</b></td><td style="margin-right:15px">{{ Carbon\Carbon::parse($remise->date_fin )->format('Y m d')}}</td>
                            </tr>
                        </table>
                            @isset($image_de_remise)
                                <table style=";margin-bottom:30px;margin-top:50px;border-radius:5px;background-image:url({{$image_de_remise}});background-position: center;background-repeat:no-repeat;background-size: contain;width:150%;height:285px">
                            @else
                                <table style=";margin-bottom:30px;margin-top:50px;border-radius:5px;background-image:url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShGtGviR-60uvC3U4Es9qCQGOkjpLp9o-Ow3EV8cYDNtMrnlYr8TYZGCUhIA5HcDn6pAU&usqp=CAU);background-position:center;background-repeat:no-repeat;background-size: contain;width:150%;height:285px">
                            @endisset
                            
                                </table>
                                <form class="my-2" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="image_remise">Selectionnez une image :</label>
                                    <input type="file" id="image_remise" name="image_remise">
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
                                            <th colspan="2" style="padding:0 0 1rem 0"><b style="font-size:2.5em;color:#333333">
                                                Description
                                                <div onclick="openModif()" style="background: none ; border : none;margin-left:10px" class="btn btn-primary" data-csrf-token="{{ csrf_token() }}">
                                                    <i style="color : green;" class="fas fa-edit fa-lg"></i>
                                                </div>
                                            </th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    
                                    <tr style="float:left ;margin-bottom:10px">
                                        <td id="affiche_descrip" style="text-align: justify;padding:0.5rem">
                                        {{ $remise->description }}
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>    
                                
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about" style="width:100%">
                        <table  style="margin-left:200px;width:140%">
                                <thead>
                                        <tr>
                                        <th colspan="2" style="padding:0 0 0 1rem;"><b style="font-size:2.5em;color:#333333;">Articles Concernées</th>
                                        <th>  <a class="btn btn-success" href="{{ route('remises.insertproduct',['id_remise'=>$remise->id_remise]) }}"  style="background-color:#888888;color:black;width: 60px;padding:0.3rem;font-size:0.9em;text-align: center;border:1px solid black"><b>+ Produit</b></a></th>
                                        <th>  <a class="btn btn-success" href="{{ route('remises.insertpack',['id_remise'=>$remise->id_remise]) }}"  style="background-color:#888888;color:black;width: 60px;padding:0.3rem;font-size:0.9em;text-align: center;border:1px solid black"><b>+ Pack</b></a></th>

                                        </tr>
                                </thead>
                            </table>
                            <table style="margin-left:200px;margin-top:10px;width:140%;font-size:1.2em">
                                <tbody >
                                <tr>
                                <td><b style="margin-right:30px">Id</b></td>
                                <td><b style="margin-right:30px">Nom</b></td>
                                <td><b style="margin-right:30px">Montant</b></td>
                                <td><b style="margin-right:30px">Taux</b></td>
                                <td><b style="margin-right:30px"></b></td>
                                {{-- @dd($produitsremise) --}}
                                @foreach ($packsremise as $pack)
                                    </tr>
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
                                    <td><a href="{{route('packs.show',['id_pack'=>$pack->id_pack])}}"><b style="color:red">GO</b></a></td>
                                    <td><a href="{{ route('remises.removepack',['id_remise'=>$remise->id_remise,'id_pack'=>$pack->id_pack]) }}"><b style="color:blue">REMOVE</b></a></td>
                                @endforeach
                         
                                @foreach ($produitsremise as $prod)
                                    </tr>
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
                                    <td><a href="/produitservice.show/{{$prod->id_produit}}"><b style="color:red">GO</b></a></td>
                                    <td><a href="{{route('remises.removeproduct',['id_remise'=>$remise->id_remise,'id_produit'=>$prod->id_produit])}}"><b style="color:blue">REMOVE</b></a></td>
                                @endforeach
                                
                                
                                </tr>
                                </tbody>
                            </table>
                            <table  style="margin-top:20px;margin-left:200px;width:220%">
                                <thead>
                                        <tr style="">
                                        <th colspan="2" style="padding:0 0 0 7rem;"><b style="font-size:2.5em;color:#333333;">Codes Promotionnels</th>
                                        <th>  <a class="btn btn-success" href="#" style="background-color:#888888;color:black;width: 60px;padding:0.3rem;font-size:0.9em;text-align: center;border:1px solid black"><b>Ajouter</b></a></th>
                                        </tr>
                                </thead>
                            </table>
                           
                            <table style="text-align:center;margin-left:190px;margin-top:10px;width:220%;font-size:1.2em">
                                <tbody >
                                <tr>
                                <td><b >Id</b></td>
                                <td><b >Code</b></td>
                                <td><b >Nb</b></td>
                                <td><b >utilisé</b></td>
                                <td><b >Restant</b></td>
                                <td><b >Début</b></td>
                                <td><b >Expiration</b></td>
                                <td><b>Lien</b></td>
                                
                                </tr>
                                @foreach ($codes as $c)
                                    <tr>
                                        <td>{{ $c->id_code }}</td> 
                                        <td>{{ $c->code }}</td>
                                        <td>{{ $c->nb_utilisation + $c->nb_code}}</td> <!-- NB--->
                                        <td>{{ $c->nb_code}}</td> <!-- utilisé --->
                                        <td>{{ $c->nb_utilisation }}</td> <!-- restant --->
                                        <td>{{ Carbon\Carbon::parse($remise->date_fin )->format('Y m d')}}</td>
                                        <td><a href="/codespromo.show/{{$c->id_code}}"><b style="color:red">GO</b></a></td>
                                    
                                    </tr>
                                @endforeach
                              
                                
                                </tbody>
                            </table>
                            <table  style="margin-top:20px;margin-left:200px;width:140%">
                                <thead>
                                        <tr style="">
                                        <th colspan="2" style="padding:0 0 0 12rem;"><b style="font-size:2.5em;color:#333333;">Bénéficiaires</th>
                                        
                                        </tr>
                                </thead>
                            </table>
                           
                            <table style="text-align:center;margin-left: 160px;margin-top:10px;width:220%;font-size:1.2em">
                                <tbody >
                                   
                                <tr>
                                <td><b >Id facture</b></td>
                                <td><b >Nom</b></td>
                                <td><b >Prénom</b></td>
                                <td><b >Date d'enregistrement</b></td>
                                <td><b ></b></td>
                                </tr>
                                @foreach ($beneficiaires as $b)
                                <tr>
                                    <td style="padding:0 3rem 0 0">{{ $b->num_facture }}</td>
                                    <td>{{ $b->nom }}</td>
                                    <td>{{ $b->prenom }}</td>
                                    <td>{{ Carbon\Carbon::parse($b->date_creation )->format('Y m d')}}</td>
                                    <td><a href="/contacts.show/{{$b->id_contact}}"><b >GO</b></a></td>
                                </tr> 
                                @endforeach
                                
                                
                                
                                
                                
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        id_produit = "{{ $remise->id_remise }}";
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
        if ("{{ $statut }}" === 'actif') {
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
                url: '/remises.change_statut/' + id_produit +'/'+ statut_change_to,
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

<script>
    function openModif() {
        document.getElementById("div_card").style.display = "block";
    }

    function closeModif() {
        document.getElementById("div_card").style.display = "none";
    }

    function openFac() {
        document.getElementById("div_card2").style.display = "block";

      }
    function closeFac() {
    document.getElementById("div_card2").style.display = "none";

    }

    function openPack() {
        document.getElementById("div_card3").style.display = "block";

      }


      function closePack() {
        document.getElementById("div_card3").style.display = "none";

      }

      function openPro() {
        document.getElementById("div_card4").style.display = "block";

      }

      function closePro() {
        document.getElementById("div_card4").style.display = "none";
      }

</script>
<div class="my-card" id="div_card">
    <form action="{{ route('remises.modif_descrip') }}" method="POST" class="my-form">
        @csrf
        <h4 class="my_heading">Modification de description</h4>
        <input type="hidden" id="id_remise" name="id_remise" value="{{ $remise->id_remise }}"> 
        <textarea class="form-control my-textarea" name="description" id="description" cols="30" rows="5"> {{ $remise->description }} </textarea>
        <div class="div_boutons">
            <button class="btn btn-info my-button" type="submit">Modifier</button>
            <div onclick="closeModif()" class="btn btn-danger my-button">Annuler</div>
        </div>
    </form>
</div>

    <div class="my-card2" id="div_card2">
    <form action="/action_page.php" class="form-container">
        <h4 class="my_heading">Vous voulez ajouter : </h4>
        <button type="button" onclick="openPack(),closeFac()" class="btn my-button" style="width:100px">Pack</button>
        <button type="button" onclick="openPro(),closeFac()" class="btn my-button" style="width:100px">Produit</button>
        <button type="button" class="btn cancel my-button" onclick="closeFac()" style="width:100px">Annuler</button>
    </form>
</div>

<div class="my-card3" id="div_card3">
    <form action="{{ route('remises.addpack') }}" method="post" class="form-container">
        @csrf
        <input type="hidden" id="id_remise" name="id_remise" value="{{ $remise->id_remise }}"> 

        <h4 class="my_heading">Ajouter pack à la remise : </h4>
        <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
        <select name="id_pack" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
            <option value="">Choisissez un Pack </option>
            @foreach ($nom_pack as $pack)
            <option value="{{ $id_pack[$loop->index] }}" {{ old('id_pack') == $id_pack[$loop->index] ? "selected" : "" }}>{{ $pack }}</option>
            @endforeach
        </select>
        </div>
        <h6 class="my_heading" >Choisissez une version existante de la remise : </h6>
        <select name="id_hist_rem" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
            <option value="">Aucune version</option>
            @foreach ($hist_rem as $rem)
            @isset($rem->taux)
                <option value="{{ $rem->id_historique_remise }}" {{ old('id_hist_rem') == $rem->id_historique_remise ? "selected" : "" }}>{{ $rem->id_historique_remise }} {{''. $rem->taux .'%' }}</option>

            @endisset
            @isset($rem->montant)
                <option value="{{ $rem->id_historique_remise }}" {{ old('id_hist_rem') == $rem->id_historique_remise ? "selected" : "" }}>{{ $rem->id_historique_remise }} {{''. $rem->montant .'€' }}</option>
            @endisset
            @endforeach
        </select>
        <h6 class="my_heading">Ou créer une nouvelle version de la remise : </h6>

        <div class="form-contact" style="margin-top:20px">
            <input type="text" name="taux" value="1" class="form-control" value="{{ old('taux') }}" placeholder="Taux remise" style="background-color:white;border:2px black  solid">
        </div>
        <div class="form-contact" style="margin-top:20px">
            <input type="text" name="montant" value="1" class="form-control" value="{{ old('montant') }}"  placeholder="Montant remise de participants adults" style="background-color:white;border:2px black  solid">
   
        <button type="submit" class="btn my-button" style="width:100px">Appliquer</button>
        <button type="button" class="btn cancel my-button" onclick="closePack()" style="width:100px">Annuler</button>
        </form>
</div>

<div class="my-card4" id="div_card4">
    <form action="{{ route('remises.addproduct') }}" method="post" class="form-container">
        @csrf
        <h4 class="my_heading">Ajouter produit à la remise : </h4>
        <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
            <input type="hidden" id="id_remise" name="id_remise" value="{{ $remise->id_remise }}"> 


        <select name="id_prod" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
            <option value="">Choisissez un produit </option>
            @foreach ($nom_prod as $prod)
            <option value="{{ $id_prod[$loop->index] }}" {{ old('id_prest') == $id_prod[$loop->index] ? "selected" : "" }} >{{ $prod }}</option>
            @endforeach
        </select>

        <h6 class="my_heading">Choisissez une version existante de la remise : </h6>
        <select name="id_hist_rem" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
            <option value="">Aucune version</option>
            @foreach ($hist_rem as $rem)
            <option value="{{ $rem->id_historique_remise }}" {{ old('id_hist_rem') == $rem->id_historique_remise ? "selected" : "" }}>{{ $rem->id_historique_remise }} {{''. $rem->taux .'%' ?? ''. $rem->montant. '€' }}</option>
            @endforeach
        </select>
        <h6 class="my_heading">Ou créer une nouvelle version de la remise : </h6>

        <div class="form-contact" style="margin-top:20px">
            <input type="text" name="taux" value="1" class="form-control" value="{{ old('taux') }}" placeholder="Taux remise" style="background-color:white;border:2px black  solid">
        </div>
        <div class="form-contact" style="margin-top:20px">
            <input type="text" name="montant" value="1" class="form-control" value="{{ old('montant') }}"  placeholder="Montant remise de participants adults" style="background-color:white;border:2px black  solid">
        </div>
   

        <button type="submit" class="btn my-button" style="width:100px">Appliquer</button>
        <button type="button" class="btn cancel my-button" onclick="closePro()" style="width:100px">Annuler</button>
        </form>
</div>

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

#M92{
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

/* ---------------------------------- */

</style>

<style>
#div_card2{
    display: none;
}
.my-card2 {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    width: 500px;
    background-color: #DEDEDE;
    padding: 30px;
}    
#div_card3{
    display: none;
}
.my-card3 {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    width: 500px;
    background-color: #DEDEDE;
    padding: 30px;
}
#div_card4{
    display: none;
}
.my-card4 {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    width: 500px;
    background-color: #DEDEDE;
    padding: 30px;
}


    /* Stylez et fixez le bouton sur la page */
     
      /* Positionnez la forme Popup */
      .formclt {
        position: center;
        text-align: center;
        z-index: 1;
        width: 80%;
      }
      /* Masquez la forme Popup */
      .form-clt {
        display: none;
        position: fixed;
        left:55%;
        top: 30%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
       
      }

      .form-pck {
        display: none;
        position: fixed;
        left:55%;
        top: 30%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
       
      }

      .form-pro {
        display: none;
        position: fixed;
        left:55%;
        top: 30%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
       
      }
      /* Styles pour le conteneur de la forme */
      .form-container {
        width: 400px;
        padding: 20px;
        background-color: #EDEFF0;
        border-radius:10px ;
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
        padding:;
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
     
</style>



@endsection
