@extends('layouts.navadmin')
@section('content')

<div class="container">
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
            <b style="margin-bottom :20px;font-size:2.5rem;">Info Paiement</b>
        </center> 
        <table>
            <tr>
                <td style="width:33%">
            <div class="profile-header-content" >
               <table style="color:#333333;">
                <tr >
                    <td >
                    <h2 style=" color:#333333;padding:2rem 0 0 0"><b> Paiement</b></h2>
             
                            <span style="padding:0 0 0 2rem"><b>id paiement : </b> {{$dbs[0]->id_paiment}}</span><br>
                            <span style="padding:0 0 0 2rem"><b>Libellé     : </b> {{$dbs[0]->libelle}}</span><br>
                            <span style="padding:0 0 0 2rem"><b>Prix        : </b> {{$dbs[0]->prix}}</span><br>
                            <span style="padding:0 0 0 2rem"><b>Date        : </b> 29 07 2023</span><br>
                            @if ($dbs[0]->statut_paiement == "Non payé")
                                <span style="padding:0 0 0 2rem"><b>Valider Paiement : </b > 
                                    <div onclick="mode_paiement()" style="background-color : #fff ; border : #fff" class="btn btn-info">
                                        <i  style="color : #4d94ff" class="fas fa-check"></i>
                                    </div>
                                </span>
                                <br>
                            @else
                            <span style="padding:0 0 0 2rem"><b>Valider Paiement : </b >  <i style="color : grey" class="fas fa-check fa-lg"></i></span><br>
                            @endif
          


                    </td>
                    
                  
                </tr>
                
                </table>
               
            </div>
            </td>
            <td  style="width:33%">
            <div class="profile-header-content">
               <table style="color:#333333">
                <tr>
                    <td style="padding: 3rem  1rem 1rem 1rem;">
                    <span style="  font-size: 2.2em;"> <b>Montant </b></span><br>
                       <span style="  font-size: 1.2em;">{{$dbs[0]->statut_paiement}}</span>
                    </td>
                    <td style="color:green;padding:3.7rem 5rem 1rem 0">
                    <span style="  font-size: 4em;"> <b> {{$dbs[0]->prix}}€</b></span>
                   
                    
                    </td>
                  
                </tr>
                <tr>
                    <td style="padding: 0rem  1rem 0rem 0rem;">
                        <span style="font-size:1.2em;padding:0 1 0 1.3rem"> <b>Lien Facture :  </b></span>
                        <a href="{{ route('factures.show',['facture'=>$dbs[0]->num_facture]) }}" style="font-size:1em;padding:0 0 0 0.4rem;color:green">Go</a>
                    </td>
                   
                </tr>
                
                </table>
               
            </div>
            </td>
            <td >
            <div class="profile-header-content" style="padding:2rem 0 0 0">
               <table style="color:#333333;">
               <tr style="padding:0 0 1rem 0">
                    <td style="font-size:1em;">
                   <span><b> Mode de facturation </b></span> 
                    </td>
                    <td style="font-size:0.8 em">
                   <span>  : {{$dbs[0]->nb_paiement}} fois</span> 
                    </td>
                </tr>
                <tr >
                    <td style="font-size:1em">
                   <span><b> Emmettre un Avoir </b></span> 
                    </td>
                    <td style="font-size:1em">
                   <span>  : </span> 
                    </td>
                </tr>
                <tr>
                    <td style="font-size:1em;padding:1rem 0 0 0">
                   <span><b> Date d'émission</b></span> 
                    </td>
                    <td style="font-size:1em;padding:1rem 0 0 0">
                   <span>  : </span> 
                    </td>
                    <td style="font-size:1em">
                        <span>{{$date_emission ? Carbon\Carbon::parse($date_emission)->format('Y m d') : '-' }}</span> 
                    </td>
                </tr>
                <tr>
                <td style="font-size:1em">
                <span> <b> Date d'échéance</b></span>
                    </td>
                    <td style="font-size:1em">
                   <span>  : </span> 
                    </td>
                    <td style="font-size:1em">
                   <span>{{$dbs[0]->date_echeance ? Carbon\Carbon::parse($dbs[0]->date_echeance)->format('Y m d') : '-' }}</span> 
                    </td>
                </tr>
                <tr >
                <td style="font-size:1em;padding:0 1rem 0 0;">
                <span><b>  Date de paiement</b></span>
                    </td>
                    <td style="font-size:1em">
                   <span>  : </span> 
                    </td>
                    <td style="font-size:1em">
                        <span>{{$date_paiement ? Carbon\Carbon::parse($date_paiement)->format('Y m d') : '-' }}</span> 
                    </td>
                </tr>  
                                
                </table>
               
            </div>
            </td>
