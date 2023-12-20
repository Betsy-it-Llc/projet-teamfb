@extends('layouts.navadmin')
@section('content')
<div class="container"  style="width:100%;margin:0">
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

    <div id="content" class="content p-0" >
        <div class="profile-header">
            <center>
                <b style="margin-bottom :20px;font-size:2.5rem;"> Info Client</b>
            </center>

        </div>
        <br>

        <div class="profil-container">
            <table>
                <tr>
                    <td>
                        <div class="profile-header-content">
                            <div class="profile-header-img" style="background:none;height:110%">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU" alt="Admin" class="rounded-circle p-1 bg-primary" width="130px">
                                <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                                    href="/contacts.edit/{{$con->id_contact}}">
                                    <i style="color : green;" class="fas fa-edit fa-lg"></i>
                                </a>

                                <button formaction="{{ route('contacts.destroy', $con->id_contact) }}"
                                    style="background:none ; border : none;" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')">
                                    <i style="color : red" class="fas fa-trash fa-lg"></i>
                                </button>
                               <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                               href="{{$con->url_contact_folder}}"><i style="color: blue" class="fas fa-light fa-folder-open"></i></a>

                               <button style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                                    onclick="openForm()">
                               <i class="fas fa-solid fa-receipt" style="color: #477628;"></i>
                               </button>
                            </div >
                        </div>

                    </td>

                    <div class="code-popup ">
                            <form action="{{ route('clients.createcode', ['contact' => $con->id_contact]) }}" method="post">
                                <div class="form-code" id="popupForm" style="background-color: #c8c7cc">

                                @csrf
                                <h2>Création Code Parrainage</h2>
                                <div class="form-contact" style="margin-bottom:20px">
                                    <select name="id_remise" id="pet-select"
                                        style="margin-left:30%;background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                                        <option value="" selected>Choisissez une remise </option>
                                        @foreach ($remises as $rem)
                                            <option value="{{ $rem->id_remise }}"{{old('id_remise')== $rem->id_remise ? "selected" : ""}}> {{ $rem->id_remise }} - {{ $rem->nom_remise }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-contact" style="margin-top:20px">
                                    <input type="text" name="code" class="form-control" value="" placeholder="Code"
                                        style="width:385px;margin-left:30%;border:2px #888888  solid">
                                </div>
                                <div class="form-contact" style="margin-top:20px">
                                    <input type="text" name="nb_utilisation" class="form-control" value="" placeholder="Nb d'utilisation"
                                        style="width:385px;margin-left:30%;border:2px #888888  solid">
                                </div>
                                <div style="margin-top:10px">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                <button type="button" class="btn btn-danger" onclick="closeForm()">Annuler</button>
                                </div>
                            </div>
                            </form>

                    </div>

                    <td>
                        <div class="profile-header-name" >
                            <table>
                                <th colspan="3">
                                    <b style="font-size:2.3em;"> {{ $con->prenom }} {{ $con->nom }}</b>
                                </th>
                                <tr>
                                    <td style="text-align:right;width:40%"><b>id contact : </b></td>
                                    <td style="text-align:center">{{ $con->id_contact }}</td>

                                </tr>

                                <tr>
                                    <td style="text-align:right;width:40%"><b>Persona : </b></td>
                                    @foreach($personas as $index=>$persona)
                                        <td style="text-align:center">{{ $persona->tag }}</td>
                                    @endforeach
                                    <td class="btn_plus text-center" style="text-align:center; width:20px;height:20px" onclick="openPersonna()">
                                        {{-- Ilham --}}
                                                <i style="cursor:pointer; color: #e6ac00" class="fas fa-edit"></i>
                                        {{-- Ilham --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;width:40%"><b >Profil : </b></td>
                                    <td style="text-align:center">{{ $con->profil }}</td>

                                </tr>

                            </table>
                            {{-- @dd($con) --}}
                                        <!-- n'est pas utilisé
                                                <table>

                                                </table>
                                            -->
                    </td>
                </tr>
            </table>
        </div>

        <div class="infoEntreprise" style="position: absolute;top:15%;left:75%">
            @if (!is_null($entreprise))
            <table class="table table-profile" style="margin-bottom:25px">
                <thead>
                <tr style="padding:0;">
                    <th style="padding:0 0 0 0;"  colspan="2">Entreprise liée   </th>
                </tr>
                <tr style="font-size:1rem;">
                   <td style="padding:0rem 0;"><b> Id :{{ $entreprise->id_organisation }}</b></td>
                </tr>

                </thead>
                <tbody>
                <tr>
                    <td class="field">Nom: </td>
                    <td class="value">
                    {{ $entreprise->nom }}
                    </td>
                </tr>

                <tr>
                    <td class="field">Email:</td>
                    <td class="value">
                        {{ $entreprise->email }}
                    </td>
                </tr>
                <tr>
                    <td class="field">Tel: </td>
                    <td class="value">
                        {{ $entreprise->tel }}
                    </td>
                </tr>
                <tr>
                    <td class="field">Adresse: </td>
                    <td class="value">
                        {{ $entreprise->adresse }}
                    </td>
                </tr>
                <tr>
                    <td class="field">CP: </td>
                    <td class="value">
                        {{ $entreprise->code_postal }}
                    </td>
                </tr>
                <tr>
                    <td class="field">Ville : </td>
                    <td class="value">
                        {{ $entreprise->ville }}
                    </td>
                </tr>
                <tr>
                    <td class="field" style="width:50%">N° CSE : </td>
                    <td class="value" >
                        {{ $entreprise->num_cse }}
                    </td>

                </tr>
                <tr>
                    <td><a style="color : blue"
                        href="{{ route('entreprises.show', ['id_organisation'=>$entreprise->id_organisation]) }}">GO</a></td>


                    </tr>
                </tbody>

            </table>
            @endif
        </div>
        <!-- <div> pk c ouvert ?

        </div> -->
        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-4 hidden-xs hidden-sm" style="max-width:25%">
                    <div class="tab-content p-0 le_rectangle">
                        <div class="tab-pane active show" id="profile-about">
                    <!-- ------------------------Info Client----------------------------- -->
                            <table class="table table-profile" style="margin-left:-50px">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;"  colspan="2">Info Client  </th>
                                    </tr>
                                    <tr style="font-size:1rem;">
                                       <td style="padding:0 0 0.5rem 0;"><b> Id : {{ $con->id_contact }}</b></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="field">Nom: </td>
                                        <td class="value">
                                        {{ $con->nom }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Prenom: </td>
                                        <td class="value">
                                        {{ $con->prenom }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Email:</td>
                                        <td class="value">
                                            {{ $con->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Tel: </td>
                                        <td class="value">
                                            {{ $con->tel }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Adresse: </td>
                                        <td class="value">
                                            {{ $con->adresse }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Code Postale: </td>
                                        <td class="value">
                                        {{ $con->code_postal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Ville : </td>
                                        <td class="value">
                                        {{ $con->ville }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width:50%">Numero CSE : </td>
                                        <td class="value" >
                                            {{ $con->num_cse }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field"><b >Lien : </b></td>
                                        <td class="value">
                                            @if(is_null($con->url_contact_folder))
                                               Il n'y a pas de lien.
                                              @else
                                               {{$con->url_contact_folder}}
                                              @endif
                                          </td>
                                    </tr>
                                </tbody>
                            </table>

                <!-- ------------------------Info Client----------------------------- -->

                <!-- --------------------- interactions ------------------- -->
                            <table class="table table-profile" style="margin:0;margin-left:-58px">
                                <thead>
                                    <tr>
                                        <th style="padding:0;"  colspan="2">Intéractions
                                            <svg style="cursor:pointer; " onclick="openInt()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                    <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                    <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                </g>
                                            </svg>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr style="padding:0;">
                                        <td style="padding:0;">
                                            <div class="history-tl-container" style="line-height:1.5em; min-width:920px; ">
                                                <ul class="tl">
                                                    <form method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @foreach ($interactions as $interaction)
                                                        <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 2rem 2rem">
                                                            <div class="timestamp" style="padding:0 0 0 0;font-size:0.75em;color:#333333; width:100px; text-align:left;">
                                                                    {{ Carbon\Carbon::parse($interaction->date_heure)->format('Y m d') }}
                                                                    <button formaction="/clients.destroyinteraction/{{$interaction->id_interaction}}/{{ $con->id_contact }}"
                                                                        style="background:none ; border : none;" type="submit" class="btn btn-danger"
                                                                        onclick="return confirm('Are you sure you want to delete ?')"><i
                                                                            style="color : red" class="fas fa-trash"></i>
                                                                    </button>
                                                                    <br>
                                                                    {{ Carbon\Carbon::parse($interaction->date_heure)->format('H:i') }}
                                                            </div>
                                                            <div class="item-title" style="padding:0 1rem 0 0;color:#333333;width:200px; display:flex;">
                                                                <div  class="btn_upd_int btn btn-primary"  data-value="{{ $interaction->id_interaction }}" style="background-color : #fff ; border : #fff;font-size:0.85rem; margin-right:-10px;">
                                                                    <i style="color : #e6ac00" class="fas fa-edit  "></i>
                                                                </div>
                                                                <div>
                                                                    @foreach($les_tags_lier_avec_inter as $tags)
                                                                        @if($tags->id_interaction == $interaction->id_interaction)
                                                                        {{ $tags->tag }} |
                                                                        @endif
                                                                    @endforeach
                                                                    <pre style="width:180px; margin:0; white-space: pre-line;">
                                                                        {{ $interaction->texte }}
                                                                    </pre>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </form>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    <!-- --------------------- interactions  fin ------------------- -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs hidden-sm" style="max-width:25%">
                    <div class="tab-content p-0 le_rectangle">
                        <div class="tab-pane active show" id="profile-about">
                <!-- ------------------------Expériences Statut----------------------------- -->
                            <table class="table table-profile" style="margin-bottom:30px">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;"  colspan="3">Expériences Statut  </th>
                                    </tr>

                                </thead>
                            </table >
                            <table style="margin-top:-10px;margin-bottom:20px;width:100%">
                                    <tr >
                                        <td id="dash" style="color:#333333;"><b>payé </b><br>{{ $paye }}</td>

                                        <td id="dash" style="color:#333333;"><b>enregistré </b><br>{{ $enregistre }} </td>

                                        <td id="dash" style="color:#333333;"><b>commencé </b><br>{{ $commence }} </td>
                                        <td id="dash" style="color:#333333;"><b>Terminé </b><br>{{ $termine }} </td>
                                     </tr>
                            </table>
                            <table>
                                <form method="post">
                                    @csrf
                                    @method('DELETE')
                                    <tbody >
                                        <tr>
                                            <td><b style="margin-right:10px;margin-left:10px">Id Exp</b></td>
                                            <td><b style="margin-right:10px">Lien Exp.</b></td>
                                            <td><b style="margin-right:10px">Suppr. Client</b></td>
                                            <td><b style="margin-right:10px">Profil</b></td>
                                            <td><b style="margin-right:10px">Num Exp</b></td>
                                            <td><b style="margin-right:10px">Statut</b></td>
                                        </tr>
                                        @foreach ($experiences as $exp)
                                            <tr style="text-align:center">
                                                <td>{{ $exp->id_experience }}</td>
                                                <td><a href="{{ route('experience.show', ['id_experience'=>$exp->id_experience,'num_facture'=>$exp->num_facture]) }}"><b style="color:red">GO</b></a></td>
                                                <td> <button formaction="{{ route('clients.destroy', ['id_contact'=>$exp->id_contact,'id_experience'=>$exp->id_experience]) }}"
                                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                                        style="color : #cc3300" class="fas fa-trash"></i></button></td>
                                                <td>{{ $exp->profil }}</td>
                                                <td>{{ $exp->numero_experience }}</td>
                                                <td>{{ $exp->statut_experience }}</td>

                                            </tr>
                                        </tr>
                                    @endforeach
                                    {{-- Ilham --}}
                                    {{-- @foreach ($experiences as $exp)
    <tr style="text-align:center">
        <td>{{ $exp->id_experience }}</td>
        <td><a href="{{ route('experience.show', ['id_experience' => $exp->id_experience, 'num_facture' => $exp->num_facture]) }}"><b style="color:red">GO</b></a></td>
        <td>
            <button formaction="{{ route('clients.destroy', ['id_contact' => $exp->id_contact, 'id_experience' => $exp->id_experience]) }}"
                style="background-color: #fff; border: #fff" type="submit" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete ?')">
                <i style="color: #cc3300" class="fas fa-trash"></i>
            </button>
        </td>
        <td>{{ $exp->profil }}</td>
        <td>{{ $exp->numero_experience }}</td>
        <td>{{ $exp->statut_experience }}</td>
    </tr>
@endforeach --}}
{{-- Ilham --}}


                                    </tbody>
                                </form>
                            </table>
                <!-- ------------------------Expériences Statut----------------------------- -->
                <!-- ----------------------------- Content Storytelling ----------- -->
                            <table style="width: 230%;margin-top:80px; margin-left:20px">
                                <thead>
                                    <tr>
                                        <th colspan="2" style="padding:3rem 0 1rem 0"><b style="font-size:2.5em;">Content Storytelling
                                            <!-- <svg style="cursor:pointer; "  onclick="openStory()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                    <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                    <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                </g>
                                            </svg> -->
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="all:unset;">
                                            <!-- <button class="btn btn-primary btn-sm" onclick="openStory()" style="margin-left : 10px"><b style="color:white;font-size:0.5em">Créer</b></button> -->
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
                                        </th>
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
                                            <td style=" text-align: justify;padding:0.5rem">
                                                @foreach($les_tags_lier_avec_story as $tags)
                                                    @if($tags->id_storytelling == $story->id_storytelling)
                                                    {{ $tags->tag }} |
                                                    @endif
                                                @endforeach
                                                <pre style="width:400px; margin:0; white-space: pre-line;">
                                                    {{ $story->description }}
                                                </pre>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center">
                                                <!-- ----------------------------------- -->
                                                <div  class="btn_upd_sto btn btn-primary"  data-value="{{ $story->id_storytelling }}" style="background-color : #fff ; border : #fff;font-size:0.85rem; margin-right:-10px;">
                                                    <i style="color : #e6ac00" class="fas fa-edit  "></i>
                                                </div>
                                                <!-- ------------------------------------- -->
                                                <button formaction="/clients.destroystorytelling/{{$story->id_storytelling}}/{{ $con->id_contact }}"
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
                <!-- ----------------------------- Content Storytelling : fin ----------- -->
                        </div>
                    </div>
                    <br>
                </div><!-- /.modal -->

                <!-- ------------------------- section ---------------------------- -->
                <div class="col-md-4 " style="max-width:25%">
                    <div class="tab-content p-0 le_rectangle">
                        <div class="tab-pane active show" id="profile-about" style="margin-left:40px">
                        <!-- -------------------------Facture Info---------------------------- -->
                            <table class="table table-profile">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;"  colspan="3">Facture Info  </th>
                                    </tr>

                                </thead>
                            </table >

                            <table style="margin-bottom:10px">
                                <tbody >
                                    <tr>
                                        <td><b style="margin-right:10px;margin-left:0">Num </b></td>
                                        <td><b style="margin-right:10px;margin-left:10px">Lien</b></td>
                                        <td><b style="margin-right:10px">Date</b></td>
                                        <td><b style="margin-right:10px">Montant</b></td>
                                        <td><b style="margin-right:10px">Statut</b></td>
                                    </tr>

                                    @foreach ($factures as $fact)
                                    <tr style="text-align:center">
                                        <td>{{ $fact->num_facture }}</td>
                                        <td><a href="/factures/{{ $fact->num_facture }}"><b style="color:red">GO</b></a></td>
                                        <td><div style="width:80px "> {{ Carbon\Carbon::parse($fact->date_statut)->format('Y m d')}}</div> </td>
                                        <td>{{ $fact->prix_facture }}€</td>
                                        <td>{{ $fact->statut_facture }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        <!-- -------------------------Facture Info---------------------------- -->
                        <!-- ------------------------Paiement----------------------------- -->
                            <table class="table table-profile">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;"  colspan="3">Paiement </th>
                                    </tr>
                                </thead>
                            </table >

                            <table>
                                <tbody >
                                    <tr>
                                    <td><b style="margin-right:10px;margin-left:0">Facture </b></td>
                                    <td><b style="margin-right:10px;margin-left:10px">Lien </b></td>
                                    <td><b style="margin-right:10px;margin-left:10px">Stripe</b></td>
                                    <td><b style="margin-right:10px">Montant</b></td>
                                    <td><b style="margin-right:10px">Statut</b></td>
                                    </tr>
                                    @foreach ($paiements as $paiement)
                                    <tr style="text-align:center">
                                        <td>{{ $paiement->num_facture }}</td>
                                        <td><a href="{{route('paiements.show',['paiement'=>$paiement->id_paiment]) }}"><b style="color:red">GO</b></a></td>
                                        <td><a href=""><b style="color:blue">S</b></a></td>
                                        <td>{{ $paiement->prix }}€</td>
                                        <td>{{ $paiement->statut_paiement }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        <!-- -------------------------Paiement---------------------------- -->

                        </div>
                    </div>
                    <br>
                </div><!-- /.modal -->



                <div class="col-md-4 " style="max-width:25%">
                    <div class="tab-content p-0 le_rectangle">
                        <div class="tab-pane active show" id="profile-about" style="margin-left:40px">

                        <!-- ----------------------Performances------------------------------- -->
                            <table class="table table-profile" style="margin-bottom:50px">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0 0 2rem 0;"  colspan="2">Performances  </th>
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
                            <!-- ---------------------Performances-------------------------------- -->
                            <!-- </table> ca sort d'ou ? -->
                            <!-- ------------------------Evenements----------------------------- -->
                            <table class="table table-profile">
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;"  colspan="2">Evenements   </th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="history-tl-container" style="line-height:1.5em; min-width:920px; ">
                                                <ul class="tl" >
                                                    @foreach ($evenements as $evenement)
                                                    <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 3rem 2rem">
                                                        <div class="timestamp" style="padding:0 3rem 0 0;font-size:1em;color:#333333; width:130px;">{{ Carbon\Carbon::parse($evenement->date_creation)->format('Y m d')}}
                                                        <br>
                                                    </div>
                                                    <div class="item-title" style="padding:0 3rem 0 0;font-size:0.7em;color:#333333;width:200px"><b>Evénement {{ $loop->index+1 }}</b> : {{ $evenement->contenu_notification }} </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                           <!-- --------------------------Evenements--------------------------- -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function openInt() {
        var div_int_from = document.getElementById("intForm");
        div_int_from.style.display = "block";
        suggestion_tag_inter(div_int_from);
    }
    function closeInt() {
        document.getElementById("intForm").style.display = "none";
    }
    function openStory() {
        var select_tag_story = document.getElementById("storyForm");
        select_tag_story.style.display = "block";
        suggestion_tag_story(select_tag_story)
    }
    function closeStory() {
        document.getElementById("storyForm").style.display = "none";
    }
    function openForm() {
            document.getElementById("popupForm").style.display = "block";
        }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
    //******************** yasser *****************************
        const csrfToken = "{{ csrf_token() }}";
        // ---------------------
        var popupActivated = false;
        console.log(popupActivated);
        var content = document.getElementById('content');
        // ---------------------
        $(document).ready(function() {
            $(document).ready(function() {
                $('.btn_upd_int').each(function() {
                    var dataValue = $(this).data('value');
                    // ___________________________________________________
                    $(this).on('click', function() {
                        // console.log(dataValue);
                        // chercher les data necessaire pour cet élément
                        $.ajax({
                            url: '/interactions.update_show_interaction/' + dataValue ,
                            method: 'GET',
                            success: function(response) {
                                // faire le traitement
                                popup_interac(response);

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




        function popup_interac(data) {
            // ---------------------
            popupActivated = true;
            // console.log(popupActivated);
            // ---------------------
            const cardBody = document.createElement('form');
            cardBody.classList.add('card-body', 'my-card-body');
            cardBody.action = "{{ route('interactions.updated_interaction') }}";
            cardBody.method = 'POST';

            // Ajouter le jeton CSRF
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = "{{ csrf_token() }}"; // Insérer la balise Blade pour le jeton CSRF
            cardBody.appendChild(csrfToken);

            // Ajouter l'id_interaction
            const id_iterac = document.createElement('input');
            id_iterac.type = 'hidden';
            id_iterac.name = 'id_interaction';
            id_iterac.id = 'id_interaction';
            id_iterac.value = data.data[0].id_interaction; // Insérer la balise Blade pour le jeton CSRF
            cardBody.appendChild(id_iterac);

            // Ajoutez le champ _method pour simuler une requête PUT
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            cardBody.appendChild(methodField);


            const heading = document.createElement('h1');
            heading.classList.add('my-heading');
            heading.textContent = 'Modification de Interaction';
            cardBody.appendChild(heading);
            //--------- div erreur ------------
            const newDiv = document.createElement('div');
            newDiv.style.padding = "10px";
            newDiv.style.color = 'red';
            newDiv.style.display = "none";
            cardBody.appendChild(newDiv);
            // --------------------------------
            const selectContact = document.createElement('select');
            selectContact.name = 'id_contact';
            selectContact.id = 'pet-select';
            selectContact.classList.add('my-select');
            selectContact.classList.add('my-select-contact');

            data.id_con.forEach((con) => {
                const optionContact = document.createElement('option');
                optionContact.value = con.id_contact;

                if (con.id_contact === data.data[0].id_contact) {
                    optionContact.selected = true;
                }

                optionContact.textContent = `${con.id_contact} - ${con.nom} ${con.prenom}`;
                selectContact.appendChild(optionContact);
            });

            cardBody.appendChild(selectContact);

            const selectExperience = document.createElement('select');
            selectExperience.name = 'id_experience';
            selectExperience.id = 'pet-select';
            selectExperience.classList.add('my-select');
            selectExperience.classList.add('my-select-experience');

            if (data.data_exp === null) {
                const optionNoExperience = document.createElement('option');
                optionNoExperience.value = '';
                optionNoExperience.selected = true;
                optionNoExperience.textContent = 'Aucune Experience';
                selectExperience.appendChild(optionNoExperience);

                data.id_exp.forEach((exp) => {
                    const optionExperience = document.createElement('option');
                    optionExperience.value = exp.id_experience;
                    optionExperience.textContent = `${exp.id_experience} - ${exp.nom_experience}`;
                    selectExperience.appendChild(optionExperience);
                });
            } else {
                const optionNoExperience = document.createElement('option');
                optionNoExperience.value = '';
                optionNoExperience.textContent = 'Aucune Experience';
                selectExperience.appendChild(optionNoExperience);

                data.id_exp.forEach((exp) => {
                    const optionExperience = document.createElement('option');
                    optionExperience.value = exp.id_experience;

                    if (exp.id_experience === data.data_exp.id_experience) {
                        optionExperience.selected = true;
                    }

                    optionExperience.textContent = `${exp.id_experience} - ${exp.nom_experience}`;
                    selectExperience.appendChild(optionExperience);
                });
            }

            cardBody.appendChild(selectExperience);
            // ------------------------------ tags ----------------------------------------
            const div_tags = document.createElement('div');
                    div_tags.style.width = '100%';
                    div_tags.style.backgroundColor = 'white';
                    div_tags.style.border = '2px solid black';
                    div_tags.style.borderRadius = '4px';
                    div_tags.style.margin = '0';
                    div_tags.style.resize = 'none';
                    div_tags.style.overflow = 'hidden';
                // _______________________________________
                // c'est dans la barre
                const div_affiche_tags = document.createElement('div');
                // c'est en dehors de la barre
                const div_affiche_suggestion_tags = document.createElement('div');
                div_affiche_suggestion_tags.style.borderRadius = "4px";
                div_affiche_suggestion_tags.style.padding = "10px";

                // _______________________________________
                const input_tag = document.createElement('input');
                    input_tag.style.width = '100%';
                    input_tag.style.height = '2rem';
                    input_tag.style.backgroundColor = 'white';
                    input_tag.style.margin = '0';
                    input_tag.style.border = "none";
                    input_tag.type = 'text';
                    input_tag.name = 'tag';
                    input_tag.placeholder = 'Cherchez votre tag Interaction';
                // _______________________________________
                div_tags.appendChild(div_affiche_tags);
                div_tags.appendChild(input_tag);
                cardBody.appendChild(div_tags);
                cardBody.appendChild(div_affiche_suggestion_tags);
                // _______________________________________
                if (typeof data.tags_lier !== 'undefined' && data.tags_lier.length > 0) {
                    // console.log('hey');

                    data.tags_lier.forEach( (tag) =>{
                        let index = 1 + div_affiche_tags.childElementCount;
                        let afficher_dans_la_barre = document.createElement("div");
                        afficher_dans_la_barre.style.margin = "2px";
                        afficher_dans_la_barre.style.padding = "2px";
                        afficher_dans_la_barre.style.border = "1px solid black";
                        afficher_dans_la_barre.style.borderRadius = "3px"
                        afficher_dans_la_barre.style.width = "fit-content";
                        afficher_dans_la_barre.style.display = "inline-block";
                        afficher_dans_la_barre.style.whiteSpace = "nowrap";

                        afficher_dans_la_barre.innerText = tag.tag
                        // ---
                        let btn_croix = document.createElement("div");
                        btn_croix.className = "btn-close";
                        btn_croix.innerText = "X";
                        btn_croix.style.marginLeft = "2px";
                        btn_croix.style.color = "red";
                        btn_croix.style.display = "inline-block";
                        btn_croix.style.cursor = "pointer";
                        // -----------
                        let checkbox = document.createElement("input");
                        checkbox.type = "hidden";
                        checkbox.value = tag.id_tag_interaction;
                        checkbox.id = "le_tag_" + index;
                        checkbox.name = "le_tag_" + index;
                        // ---------------------------------
                        afficher_dans_la_barre.appendChild(btn_croix)
                        afficher_dans_la_barre.appendChild(checkbox)
                        div_affiche_tags.appendChild(afficher_dans_la_barre)
                        // ---------------------------------
                        btn_croix.onclick = function(){
                            div_affiche_tags.removeChild(afficher_dans_la_barre);
                        }
                    })
                }
                // _________________________________________ss
                suggestion_tag_inter_update(input_tag, div_affiche_suggestion_tags, div_affiche_tags );

            // ------------------------------ tags ----------------------------------------
            const descriptionHeading = document.createElement('h6');
            descriptionHeading.classList.add('my-description-heading');
            descriptionHeading.textContent = 'Description';
            cardBody.appendChild(descriptionHeading);

            const textarea = document.createElement('textarea');
            textarea.name = 'texte';
            textarea.className = 'form-control my-textarea';
            textarea.cols = '30';
            textarea.rows = '5';
            textarea.textContent = data.data[0].texte;
            cardBody.appendChild(textarea);

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

                // content.addEventListener('click', function(event) {
                //     if (!card.contains(event.target) && content.contains(card)) {
                //         content.removeChild(card);
                //         popupActivated = false;
                //         console.log(popupActivated);
                //     }
                // });
            }
        }

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


        function popup_storytelling(story) {
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
            id_story.value = story.data.id_storytelling; // Insérer la balise Blade pour le jeton CSRF
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
            descContentLabel.textContent = 'Cherchez un tag';
            cardBody.appendChild(descContentLabel);
            // input 1
            // ------------------------------ tags ----------------------------------------
            const div_tags = document.createElement('div');
                    div_tags.style.width = '100%';
                    div_tags.style.backgroundColor = 'white';
                    div_tags.style.border = '2px solid black';
                    div_tags.style.borderRadius = '4px';
                    div_tags.style.margin = '0';
                    div_tags.style.resize = 'none';
                    div_tags.style.overflow = 'hidden';
                // _______________________________________
                // c'est dans la barre
                const div_affiche_tags = document.createElement('div');
                // c'est en dehors de la barre
                const div_affiche_suggestion_tags = document.createElement('div');
                div_affiche_suggestion_tags.style.borderRadius = "4px";
                div_affiche_suggestion_tags.style.padding = "10px";

                // _______________________________________
                const input_tag = document.createElement('input');
                    input_tag.style.width = '100%';
                    input_tag.style.height = '2rem';
                    input_tag.style.backgroundColor = 'white';
                    input_tag.style.margin = '0';
                    input_tag.style.border = "none";
                    input_tag.type = 'text';
                    input_tag.name = 'tag';
                    input_tag.placeholder = 'Cherchez votre tag Interaction';
                // _______________________________________
                div_tags.appendChild(div_affiche_tags);
                div_tags.appendChild(input_tag);
                cardBody.appendChild(div_tags);
                cardBody.appendChild(div_affiche_suggestion_tags);
                // _______________________________________
                if (typeof story.tags_lier !== 'undefined' && story.tags_lier.length > 0) {
                    // console.log('hey');

                    story.tags_lier.forEach( (tag) =>{
                        let index = 1 + div_affiche_tags.childElementCount;
                        let afficher_dans_la_barre = document.createElement("div");
                        afficher_dans_la_barre.style.margin = "2px";
                        afficher_dans_la_barre.style.padding = "2px";
                        afficher_dans_la_barre.style.border = "1px solid black";
                        afficher_dans_la_barre.style.borderRadius = "3px"
                        afficher_dans_la_barre.style.width = "fit-content";
                        afficher_dans_la_barre.style.display = "inline-block";
                        afficher_dans_la_barre.style.whiteSpace = "nowrap";

                        afficher_dans_la_barre.innerText = tag.tag
                        // ---
                        let btn_croix = document.createElement("div");
                        btn_croix.className = "btn-close";
                        btn_croix.innerText = "X";
                        btn_croix.style.marginLeft = "2px";
                        btn_croix.style.color = "red";
                        btn_croix.style.display = "inline-block";
                        btn_croix.style.cursor = "pointer";
                        // -----------
                        let checkbox = document.createElement("input");
                        checkbox.type = "hidden";
                        checkbox.value = tag.id_tag_story;
                        checkbox.id = "le_tag_" + index;
                        checkbox.name = "le_tag_" + index;
                        // ---------------------------------
                        afficher_dans_la_barre.appendChild(btn_croix)
                        afficher_dans_la_barre.appendChild(checkbox)
                        div_affiche_tags.appendChild(afficher_dans_la_barre)
                        // ---------------------------------
                        btn_croix.onclick = function(){
                            div_affiche_tags.removeChild(afficher_dans_la_barre);
                        }
                    })
                }
                // _________________________________________ss
                suggestion_tag_story_update(input_tag, div_affiche_suggestion_tags, div_affiche_tags );

            // ------------------------------ tags ----------------------------------------
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
            descStoryTextarea.textContent = story.data.description;
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

                // content.addEventListener('click', function(event) {
                //     if (!card.contains(event.target) && content.contains(card)) {
                //         content.removeChild(card);
                //         popupActivated = false;
                //         console.log(popupActivated);
                //     }
                // });
            }
        }

 // script persona JM

 //Ilham
           //---------------------------------barre de recherche : personna update -------------------
           function suggestion_tag_personna_update(searched_tag, div_affichage, zone_affichage_dans_barre ){
            searched_tag.addEventListener("keyup", function() {
                let expression = searched_tag.value;
                console.log(expression);
                if(expression != "")
                {
                    div_affichage.innerHTML ="";
                    $.ajax({
                        url: '/personnas.liste_tags/' +
                            expression,
                        method: 'GET',
                        success: function(response) {
                            div_affichage.style.backgroundColor = "#7c9c97"
                            if (response.length > 0) {
                                div_affichage.innerHTML = "";
                                response.forEach( function(un_tag) {
                                    affiche_checkbox_tag(un_tag.tag,div_affichage, zone_affichage_dans_barre  )
                                });
                            }else{
                                div_affichage.innerHTML = "";
                                creer_un_tag( expression, div_affichage, zone_affichage_dans_barre)
                            }
                        },
                        error: function(error) {
                            // Gérer les erreurs
                        }
                    });
                }else{
                    div_affichage.style.backgroundColor = ""
                    div_affichage.innerHTML = "";
                }
            });

        }
        // JM
        //---------------------------------barre de recherche : personna-------------------
        function suggestion_tag_personna(div_int_from){
            let searched_tag = document.getElementById('select_tag_personna');
            let div_affichage = document.getElementById('affichage_tag_selected_personna');
            let zone_affichage_dans_barre = document.getElementById('tag_selectionned_personna');


            if (div_int_from.style.display === "block") {
                // console.log('je suis la');
                searched_tag.addEventListener("keyup", function() {
                    let expression = searched_tag.value;
                    console.log(expression);
                    if(expression != "")
                    {
                        div_affichage.innerHTML ="";
                        $.ajax({
                            url: '/personnas.liste_tags/' +
                                expression,
                            method: 'GET',
                            success: function(response) {
                                div_affichage.style.backgroundColor = "#7c9c97"
                                if (response.length > 0) {
                                    zone_affichage_dans_barre.innerHTML=""
                                    div_affichage.innerHTML = "";
                                    response.forEach( function(un_tag) {
                                        affiche_checkbox_tag(un_tag.tag,un_tag.id_persona, div_affichage, zone_affichage_dans_barre  )
                                        
                                    });
                                }else{
                                    div_affichage.innerHTML = "";
                                    creer_un_tag( expression, div_affichage, zone_affichage_dans_barre)
                                }
                            },
                            error: function(error) {
                                // Gérer les erreurs
                            }
                        });
                    }else{
                        div_affichage.style.backgroundColor = ""
                        div_affichage.innerHTML = "";
                    }
                });
            }
        }

           //Ilham

function closeIntPersonna() {
        document.getElementById("persoForm").style.display = "none";
    }
    function openPersonna() {
        var select_tag_personna = document.getElementById("persoForm");
        select_tag_personna.style.display = "block";
        suggestion_tag_personna(select_tag_personna);
        document.getElementById("persoForm").style.display = "block";
    }
    function closePersonna() {
        document.getElementById("persoForm").style.display = "none";
    }

</script>
<script>
    // **************************** barre de recherche ************************************************
        //---------------------------------barre de recherche : interaction update -------------------
        function suggestion_tag_inter_update(searched_tag, div_affichage, zone_affichage_dans_barre ){
            searched_tag.addEventListener("keyup", function() {
                let expression = searched_tag.value;
                console.log(expression);
                if(expression != "")
                {
                    div_affichage.innerHTML ="";
                    $.ajax({
                        url: '/interactions.liste_tags/' +
                            expression,
                        method: 'GET',
                        success: function(response) {
                            div_affichage.style.backgroundColor = "#7c9c97"
                            if (response.length > 0) {
                                div_affichage.innerHTML = "";
                                response.forEach( function(un_tag) {
                                    affiche_checkbox_tag(un_tag.tag, un_tag.id_tag_interaction,div_affichage, zone_affichage_dans_barre  )
                                });
                            }else{
                                div_affichage.innerHTML = "";
                                creer_un_tag( expression, div_affichage, zone_affichage_dans_barre)
                            }
                        },
                        error: function(error) {
                            // Gérer les erreurs
                        }
                    });
                }else{
                    div_affichage.style.backgroundColor = ""
                    div_affichage.innerHTML = "";
                }
            });

        }
        //---------------------------------barre de recherche : interaction-------------------
        function suggestion_tag_inter(div_int_from){
            let searched_tag = document.getElementById('select_tag_int');
            let div_affichage = document.getElementById('affichage_tag_selected_inter');
            let zone_affichage_dans_barre = document.getElementById('tag_selectionned');


            if (div_int_from.style.display === "block") {
                searched_tag.addEventListener("keyup", function() {
                    let expression = searched_tag.value;
                    console.log(expression);
                    if(expression != "")
                    {
                        div_affichage.innerHTML ="";
                        $.ajax({
                            url: '/interactions.liste_tags/' +
                                expression,
                            method: 'GET',
                            success: function(response) {
                                div_affichage.style.backgroundColor = "#7c9c97"
                                if (response.length > 0) {
                                    div_affichage.innerHTML = "";
                                    response.forEach( function(un_tag) {
                                        affiche_checkbox_tag(un_tag.tag, un_tag.id_tag_interaction,div_affichage, zone_affichage_dans_barre  )

                                    });
                                }else{
                                    div_affichage.innerHTML = "";
                                    creer_un_tag( expression, div_affichage, zone_affichage_dans_barre)
                                }
                            },
                            error: function(error) {
                                // Gérer les erreurs
                            }
                        });
                    }else{
                        div_affichage.style.backgroundColor = ""
                        div_affichage.innerHTML = "";
                    }
                });
            }
        }
        // -------------------------- affichage tag : pour interaction et storytelling--------
        function affiche_checkbox_tag(tag, id_tag, zone_affichage , zone_affichage_dans_barre) {
            // -----------------------------
            let une_ligne = document.createElement("div");
            une_ligne.style.cursor = "pointer";
            une_ligne.innerText = tag;

            zone_affichage.appendChild(une_ligne);
            // ------------------------------------
            une_ligne.onclick = function (){
                // JM ----------------------------
                let searched_tag = document.getElementById('select_tag_personna');
                searched_tag.value=tag;
                // JM ----------------------------
                let index = 1 + zone_affichage_dans_barre.childElementCount;
                // console.log(index);
                if (1 + zone_affichage_dans_barre.childElementCount <= 5) {
                    // ------------------------------------
                    let afficher_dans_la_barre = document.createElement("div");
                    afficher_dans_la_barre.style.margin = "2px";
                    afficher_dans_la_barre.style.padding = "2px";
                    afficher_dans_la_barre.style.border = "1px solid black";
                    afficher_dans_la_barre.style.borderRadius = "3px"
                    afficher_dans_la_barre.style.width = "fit-content";
                    afficher_dans_la_barre.style.display = "inline-block";
                    afficher_dans_la_barre.style.whiteSpace = "nowrap";

                    afficher_dans_la_barre.innerText = tag
                    // ---
                    let btn_croix = document.createElement("div");
                    btn_croix.className = "btn-close";
                    btn_croix.innerText = "X";
                    btn_croix.style.marginLeft = "2px";
                    btn_croix.style.color = "red";
                    btn_croix.style.display = "inline-block";
                    btn_croix.style.cursor = "pointer";
                    // -----------
                    let checkbox = document.createElement("input");
                    checkbox.type = "hidden";
                    checkbox.value = id_tag;
                    checkbox.id = "le_tag_" + index;
                    checkbox.name = "le_tag_" + index;
                    // ---------------------------------
                    afficher_dans_la_barre.appendChild(checkbox);

                    afficher_dans_la_barre.appendChild(btn_croix);
                    zone_affichage_dans_barre.appendChild(afficher_dans_la_barre);
                    // ------------------------------------
                    btn_croix.onclick = function(){
                        zone_affichage_dans_barre.removeChild(afficher_dans_la_barre);
                    }
                }else{
                    let message = document.createElement("div");
                    message.innerText = "vous avez atteint le nombre max de tag";
                    zone_affichage.innerHTML = "";
                    zone_affichage.appendChild(message);
                }
            };
        }
        // -------------------------- creation tag : pour interaction et storytelling---------
        function creer_un_tag( le_nouveau_tag, zone_affichage , zone_affichage_dans_barre) {
            let une_ligne = document.createElement("div");
            une_ligne.style.cursor = "pointer";
            une_ligne.innerText = le_nouveau_tag + '(nouvel tag)';

            zone_affichage.appendChild(une_ligne);
            // ------------------------------------
            une_ligne.onclick = function (){
                let index = 1 + zone_affichage_dans_barre.childElementCount;
                console.log(index);
                if (1 + zone_affichage_dans_barre.childElementCount <= 5) {
                    let afficher_dans_la_barre = document.createElement("div");
                    afficher_dans_la_barre.style.margin = "2px";
                    afficher_dans_la_barre.style.padding = "2px";
                    afficher_dans_la_barre.style.border = "1px solid black";
                    afficher_dans_la_barre.style.borderRadius = "3px"
                    afficher_dans_la_barre.style.width = "fit-content";
                    afficher_dans_la_barre.style.display = "inline-block";
                    afficher_dans_la_barre.style.whiteSpace = "nowrap";

                    afficher_dans_la_barre.innerText = le_nouveau_tag + '(nouvel tag)';
                    // ---
                    let btn_croix = document.createElement("div");
                    btn_croix.className = "btn-close";
                    btn_croix.innerText = "X";
                    btn_croix.style.marginLeft = "2px";
                    btn_croix.style.color = "red";
                    btn_croix.style.display = "inline-block";
                    btn_croix.style.cursor = "pointer";
                    // -----------
                    let checkbox = document.createElement("input");
                    checkbox.type = "hidden";
                    checkbox.value = le_nouveau_tag;
                    checkbox.id = "nouveau_tag_" + index;
                    checkbox.name = "nouveau_tag_" + index;
                    // ---------------------------------
                    afficher_dans_la_barre.appendChild(checkbox);
                    // -----------
                    afficher_dans_la_barre.appendChild(btn_croix);
                    zone_affichage_dans_barre.appendChild(afficher_dans_la_barre);
                    // ------------
                    btn_croix.onclick = function(){
                        zone_affichage_dans_barre.removeChild(afficher_dans_la_barre);
                    }
                }else{
                    let message = document.createElement("div");
                    message.innerText = "vous avez atteint le nombre max de tag";
                    zone_affichage.innerHTML = "";
                    zone_affichage.appendChild(message);
                }

            }
        }
        //---------------------------------barre de recherche : storytelling------------------
        function suggestion_tag_story(div_int_from){
            let searched_tag = document.getElementById('select_tag_story');
            let div_affichage = document.getElementById('affichage_tag_selected_story');
            let zone_affichage_dans_barre = document.getElementById('tag_selectionned_story');


            if (div_int_from.style.display === "block") {
                // console.log('je suis la');
                searched_tag.addEventListener("keyup", function() {
                    let expression = searched_tag.value;
                    console.log(expression);
                    if(expression != "")
                    {
                        div_affichage.innerHTML ="";
                        $.ajax({
                            url: '/storytellings.liste_tags/' +
                                expression,
                            method: 'GET',
                            success: function(response) {
                                div_affichage.style.backgroundColor = "#7c9c97"
                                // console.log(response);
                                if (response.length > 0) {
                                    div_affichage.innerHTML = "";
                                    // let compteur = 0;
                                    response.forEach( function(un_tag) {
                                        // console.log(un_tag.tag);
                                        affiche_checkbox_tag(un_tag.tag, un_tag.id_tag_story,div_affichage, zone_affichage_dans_barre  )

                                    });
                                }else{
                                    div_affichage.innerHTML = "";
                                    creer_un_tag( expression, div_affichage, zone_affichage_dans_barre)
                                }
                            },
                            error: function(error) {
                                // Gérer les erreurs
                            }
                        });
                    }else{
                        div_affichage.style.backgroundColor = ""
                        div_affichage.innerHTML = "";
                    }
                });
            }
        }

        //---------------------------------barre de recherche : storytelling update -------------------
        function suggestion_tag_story_update(searched_tag, div_affichage, zone_affichage_dans_barre ){
            searched_tag.addEventListener("keyup", function() {
                let expression = searched_tag.value;
                console.log(expression);
                if(expression != "")
                {
                    div_affichage.innerHTML ="";
                    $.ajax({
                        url: '/storytellings.liste_tags/' +
                            expression,
                        method: 'GET',
                        success: function(response) {
                            div_affichage.style.backgroundColor = "#7c9c97"
                            if (response.length > 0) {
                                div_affichage.innerHTML = "";
                                response.forEach( function(un_tag) {
                                    affiche_checkbox_tag(un_tag.tag, un_tag.id_tag_story,div_affichage, zone_affichage_dans_barre  )
                                });
                            }else{
                                div_affichage.innerHTML = "";
                                creer_un_tag( expression, div_affichage, zone_affichage_dans_barre)
                            }
                        },
                        error: function(error) {
                            // Gérer les erreurs
                        }
                    });
                }else{
                    div_affichage.style.backgroundColor = ""
                    div_affichage.innerHTML = "";
                }
            });

        }
        // **************************** barre de recherche ***********************************************
</script>



    <div class="formclt" >
        {{--Ilham--}}
    <div class="form-perso" id="persoForm">
        <form action="{{ route('contacts.createpersonna') }}" method="post" class="form-container">
            @csrf
            <h4 style="text-align:start;margin-top:30px">Ajouter une nouvelle personna </h4>
            <input type="hidden" id="id_contact" name="id_contact" value="{{old('id_contact') ?? $con->id_contact }}">

            <div class="form-contact" style="margin-bottom:20px;margin-top:30px">

            {{-- <select name="id_exp" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                <option value="">Aucune Experience </option>
                @foreach ($experiences as $exp)
                    <option value="{{ $exp->id_experience }}"{{ $loop->first ? ' selected' : '' }}>
                        {{ $exp->id_experience }} - {{ $exp->nom_experience }}
                    </option>
                    <!-- <option value="{{ $exp->id_experience }}" {{old('id_exp') == $exp->id_experience ? "selected" : ""}}>{{ $exp->id_experience }} - {{ $exp->nom_experience }} </option>     -->
                @endforeach
            </select> --}}
            </div>
            <!-- -------------------------tags--------------- -->
            <div style="width: 100%; background-color: white; border: 2px black solid; border-radius: 4px; margin: 0; resize: none; overflow: hidden;" >
                <div id="tag_selectionned_personna"></div>
                <input  style="margin:0; background:none;" placeholder="Cherchez un tag" type="text" id="select_tag_personna" name="tag">
            </div>
            <!--  -->
            <div id="affichage_tag_selected_personna" style="border-radius:4px; padding:10px;  ">
            </div>
            <!-- -------------------------tags--------------- -->
            <!-- <div class="form-contact" style="margin-top:20px">
                <input type="text" name="type_int" class="form-control" value="{{old('type_int')}}"  placeholder="Type d'Interaction" style="background-color:white;border:2px black  solid">
            </div> -->
            <div class="form-contact" style="margin-top:20px">
                <!-- <input type="text" name="texte" class="form-control"  placeholder="Texte de l'Interaction" style="background-color:white;border:2px black  solid"> -->
                {{-- <textarea name="texte" class="form-control" cols="30" rows="5" value="{{old('texte')}}" placeholder="Texte de Personna" style="background-color:white;border:2px black  solid  ; margin-bottom:3px"></textarea> --}}
            </div>
            <button type="submit" class="btn" style="width:100px">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeIntPersonna()" style="width:100px">Annuler</button>
            </form>
    </div>

    {{--Ilham--}}
        <div class="form-int" id="intForm">
            <form action="{{ route('clients.createinteraction') }}" method="post" class="form-container">
                @csrf
                <h4 style="text-align:start;margin-top:30px">Ajouter une nouvelle interaction liée au client </h4>
                <input type="hidden" id="id_contact" name="id_contact" value="{{old('id_contact') ?? $con->id_contact }}">

                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">

                <select name="id_exp" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Aucune Experience </option>
                    @foreach ($experiences as $exp)
                        <option value="{{ $exp->id_experience }}"{{ $loop->first ? ' selected' : '' }}>
                            {{ $exp->id_experience }} - {{ $exp->nom_experience }}
                        </option>
                        <!-- <option value="{{ $exp->id_experience }}"{{ old('id_exp') == $exp->id_experience ? "selected" : "" }}>{{ $exp->id_experience }} - {{ $exp->nom_experience }} </option>     -->
                    @endforeach
                </select>
                </div>
                <!-- -------------------------tags--------------- -->
                <div style="width: 100%; background-color: white; border: 2px black solid; border-radius: 4px; margin: 0; resize: none; overflow: hidden;" >
                    <div id="tag_selectionned"></div>
                    <input  style="margin:0; background:none;" placeholder="Cherchez un tag" type="text" id="select_tag_int">
                </div>
                <!--  -->
                <div id="affichage_tag_selected_inter" style="border-radius:4px; padding:10px;  ">
                </div>
                <!-- -------------------------tags--------------- -->
                <!-- <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="type_int" class="form-control" value="{{old('type_int')}}"  placeholder="Type d'Interaction" style="background-color:white;border:2px black  solid">
                </div> -->
                <div class="form-contact" style="margin-top:20px">
                    <!-- <input type="text" name="texte" class="form-control"  placeholder="Texte de l'Interaction" style="background-color:white;border:2px black  solid"> -->
                    <textarea name="texte" class="form-control" cols="30" rows="5" placeholder="Texte de l'Interaction" style="background-color:white;border:2px black  solid  ; margin-bottom:3px"></textarea>
                </div>
                <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeInt()" style="width:100px">Annuler</button>
                </form>
        </div>
        <div class="form-story" id="storyForm">
            <form action="{{ route('clients.createstorytelling') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="id_contact" name="id_contact" value="{{old("id_contact") ?? $con->id_contact }}">


                <h4 style="text-align:start;margin-top:30px">Ajouter un nouveau storytelling à une experience </h4>

                <select name="id_exp" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Selectionnez une Experience </option>
                    @foreach ($experiences as $exp)
                        <option value="{{ $exp->id_experience }}"{{ $loop->first ? ' selected' : '' }}>
                            {{ $exp->id_experience }} - {{ $exp->nom_experience }}
                        </option>
                        <!-- <option value="{{ $exp->id_experience }}"{{old('id_exp') == $exp->id_experience ? "selected" : ""}}>{{ $exp->id_experience }} - {{ $exp->nom_experience }} </option>     -->
                    @endforeach
                </select>
                <!-- -------------------------tags--------------- -->
                <div style="width: 100%; background-color: white; border: 2px black solid; border-radius: 4px; margin: 0; resize: none; overflow: hidden;" >
                    <div id="tag_selectionned_story"></div>
                    <input  style="margin:0; background:none;" placeholder="Cherchez un tag" type="text" id="select_tag_story" >
                </div>
                <div id="affichage_tag_selected_story" style="border-radius:4px; padding:10px;  ">

                </div>
                <!-- -------------------------tags--------------- -->
                <!-- <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="desc_content" class="form-control" value="{{old('desc_content')}}"  placeholder="Description Contents Experience" style="background-color:white;border:2px black  solid">
                </div> -->
                <div class="form-contact" style="margin-top:20px">
                    <!-- <input type="text" name="desc_story" class="form-control"  placeholder="Description Storytelling" style="background-color:white;border:2px black  solid"> -->
                    <textarea name="desc_story" class="form-control" cols="30" rows="5" value="{{old('desc_story')}}" placeholder="Description Storytelling" style="background-color:white;border:2px black  solid; margin-bottom:3px"></textarea>
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

    /*JM*/
    /* Ilham */
    .form-perso {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-75%, -50%);
        z-index: 99;
    border:3px black solid;
    border-radius:10px;
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
        z-index: 1;
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
    #pageSubmenu14{
        visibility:visible;
        display:block;
    }
    #pageSubmenu18{
        visibility:visible;
        display:block;
    }
    #M51{
    background-color: #747474;
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
    #dash{

        font-size:0.9em;

        text-align:center;




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
</style>

<style>
   .login-popup {
        position: center;
        text-align: center;
        z-index: 1;
        width: 80%;
      }
      .code-popup{
        position: center;
        text-align: center;
        z-index: 10;
        width: 80%;
      }
      /* Masquez la forme Popup */
      .form-popup {
        display: none;
        position: fixed;
        left:55%;
        top: 25%;
        transform: translate(-45%, 5%);

      }
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
    .form-code {
    display: none;
    position: relative;
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
        width: 450px;
        padding: 20px;
        background-color: #DEDEDE;
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
      /* Planez les effets pour les boutons */
      .form-container .btn:hover,
      .open-button:hover {
        opacity: 1;
      }
    /* ---------------------- */
    .le_rectangle{
        position: inherit;
        z-index: 1;
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
