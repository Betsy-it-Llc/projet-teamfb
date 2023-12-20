@extends('layouts.navadmin')
@section('content')
    <div class="container">
        {{-- Ajout des messages personnalisés 'success' --}}
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        {{-- Ajout des messages personnalisés 'error' 
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div id="content" class="content p-0">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}


            <!---------------------------titre de la page --------------------------------------------->
            <div class="profile-header">
                <center>
                    <b style="margin-bottom :20px;font-size:2.5rem;"> Info Réservation </b>
                </center>

            </div>
            <br>
            <div class="profil-container">
                <!-- ---------------------------- le profil ------------------------------------------------- -->
                <table>
                    <tr>
                        <td>
                            <div class="profile-header-content">
                                <div class="profile-header-img" style="background:none;height:110%">
                                    <form method="post">
                                        @csrf
                                        @method('DELETE')
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU"
                                            alt="Admin" class="rounded-circle p-1 bg-primary" width="130px">
                                        <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"
                                            href="/contacts.edit/{{ $con->id_contact }}"><i style="color : green;"
                                                class="fas fa-edit fa-lg"></i></a>
                                        <button formaction="{{ route('reservationclient.destroy', ['facture' => $url]) }}"
                                            style="background:none ; border : none;" type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete ?')"><i
                                                style="color : red" class="fas fa-trash fa-lg"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="profile-header-name">
                                <span>
                                    <h3> {{ $con->nom }} {{ $con->prenom }} </h3>
                                </span>
                                <table>
                                    @if (!empty($paiements))
                                        @foreach ($paiements as $key => $value)
                                            <tr>
                                                <td>
                                                    <b>Paiement </b>
                                                </td>
                                                <td>
                                                    <b> {{ $value->id_paiment }}</b>
                                                </td>
                                                <td>
                                                    <a style=" border : black;"
                                                        href="/paiementss.show/{{ $value->id_paiment }}"><i
                                                            style="color : black;" class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $value->libelle }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                                <span style="font-size:0.9em">Canal de reservation </span><br>
                                @if ($statut->id_facture_statut == 3 || $statut->id_facture_statut == 1 || $statut->id_facture_statut == 11)
                                    <span style="font-size:0.9em"><b>Valider : </b> <a
                                            style="background-color : #fff ; border : #fff" class="btn btn-info"
                                            href="{{ route('reservationclient.valider', ['num_facture' => $url, 'id_facture_statut' => $statut->id_facture_statut]) }}"
                                            onclick="return confirm('Etes-vous sure de vouloir valider la Facture ?')"><i
                                                style="color : #4d94ff" class="fas fa-check"></i></a></span><br>
                                @else
                                    <span><b style="font-size:0.9em;">Valider : </b> <i
                                            style=" color : grey; width:30px;   padding-left:10px;"class="fas fa-check fa-lg">
                                        </i></span><br>
                                @endif
                                @if (($statut->id_facture_statut >= 3 && $statut->id_facture_statut <= 6) || $statut->id_facture_statut == 10)
                                    <span style="font-size:0.9em; "><b>Envoyer : </b> <a
                                            style="background-color : #fff ; border : #fff" class="btn btn-info"
                                            href="{{ route('reservationclient.envoyer', ['num_facture' => $url, 'id_facture_statut' => $statut->id_facture_statut]) }}"
                                            onclick="return confirm('Etes-vous sure de valider l\'envoie de la Facture ?')"><i
                                                style="color : #4ddbff" class="fas fa-paper-plane"></i></a></span>
                                @else
                                    <span style="font-size:0.9em"><b>Envoyer : </b> <i style="color : grey"
                                            class="fas fa-paper-plane fa-lg"></i>
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td style="padding:0 0 1rem 10rem;">
                            <span style="  font-size: 2em;"> <b>Montant</b></span><br>
                            <span style="  font-size: 1em;">{{ $statut->statut_facture }}</span>
                        </td>
                        <td style="  font-size: 4em;padding:0.5rem 0.5rem 1rem 1rem ;color:green">
                            <b> {{ $fact->prix_facture }} </b> €
                        </td>
                    </tr>
                </table>
                <!-- ----------------------------------------------------------------------------- -->
            </div>
            <!-- <div>     une div non utilisé
                
            </div> -->
            <!-- ----------------------------------------------------------------  -->
            <div class="profile-container">
                <div class="row row-space-20">
                    <!-- -------------------------section -------------------------------------- -->
                    <div class="col-md-4 hidden-xs hidden-sm">
                        <div class="tab-content p-0">
                            <div class="tab-pane active show" id="profile-about">
                                <!----------------------------------Info Client----------------------------------------  -->
                                <table class="table table-profile">
                                    <thead>
                                        <tr style="padding:0;">
                                            <th style="padding:0;" colspan="2">Info Client 
                                                <a
                                                    style="background: none ; border : none;margin-left:10px"
                                                    onclick="openClient()" class="btn btn-primary">
                                                    <i style="color : green;" class="fas fa-edit fa-lg"></i>
                                                </a>
                                            </th>
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
                                        <!-- ------------------------------------------------------- -->
                                        <thead>
                                            <tr>
                                                <th colspan="2">Liste Client</th>
                                            </tr>
                                        </thead>
                                        <table>
                                            <tbody>

                                                {{-- @dd(count($experiences)) --}}
                                                @foreach ($clients as $clt)
                                                    <!-- ici ca contient rien ! -->
                                                    <!-- <tr>
                                                    <td>
                                                        
                                                    </td>
                                                </tr> -->
                                                    <tr style="padding:0 0 2rem 0;  ">
                                                        <td style="padding:0 1rem 0 0.5rem">
                                                            {{ $clt->id_contact }}
                                                        </td>
                                                        <td style="padding:0 1rem 0 0.5rem">
                                                            {{ $clt->nom }}
                                                        </td>
                                                        <td style="padding:0 1rem 0 2rem">
                                                            {{ $clt->prenom }}
                                                        </td>
                                                        <td style="padding:0 1rem 0 1rem">
                                                            <a href="/contacts.show/{{ $clt->id_contact }}"
                                                                Style="color:blue">GO</a>
                                                                
                                                        </td>
                                                        {{-- <td>
                                                            <form
                                                            action="{{ route('reservationclient.clienttoexperimentateur') }}"
                                                            method="GET">
                                                            @if (count($experiences) > 0)
                                                                <select name="id_experience">
                                                                    @foreach ($experiences as $experience)
                                                                        <option value="{{ $experience->id_experience }}">
                                                                            {{ $experience->nom_experience }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" name="num_facture"
                                                                    value="{{ $url }}">
                                                                <input type="hidden" name="id_contact"
                                                                    value="{{ $clt->id_contact }}">
                                                                <button type="submit">EXP</button>
                                                            @else
                                                                <p>Aucune expérience disponible</p>
                                                            @endif
                                                        </form>
                                                        </td> --}}
                                                        @if (count($experiences) > 0)
                                                        <td>
                                                            <a style="color:blue" onclick="open_selectButton()" id="selectButton">EXP</a>
                                                        
                                                        <div class="popup-select"  id="popupSelect">
                                                        <form  action="{{ route('reservationclient.clienttoexperimentateur') }}" method="GET">
                                                            
                                                            <label for="id_experience">Sélectionner une expérience</label>
                                                                <select name="id_experience" >
                                                                    @foreach ($experiences as $experience)
                                                                        <option value="{{ $experience->id_experience }}">{{ $experience->nom_experience }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" name="num_facture" value="{{ $url }}">
                                                                <input type="hidden" name="id_contact" value="{{ $clt->id_contact }}">
                                                                <button type="submit" class="btn btn-success">Valider</button>
                                                                <button type="reset" class="btn btn-danger" onclick="close_selectButton()"  id="cancelButton">Annuler</button>
                                                            </td>
                                                            @else
                                                               <td> <p>Aucune expérience disponible</p> </td>
                                                            @endif
                                                        </form>
                                                    </div>
                                               
                                                        {{-- <td style="padding:0 1rem 0 1rem">
                                                    <a href="{{ route('reservationclient.clienttoexperimentateur',['id_experience'=>$experiences[0]->id_experience,'num_facture'=>$url,'id_contact'=>$clt->id_contact]) }}" Style="color:blue">EXP</a>
                                                </td> --}}

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- <tbody>
                                    @foreach ($clients as $key => $value)
                                    @if ($value->id_contact != $con->id_contact)
                                        <tr>
                                            <td>{{ $value->nom }}</td>
                                            <td>{{ $value->prenom }} <a href="/clients.show/{{ $value->id_contact }}" style="font-size:1em;padding:0 0 0 2rem;color:green"><b>Go</b></a></td>
                                            
                                        </tr>
                                    @endif
                                    @endforeach
                                    </tbody> --}}
                                    </tbody>
                                </table>
                                <!-- ----------------------------------Info Client-------------------------------------------- -->

                                <!-- ----------------------------------Interaction-------------------------------------------- -->

                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Intéractions
                                                <svg style="cursor:pointer" onclick="openInt()"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20">
                                                    <g id="Groupe_3" data-name="Groupe 3"
                                                        transform="translate(-505.039 -340.955)">
                                                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="10"
                                                            cy="10" r="10"
                                                            transform="translate(505.039 340.955)" fill="#3ac25e" />
                                                        <rect id="Rectangle_1" data-name="Rectangle 1" width="4"
                                                            height="15.055" rx="2"
                                                            transform="translate(513.039 343.428)" fill="#fff" />
                                                        <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998"
                                                            height="15.622" rx="1.999"
                                                            transform="translate(522.85 348.956) rotate(90)"
                                                            fill="#fff" />
                                                    </g>
                                                </svg>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form method="post">
                                            @csrf
                                            @method('DELETE')
                                            @foreach ($interactions as $interaction)
                                                <tr>
                                                    <td style="text-align:right;">
                                                        <!-- {{ $interaction->date_heure }} -->
                                                        {{ Carbon\Carbon::parse($interaction->date_heure)->format('Y m d H:i') }}
                                                    </td>
                                                </tr>
                                                <tr style="border-radius:10px;margin-bottom:30px; width: fit-content;">
                                                    <td style="text-align: left; padding:0.5rem; ">
                                                        @foreach($les_tags_lier_avec_inter as $tags)
                                                            @if($tags->id_interaction == $interaction->id_interaction)
                                                            {{ $tags->tag }} | 
                                                            @endif
                                                        @endforeach
                                                        <pre style="width:180px; margin:0; white-space: pre-line;">
                                                            {{ $interaction->texte }}
                                                        </pre>
                                                    </td>
                                                    <td style="margin:0;  padding:0; ">
                                                        <!-- -------------btn update test ------------------- -->
                                                        <div class="btn_upd_int btn btn-primary"
                                                            data-value="{{ $interaction->id_interaction }}"
                                                            style="background-color : #fff ; border : #fff;font-size:0.85rem; margin-right:-10px;">
                                                            <i style="color : #e6ac00" class="fas fa-edit  "></i>
                                                        </div>
                                                        <!-- ----------------------------------- -->
                                                        <button
                                                            formaction="/reservationclient.destroyinteraction/{{ $interaction->id_interaction }}/{{ $url }}"
                                                            style="background-color : #fff ; border : #fff; font-size:0.85rem; margin-left:-5px"
                                                            type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Vous êtes sûrs de vouloir supprimer cette intéraction ?')">
                                                            <i style="color : #cc3300" class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </form>
                                    </tbody>
                                </table>
                                <!-- ----------------------------------Interaction-------------------------------------------- -->

                            </div>
                        </div>
                    </div>
                    <!-- ------------------------- /section -------------------------------------- -->
                    {{-- @dd($experience) --}}
                    <!-- -------------------------section -------------------------------------- -->
                    <div class="col-md-4 hidden-xs hidden-sm">
                        <div class="tab-content p-0">
                            <div class="tab-pane active show" id="profile-about">
                                <!-- ------------------------------Info Facture------------------------------------------ -->
                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Info Facture
                                                <!-- <b style="font-size:0.7em;padding:0 0 0 2rem"></b> -->
                                                <span style="font-size:0.5em;padding:0 0 0 2rem">ID : {{ $url }}
                                                </span><br>
                                                <!-- <b style="font-size:0.7em;padding:0 0 0 2rem">Lien Facture : </b> -->
                                                <span style="font-size:0.5em;padding:0 0 0 2rem"> Lien Facture : </span>
                                                <a href="{{ route('factures.show', ['facture' => $url]) }}"
                                                    style="font-size:1em;padding:0 0 0 0.4rem;color:green">Go</a>

                                            </th>
                                        </tr>
                                    </thead>


                                    @if (empty($experiences))
                                        @foreach ($prestations as $key => $value)
                                            <tbody style="border:none">
                                                <tr>
                                                    <td class="field"> <b style="color: red;">Pack N°
                                                            {{ $loop->index + 1 }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field" style="padding:1rem 0 0 1rem;">Pack: </td>
                                                    <td class="value" style="padding:1rem 0 0 1rem; text-align:center;">
                                                        {{ $value->nom }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Titre:</td>
                                                    <td class="value" style="text-align:center;">
                                                        {{ $value->nb_titres }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Participant:</td>
                                                    <td class="value" style="text-align:center;">
                                                        {{ $value->nb_participants }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Lien Pack : </td>
                                                    <td class="value" style="text-align:center;">
                                                        <a href="{{ route('packs.show', ['id_pack' => $value->id_pack]) }}"
                                                            style="font-size:1em;padding:0 0 0 0.4rem;color:green">Go</a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $p = $prest_pack->firstWhere('id_pack_experience', $value->id_pack_experience);
                                                    
                                                @endphp
                                                @if (!empty($p))
                                                    <tr>
                                                        <td class="field"> <b style="color: red;">Autre Prestation Pack
                                                                N° {{ $loop->index + 1 }}</b>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="field">Nom Produit:</td>
                                                        <td class="value">
                                                            {{ $p->nom_produit }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Montant:</td>
                                                        <td class="value">
                                                            {{ $p->prix }}€
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Lien Produit : </td>
                                                        <td class="value" style="text-align:center;">
                                                            <a href="{{ route('produitservice.show', ['produitservice' => $p->id_produit]) }}"
                                                                style="font-size:1em;padding:0 0 0 0.4rem;color:green">Go</a>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        @endforeach

                                        @foreach ($fact_prod as $key => $value)
                                            <tbody style="border:none">
                                                <tr>
                                                    <td class="field"><b style="color: red;"> Autres Prestations Non
                                                            liées à un pack</b></td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Nom Produit:</td>
                                                    <td class="value">
                                                        {{ $value->nom_produit }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Montant:</td>
                                                    <td class="value">
                                                        {{ $value->prix }}€
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Lien Produit : </td>
                                                    <td class="value" style="text-align:center;">
                                                        <a href="{{ route('produitservice.show', ['produitservice' => $value->id_produit]) }}"
                                                            style="font-size:1em;padding:0 0 0 0.4rem;color:green">Go</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    @else
                                        @foreach ($experiences as $key => $value)
                                            <tbody style="border:none">
                                                <tr>
                                                    <td class="field"> Nom Experience :
                                                        <!-- <b style="font-size:0.7em;padding:0 0 0 2rem"> {{ $statut_experience->firstWhere('id_experience', $value->id_experience)->statut_experience }}<b> -->
                                                        <!-- <br><b style="font-size:0.9em;padding:0 0 0 2rem"> Numero Experience : {{ $value->numero_experience }}<b> -->
                                                    </td>
                                                    <td class="value" style="text-align:center;">
                                                        {{ $value->nom_experience }} </td>
                                                </tr>
                                                <tr>
                                                    <td class="field"> statut : </td>
                                                    <td class="value" style="text-align:center;">
                                                        {{ $statut_experience->firstWhere('id_experience', $value->id_experience)->statut_experience }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Numero Experience : </td>
                                                    <td class="value" style="text-align:center;">
                                                        {{ $value->numero_experience }} <a href="{{ route('experience.show', ['id_experience' => $value->id_experience, 'num_facture' => $url]) }}"
                                                            style="font-size:1em;padding:0 0 0 0.4rem;color:green">Go</a></td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Page Experience : </td>
                                                    <td class="value" style="text-align:center;">
                                                        <a href="{{route('contributions', ['idExperience'=>$value->id_experience])}}"
                                                            style="font-size:1em;padding:0 0 0 0.4rem;color:green">Go</a></td>
                                                </tr>
                                                <tr>
                                                    <td class="field" style="padding:1rem 0 0 1rem;">Pack: </td>
                                                    <td class="value" style="padding:1rem 0 0 1rem; text-align:center;">
                                                        {{ $value->nom }}
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="field">Titre:</td>
                                                    <td class="value" style="text-align:center;">
                                                        {{ $value->nb_titres }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Participant:</td>
                                                    <td class="value" style="text-align:center;">
                                                        {{ $value->nb_participants }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">Bon cadeau:</td>
                                                    <?php
                                                    if (is_null($value->titre)) {
                                                        $cadeau = 'non';
                                                    } else {
                                                        $cadeau = 'oui';
                                                    } ?>
                                                    <td class="value" style="padding:0 0 2rem 0;text-align:center;">
                                                        {{ $cadeau }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    @endif

                                </table>
                                <!-- -----------------------------Info Facture ------------------------------------------ -->
                            </div>
                        </div>
                        <br>
                    </div><!-- /.modal -->
                    <!-- ------------------------- /section -------------------------------------- -->
                    <!-- ------------------------- section -------------------------------------- -->
                    <div class="col-md-4 ">
                        <div class="tab-content p-0">
                            <div class="tab-pane active show" id="profile-about">
                                <!-- ------------------------------------Evénements---------------------------------------- -->
                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th colspan=2>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td>{{$description}}</td> 
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="2">Evénements </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($evenements as $e)
                                            <tr>
                                                <td class="field">
                                                    {{ Carbon\Carbon::parse($e->date_statut)->format('Y m d') }}</td>
                                                <td class="value">
                                                    {{ $e->contenu_notification }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <!-- --------------- -->
                                    <thead>
                                        <tr>
                                            <th colspan="2">Expérimentateurs </th>
                                        </tr>
                                    </thead>
                                    @foreach ($experimentateurs as $key => $value)
                                        <tbody style="border:none">
                                            <tr>
                                                <td style="font-size:1em;color:#333333;"><b> Expérience
                                                        {{ $key + 1 }} </b> </td>
                                                <td></td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <td>{{ $value->prenom }}</td>
                                                <td>{{ $value->nom }}</td>
                                                <td> <a href="/contacts.show/{{ $value->id_contact }}"
                                                        style="font-size:1em;padding:0 0 0 2rem;color:green"><b>Go</b></a>
                                                </td>

                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                                <!-- -------------------------------------Evénements----------------------------------------------- -->
                                <!-- ------------------------------------Storytelling---------------------------------------- -->
                                <div style="max-width:33% ">
                                    <table class="table table-profile" >
                                        <thead>
                                            <tr>
                                                <th > Storytelling
                                                    <svg style="cursor:pointer" onclick="openStory()"
                                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <g id="Groupe_3" data-name="Groupe 3"
                                                            transform="translate(-505.039 -340.955)">
                                                            <circle id="Ellipse_1" data-name="Ellipse 1" cx="10"
                                                                cy="10" r="10"
                                                                transform="translate(505.039 340.955)" fill="#3ac25e" />
                                                            <rect id="Rectangle_1" data-name="Rectangle 1" width="4"
                                                                height="15.055" rx="2"
                                                                transform="translate(513.039 343.428)" fill="#fff" />
                                                            <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998"
                                                                height="15.622" rx="1.999"
                                                                transform="translate(522.85 348.956) rotate(90)"
                                                                fill="#fff" />
                                                        </g>
                                                    </svg>
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
                                                            <div class="btn_upd_sto btn btn-primary"
                                                                data-value="{{ $story->id_storytelling }}"
                                                                style="background-color : #fff ; border : #fff;font-size:0.85rem; margin-right:-10px;">
                                                                <i style="color : #e6ac00" class="fas fa-edit  "></i>
                                                            </div>
                                                            <!-- ------------------------------------- -->
                                                            <button
                                                                formaction="/reservationclient.destroystorytelling/{{ $story->id_storytelling }}/{{ $url }}"
                                                                style="background-color : #fff ; border : #fff; font-size:0.85rem; margin-left:-5px;"
                                                                type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Vous êtes sûrs de vouloir supprimer ce storytelling ?')"><i
                                                                    style="color : #cc3300" class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </form>
                                        </tbody>
                                    </table>

                                </div>
                                
                            
                            <!-- ------------------------------------Storytelling---------------------------------------- -->
                        
                    </div>
                    <br>
                </div><!-- /.modal -->
            </div>
            <!-- ------------------------------------------------------------------------------- -->
        </div>
    </div>
    <!-- </div> 2 fermeture en trop


    </div> -->

    <br>
    <br>
    <br>
    <!--<div class="h-100 d-flex align-items-center justify-content-center">
        <a class="btn btn-primary" href="{{ route('reservationclient.index') }}" > Back</a>
        <a class="btn btn-success" href="" style="margin-left : 6px "> Print</a>
        <a href="{{ route('reservationclient.edit', ['experience' => $url]) }}" style="margin-left : 6px " class="btn btn-warning">Edit</a>
    </div>-->
    </div>
    <script>
        function openInt() {
            var div_int_form = document.getElementById("intForm");
            div_int_form.style.display = "block";
            suggestion_tag_inter(div_int_form);
        }

        function closeInt() {
            document.getElementById("intForm").style.display = "none";
        }

        function openStory() {
            var div_story_form = document.getElementById("storyForm");
            div_story_form.style.display = "block";
            suggestion_tag_story(div_story_form);
        }

        function closeStory() {
            document.getElementById("storyForm").style.display = "none";
        }

        function openClient() {
            document.getElementById("clientForm").style.display = "block";
        }

        function closeClient() {
            document.getElementById("clientForm").style.display = "none";
        }
        // --------------- ---------------------
        function open_selectButton() {
            document.getElementById('popupSelect').style.display = 'block';
        }
        function close_selectButton() {
            document.getElementById("popupSelect").style.display = "none";
        }
        // ------------ca posait preobleme dans le cas ou il n'y avait pas d'xperience----------------
        // document.getElementById('selectButton').addEventListener('click', function() {
            // document.getElementById('popupSelect').style.display = 'block';
        // });
        // document.getElementById("cancelButton").addEventListener("click", function() {
        //     document.getElementById("popupSelect").style.display = "none";
        // });
        // ---------------  ---------------------

        //******************** yasser *****************************
        const csrfToken = "{{ csrf_token() }}";
        // ---------------------
        var popupActivated = false;
        // console.log(popupActivated);
        var content = document.getElementById('content');
        // -----------------------------interaction--------------------------------------
        $(document).ready(function() {
            $(document).ready(function() {
                $('.btn_upd_int').each(function() {
                    var dataValue = $(this).data('value');
                    // console.log(dataValue)
                    // ___________________________________________________
                    $(this).on('click', function() {
                        // console.log(dataValue);
                        // chercher les data necessaire pour cet élément
                        $.ajax({
                            url: '/interactions.update_show_interaction/' +
                                dataValue,
                            method: 'GET',
                            success: function(response) {
                                console.log(response)
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
            console.log(popupActivated);
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
                // console.log('je suis la');
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
                                // console.log(response);
                                if (response.length > 0) {
                                    div_affichage.innerHTML = "";
                                    // let compteur = 0;
                                    response.forEach( function(un_tag) {
                                        // console.log(un_tag.tag);
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
                let index = 1 + zone_affichage_dans_barre.childElementCount;
                console.log(index);
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

                

            // le_btn_creer.onclick = function() {
            //     alert('Hello');
            // };
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

        // ------------------------------- storytelling -------------------------------------

        $(document).ready(function() {
            $(document).ready(function() {
                $('.btn_upd_sto').each(function() {
                    var dataValue = $(this).data('value');
                    // console.log(dataValue)
                    // ___________________________________________________
                    $(this).on('click', function() {
                        // chercher les data necessaire pour cet élément
                        $.ajax({
                            url: '/storytellings.edit_show_storytelling/' +
                                dataValue,
                            method: 'GET',
                            success: function(response) {
                                // faire le traitement
                                console.log(response)
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
    </script>

    <div class="formclt">
        <div class="form-int" id="intForm">
            <form action="{{ route('reservationclient.createinteraction') }}" method="post" class="form-container">
                @csrf
                <h4 style="text-align:start;margin-top:30px">Ajouter une nouvelle interaction liée à la réservation</h4>
                <input type="hidden" id="num_facture" name="num_facture" value="{{ $url }}">

                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                    <select name="id_cnt" id="pet-select"
                        style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                        <option value="">Choisissez un Contact </option>
                        @foreach ($clients as $contact)
                            <option value="{{ $contact->id_contact }}"{{ $loop->first ? ' selected' : '' }}>
                                {{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}
                            </option>
                            <!-- <option value="{{ $contact->id_contact }}"{{ old('id_cnt') == $contact->id_contact ? 'selected' : '' }}>{{ $contact->id_contact }} - {{ $contact->nom }} {{ $contact->prenom }}</option>     -->
                        @endforeach
                    </select>

                    <select name="id_exp" id="pet-select"
                        style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                        <option value="">Aucune Experience </option>
                        @foreach ($experiences as $exp)
                            <option value="{{ $exp->id_experience }}"{{ $loop->first ? ' selected' : '' }}>
                                {{ $exp->id_experience }} - {{ $exp->nom_experience }}
                            </option>
                            <!-- <option value="{{ $exp->id_experience }}"{{ old('id_exp') == $exp->id_experience ? 'selected' : '' }}>{{ $exp->id_experience }} - {{ $exp->nom_experience }} </option>     -->
                        @endforeach
                    </select>
                </div>
                    <!-- -------------------------tags--------------- -->
                    <div style="width: 100%; background-color: white; border: 2px black solid; border-radius: 4px; margin: 0; resize: none; overflow: hidden;" >
                        <div id="tag_selectionned"></div>
                        <!-- <div  contenteditable="true" placeholder="Cherchez un tag"  id="select_tag_int"></div> -->
                        <input  style="margin:0; background:none;" placeholder="Cherchez un tag" type="text" id="select_tag_int">
                    </div>
                    <!--  -->
                    <div id="affichage_tag_selected_inter" style="border-radius:4px; padding:10px;  ">
                    </div>
                    <!-- -------------------------tags--------------- -->
                <!-- <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="type_int" class="form-control" value="{{ old('type_int') }}"
                        placeholder="Type d'Interaction" style="background-color:white;border:2px black  solid">
                </div> -->
                <div class="form-contact" style="margin-top:20px">
                    <!-- <input type="text" name="texte" class="form-control"  placeholder="Texte de l'Interaction" style="background-color:white;border:2px black  solid"> -->
                    <textarea name="texte" class="form-control" value="{{ old('texte') }}" cols="30" rows="5"
                        placeholder="Texte de l'Interaction"
                        style="white-space: pre-line; background-color:white;border:2px black  solid  ; margin-bottom:3px"></textarea>
                </div>
                <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeInt()" style="width:100px">Annuler</button>
            </form>
        </div>

        <div class="form-story" id="storyForm">
            <form action="{{ route('reservationclient.createstorytelling') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="num_facture" name="num_facture" value="{{ $url }}">


                <h4 style="text-align:start;margin-top:30px">Ajouter un nouveau storytelling à une experience </h4>
                    

                <select name="id_exp" id="pet-select"
                    style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Selectionnez une Experience </option>
                    @foreach ($experiences as $exp)
                        <option value="{{ $exp->id_experience }}"{{ $loop->first ? ' selected' : '' }}>
                            {{ $exp->id_experience }} - {{ $exp->nom_experience }}
                        </option>
                        <!-- <option value="{{ $exp->id_experience }}"{{ old('id_exp') == $exp->id_experience ? 'selected' : '' }}>{{ $exp->id_experience }} - {{ $exp->nom_experience }} </option>     -->
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
                <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="desc_content" class="form-control" value="{{ old('desc_content') }}"
                        placeholder="Description Contents Experience"
                        style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:20px">
                    <!-- <input type="text" name="desc_story" class="form-control"  placeholder="Description Storytelling" style="background-color:white;border:2px black  solid"> -->
                    <textarea name="desc_story" class="form-control" value="{{ old('desc_story') }}" cols="30" rows="5"
                        placeholder="Description Storytelling" style="background-color:white;border:2px black  solid; margin-bottom:3px"></textarea>
                </div>

                <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeStory()" style="width:100px">Annuler</button>
            </form>
        </div>

        <div class="form-client" id="clientForm">
            <form action="{{ route('reservationclient.updateclient', ['id_contact' => $con->id_contact]) }}" method="post"
                class="form-container">
                @csrf
                @method('PUT')
                <input type="hidden" id="num_facture" name="num_facture" value="{{ $url }}">
                <input type="hidden" id="id_contact" name="id_contact" value="{{ $con->id_contact }}">


                <h4 style="text-align:start;margin-top:0px">Modifié le client liée à la réservation </h4>


                <div class="form-contact" style="margin-top:5px">
                    <input type="text" name="Nom" class="form-control" placeholder="Entrer le nom"
                        value='{{ old('Nom') ?? $con->nom }}' style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:5px">
                    <input type="text" name="Prénom" class="form-control" placeholder="Entrer le prénom"
                        value="{{ old('Prénom') ?? $con->prenom }}"
                        style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:5px">
                    <input type="text" name="mail" class="form-control" placeholder="Email"
                        value="{{ old('mail') ?? $con->email }}" style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:5px">
                    <input type="text" name="tel" class="form-control" placeholder="Téléphone"
                        value="{{ old('tel') ?? $con->tel }}" style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:5px">
                    <input type="text" name="adress" class="form-control" placeholder="Adresse"
                        value="{{ old('adress') ?? $con->adresse }}"
                        style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:5px">
                    <input type="text" name="cp" class="form-control" placeholder="Code postale"
                        value="{{ old('cp') ?? $con->code_postal }}"
                        style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:5px">
                    <input type="text" name="ville" class="form-control" placeholder="Ville"
                        value="{{ old('ville') ?? $con->ville }}"
                        style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:5px">
                    <input type="text" name="url" class="form-control" placeholder="URL dossier"
                        value="{{ old('url') ?? $con->url_contact_folder }}"
                        style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:5px">
                    <label for="pet-select">Entreprise</label>
                    <select name="entreprise" id="pet-select"
                        style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                        @if (isset($org->id_organisation))
                            @if (old('entreprise') !== null)
                                <option value="">Aucune</option>
                                @foreach ($nom_org as $nom)
                                    <option value="{{ $id_org[$loop->index] }}"
                                        {{ old('entreprise') == $id_org[$loop->index] ? 'selected' : '' }}>
                                        {{ $nom }}</option>
                                @endforeach
                            @else
                                <option value="">Aucune</option>
                                @foreach ($nom_org as $nom)
                                    @if ($id_org[$loop->index] == $org->id_organisation)
                                        <option value="{{ $id_org[$loop->index] }}" selected>{{ $nom }}
                                        </option>
                                    @else
                                        <option value="{{ $id_org[$loop->index] }}">{{ $nom }}</option>
                                    @endif
                                @endforeach
                            @endif
                        @else
                            <option value="" selected>Aucune</option>
                            @foreach ($nom_org as $nom)
                                <option value="{{ $id_org[$loop->index] }}"
                                    {{ old('entreprise') == $id_org[$loop->index] ? 'selected' : '' }}>
                                    {{ $nom }}</option>
                            @endforeach
                        @endif


                    </select>
                </div>
                <div class="form-contact" style="margin-top:20px">
                    @if (isset($org->type))
                        <input type="text" name="type" class="form-control" placeholder="Type Contact"
                            value="{{ old('type') ?? $org->type }}"
                            style="background-color:white;border:2px black  solid">
                    @else
                        <input type="text" name="type" class="form-control" placeholder="Type Contact"
                            style="background-color:white;border:2px black  solid">
                    @endif
                </div>

                <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeClient()" style="width:100px">Annuler</button>
            </form>
        </div>
    </div>

    <STYLE>
        body {
            background: #eaeaea;
        }


        #selectButton {
            cursor: pointer;
        }
        /* Style pour la pop-up */
        .popup-select {
            position: absolute;
            top: 20%;
            left: 300px;
            z-index: 1;
            display: none;
            background-color: #f9f9f9;
            min-width: 300px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 16px;
            text-align: center;
        }

        /* Style pour les options du select */
        .popup-select select {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
        }

        /* Affichage de la pop-up lorsque le bouton est cliqué */
        #selectButton:focus + #popupSelect,
        #popupSelect:focus {
            display: block;
        }

        /* Autres styles de positionnement et d'apparence */
    
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

        #pageSubmenu14 {
            visibility: visible;
            display: block;
        }

        #pageSubmenu18 {
            visibility: visible;
            display: block;
        }

        #M49 {
            background-color: #747474;
        }
    </STYLE>


    <style>
        /* Stylez et fixez le bouton sur la page */


        /* Masquez la forme Popup */
        .form-clt {
            display: none;
            position: fixed;
            left: 55%;
            top: 30%;
            transform: translate(-45%, 5%);
            border: 3px black solid;
            border-radius: 10px;

        }

        .form-pay {
            display: none;
            position: fixed;
            left: 55%;
            top: 1%;
            transform: translate(-45%, 5%);
            border: 3px black solid;
            border-radius: 10px;

        }

        /* Masquez la forme Popup */
        .form-int {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-75%, -50%);
            z-index: 9998;
            border: 3px black solid;
            border-radius: 10px;

        }

        .form-story {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-25%, -50%);
            z-index: 9999;
            border: 3px black solid;
            border-radius: 10px;

        }

        .form-client {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-25%, -50%);
            z-index: 9999;
            border: 3px black solid;
            border-radius: 10px;

        }

        /* Masquez la forme Popup */
        .form-pck {
            display: none;
            position: fixed;
            left: 55%;
            top: 15%;
            transform: translate(-45%, 5%);
            border: 3px black solid;
            border-radius: 10px;

        }

        .form-crepck {
            display: none;
            position: fixed;
            left: 55%;
            top: 15%;
            transform: translate(-45%, 5%);
            border: 3px black solid;
            border-radius: 10px;
        }

        .form-crepro {
            display: none;
            position: fixed;
            left: 55%;
            top: 15%;
            transform: translate(-45%, 5%);
            border: 3px black solid;
            border-radius: 10px;
        }

        .form-creclt {
            display: none;
            position: fixed;
            left: 55%;
            top: 1%;
            transform: translate(-45%, 5%);
            border: 3px black solid;
            border-radius: 10px;
        }

        /* Styles pour le conteneur de la forme */
        .form-container {
            overflow: auto;
            max-height: 80vh;
            width: 400px;
            padding: 20px;
            background-color: #EDEFF0;
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
            /* padding: ; */
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
        .btn_plus {
            width: 115px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
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

        .div_boutons {
            display: flex;
            justify-content: space-evenly;
        }
    </style>

@endsection
