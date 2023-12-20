@extends('layouts.navadmin')
@section('content')
<div class="container">
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
                <b style="margin-bottom :20px;font-size:2.5rem;">Info Facture</b>
            </center>
            <table>
                <tr>
                    <td style="width:33%">
                        <div class="profile-header-content" >
                            <table style="color:#333333;">
                                <tr >
                                    <td >
                                        <div class="profile-header-content">
                                            <div class="profile-header-img" style="background:none;height:110%">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU" alt="Admin" class="rounded-circle p-1 bg-primary" width="130px">
                                                <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                                                    href="/contacts.edit/{{$dbs[0]->id_contact}}">
                                                    <i style="color : green;" class="fas fa-edit fa-lg"></i>
                                                </a>
                                                <button formaction=""
                                                    style="background:none ; border : none;" type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete ?')">
                                                    <i style="color : red" class="fas fa-trash fa-lg"></i>
                                                </button>
                                            </div >
                                        </div>
                                    </td>
                                    <td >
                                        <span > <h3> {{$dbs[0]->prenom}} {{$dbs[0]->nom}}</h3></span>
                                        <span ><h9>Num de facture : </h9> {{$dbs[0]->num_facture}}</span><br>
                                        <span ><h9>Stripe de facture : <a href="" style="color:red;">Go</a></span><br>
                                        @if (($statut_facture->id_facture_statut== 3)||($statut_facture->id_facture_statut== 1)||($statut_facture->id_facture_statut== 11))
                                            <span><h9>Valider : </h9> <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                                href="{{ route('facture.valider',['num_facture'=>$dbs[0]->num_facture,'id_facture_statut'=>$statut_facture->id_facture_statut]) }}"
                                                onclick="return confirm('Etes-vous sure de vouloir valider la Facture ?')"><i style="color : #4d94ff"
                                                    class="fas fa-check"></i></a></span><br>
                                        @else
                                            <span><h9>Valider : </h9> <i style="color : grey" class="fas fa-check fa-lg"></i></span><br>
                                        @endif
                                        @if ((($statut_facture->id_facture_statut >= 3)&&($statut_facture->id_facture_statut <= 6))||($statut_facture->id_facture_statut ==10))
                                            <span><h9>Envoyer : </h9> <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                                href="{{ route('facture.envoyer',['num_facture'=>$dbs[0]->num_facture,'id_facture_statut'=>$statut_facture->id_facture_statut]) }}"
                                                onclick="return confirm('Etes-vous sure de valider l\'envoie de la Facture ?')"><i style="color : #4ddbff"
                                                    class="fas fa-paper-plane"></i></a></span>
                                        @else
                                            <span><h9>Envoyer : </h9> <i style="color : grey" class="fas fa-paper-plane fa-lg"></i></span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="width:33%">
                        <div class="profile-header-content">
                            <table style="color:#333333">
                                <tr>
                                    <td style="padding:0 0 1rem 0;">
                                    <span style="  font-size: 2.5em;"> <b>Montant</b></span><br>
                                    <span style="  font-size: 1em;"><?php $nb=count($dbs)-1; ?>{{$statut_facture->statut_facture}}</span>
                                    </td>
                                    <td style="  font-size:5em;color:green;padding:0 0 0 0">
                                    <b> {{$dbs[0]->prix_facture}}€</b>

                                    </td>

                                </tr>
                                <tr>
                                    <td><b>description    <i style="cursor:pointer; color : #e6ac00" onclick="openUpdateDescripton()" class="fas fa-edit"></i>  : </b></td>
                                    <td>{{$dbs[0]->description_lib}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td >
                        <div class="profile-header-content">
                            <table style="color:#333333">
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
                                        <span><b> Emettre un Avoir </b></span>
                                    </td>
                                    <td style="font-size:1em">
                                        <span>  : - </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:1em;padding:1rem 0 0 0">
                                        <span><b> Date de creation</b></span>
                                    </td>
                                    <td style="font-size:1em;padding:1rem 0 0 0">
                                        {{-- @dd() --}}
                                        <span>  : {{ $dbs[0]->date_creation ? Carbon\Carbon::parse($dbs[0]->date_creation)->format('Y m d H:i:s') : '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:1em;padding:1rem 0 0 0">
                                        <span><b> Date d'émission</b></span>
                                    </td>
                                    <td style="font-size:1em;padding:1rem 0 0 0">
                                        {{-- @dd() --}}
                                        <span>  : {{ $date_emission ? Carbon\Carbon::parse($date_emission)->format('Y m d H:i:s') : '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:1em;padding:1rem 0 0 0">
                                        <span><b> Date d'échéance</b></span>
                                    </td>
                                    <td style="font-size:1em;padding:1rem 0 0 0">
                                        {{-- @dd() --}}
                                        <span>  : {{ $date_echeance ? Carbon\Carbon::parse($date_echeance)->format('Y m d H:i:s') : '-' }}</span>
                                    </td>
                                </tr>
                                <thead>
                                </thead>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- ------------------------------------------- -->
        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">

                            <table class="table table-profile">
                                <thead>
                                    <tr style="padding:0;">
                                        <th colspan="2"  style="padding:0;color:#333333" >Info Client </th>
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
                                    <tr>
                                        <td class="field">Lien</td>
                                        <td class="value">
                                            <a href="/clients.show/{{ $dbs[0]->id_contact }}" style="font-size:1em;padding:0 0 0 2rem;color:green"><b>Go</b></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <div class="profile-container">
                                    <div class="row row-space-20">
                                        <div class="col-md-4 hidden-xs hidden-sm">
                                            <div class="tab-content p-0">
                                                <div class="tab-pane active show" id="profile-about">
                        
                                                    <table class="table table-profile">
                                                        <thead>
                                                            <tr style="padding:0;">
                                                                <th colspan="2"  style="padding:0;color:#333333" >Lien Stripe </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="field">Lien: </td>
                                                                <td class="value">
                                                                    <a href="https://dashboard.stripe.com/test/invoices/{{$dbs[0]->id_stripe_paiement}}" style="font-size:1em;padding:0 0 0 0.4rem;color:green"><b>Go</b></a>
                                                                </td>
                                <thead>
                                    <tr style="padding:0;">
                                        <th colspan="2"  style="padding:0;color:#333333" >Liens Externes </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="field">Lien reservation</td>
                                        <td class="value">
                                            <a href="{{ route('reservationclient.show',['experience'=>$dbs[0]->num_facture]) }}" style="font-size:1em;padding:0 0 0 0.4rem;color:green"><b>Go</b></a>

                                        </td>
                                    </tr>
                                    @foreach ($experiences as $exp)
                                    <tr>
                                        <td class="field">Exp {{ $exp->id_experience }} - {{ $exp->nom_experience }}</td>
                                        <td class="value">
                                            <a href="{{ route('experience.show', ['id_experience'=>$exp->id_experience,'num_facture'=>$dbs[0]->num_facture]) }}" style="font-size:1em;padding:0 0 0 0.4rem;color:green"><b>Go</b></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
                                <thead>
                                    <tr>
                                        <th style="padding:2rem 0 0 0;" colspan="2">Evénements Facture </th>
                                    </tr>
                                </thead>
                            </table>




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
                                    <thead>
                                        <tr>
                                            <th style="padding:2rem 0 0 0;" colspan="2">Evénements Facture </th>
                                        </tr>
                                    </thead>
                                    </table>
                                    {{-- @dd($event_fact) --}}
                                    <div class="history-tl-container" style="line-height:1.5em; min-width:920px; ">
                                    <ul class="tl" >

                                        @foreach($event_fact as $event)
                                        <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 3rem 2rem">
                                     <div class="timestamp" style="padding:0 3rem 0 0;font-size:1em;color:#333333">
                                          {{$event->statut_facture}}<br>
                                    </div>
                                <div class="item-title" style="padding:0 3rem 0 0;font-size:0.7em;color:#333333;width:200px"><b>{{$event->date_statut}}</b> : {{$event->contenu_notification}}</div>
                                    @endforeach
                                </li>



                             </ul>

                            </div>
                        </div> <!-- ok --->
                    </div><!-- ok --->
                </div><!-- ok --->

                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                            <table class="table table-profile">
                                <tbody>
                                <tr>
                                    <td>
                                        <a class="btn btn-success" href="" style="margin-bottom : 10px ;padding: 0;color:black"> Ajouter</a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <b style="font-size:1.2rem">Dates</b>
                                        </td>
                                        </td>


                                </tr>

                                @if(count($taille)!=1)
                                @foreach($paiements as $pay)
                                <tr>
                                    <td>
                                        <b>Paiement:</b><b> {{$pay->id_paiment}}</b>
                                    </td>
                                    <td>{{$pay->libelle}}</td>
                                    <td style="  font-size:14px; color:#040b6b">
                                    @foreach($taille as $item)
                                    {{ $item->prix }}€
                                    @endforeach
                                   </td>
                                    <td>{{$pay->statut_paiement}}</td>
                                    <td style="width:130px;">{{ $pay->date_echeance ? Carbon\Carbon::parse($pay->date_echeance)->format('Y m d H:i:s') : '-' }}</td>
                                    <td>
                                        <a href="{{route('paiements.show',['paiement'=>$pay->id_paiment]) }}" style="font-size:1em;padding:0 0 0 0.4rem;color:green"><b>Go</b></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>
                                        <b>Paiement:</b><b> {{$dbs[0]->id_paiment}}</b>
                                    </td>
                                    <td>{{$dbs[0]->libelle}}</td>
                                    <td style="  font-size:14px; color:#040b6b">
                                    @foreach($taille as $item)
                                        {{ $item->prix }}€
                                    @endforeach
                                    </td>
                                    <td>{{$dbs[0]->statut_paiement}}</td>
                                    <td style="width: 130px;">{{$dbs[0]->date_echeance ? Carbon\Carbon::parse($dbs[0]->date_echeance)->format('Y m d H:i:s') : '-' }}</td>
                                    <td>
                                        <a href="{{route('paiements.show',['paiement'=>$dbs[0]->id_paiment]) }}" style="font-size:1em;padding:0 0 0 0.4rem;color:green"><b>Go</b></a>
                                    </td>
                                </tr>
                                @endif
                                </tbody>
                            </table>

                            <table>
                                <thead>
                                    <tr>
                                        <th style="padding:4rem 0 1rem 10rem;font-size:1.6em;color:#333333;" colspan="2">Facture : {{$dbs[0]->num_facture}}</th>
                                    </tr>
                                </thead>
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

                            {{-- </table> --> @dd($packs) --}}
                            <!-- -------------------------- yasser ---------------------------- -->
                            @if($packs->isEmpty() && $produits->isEmpty())
                                <div style="width: 300px;">Il n'y a pas de données </div>
                            @elseif(!empty($pack) || !empty($produits))
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
                                    {{-- @dd($packs) --}}

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

                            @endif

                            <!-- -------------------------- yasser ---------------------------- -->
                        </div>
                    </div>
                    <br>
                </div><!-- /.modal -->
                <!--**************************************************************************** -->
                <div class="col-md-4 ">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                            <table class="table table-profile">
                                <thead>
                                    <tr>
                                        <td>
                                        <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Imprimer</a>
                                        </td>
                                        <!-- --------------------------------yasser----------------------------------- -->
                                        <td>
                                            <!-- <button class="btn btn-primary btn-sm" onclick="openInt()" style="margin-left : 10px"><b style="color:white;font-size:0.5em">Intéraction</b></button> -->
                                            <div class="btn_plus" onclick="openInt()" >
                                                <div>Intéraction </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                    <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                        <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                        <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                    </g>
                                                </svg>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- <button class="btn btn-primary btn-sm" onclick="openStory()" style="margin-left : 10px"><b style="color:white;font-size:0.5em">Storytelling</b></button> -->
                                            <div class="btn_plus" onclick="openStory()" >
                                                <div>Storytelling </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                    <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                        <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                        <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                    </g>
                                                </svg>
                                            </div>
                                        </td>
                                        <!-- --------------------------------yasser----------------------------------- -->
                                        <td>
                                        <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Renvoyer</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('facture.valider',['num_facture'=>$dbs[0]->num_facture,'id_facture_statut'=>$statut_facture->id_facture_statut]) }}" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Valider</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Modifier</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('facture.envoyer',['num_facture'=>$dbs[0]->num_facture,'id_facture_statut'=>$statut_facture->id_facture_statut]) }}" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Envoyer</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="" style="margin-bottom : 10px ;color:black;width:100px;font-size:0.7rem;background-color:#DEDEDE"> Supprimer</a>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <br>
                </div><!-- /.modal -->
            </div><!-- ok --->
        </div><!-- ok --->
    </div><!-- ok --->
</div><!-- ok --->

<!-------------------------------------------Oumayma----------------------------------------------------- -->

<!-------------------------------------------Edit la description----------------------------------------------------- -->
<div class="formclt" id="form_clt">
    <div class="form-int" id="editFormdescription">
        <form action="{{route('factures.update_description', ['facture' => $dbs[0]->num_facture])  }}" method="post" class="form-container">
            @csrf
            <h4 style="text-align: start; margin-top: 30px;">Modifier la description</h4>
            <input type="hidden" id="num_facture" name="num_facture" value="{{ $num_facture }}">

            <div class="form-contact" style="margin-bottom: 30px; margin-top: 30px;">
                <input type="text" id="description_lib" style="margin: 0; background: white; border: 1px solid #000000; border-radius: 10px;" name="description_lib" value="{{ old('description_lib', $dbs[0]->description_lib) }}" >
            </div>

            <button type="submit" class="btn" style="width: 100px;">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeUpdateDescripton()" style="width: 100px; background: red;">Annuler</button>
        </form>
    </div>
</div>





<script>

     function openUpdateDescripton() {
        var div_descp_form = document.getElementById("editFormdescription");
        div_descp_form.style.display = "block";
        suggestion_tag_inter(div_descp_form);
        document.getElementById("description_lib").value = description_lib;

    }

    function closeUpdateDescripton() {
        document.getElementById("editFormdescription").style.display = "none";
    }

    function openInt() {
        document.getElementById("intForm").style.display = "block";
        }

        function closeInt() {
        document.getElementById("intForm").style.display = "none";
        }
        function openStory() {
        document.getElementById("storyForm").style.display = "block";
        }


        function closeStory() {
        document.getElementById("storyForm").style.display = "none";
        }
</script>

<div class="formclt">
    <div class="form-int" id="intForm">
        <form action="{{ route('factures.createinteraction') }}" method="post" class="form-container">
            @csrf
            <h4 style="text-align:start;margin-top:30px">Ajouter une nouvelle interaction liée à la réservation</h4>
            <input type="hidden" id="num_facture" name="num_facture" value="{{old('num_facture') ?? $dbs[0]->num_facture }}">

            <div class="form-contact" style="margin-bottom:20px;margin-top:30px">

                <select name="id_cnt" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Choisissez un Contact </option>
                    @foreach ($clients as $con)
                        <option value="{{ $con->id_contact }}"{{ $loop->first ? ' selected' : '' }}>
                            {{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}
                        </option>
                        <!-- <option value="{{ $con->id_contact }}" {{old('id_cnt') == $con->id_contact ? "selected" : ""}}>{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>     -->
                    @endforeach
                </select>

            <select name="id_exp" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                <option value="">Aucune Experience </option>
                @foreach ($experiences as $exp)
                    <option value="{{ $exp->id_experience }}"{{ $loop->first ? ' selected' : '' }}>
                        {{ $exp->id_experience }} - {{ $exp->nom_experience }}
                    </option>
                    <!-- <option value="{{ $exp->id_experience }}"{{old('id_exp') == $exp->id_experience ? "selected" : ""}}>{{ $exp->id_experience }} - {{ $exp->nom_experience }} </option>     -->
                @endforeach
            </select>
            </div>
            <div class="form-contact" style="margin-top:20px">
                <input type="text" name="type_int" class="form-control" value="{{old('type_int')}}"  placeholder="Type d'Interaction" style="background-color:white;border:2px black  solid">
            </div>
            <div class="form-contact" style="margin-top:20px">
                <!-- <input type="text" name="texte" class="form-control"  placeholder="Texte de l'Interaction" style="background-color:white;border:2px black  solid"> -->
                <textarea name="texte" class="form-control" value="{{old('texte')}}" cols="30" rows="5"  placeholder="Texte de l'Interaction" style="background-color:white;border:2px black  solid  ; margin-bottom:3px"></textarea>
            </div>
            <button type="submit" class="btn" style="width:100px">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeInt()" style="width:100px">Annuler</button>
            </form>
    </div>
    <div class="form-story" id="storyForm">
        <form action="{{ route('factures.createstorytelling') }}" method="post" class="form-container">
            @csrf
            <input type="hidden" id="num_facture" name="num_facture" value="{{old('num_facture') ?? $dbs[0]->num_facture }}">


            <h4 style="text-align:start;margin-top:30px">Ajouter un nouveau storytelling à une experience </h4>

            <select name="id_exp" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                <option value="">Selectionnez une Experience </option>
                @foreach ($experiences as $exp)
                    <option value="{{ $exp->id_experience }}"{{ $loop->first ? ' selected' : '' }}>
                        {{ $exp->id_experience }} - {{ $exp->nom_experience }}
                    </option>
                    <!-- <option value="{{ $exp->id_experience }}" {{old('id_exp') == $exp->id_experience ? "selected" : ""}}>{{ $exp->id_experience }} - {{ $exp->nom_experience }} </option>     -->
                @endforeach
            </select>
            <div class="form-contact" style="margin-top:20px">
                <input type="text" name="desc_content" class="form-control" value="{{old('desc_content')}}" placeholder="Description Contents Experience" style="background-color:white;border:2px black  solid">
            </div>
            <div class="form-contact" style="margin-top:20px">
                <!-- <input type="text" name="desc_story" class="form-control"  placeholder="Description Storytelling" style="background-color:white;border:2px black  solid"> -->
                <textarea name="desc_story" class="form-control" value="{{old('texte')}}" cols="30" rows="5" placeholder="Description Storytelling" style="background-color:white;border:2px black  solid; margin-bottom:3px"></textarea>
            </div>

            <button type="submit" class="btn" style="width:100px">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeStory()" style="width:100px">Annuler</button>
            </form>
    </div>
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
    #M54{
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

<style>
    /* Stylez et fixez le bouton sur la page */

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
    .form-pay {
    display: none;
    position: fixed;
    left:55%;
    top: 1%;
    transform: translate(-45%, 5%);
    border:3px black solid;
    border-radius:10px;

    }

    /* Masquez la forme Popup */
    .form-int {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-75%, -50%);
        z-index: 9998;
        border:3px black solid;
        border-radius:10px;

    }
    .form-story {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-25%, -50%);
        z-index: 9999;
        border:3px black solid;
        border-radius:10px;

    }
    /* Masquez la forme Popup */
    .form-pck {
    display: none;
    position: fixed;
    left:55%;
    top: 15%;
    transform: translate(-45%, 5%);
    border:3px black solid;
    border-radius:10px;

    }
    .form-crepck{
    display: none;
    position: fixed;
    left:55%;
    top: 15%;
    transform: translate(-45%, 5%);
    border:3px black solid;
    border-radius:10px;
    }
    .form-crepro{
    display: none;
    position: fixed;
    left:55%;
    top: 15%;
    transform: translate(-45%, 5%);
    border:3px black solid;
    border-radius:10px;
    }
    .form-creclt{
    display: none;
    position: fixed;
    left:55%;
    top: 1%;
    transform: translate(-45%, 5%);
    border:3px black solid;
    border-radius:10px;
    }
    /* Styles pour le conteneur de la forme */
    .form-container {
        overflow: auto;
        max-height: 80vh;
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


    /* -------------yasser------------ */
    .btn_plus{
        width:115px;
        display:flex;
        justify-content:space-evenly;
        align-items:center;
        cursor: pointer;
        font-weight: bold;

    }
</style>
@endsection
