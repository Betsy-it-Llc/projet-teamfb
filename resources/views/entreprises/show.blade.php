@extends('layouts.navadmin')
@section('content')

<head>
<title>{{ $organisation->nom }} </title>
<link rel="shortcut icon" href="data:image/png;base64,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">
</head>
<div class="container"  style="width:100%;margin:0">
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
    <div id="content" class="content p-0" >
        <div class="profile-header" style="margin-bottom :50px;">
        <center>
            <b style="margin-bottom :20px;font-size:2.5rem;">Info Entreprise</b>
        </center>    
            
        </div>
        <br>
        <div class="profil-container">
        <table>
                <tr>
                    <td>
                    <div class="profile-header-content">
                            <div class="profile-header-img" style="background:none;padding:0;height:110%">
                                     <img src="data:image/png;base64,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" alt="Admin" class="rounded-circle p-1 bg-primary" width="100px">
                                     <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                                    href="/entreprises.edit/{{$organisation->id_organisation}}"><i style="color : green;"
                                        class="fas fa-edit fa-lg"></i></a>
                                     <button formaction="{{ route('entreprises.destroy', $organisation->id_organisation) }}"
                                    style="background:none ; border : none;" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : red" class="fas fa-trash fa-lg"></i></button>
                                    </div >
                    </div>      
                    </td>
                    <td>
                    <div class="profile-header-name" style="width:140%">
                           <table style="margin-left:-30px;width:110%">
                            <th colspan="3">
                            <b style="font-size:2.3em;"> {{ $organisation->nom }}</b>
                            </th>
                            <tr>
                                <td style="text-align:right;width:40%"><b>id: </b></td>
                                <td style="text-align:center">{{ isset($contact_principal[0]) ? $contact_principal[0]->id_contact : '' }}</td>
                                
                            </tr>
                            <tr>
                            <td style="text-align:right;width:40%"><b>Nom: </b></td>
                            <td style="text-align:center">{{ isset($contact_principal[0]) ? $contact_principal[0]->nom  : '' }}</td>
                            </tr>
                            <tr>
                            <td style="text-align:right;width:40%"><b >Prenom: </b></td>
                            <td style="text-align:center">{{ isset($contact_principal[0]) ? $contact_principal[0]->prenom : ''}}</td>
                            </tr>
                           </table>
                           
                    </td>

                </tr>

            </table>

            {{-- @dd($rem_org_liee) --}}
                   
        </div> 
        <div>
            
        </div>
        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-4 hidden-xs hidden-sm" style="max-width:25%">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                            <table class="table table-profile">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;color:#333333"  colspan="2">Info Entreprise </th>
                                    </tr>
                                    <tr style="font-size:1rem;">
                                       <td style="padding:0 0 0.5rem 0;"><b> Id : {{ $organisation->id_organisation }}</b></td>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <tr>
                                        <td class="field">Nom: </td>
                                        <td class="value">
                                        {{ $organisation->nom }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Email: </td>
                                        <td class="value">
                                        {{ $organisation->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Tel:</td>
                                        <td class="value">
                                            {{ $organisation->tel }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Adresse: </td>
                                        <td class="value">
                                            {{ $organisation->adresse }} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Code Postale: </td>
                                        <td class="value">
                                        {{ $organisation->code_postal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Ville : </td>
                                        <td class="value">
                                        {{ $organisation->ville }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width:50%">Numero CSE : </td>
                                        <td class="value" >
                                            {{ $organisation->num_cse }}
                                        </td>
                                    </tr>
                                  
                                    
                                </tbody>
                            </table>
                            <table class="table table-profile">
                            <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;color:#333333"  colspan="2">Description</th>
                                    </tr>
                            </thead>
                            <tbody>
                                    <tr style="float:left ">
                                        <td style="text-align: justify;padding:0.5rem">{{ $organisation->description }}</td>
                                    </tr>
                            </tbody>        
                            </table>
                            <table class="table table-profile" style="margin:0">
                                <thead>
                                    <tr>
                                    <th style="padding:0;color:#333333"  colspan="2">Evenements</th>
                                    </tr>
                                </thead>
                                    <tbody >
                                    <tr style="padding:0;">
                                    <td style="padding:0;">
                                                    
                                    <div class="history-tl-container" style="line-height:1.5em; min-width:920px; ">
                                    
                                    <ul class="tl" >
                                    
                                    <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 2rem 2rem">
                                    <div class="timestamp" style="padding:0 2rem 0 0;font-size:1em;color:#333333">2023 03 30
                                    <br> 
                                    </div>
                                    <div class="item-title" style="padding:0 2rem 0 0;font-size:0.7em;color:#333333;width:200px"><b>View 1</b>  </div>
                                
                                    </li>
                                    
                                    <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 2rem 2rem">
                                    <div class="timestamp" style="padding:0 2rem 0 0;font-size:1em;color:#333333">2023 03 30
                                    <br> 
                                    </div>
                                    <div class="item-title" style="padding:0 2rem 0 0;font-size:0.7em;color:#333333;width:200px"><b>View 1</b>  </div>
                                
                                    </li>
                                    <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 2rem 2rem">
                                    <div class="timestamp" style="padding:0 2rem 0 0;font-size:1em;color:#333333">2023 03 30
                                    <br> 
                                    </div>
                                    <div class="item-title" style="padding:0 2rem 0 0;font-size:0.7em;color:#333333;width:200px"><b>View 3</b> </div>
                                
                                    </li>
                                    <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 2rem 2rem">
                                    <div class="timestamp" style="padding:0 2rem 0 0;font-size:1em;color:#333333">2023 03 30
                                    <br> 
                                    </div>
                                    <div class="item-title" style="padding:0 2rem 0 0;font-size:0.7em;color:#333333;width:200px"><b>View 4</b></div>
                                
                                    </li>
                                    

                                    </ul>
                                    
                                    
                                    </div> 
                                    </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs hidden-sm" style="max-width:25%">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                        <table class="table table-profile" >
                                <thead>
                                    <tr>
                                        <th  style="padding:0;color:#333333" colspan="2">Remises
                                            <svg style="cursor:pointer; " onclick="openPopup()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                    <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                    <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                </g>
                                            </svg>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            
                            <table style="margin-right:-220px;margin-top: 30%;min-height:10%">
                                <tbody >
                                <tr>
                                <td><b style="margin-right:20px">Nom</b></td>
                                <td><b style="margin-right:20px">Code</b></td>
                                <td><b style="margin-right:20px">Taux</b></td>
                                <td><b style="margin-right:20px">nb</b></td>
                                <td><b style="margin-right:20px">Restant</b></td>
                                </tr>
                                @foreach ($rem_org_liee as $remOrg)
                                <tr style="text-align:center">
                                    <td>{{ $remOrg->nom_remise }}</td>
                                    <td>
                                    @if(!is_null($remOrg->code))
                                    {{ $remOrg->code }}
                                    @else
                                    <b> - </b>
                                    @endif
                                </td>
                                {{-- @dd($rem_org_liee) --}}
                                    <td>{{ $remOrg->taux }}%</td>
                                    <td><b>
                                        @if(is_null($remOrg->nb_utilisation))
                                        -
                                        @else
                                        {{ $remOrg->nb_utilisation }}
                                    @endif
                                    </b></td>

                                    @if(is_null($remOrg->nb_utilisation)||is_null($remOrg->nb_code))
                                    <td><b> - </b></td>
                                    @else
                                    <td><b>{{ $remOrg->nb_utilisation - $remOrg->nb_code }}</b></td>
                                    @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>    
                                <div class="popup_remise" id="popup_remise" style="display:none">
                                    <form action="{{route('entreprises.insertremise')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_org" value="{{ $organisation->id_organisation  }}">
                                        
                                    <h5>Sélectionnez une remise :</h5>
                                    <select  name="id_remise" class="remise_select">
                                      <!-- Options du select -->
                                      @foreach($allRem as $remise)
                                      <option value="{{$remise->id_remise}}">{{$remise->id_remise}} : {{$remise->nom_remise}}</option>
                                     @endforeach
                                    </select>
                                    <svg style="cursor:pointer;" onclick="openCreateRemisePopup()"   xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                            <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                            <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                            <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                        </g>
                                    </svg>
                                    <button class="btn btn-success" type="submit" >Ajouter</button>
                                    <button class="btn btn-danger" onclick="closePopup()" type="button">Annuler</button>
                                </form>
                                  </div>
                                
                                  <div class="create_remise_popup" id="create_remise_popup" style="display:none">
                                    <form action="{{ route('entreprises.createremise') }}" method="post">
                                        @csrf
                                        <h5>Création de nouvelle remise :</h5>
                                        <!-- Champs pour la création de la remise -->
                                     <input type="hidden" name="id_organisation" value="{{$organisation->id_organisation}}"> 
                                        <input type="text" name="nom_remise" placeholder="Nom" class="form-control">
                                        <input type="text" name="type_remise" placeholder="Type" class="form-control">
                                        <input type="text" name="taux" id="" placeholder="Taux*" class="form-control w-75 d-inline"> <a href=""><b style="font-size:2em;color:green">%</b></a> 
                                        <input type="text" name="montant" id="" placeholder="Montant*" class="form-control w-75 d-inline"> <a href=""><b style="font-size:2em;color:green">€</b></a>  
                                        <h6>Date début</h6>
                                        <input type="date" name="date_debut" id="" class="form-control">
                                        <h6>Date fin</h6>
                                        <input type="date" name="date_fin" id="" class="form-control" style="margin-bottom: 10px">                                        <!-- Autres champs nécessaires -->
                                        <button class="btn btn-success" type="submit">Créer remise</button>
                                        <button class="btn btn-danger" type="button" onclick="closeCreateRemisePopup()">Annuler</button>
                                    </form>
                                </div>
                                


                                   
                            
                            <table class="table table-profile" style="margin-top:75px">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0 0 2rem 0;color:#333333"  colspan="2">Performances  </th>
                                    </tr>
                                  
                                </thead>
                               
                                <tbody>
                                    <tr>
                                        <td class="field" style="width:90%;">Nombre de factures: </td>
                                        <td class="value">
                                            {{ $nb_fact->facts }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Nombre d'experiences achetées: </td>
                                        <td class="value">
                                            {{ $total_exp->exp }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Nombre d'experiences vécues:</td>
                                        <td class="value">
                                        {{ $exp_vecu->exp }}
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            </table>
                            
                        </div>
                        <div>
            <!-- ------------------- Content Storytelling ---------------------------- -->
                        <table style="width: 230%;margin-top:70px">
                                   <thead>
                                        <tr>
                                        <th colspan="2" style="padding:0 0 1rem 0;"><b style="font-size:2.5em;color:#333333">Content Storytelling </th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    <form method="post">
                                    @csrf
                                    @method('DELETE')
                                        @foreach ($storytelling as $story)
                                        <tr>
                                            <td style="text-align: center;">
                                                {{ Carbon\Carbon::parse($story->date_heure)->format('Y m d H:i') }}
                                            </td> 
                                        </tr>
                                        <tr style="float:left ;border-radius:10px;">
                                            <td style="white-space: pre-line; text-align: justify;padding:0.5rem"> {{ $story->description }} </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center">
                                                <!-- ----------------------------------- -->
                                                <div  class="btn_upd_sto btn btn-primary"  data-value="{{ $story->id_storytelling }}" style="background-color : #fff ; border : #fff;font-size:0.85rem; margin-right:-10px;">
                                                    <i style="color : #e6ac00" class="fas fa-edit  "></i>
                                                </div>
                                                <!-- ------------------------------------- -->
                                                <button formaction="/entreprises.destroystorytelling/{{ $story->id_storytelling }}/{{ $organisation->id_organisation }}"
                                                    style="background-color : #fff ; border : #fff; font-size:0.85rem; margin-left:-5px;" type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Vous êtes sûrs de vouloir supprimer ce storytelling ?')"><i
                                                        style="color : #cc3300" class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </form>
                                    </tbody>

                                </table>
            <!-- ------------------- Content Storytelling : fin ---------------------------- -->
                                <table style="width: 120%;">
                                   <thead>
                                        <tr>
                                        <th colspan="2" style="padding:1rem 0 1rem 0"><b style="font-size:2.5em;color:#333333">Bénéficiaires CSE </th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                                                          
                            <table style="width: 390%;">
                                <tbody >
                                @foreach ($beneficiaires as $ben)
                                <tr style="text-align:center">
                                    <td>{{ $ben->id_contact }}</td>
                                    <td>{{ $ben->nom }}</td>
                                    <td>{{ $ben->prenom }}</td>
                                    <td>{{ $ben->email }}</td>
                                    <td>{{ $ben->tel }}</td>
                                    <td>{{ $ben->profil }}</td>
                                    <td>{{ Carbon\Carbon::parse($ben->date_creation)->format('Y m d')}}</td>
                                    
                                    <td><a href="/contacts.show/{{$ben->id_contact}}"><b style="color:red">GO</b></a></td>
                                    </tr>
                                @endforeach
                                
                                
                                
                                
                                </tbody>
                            </table> 
                        </div>
                        
                    </div>
                    <br>
                </div><!-- /.modal -->
                <div class=" " style="max-width:25%">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about" style="margin-right:-100px">
                        <table class="table table-profile" >
                                <thead>
                                    <tr style="padding:0;" >
                                        <th style="padding:0;color:#333333"  colspan="2" >Liste Expériences  </th>
                                    </tr>
                                    
                                </thead>
                            </table >
                            <table style="margin-top:-15px;margin-bottom:0px;width:100%">
                                    <tr >
                                        <td id="dash" style="color:#333333;"><b>payé </b><br>{{ $paye }}</td>
                                        
                                        <td id="dash" style="color:#333333;"><b>présenté </b><br>{{ $enregistre }} </td>
                                        
                                        <td id="dash" style="color:#333333;"><b>commencé </b><br>{{ $commence }} </td>
                                        <td id="dash" style="color:#333333;"><b>Terminé </b><br>{{ $termine }} </td>
                                     </tr>
                            </table>
                            <table style="width:100%">
                                <tbody >
                                <tr style="text-align:center">
                                <td><b style="margin-right:20px;margin-left:10px">Id Exp</b></td>
                                <td><b style="margin-right:20px">Profil</b></td>
                                <td><b style="margin-right:20px">Num Exp</b></td>
                                <td><b style="margin-right:20px">Statut</b></td>
                                <td><b style="margin-right:20px"></b></td>
                                </tr>
                                @foreach ($experiences as $exp)
                                <tr style="text-align:center">
                                    <td>{{ $exp->id_experience }}</td>
                                    <td>???</td>
                                    <td>{{ $exp->numero_experience }}</td>
                                    <td>{{ $exp->statut_experience }}</td>
                                    <td><a href="{{ route('experience.show', ['id_experience'=>$exp->id_experience,'num_facture'=>$exp->num_facture]) }}"><b style="color:red">GO</b></a></td>
                                    </tr>
                                @endforeach
                                
                                                  
                                                                
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <br>
                </div><!-- /.modal -->
                <div class="col-md-4 " style="max-width:25%">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about" style="margin-left:40px">
                        <table class="table table-profile" style="margin-left:70px">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;color:#333333"  colspan="3">Facture Info  </th>
                                    </tr>
                                    
                                </thead>
                            </table >
                            
                            <table style="margin-bottom:10px;margin-left:50px;width:170%">
                                <tbody >
                                <tr>
                                <td><b style="margin-right:10px;margin-left:0">Num </b></td>
                                <td><b style="margin-right:10px">Date</b></td>
                                <td><b style="margin-right:10px">Montant</b></td>
                                <td><b style="margin-right:10px">Statut</b></td>
                                <td><b style="margin-right:10px"></b></td>
                                </tr>
                                @foreach ($factures as $fac)
                                <tr style="text-align:center">
                                    <td>{{$fac->num_facture }}</td>
                                    <td>{{ $fac->date_statut }}</td>
                                    <td>{{ $fac->prix_facture }}€</td>
                                    <td>{{ $fac->statut_facture }}</td>
                                    <td><a href="/factures/{{ $fac->num_facture }}"><b style="color:red">GO</b></a></td>
                                    </tr>    
                                @endforeach
                                
                                
                                                                  
                                                                
                                </tbody>
                            </table>
                        <table class="table table-profile" style="margin-left:70px;margin-top:60px">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;color:#333333"  colspan="3">Paiement </th>
                                    </tr>
                                    
                                </thead>
                            </table >
                            
                            <table style="margin-bottom:10px;margin-left:50px;width:170%">
                                <tbody >
                                <tr>
                                <td><b style="margin-right:10px;margin-left:0">Facture </b></td>
                                <td><b style="margin-right:10px">Montant</b></td>
                                <td><b style="margin-right:10px;">Statut</b></td>
                                <td><b style="margin-right:10px">Stripe</b></td>
                                </tr>
                                @foreach ($paiements as $pay)
                                <tr style="text-align:center">
                                    <td>{{ $pay->num_facture }}</td>
                                    <td>{{ $pay->prix }}€</td>
                                    <td>{{ $pay->statut_paiement }}</td>
                                    <td><a href="/paiementss.show/{{$pay->id_paiment}}"><b style="color:blue">S</b></a></td>
                                    </tr>
                                @endforeach
                                                         
                                                                
                                </tbody>
                            </table>
                                                           
                           
                        </div>
                    </div>
                    </div>
                    </div>
                    
                    </div>
<script>
//******************** yasser *****************************
const csrfToken = "{{ csrf_token() }}";
        // ---------------------
        var popupActivated = false;
        console.log(popupActivated);
        var content = document.getElementById('content');
        // ---------------------

//---------------------------------storytelling--------------------------------
        $(document).ready(function() {
            $(document).ready(function() {
                $('.btn_upd_sto').each(function() {
                    var dataValue = $(this).data('value');
                    // console.log(dataValue)
                    // ___________________________________________________
                    $(this).on('click', function() {
                        // chercher les data necessaire pour cet élément
                        $.ajax({
                            url: '/storytellings.edit_show_storytelling/' + dataValue ,
                            method: 'GET',
                            success: function(response) {
                                // faire le traitement
                                popup_storytelling(response);
                                
                            },
                            error: function(error) {
                                // Gérer les erreurs
                            }
                        });
                        //_________________________________________________
                    });
                });
            });
        });


        function popup_storytelling(story){
            // ---------------------
            popupActivated = true;
            console.log(popupActivated);
            // ---------------------
            const cardBody = document.createElement('form');
            cardBody.classList.add('card-body', 'my-card-body');
            cardBody.action = "{{ route('storytellings.update_show_storytelling') }}";
            cardBody.method = 'POST';

            // Ajouter le jeton CSRF
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = "{{ csrf_token() }}"; // Insérer la balise Blade pour le jeton CSRF
            cardBody.appendChild(csrfToken);

            // Ajoutez le champ _method pour simuler une requête PUT
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            cardBody.appendChild(methodField);
            // Ajouter l'id_story
            const id_story = document.createElement('input');
            id_story.type = 'hidden';
            id_story.name = 'id_storytelling';
            id_story.id = 'id_storytelling';
            id_story.value =  story.id_storytelling ; // Insérer la balise Blade pour le jeton CSRF
            cardBody.appendChild(id_story);

            // h1
            const heading = document.createElement('h1');
            heading.classList.add('my-heading');
            heading.textContent = 'Modification Storytelling';
            cardBody.appendChild(heading);
            //--------- div erreur ------------
            const newDiv = document.createElement('div');
            newDiv.style.padding = "10px";
            newDiv.style.color = 'red';
            newDiv.style.display = "none";
            cardBody.appendChild(newDiv);
            // --------------------------------
            // label 1
            const descContentLabel = document.createElement('label');
            descContentLabel.setAttribute('for', 'desc_content');
            descContentLabel.textContent = 'Description Content';
            cardBody.appendChild(descContentLabel);
            // input 1
            const descContentInput = document.createElement('input');
            descContentInput.type = 'text';
            descContentInput.name = 'desc_content';
            descContentInput.classList.add('form-control');
            descContentInput.placeholder = 'Description Content';
            descContentInput.value = story.description_;
            descContentInput.style.width = '385px';
            descContentInput.style.border = '2px #888888 solid';
            cardBody.appendChild(descContentInput);
            // label 2 
            const descStoryLabel = document.createElement('label');
            descStoryLabel.setAttribute('for', 'desc_story');
            descStoryLabel.textContent = 'Description Storytelling';
            cardBody.appendChild(descStoryLabel);
            // inout 2 : textarea
            const descStoryTextarea = document.createElement('textarea');
            descStoryTextarea.name = 'desc_story';
            descStoryTextarea.classList.add('form-control');
            descStoryTextarea.placeholder = 'Description Storytelling';
            descStoryTextarea.style.whiteSpace = 'pre-line';
            descStoryTextarea.style.width = '385px';
            descStoryTextarea.style.border = '2px #888888 solid';
            descStoryTextarea.style.marginBottom = '50px';
            descStoryTextarea.cols = '30';
            descStoryTextarea.rows = '5';
            descStoryTextarea.textContent = story.description ;
            cardBody.appendChild(descStoryTextarea);
            // -----------------------------------------------
            const div_btns = document.createElement('div');
            div_btns.classList.add('div_boutons');
            

            const submitButton = document.createElement('button');
            submitButton.type = 'submit';
            submitButton.className = 'btn btn-info my-button';
            submitButton.textContent = 'Modifier';
            div_btns.appendChild(submitButton);

            
            // ------------------envoie formulaire ---------------------------
            submitButton.addEventListener('click', function() {
                // Empêcher le comportement par défaut du formulaire
                event.preventDefault();
                // Effacer les enfants de la newDiv s'ils existent déjà
                while (newDiv.firstChild) {
                    newDiv.removeChild(newDiv.firstChild);
                }
                // Effectuer la requête AJAX vers le contrôleur pour le traitement
                const formData = new FormData(cardBody);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', cardBody.action, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Traitement réussi
                        // const response = JSON.parse(xhr.responseText);
                        // console.log(response);
                        
                        location.reload();
                    } else {
                        // Traitement échoué
                        const response = JSON.parse(xhr.responseText);
                        if (response.hasOwnProperty('errors')) {
                            const errors = response.errors;
                            Object.keys(errors).forEach(field => {
                                const errorMessages = errors[field];
                                errorMessages.forEach(errorMessage => {
                                    console.log(errorMessage);
                                    newDiv.style.display = "grid";
                                    const newP = document.createElement('div');
                                    newP.textContent = errorMessage;
                                    newDiv.appendChild(newP)
                                });
                            });
                        }
                        
                    }
                };
                xhr.send(formData);
            });
            // ----------------------------------------------
            
            const cancelButton = document.createElement('div');
            cancelButton.className = 'btn btn-danger my-button';
            cancelButton.textContent = 'Annuler';
            div_btns.appendChild(cancelButton);

            cardBody.appendChild(div_btns);
            // --------------------------------------------------
            
            const card = document.createElement('div');
            card.classList.add('card', 'my-card');
            card.appendChild(cardBody);

            // ---------- append le pupup à la page-------------
            content.appendChild(card);
            // -------------------------------------------------
            if (popupActivated === true) {
                cancelButton.addEventListener('click', function() {
                    if (content.contains(card)) {
                        content.removeChild(card);
                    }
                    popupActivated = false;
                    console.log(popupActivated);
                });

                content.addEventListener('click', function(event) {
                    if (!card.contains(event.target) && content.contains(card)) {
                        content.removeChild(card);
                        popupActivated = false;
                        console.log(popupActivated);
                    }
                });
            }
        }

        const svg = document.querySelector('svg');
  const popup = document.getElementById('popup_remise');
  const selectOption = document.getElementById('selectOption');

  // Fonction pour ouvrir la pop-up
  function openPopup() {
    popup.style.display = 'block';
  }
  function closePopup() {
    popup.style.display = 'none';
  }

  function openCreateRemisePopup() {
        // Afficher le pop-up pour créer une nouvelle remise
        document.getElementById("create_remise_popup").style.display = "block";
    }

    function closeCreateRemisePopup() {
        // Fermer le pop-up pour créer une nouvelle remise
        document.getElementById("create_remise_popup").style.display = "none";
    }

</script>

<STYLE>
    body {
        background: #eaeaea;
    }
    
    .popup_remise , .create_remise_popup{
        position: absolute;
  
  left: 300px;
  z-index: 1;
  display: none;
  background-color: #f9f9f9;
  min-width: 300px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 16px;
  text-align: center;
    }
    /* .create_remise_popup{
        width: 350px;
    } */
    .remise_select {
  width: 80%;
  padding: 8px;
  margin-bottom: 8px;
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
        #pageSubmenu17{
        visibility:visible;
        display:block;
        }
        #pageSubmenu18{
        visibility:visible;
        display:block;
        }
        #M91{
        background-color: #747474;
        }
#dash{
    
    font-size:0.9em;
    text-align:center;
    
}
</STYLE>

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



/* --------------------popup------------------- */
.my-card {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width: 420px;
        background-color: #DEDEDE;
    }

    .my-card-body {
        margin: 0;
        padding: 20px;
    }

    .my-heading {
    margin-bottom: 40px;
    }

    .my-select {
    background-color: #eee;
    margin-bottom: 20px;
    width: 385px;
    height: 50px;
    float: left;
    border-radius: 4px;
    }


    .my-input {
    width: 385px;
    border: 2px #888888 solid;
    }

    .my-description-heading {
    color: black;
    margin-right: 50px;
    }

    .my-textarea {
        white-space: pre-line;
        width: 385px;
        height: 80px;
        border: 2px #888888 solid;
        margin-bottom: 20px;
    }

    .my-button {
        margin-left: 0px;
    }

    .div_boutons{
        display: flex;
        justify-content: space-evenly;
    }
</style>

@endsection