</tr>
       </table>    
            
        </div>

        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                            <table class="table table-profile" >
                                <thead >
                                <tr >
                                 <td style="padding: 0 0 2rem 0 ">
                                 <div class="profile-header-content">
                            <div class="profile-header-img" style="background:none;height:110%">
                                     <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU" alt="Admin" class="rounded-circle p-1 bg-primary" width="130px">
                                     <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                                    href="/contacts.edit/{{$dbs[0]->id_contact}}"><i style="color : green;"
                                        class="fas fa-edit fa-lg"></i></a>
                                     <button formaction=""
                                    style="background:none ; border : none;" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : red" class="fas fa-trash fa-lg"></i></button>
                          
                            
                                    </div >
                    </div>      
                       
                                </td>
                                 <td >
                                 <span > <h3>{{$dbs[0]->prenom}} {{$dbs[0]->nom}} </h3></span>
                                 <span ><h9>Dossier Client : </h9> <a href="{{$dbs[0]->url_contact_folder}}" style="color:red">GO</a></span><br>
                                

                                  </td>
                  
                                 </tr>
                                    <tr style="padding:0;">
                                        <th colspan="2"  style="padding:0;color:#333333" >Info Client  </th>
                                    </tr>
                                    <tr style="font-size:1rem;">
                                       <td style="padding:0 0 0.5rem 0;"><b> Id : {{$dbs[0]->id_contact}}</b></td>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <tr>
                                        <td class="field">Nom</td>
                                        <td class="value">
                                        {{$dbs[0]->nom}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Prenom</td>
                                        <td class="value">
                                        {{$dbs[0]->prenom}} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Email</td>
                                        <td class="value">
                                        {{$dbs[0]->email}} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Tel</td>
                                        <td class="value">
                                        {{$dbs[0]->tel}} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Adresse</td>
                                        <td class="value">
                                        {{$dbs[0]->adresse}} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">CP</td>
                                        <td class="value">
                                        {{$dbs[0]->code_postal}} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Ville</td>
                                        <td class="value">
                                        {{$dbs[0]->ville}} 
                                        </td>
                                    </tr>
                                    
                                    <thead>
                                        <tr>
                                            <th style="padding:2rem 0 0 0;" colspan="2">Clients Supplémentaires </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $key => $value)
                                        @if ($value->id_contact!=$dbs[0]->id_contact)
                                        <tr>
                                            <td>{{ $value->nom }}</td>
                                            <td>{{ $value->prenom }} <a href="/clients.show/{{ $value->id_contact }}" style="font-size:1em;padding:0 0 0 2rem;color:green"><b>Go</b></a></td>
                                            
                                        </tr>
                                        @endif
                                        @endforeach
                           
                                    </tbody>
                                </tbody>
                                <thead>
                                        <tr>
                                            <th style="padding:2rem 0 0 0;" colspan="2">Evénements </th>
                                        </tr>
                                    </thead>
                                    </table>
                                    
                                    <div class="history-tl-container" style="line-height:1.5em; min-width:920px; ">
                                    <ul class="tl" >
                                               {{-- @dd($paiementNotif) --}}
                    {{-- @dd($dbs) --}}
                    @foreach($paiementNotif as $event)
                                     <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 3rem 2rem">
                                     <div class="timestamp" style="padding:0 3rem 0 0;font-size:1em;color:#333333">
                                          {{$event->statut_paiement}}<br> 
                                    </div>
                                <div class="item-title" style="padding:0 3rem 0 0;font-size:0.7em;color:#333333;width:200px"><b>{{$event->date_statut}}</b>:  {{$event->libelle}}</div>
                                
                                </li>
                    @endforeach            
                             </ul>

                            </div>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                            
                            <table>
                            <thead>
                                        <tr>
                                            <th style="padding:8rem 0 1rem 10rem;font-size:1.6em;color:#333333;" colspan="2">Facture  liée : {{$dbs[0]->num_facture}} </th>
                                        </tr>
                            </table>
                            <!-- <table>
                                <thead>
                                    <tr>
                                        <th>Nom pack/produit</th>
                                        <th>Prix</th>
                                        <th>lien</th>
                                    </tr>
                                </thead>
                            
                                @foreach ($packs as $pack)
                                <tr>
                                    <td>{{ $pack->nom }}</td>
                                    <td>{{ $pack->prix }} €</td>
                                    <td><a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                        href="{{route('packs.show',['id_pack'=>$pack->id_pack])}}"><i style="color : #4d94ff"
                                            class="fas fa-info"></i></a></td>
                                </tr>
                                @endforeach  
                                @foreach($produits as $produit)
                                <tr>
                                    <td>{{ $produit->nom_produit }}</td>
                                    <td>{{ $produit->prix }} €</td>
                                    <td> <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                        href="/produitservice.show/{{$produit->id_produit}}"><i style="color : #4d94ff"
                                            class="fas fa-info"></i></a></td>
                                </tr>
                                @endforeach
                            </table> -->
                            <!-- -------------------------- yasser ---------------------------- -->
                            @if(!empty($pack) && !empty($produits))
                                <div style="width: 300px; ">
                                    <div style="display:flex; justify-content: flex-end; ">
                                        <div style="width: 25%; text-align:center; font-weight:bold;">Q</div>
                                        <div style="width: 25%; text-align:right; font-weight:bold;">M</div>
                                    </div>
                                    <!-- ********************** packs ******************** -->
                                    @php 
                                        $montant_totale_pack = 0; 
                                    @endphp
                                    @foreach ($packs as $pack)
                                    <!-- -------calcul------ -->
                                    @php 
                                        $prix_chanson_sup =  ($pack->nb_titres - 1)* 85 ;
                                        $nbr_pers_sup     = ($pack->nb_participants - 1);
                                        $prix_pers_sup    = '';
                                        if( $nbr_pers_sup < 10){
                                            $prix_pers_sup  = $nbr_pers_sup* 40;
                                        }elseif( $nbr_pers_sup > 10){
                                            $prix_pers_sup  = (40 * 9) + ( 35 * ($nbr_pers_sup-9));
                                        }
                                        $montant_total = $prix_chanson_sup + $prix_pers_sup + $pack->prix;
                                        $montant_totale_pack = $montant_totale_pack + $montant_total ; 
                                    @endphp
                                    <!-- -------calcul------ -->
                                    <!-- ligne 1  -->
                                    <div style="width: 100%; display:flex; justify-content:space-around; margin-top:5px;">
                                        <div style="width: 50%; font-weight:bolder;">Pack {{ $pack->nom }} </div>
                                        <div style="width: 25%; text-align:center;">1</div>
                                        <div style="width: 25%; text-align:right;">{{ $pack->prix }} €</div>
                                    </div>
                                    <!-- ligne 1  -->
                                    <!--  ligne 2  -->
                                    <div style="width: 100%; display:flex; justify-content:space-around; ">
                                        <div style="width: 50%; text-align:right; font-weight: 550; color: #666;">Chanson Supl</div>
                                        <div style="width: 25%; text-align:center;"> {{ $pack->nb_titres - 1 }} </div>
                                        <div style="width: 25%; text-align:right;"> {{ $prix_chanson_sup}} €</div>
                                    </div>
                                    <!--  ligne 2  -->
                                    <!--  ligne 3  -->
                                    <div style="width: 100%; display:flex; justify-content:space-around; ">
                                        <div style="width: 50%; text-align:right; font-weight: 550; color: #666;">Personne Supl</div>
                                        <div style="width: 25%; text-align:center;"> {{ $nbr_pers_sup}} </div>
                                        <div style="width: 25%; text-align:right;"> {{ $prix_pers_sup}} €</div>
                                    </div>
                                    <!--  ligne 3  -->
                                    <!-- ligne 4 -->
                                    @if(isset($pack->statut_experience))
                                    <div style="width: 100%; display:flex; justify-content:space-around; margin-top:5px; ">
                                        <div style="width: 50%; text-align:right; color: #666;">Statut</div>
                                        <div style="width: 25%; text-align:center;"></div>
                                        <div style="width: 25%; text-align:right;">{{ $pack->statut_experience }}</div>
                                    </div>
                                    @endif
                                    <!-- ligne 4 -->

                                    <!-- ligne 5 -->
                                    @if(isset($pack->numero_experience))
                                    <div style="width: 100%; display:flex; justify-content:space-around; ">
                                        <div style="width: 50%; text-align:right; color: #666;">Numéro</div>
                                        <div style="width: 10%; text-align:center;"></div>
                                        <div style="width: 40%; text-align:right;">{{ $pack->numero_experience }}</div>
                                    </div>
                                    @endif
                                    <!-- ligne 5 -->
                                    <!--  ligne 5  -->
                                    <!--  ligne 6  -->
                                    <div style="width: 100%; display:flex; justify-content:space-around; ">
                                        <div style="width: 50%; text-align:right;"></div>
                                        <div style="width: 25%; text-align:center;"> 
                                            @if(isset($pack->id_experience))
                                            <a href="{{ route('experience.show', ['id_experience'=>$pack->id_experience,'num_facture'=>$pack->num_facture]) }}" style="font-size:1em; color:green">
                                                <b>Go</b>
                                            </a>
                                            @endif
                                        </div>
                                        <div style="width: 25%; text-align:right;"> {{ $montant_total }} €</div>
                                    </div>
                                    <!--  ligne 6  -->
                                    @endforeach 
                                    @if(!empty($pack))
                                    <!--  ligne 7  laisser vide pour afficher le prix total de la facture -->
                                    <div style="width: 100%; display:flex; justify-content:space-around; ">
                                        <div style="width: 50%; text-align:right; color: #666;"> Montant total pack</div>
                                        <div style="width: 25%; text-align:center;"></div>
                                        <div style="width: 25%; text-align:right;"> {{ $montant_totale_pack }} €</div>
                                    </div>
                                    <!--  ligne 7  -->
                                    <hr>
                                    @endif
                                    <!-- ********************** packs ******************** -->
                                    @foreach($produits as $produit)
                                    <!-- ligne 1  -->
                                    <div style="width: 100%; display:flex; justify-content:space-around; margin-top:5px;">
                                        <div style="width: 50%; font-weight:bolder; ">Produit {{ $produit->nom_produit }} </div>
                                        <div style="width: 25%; text-align:center;">{{ $produit->quantity }}</div>
                                        <div style="width: 25%; text-align:right;">{{ $produit->prix }} €</div>
                                    </div>
                                    <!-- ligne 1  -->
                                    <!--  ligne 2  -->
                                    <div style="width: 100%; display:flex; justify-content:space-around; ">
                                        <div style="width: 50%; text-align:right;"></div>
                                        <div style="width: 25%; text-align:center;"> 
                                            <a href="/produitservice.show/{{$produit->id_produit}}" style="font-size:1em; color:green">
                                                <b>Go</b>
                                            </a>
                                        </div>
                                        <div style="width: 25%; text-align:right;"> €</div>
                                    </div>
                                    <!--  ligne 2  -->
                                    @endforeach 
                                </div>
                            @else
                                <div style="width: 300px;">Il n'y a pas de données </div>
                            @endif
                            <!-- -------------------------- yasser ---------------------------- -->
                            
                        </div>
                    </div>
                    <br>
                </div><!-- /.modal -->
                <div class="col-md-4 ">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                            <table class="table table-profile">
                                <thead>
                                    <tr>
                                        <td>
                                        <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Imprimer</a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                        <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Renvoyer</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="btn btn-primary" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE" href="" >Valider</a>
                                        </td>
                                        <td>
                                        <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Modifier</a>
                                        </td>
                                        <td>
                                        <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Envoyer</a>
                                        </td>
                                        <td>
                                        <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Supprimer</a>
                                        </td>
                                    </tr>
                                </table>
                                    
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
</div>
<!-- -------------------------------------------------- -->
<script>
    function mode_paiement(){

        var mode_paiement = document.getElementById('mode_paiement');
        mode_paiement.style.display = "flex";
    
    }
    function close_mode_paiement(){
        var mode_paiement = document.getElementById('mode_paiement');
        mode_paiement.style.display = "none";
    }
    function close_refus(){
        var mode_paiement = document.getElementById('refus_mode_paiement');
        mode_paiement.style.display = "none";
    }

</script>
<!-- ------------ -->
<div id="mode_paiement" class="my_card" style="display:none">
    <form action="/paiementss.mode_paiement" method="POST">
        @csrf
        <h3 style="text-align:center; margin-bottom:15px">Le mode de paiement</h3>
        <input type="hidden" name="id_paiement" value="{{$dbs[0]->id_paiment}}">

        <select style="width: 100%;"  name="mode_paiement" id="mode_paiement">
            @foreach ($enum_values as $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="mes_btn">
            <div class="btn btn-danger my-button" onclick="close_mode_paiement()">Fermer</div>
            <button class="btn  btn-success" type="submit">Envoyer</button>
        </div>
    </form>
</div>
<!-- <div id="refus_mode_paiement" class="my_card" style="display:none; text-align:center; height: 15vh;">
    <h3 style="text-align:center; margin-bottom:15px">Vous ne pouvez pas car le statut n'est pas 'Non payé'</h3>
    <div style="margin-top:30px">
        Vous ne pouvez pas car le statut n'est pas 'Non payé'
    </div>
    <div class="mes_btn">
        <div class="btn btn-danger my-button" onclick="close_refus()">Fermer</div>
    </div>
</div> -->
<!-- ------------ -->
<style>
    .my_card {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width: 25vw;
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
        justify-content:space-evenly;
    }
</style>





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
        font-size:20px;
        color: black;
        padding-bottom: 1rem;
        padding-top: 0;
    }

    .table.table-profile td {
        
        border-color: #c8c7cc;
        font-size:12px;
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
       color:#333333;
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
        #pageSubmenu14{
                visibility:visible;
                display:block;
                }
        #pageSubmenu18{
            visibility:visible;
            display:block;
        }
    #M90{
    background-color: #747474;
    }
    .history-tl-container ul.tl{
    
    padding:0.5rem;
    display:inline-block;

    }
    .history-tl-container ul.tl li{
    list-style: none;
    
    margin-left:120px;
    
    /*background: rgba(255,255,0,0.1);*/
    border-left:3px solid  black;
    padding:10px 0 50px 30px;
    position:relative;
    }
    .history-tl-container ul.tl li:last-child{ border-left:0;}
    .history-tl-container ul.tl li::before{
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
    .history-tl-container ul.tl li:hover::before{
    border-color:  #258CC7;
    
    }
    ul.tl li .item-title{
    }
    ul.tl li .item-detail{
    color:rgba(0,0,0,0.5);
    font-size:12px;
    }
    ul.tl li .timestamp{
    color: #8D8D8D;
    position: absolute;
    width:100px;
    left: -50%;
    text-align: right;
    font-size: 12px;
    }
</STYLE>

@endsection