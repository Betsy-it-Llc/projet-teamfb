<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
@extends('layouts.navadmin')
@section('content')
<div class="container" style=" width:100%;margin:0">
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
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <div id="content" class="p-0 content" style=" width:100%;margin:0">

        <div class="profile-header">
        <center><b style="margin-bottom :20px;font-size:2.5rem;"> Info Expérience </b>
                <h1> {{ $experience[0]->nom_experience }}
                    <i  style="cursor:pointer; color : #e6ac00" onclick="openIntNom()" class="fas fa-edit"></i>
                </h1>


        </div>
        <br>


        <div class="profile-container" style="margin-top:70px">
            <div class="row row-space-20" style="margin-right:0">
                <div class="col-md-4 hidden-xs hidden-sm" >
                    <div class="p-0 tab-content" >
                        <div class="tab-pane active show" id="profile-about" style="" >
                <!-- ----------------------------------------------------------------------- -->
                            <table >
                                <thead>
                                    <tr>
                                            <th colspan="2"><b style="font-size:2.5em;">Expérience</b></th>
                                            <tr ><td style="padding:0 0 2rem 0;">
                                                <b style="padding:0;font-size:1.1em"> ID : </b>{{ $id_experience }}<br>
                                                <b style="padding:0;font-size:1.1em"> Num : </b>{{ $experience[0]->numero_experience }}<br>
                                                <b style="padding:0;font-size:1.1em"> Nom : </b>{{ $experience[0]->nom_experience }}<br>
                                                <b style="padding:0;font-size:1.1em"> Statut : </b>{{ $statut_experience->statut_experience }}<br>
                                                <b style="padding:0;font-size:1.1em"> Date Reservation : </b> {{ Carbon\Carbon::parse($experience[0]->date_reservation . ' ' . $experience[0]->heure_reservation, 'Europe/Paris')->format('Y m d H:i:s') }}  <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                                href="{{ route('experience.edit', ['id_experience'=>$id_experience,'num_facture'=>$num_facture]) }}"><i style="color : #e6ac00"
                                                    class="fas fa-edit"></i></a><br>
                                                <b style="padding:0;font-size:1.1em"> Durée Réservation : </b>{{ Carbon\Carbon::parse($experience[0]->duree_reservation, 'Europe/Paris')->format('H:i:s') }}<br>
                                                <br>
                                                <b style="padding:0;font-size:1.1em"> Page Exp : </b><a href="{{route('contributions', ['idExperience'=>$id_experience])}}"><img src="{{ asset('img/exp_icon.png') }}" style="width:2em;height:2em;"></a><br>
                                                <br>
                                                <div class="row" style="margin-left: 0;">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch d-flex align-items-center justify-content-start" style="margin-left: 0%;">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Non Repertorié</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch d-flex align-items-center justify-content-end" style="margin-right: 0%;">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-id="{{$id_experience}}" {{ $experience[0]->visibility == 'public' ? 'checked' : '' }} onclick="toggleRepertorie()">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td></tr>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td class="field"><b style="padding:0 0 0 9rem;">Expérience liée : </b> </td>

                                    </tr>
                                    @foreach ($experiences_liees as $exp)
                                    <tr>
                                        <td class="value" style="text-align:right">
                                        {{ $exp->nom_experience }} : <a href="{{ route('experience.show', ['id_experience'=>$exp->id_experience,'num_facture'=>$num_facture])  }}" Style="color:blue">GO</a> <br>
                                        </td>
                                    </tr>

                                    @endforeach
                                    <tr>
                                        <td class="field" ><b style="padding:0 0 0 10.1rem;">Contact liée :</b></td>
                                        <td class="value">

                                        </td>
                                    </tr>
                                    <!-- ****************** info client doit etre liee au tableau suivant pas ici ************* -->
                                    <tr>
                                        <td class="field" ><b style="padding:0 0 0 2.6rem;font-size:2em">Info Client :</b> </td>

                                    </tr>

                                </tbody>
                            </table>
                <!-- ----------------------------------------------------------------------- -->

                            <table>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <!-- ici ca contient rien ! -->
                                    <!-- <tr>
                                        <td>

                                        </td>
                                    </tr> -->
                                    <tr style="padding:0 0 2rem 0;  ">
                                        <td style="padding:0 1rem 0 0.5rem">
                                            {{ $client->id_contact }}
                                        </td>
                                        <td style="padding:0 1rem 0 0.5rem">
                                            {{ $client->nom }}
                                        </td>
                                        <td style="padding:0 1rem 0 2rem">
                                            {{ $client->prenom }}
                                        </td>
                                        <td style="padding:0 1rem 0 1rem">
                                            <a href="/contacts.show/{{$client->id_contact}}" Style="color:blue">GO</a>
                                        </td>
                                        <td style="padding:0 1rem 0 1rem">
                                            <a href="{{ route('experience.clienttoexperimentateur',['id_experience'=>$id_experience,'num_facture'=>$num_facture,'id_contact'=>$client->id_contact]) }}" Style="color:blue">EXP</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            @php
                                $nb_participants=(int) $experience[0]->nb_participants;
                            @endphp
                            {{-- @dd($experimentateurs) --}}
                            <table>
                                <thead>
                                    <tr>
                                        <td class="field" style="font-size:2em;padding:1rem 0 0 0"><b style="padding:0 0 0 2.6rem;">Info Facture :</b> {{ $num_facture }} </td>
                                    </tr>
                                </thead>
                            </table>
                            <table >
                                <tbody>
                                @foreach ($facture as $fact)

                                        <tr>
                                            <td class="field" style="font-size:1.2em;color:#333333;width:73%;text-align:right"><b>Studio :</b></td>
                                            <td class="value" style="text-align:right">
                                            Studio Paris
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field" style="color:black;width:73%;text-align:right"><b>Pack : </b></td>
                                            <td class="value" style="text-align:right">
                                            {{ $fact->nom }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field" style="color:black;width:73%;text-align:right"><b>Titre : </b></td>
                                            <td class="value" style="text-align:right">
                                            {{ $fact->nb_titres }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field" style="color:black;width:73%;text-align:right"><b>Bon Cadeau : </b></td>
                                            <?php
                                            if (empty($bon_cadeau)) {
                                                $cadeau="non";
                                            }
                                            else {
                                                $cadeau="oui";
                                            }
                                            /*foreach ($bons as $bon => $val) {
                                                if ($val->num_facture === $value->num_facture) {
                                                    $cadeau = "oui";
                                                } else {
                                                    $cadeau = "non";
                                                }
                                            }*/
                                            ?>
                                            <td class="value" style="text-align:right">
                                            {{ $cadeau }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field" style="color:black;width:73%;text-align:right"><b>Participants : </b></td>
                                            <td class="value" style="text-align:right">
                                            {{ $fact->nb_participants }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field" style="color:black;width:73%;text-align:right"><b>Statut Facture : </b></td>
                                            <td class="value" style="text-align:right">
                                            {{ $statut_facture->statut_facture }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field" style="color:black;width:73%;text-align:right"><b>Lien Facture : </b></td>
                                            <td class="value" style="text-align:right">
                                                <a href="{{route('factures.show',['facture'=>$fact->num_facture])}}" style="color:blue;">GO</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field" style="color:black;width:73%;text-align:right"><b>Lien Reservation : </b></td>
                                            <td class="value" style="text-align:right">
                                                <a href="{{route('reservationclient.show',['experience'=>$fact->num_facture])}}" style="color:blue;">GO</a>
                                            </td>
                                        </tr>


                                        @endforeach
                            </tbody>

                            </table>
                            <table>
                            @if (!empty($autres_prestations))
                                        <thead>
                                        <tr>
                                        <td class="field" style="padding:1rem 0 0 0"><b style="padding:0 0 0 2.6rem;font-size:2em;">Autre Prestations</td>
                                        </tr>

                                        </thead></table>
                                            <table>
                                        <tbody>


                                            @foreach ($autres_prestations as $pres)

                                            @if ($pres->nom_produit=="Vynile")
                                                <tr>
                                                    <td class="field" style="text-align:right;padding:0 2.5rem 0 9rem"><b>Vinyle: </b></td>
                                                    <td class="value"style="padding:0;">
                                                        {{ $pres->nom_produit }}
                                                    </td>
                                                </tr>
                                            @elseif ($pres->nom_produit=="Interview")
                                                <tr>
                                                    <td class="field"><b>Interview:</b> </td>
                                                    <td class="value">
                                                    Interview ???
                                                    </td>
                                                </tr>
                                            @else
                                            <tr>
                                                <td class="field" style="text-align:center;padding:0 0rem 0 7rem"><b>Prestation {{ $loop->index+1 }}:</b></td>
                                                <td class="value" >
                                                {{ $pres->nom_produit }}
                                                </td>
                                            </tr>
                                            @endif


                                            @endforeach



                                        </tbody></table>


                            @endif
                                        <table >
                                        <thead>
                                        <tr>
                                        <th colspan="2" style="padding:3rem 0 1rem 0"><b style="font-size:2.5em;">Timeline</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>

                                                <div class="history-tl-container" style="line-height:1.5em; min-width:920px; ">

                                        <ul class="tl" >
                                            
                                        @php
                                            $totalEvenements = count($evenements);
                                        @endphp
                                        
                                        @foreach ($evenements as $e)
                                            @php
                                                $numeroEvenement = $totalEvenements - $loop->index;
                                            @endphp
                                            <li class="tl-item" ng-repeat="item in retailer_history" style="padding:0 0 3rem 2rem">
                                                <div class="timestamp" style="padding:0 3rem 0 0;font-size:1em;color:#333333">{{ Carbon\Carbon::parse($e->date_statut)->format('Y-m-d H:i:s')}}
                                                    <br>
                                                </div>
                                                <div class="item-title" style="padding:0 3rem 0 0;font-size:0.7em;color:#333333;width:200px"><b>Événement {{ $numeroEvenement }}</b> : {{ $e->contenu_notification }}</div>
                                            </li>
                                        @endforeach
                                        



                                    </ul>


                                    </div>
                                    </td></tr>
                                        </tbody>
                                        </table>
                                        {{-- :::::::::: --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs hidden-sm" >
                    <div class="p-0 tab-content"  >
                        <div class="tab-pane active show" id="profile-about" >
                            <table>

                                <thead>
                                    <tr>
                                    <th colspan="2" style="padding:0 0 0 0"><b style="font-size:2.5em;">Experimentateurs</th>
                                    </tr>
                                    <tr >
                                        <td style="padding:0 0 2rem 0; display:flex; justify-content: space-between;">
                                            <!-- <button class="btn btn-primary btn-sm" onclick="openExp()" style="margin-left : 10px"><b style="color:white;font-size:0.5em">Créer</b></button> -->
                                            <svg style="cursor:pointer" onclick="openExp()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                    <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                    <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                </g>
                                            </svg>
                                            <span><b style="font-size:1em"> {{ count($experimentateurs) }}/{{ $nb_participants }} </b> Enregistrés  </span>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <th>
                                            <button class="btn btn-primary btn-sm" onclick="openExp()" style="margin-left : 10px"><b style="color:white;font-size:0.5em">Créer</b></button>
                                        </th>
                                    </tr> -->
                                </thead>
                            </table>
                            <table>
                                <tbody >


                                    @foreach ($experimentateurs as $client)
                                    <tr>
                                        <td>
                                        <div>
                                                <div class="profile-header-img" style="margin-right:0;background:none;width:70px;height:80px">
                                                        <img style="width:50px;height:50px;"src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU" class="p-1 rounded-circle bg-primary" >
                                                </div >
                                        </div>
                                        </td>
                                        <td>
                                            <span style="padding:0 0.5rem 0 0.5rem;font-size:1.3em"> {{ $client->nom }} </span>
                                        </td>
                                        <td>
                                            <span style="padding:0 0.5rem 0 0.5rem;font-size:1.3em"> {{  $client->prenom  }} </span>
                                        </td>
                                        <td>
                                            <a href="{{route('contacts.show',['contact'=>$client->id_contact])}}" style="color:blue;">GO</a>
                                        </td>

                                    </tr>
                                    @php
                                            $id=$loop->index+1;
                                        @endphp
                                    @endforeach



                                    @php
                                        if(isset($id))
                                        {
                                            $clients_left=$nb_participants-$id;
                                        }
                                        else
                                        {
                                            $clients_left=$nb_participants;
                                        }
                                    @endphp

                                </tbody>
                            </table>
                            <table>
                                <thead>
                                    <tr>
                                        <tr>
                                            <th colspan="2" style="padding:3rem 0 1rem 0"><b style="font-size:2.5em;">Content </b>
                                                <svg style="cursor:pointer" onclick="openCont()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                    <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                        <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                        <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                    </g>
                                                </svg>
                                            </th>
                                            <th style="padding:3rem 0 1rem 0">
                                                @if(!isset($ExpFolder[0]))
                                                <a style="background: none ; border : none;margin-left:10px" class="btn btn-primary"><i style="disabled" class="fas fa-light fa-folder-open"></i></a>
                                                @else
                                                <a style="background:none; border: none; margin-left:10px; " class="btn btn-primary"
                                                href="https://drive.google.com/drive/u/1/folders/{{$ExpFolder[0]->url_experience_folder}}"><i style="color: blue" class="fas fa-light fa-folder-open"></i></a>

                                                @endif
                                            </th>
                                            <!------------------------------------ Oumayma---------------------------------------------->
                                            <th style="padding:3rem 0 1rem 0">

                                                <a style="background: none; border: none; margin-left: 10px;" class="btn btn-primary"
                                                href="{{ route('create-experience-folder', ['id_experience' => $id_experience, 'num_facture' => $num_facture]) }}">
                                               <img style="width: 15px; height: 15px;" src="{{ asset('img/folder_plus.png') }}" alt="folderplus">
                                                </a>
                                            </th>
                                        </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$bons->isEmpty())
                                        <tr >
                                            <td><b style="font-size:1.2em;">Bon Cadeau</b> </td>
                                        </tr>
                                        @foreach ($bons as $bon)
                                            <tr>
                                                <td>{{ Str::limit($bon->titre, 20) }} </td>
                                                <td>
                                                    <a href="{{ route('contents.show',['id_content_experience'=>$bon->id_content_experience]) }}">
                                                        <span style="color:green">GO</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @if (!$stories->isEmpty())
                                        <tr >
                                            <td><b style="font-size:1.2em;">Storytellings</b> </td>
                                        </tr>
                                        @foreach ($stories as $s)
                                            <tr>
                                                <td>{{ Str::limit($s->description, 20); }} </td>
                                                <td>
                                                    <a href="{{ route('contents.show',['id_content_experience'=>$s->id_content_experience]) }}">
                                                        <span style="color:green">GO</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @if (!$livrables->isEmpty())
                                        <tr >
                                            <td><b style="font-size:1.2em;">Livrables</b> </td>
                                        </tr>
                                        @foreach ($livrables as $l)
                                            <tr>
                                                <td>{{ Str::limit($l->nom, 20); }} </td>
                                                <td>
                                                    <a href="{{ route('contents.show',['id_content_experience'=>$l->id_content_experience]) }}">
                                                        <span style="color:green">GO</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                    @if (!$media->isEmpty())
                                        <tr >
                                            <td><b style="font-size:1.2em;">Média</b> </td>
                                        </tr>
                                        @foreach ($media as $m)
                                            <tr>
                                                <td>{{ Str::limit($m->description, 20); }} </td>
                                                <td>
                                                    <a href="{{ route('contents.show',['id_content_experience'=>$m->id_content_experience]) }}">
                                                        <span style="color:green">GO</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>
                            </table>
                    <!-- -----------------------------Liest des médias ------------------------->
                            @if (count($experienceMedias)>0)
                                <hr>
                                <p class="my-2">Fichiers liés</p>
                                <form style="overflow-y:scroll;height:150px;width:110%">
                                    @csrf
                                    <table class="table text-center table-hover">
                                        <thead>
                                        <tr>
                                            {{-- <th scope="col">Id</th> --}}
                                            <th scope="col">Fichier</th>
                                            <th scope="col">collection</th>
                                            <th scope="col">Suppr.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($experienceMedias as $item)
                                                <tr class=" modal-shut-down-btn"  onclick="displayContent()">
                                                    <td class="file-row" data-file-url='{{$item->getUrl()}}' data-file-type="{{$item->mime_type}}" data-youtube-link="{{$item->getCustomProperty('youtube_link')}}" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100px" title="{{$item->file_name}}">{{$item->file_name}}</td>
                                                    <td class="file-row" data-file-url='{{$item->getUrl()}}' data-file-type="{{$item->mime_type}}" data-youtube-link="{{$item->getCustomProperty('youtube_link')}}"style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100px" title="{{$item->collection_name}}">{{$item->collection_name}}</td>
                                                    <td  title="Supprimer"><button name="delete_file" value="{{$item->id}}" class="rounded"  type="submit"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </form>
                            @else
                                <hr>
                                <p class="my-2">Aucun fichiers liés</p>
                            @endif
                            {{-- JM modal pour les images de la liste  --}}
                            <div  id="modal_image" style="position:fixed; top:50%;left:50%;transform:translate(-50%,-50%);width:400px;height:400px;display:none">
                                <div class="my-2 d-flex justify-content-center align-items-center text-white modal-shut-down-btn" style="position:relative;right:0;top;0; width: 25px; height:25px;border-radius:100%;background-color:red" onclick="dissmissPopup()">X</div>
                                <img style="width:100% " src="" alt="alalala">
                                <audio controls>
                                    <source src="" type="audio/mpeg" >
                                </audio>
                                <video controls>
                                    <source src="">
                                </video>
                                <iframe width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                    <!-- -----------------------------partie histoire : debut ------------------------->
                                {{-- Ilham --}}
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="padding:3rem 0 1rem 0"><b style="font-size:2.5em;">Histoire <i style="cursor:pointer; color : #e6ac00" onclick="openIntHistorique()" class="fas fa-edit"></i></b></th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($histoire as $hist)
                                        <tr style="float:left ;border-radius:10px">
                                            <td style="text-align: justify;padding:0.5rem">
                                                Histoire {{ $loop->index+1 }} :{{ $hist->histoire_experience }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                     <!-- -----------------------------Cagnotte ------------------------->
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="padding:3rem 0 1rem 0"><b style="font-size:2.5em;">Cagnotte </b></th>


                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                        <tr style="float:left ;border-radius:10px">
                                            <td style="font-size:1.5em;text-align: justify;padding:0.5rem">
                                                Cagnotte liée  : <a href="{{ $cagnotteLink }}">
                                                    <span style="color:red; font-weight: bold">GO</span>
                                                </a>
                                            </td>
                                        </tr>
                                        

                                    </tbody>

                                </table>
                            {{-- Ilham --}}

                    <!-- ------------------------- partie intéraction : yasser ----------------------------------- -->

                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2" style="padding:3rem 0 1rem 0"><b style="font-size:2.5em;">Intéraction </b>
                                            <svg style="cursor:pointer" onclick="openInt()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                    <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                    <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                </g>
                                            </svg>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form method="post" >
                                        @csrf
                                        @method('DELETE')
                                        @foreach ($interactions as $interaction)
                                        <tr>
                                            <td colspan="2" class="interaction_date-td">
                                                <!-- {{ $interaction->date_heure }} -->
                                                {{ Carbon\Carbon::parse($interaction->date_heure)->format('Y m d H:i') }}
                                            </td>
                                        </tr>
                                        <tr style="border-radius:10px;margin-bottom:30px; width: fit-content;">
                                            <td style="text-align: left; padding:0.5rem; ">
                                                    @foreach($les_tags_lier_avec_inter as $tags)
                                                        @if($tags->id_interaction == $interaction->id_interaction)
                                                        {{ $tags->tag }}|
                                                        @endif
                                                    @endforeach
                                                <pre style="width:180px; margin:0; white-space: pre-line;">
                                                    {{ $interaction->texte }}
                                                </pre>
                                            </td>
                                            <td style="margin:0;  padding:0;">
                                                <!-- -------------btn update test ------------------- -->
                                                <div  class="btn_upd_int btn btn-primary"  data-value="{{ $interaction->id_interaction }}" style="background-color : #fff ; border : #fff;font-size:0.85rem; margin-right:-10px;">
                                                    <i style="color : #e6ac00" class="fas fa-edit "></i>
                                                </div>
                                                <!-- ------------ btn delete ----------------------- -->
                                                <button formaction="/experience.destroyinteraction/{{ $interaction->id_interaction }}/{{ $id_experience }}/{{ $num_facture }}"
                                                    style="background-color : #fff ; border : #fff; font-size:0.85rem; margin-left:-5px" type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Vous êtes sûrs de vouloir supprimer cette intéraction ?')">
                                                    <i style="color : #cc3300" class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </form>
                                </tbody>
                            </table>
                    <!-- ------------------------- partie interaction : fin --------------------------------------------------------------------- -->
                        </div>
                    </div>
                    <br>
                </div>
                <!-- /.modal -->
                <div class="col-md-4 ">
                    <div class="p-0 tab-content">
                        <div class="tab-pane active show" id="profile-about">
                    <!-- --------------------------  image à droite : debut ---------------------------------- -->
                            <table
                                style="margin-top:20px;border:3px solid;float:left ;border-radius:10px;width:150%;height:300px;background-image:url(https://webtoulousain.fr/wp-content/uploads/2020/06/wp-15912821119331669631060388854563.png);background-position: start;background-repeat:no-repeat;background-size: contain;">
                            </table>
                    <!-- --------------------------  image à droite : fin ---------------------------------- -->
                    <!-- --------------------------  evenement : debut ---------------------------------- -->
                            <table style="width:150%;margin-left:40px">
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="padding:0 0 1rem 0"><b style="font-size:2.5em;">Evénements </th>
                                        </tr>
                                        <tr>
                                            <th style="all:unset;">
                                                <!-- <button class="btn btn-primary btn-sm" onclick="openStory()" style="margin-left : 10px"><b style="color:white;font-size:0.5em">Créer</b></button> -->
                                                <div class="btn_plus" onclick="openEv()" >
                                                    <div>Evénement </div>
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
                                    <tr>
                                        <td class="field" ><b>Prise de contact :</b></td>
                                        <td class="value" style="width:60%;">
                                            @if (!is_null($events->firstWhere('type_evenement',"Prise de contact")))
                                                {{ Carbon\Carbon::parse($events->firstWhere('type_evenement',"Prise de contact")->date_evenement)->format('Y m d') }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field"><b>Speetch experience :</b></td>
                                        <td class="value">
                                            @if (!is_null($events->firstWhere('type_evenement',"Speetch experience")))
                                                {{ Carbon\Carbon::parse($events->firstWhere('type_evenement',"Speetch experience")->date_evenement)->format('Y m d') }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field"><b>Interaction (pré experience) :</b></td>
                                        <td class="value">
                                            @if (!is_null($events->firstWhere('type_evenement',"Interaction (pré experience)")))
                                                {{ Carbon\Carbon::parse($events->firstWhere('type_evenement',"Interaction (pré experience)")->date_evenement)->format('Y m d') }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field"><b>Reservation date :</b></td>
                                        <td class="value">
                                            @if (!is_null($events->firstWhere('type_evenement',"Reservation date")))
                                                {{ Carbon\Carbon::parse($events->firstWhere('type_evenement',"Reservation date")->date_evenement)->format('Y m d') }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field"><b>Record date :</b></td>
                                        <td class="value">
                                            @if (!is_null($events->firstWhere('type_evenement',"Record date")))
                                                {{ Carbon\Carbon::parse($events->firstWhere('type_evenement',"Record date")->date_evenement)->format('Y m d') }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field"><b>Période studio experience :</b></td>
                                        <td class="value">
                                            @if (!is_null($events->firstWhere('type_evenement',"Période studio experience")))
                                                {{ Carbon\Carbon::parse($events->firstWhere('type_evenement',"Période studio experience")->date_evenement)->format('Y m d') }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field"><b>Livraison chanson Experience :</b></td>
                                        <td class="value">
                                            @if (!is_null($events->firstWhere('type_evenement',"Livraison chanson Experience")))
                                                {{ Carbon\Carbon::parse($events->firstWhere('type_evenement',"Livraison chanson Experience")->date_evenement)->format('Y m d') }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field"><b>Sucess post Experience :</b></td>
                                        <td class="value">
                                            @if (!is_null($events->firstWhere('type_evenement',"Sucess post Experience")))
                                                {{ Carbon\Carbon::parse($events->firstWhere('type_evenement',"Sucess post Experience")->date_evenement)->format('Y m d') }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                    <!-- --------------------------  evenement : fin ---------------------------------- -->
                    <!-- --------------------------  storytelling : debut ---------------------------------- -->
                                <table style="width: 150%;margin-left:40px">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="padding:3rem 0 1rem 0"><b style="font-size:2.5em;">Storytelling </b>
                                                <svg style="cursor:pointer" onclick="openStory()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                    <g id="Groupe_3" data-name="Groupe 3" transform="translate(-505.039 -340.955)">
                                                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="10" cy="10" r="10" transform="translate(505.039 340.955)" fill="#3ac25e"/>
                                                        <rect id="Rectangle_1" data-name="Rectangle 1" width="4" height="15.055" rx="2" transform="translate(513.039 343.428)" fill="#fff"/>
                                                        <rect id="Rectangle_2" data-name="Rectangle 2" width="3.998" height="15.622" rx="1.999" transform="translate(522.85 348.956) rotate(90)" fill="#fff"/>
                                                    </g>
                                                </svg>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form method="post">
                                            @csrf
                                            @method('DELETE')
                                        @foreach($storytelling as $story)
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
                                                    <i style="color : #e6ac00" class="fas fa-edit "></i>
                                                </div>
                                                <!-- ------------------------------------- -->
                                                <button formaction="/experience.destroystorytelling/{{ $story->id_storytelling }}/{{ $id_experience }}/{{ $num_facture }}"
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
                    <!-- --------------------------  storytelling : fin ---------------------------------- -->
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

<script>
    /*JM - Aperçu des contenu - ce code est optimisable*/
    function dissmissPopup() {
        const audioTag=document.querySelector('#modal_image audio');
        const videoTag=document.querySelector('#modal_image video');
        const iframe=document.querySelector('#modal_image iframe');
        const modal= document.querySelector('#modal_image');
        modal.style.display='none';
        iframe.src="";
        videoTag.src="";
        audioTag.src="";
        imageTag.src="";

    }
    function displayContent() {
        const fileRows = document.querySelectorAll('.file-row');
        const modal= document.querySelector('#modal_image');
        const imageTag= document.querySelector('#modal_image img');
        const audioTag=document.querySelector('#modal_image audio');
        const videoTag=document.querySelector('#modal_image video');
        const iframe=document.querySelector('#modal_image iframe');
        modal.style.zIndex="20"
        fileRows.forEach(element => {
            const mime_type=element.getAttribute("data-file-type");
            const url=element.getAttribute("data-file-url");
            const youtube_link=element.getAttribute('data-youtube-link')
            element.addEventListener('click',handleckick);
            function handleckick() {
                modal.style.display="block";
                if(mime_type.includes("image")){
                    iframe.style.display="none";
                    audioTag.style.display="none";
                    videoTag.style.display="none";
                    imageTag.style.display="block";
                    iframe.src="";
                    videoTag.src="";
                    audioTag.src="";
                    imageTag.src=url;
                    imageTag.alt="aperçu";
                }
                if(mime_type.includes("audio")){
                    iframe.style.display="none";
                    imageTag.style.display="none";
                    videoTag.style.display="none";
                    audioTag.style.display="block";
                    imageTag.src="";
                    iframe.src="";
                    videoTag.src="";
                    urlParts=url.split('?');
                    urlParts2=urlParts[1].split("&")
                    audioTag.src=urlParts[0]+"?export=download&"+urlParts2[0];
                }
                if(mime_type.includes("video")){
                    iframe.style.display="none";
                    imageTag.style.display="none";
                    videoTag.style.display="block";
                    audioTag.style.display="none";
                    urlParts=url.split('?');
                    urlParts2=urlParts[1].split("&");
                    imageTag.src="";
                    iframe.src="";
                    audioTag.src="";
                    videoTag.src=url;
                    videoTag.width="300";
                    videoTag.height="300";
                }
                if(youtube_link!==""){
                    imageTag.style.display="none";
                    videoTag.style.display="none";
                    audioTag.style.display="none";
                    iframe.style.display="block";
                    audioTag.src="";
                    imageTag.src="";
                    videoTag.src="";
                    videoParts=youtube_link.split('=');
                    iframe.src="https://www.youtube.com/embed/"+videoParts[1]

                }
            }      
        });
    }
    // Ilham
    function openIntHistorique() {
        var div_hist_form = document.getElementById("histForm");
    div_hist_form.style.display = "block";
    suggestion_tag_inter(div_hist_form);
    document.getElementById("histoire_experience").value = histoire;
    }
     // Fonction pour ouvrir le cadre de modification de l'histoire
     function openStory1() {
        document.getElementById("histForm").style.display = "block";
    }
    // function closeCreHist() {
    //     document.getElementById("histForm").style.display = "none";
    // }
    function closeHist() {
    document.getElementById("histForm").style.display = "none";
}

    // Ilham
     function openIntNom() {
        var div_int_form = document.getElementById("editForm");
        div_int_form.style.display = "block";
        suggestion_tag_inter(div_int_form);
    }
    function closeIntNom() {
        document.getElementById("editForm").style.display = "none";
    }

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

    function openExp() {
        document.getElementById("expForm").style.display = "block";
    }

    function closeExp() {
        document.getElementById("expForm").style.display = "none";
    }

    function openCreExp() {
        document.getElementById("creexpForm").style.display = "block";
    }

    function closeCreExp() {
        document.getElementById("creexpForm").style.display = "none";
    }

    function openEv() {
        document.getElementById("evForm").style.display = "block";
    }

    function closeEv() {
        document.getElementById("evForm").style.display = "none";
    }

    function openCont() {
        document.getElementById("contForm").style.display = "block";
    }

    function closeCont() {
        document.getElementById("contForm").style.display = "none";
    }
    //******************** yasser *****************************
        const csrfToken = "{{ csrf_token() }}";
        // ---------------------
        var popupActivated = false;
        console.log(popupActivated);
        var content = document.getElementById('content');
        // ---------------------
        // $(document).ready(function() {
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
        // });



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
            // console.log(popupActivated);
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
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkbox = document.getElementById("flexSwitchCheckDefault");
        var label = document.querySelector('.form-check-label');

        if (checkbox.checked) {
            label.textContent = "Repertorié";
            // Ajoutez ici le code que vous souhaitez exécuter lorsque le bouton est activé
        } else {
            label.textContent = "Non Repertorié";
        }
    });
    function toggleRepertorie() {
        var checkbox = document.getElementById("flexSwitchCheckDefault");
        var label = document.querySelector('.form-check-label');
        var exp = checkbox.getAttribute('data-id');

        if (checkbox.checked) {
            $.ajax({
                type: 'GET',
                url: `/setvisibility/${exp}/public`, // Remplacez par l'URL de votre route
                success: function (response) {
                    console.log('OK');
                    // Effectuez des actions supplémentaires avec la réponse si nécessaire
                },
                error: function (error) {
                    console.error('Erreur lors de l\'appel de la fonction du contrôleur:', error);
                }
            });
            label.textContent = "Repertorié";
            // Ajoutez ici le code que vous souhaitez exécuter lorsque le bouton est activé
        } else {
            $.ajax({
                type: 'GET',
                url: `/setvisibility/${exp}/unlisted`, // Remplacez par l'URL de votre route
                success: function (response) {
                    console.log('OK');
                    // Effectuez des actions supplémentaires avec la réponse si nécessaire
                },
                error: function (error) {
                    console.error("Erreur lors de l\'appel de la fonction du contrôleur:", error);
                }
            });
            label.textContent = "Non Repertorié";
            // Ajoutez ici le code que vous souhaitez exécuter lorsque le bouton est désactivé
        }
    }
</script>



<div class="formclt" id="form_clt">
    <!--***********************************************Oumayma*****************************************************-->
    <div class="form-int" id="editForm">
        <form action="{{ route('experience.update_name', ['id_experience' => $id_experience, 'num_facture' => $num_facture]) }}" method="post" class="form-container">
              @csrf
            <h4 style="text-align:start;margin-top:30px">Modifier le nom de l'expérience</h4>
            <input type="hidden" id="id_experience" name="id_experience" value="{{ $id_experience }}">
            <input type="hidden" id="num_facture" name="num_facture" value="{{ $num_facture }}">

            <div class="form-contact" style="margin-bottom:30px;margin-top:30px">
                <input type="text" style="margin:0; background:white; border:1px solid #000000; border-radius:10px" name="nom_experience" value="{{ old('nom_experience', $experience[0]->nom_experience) }}">
            </div>

            <button type="submit" class="btn" style="width:100px">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeCreExp()" style="width:100px; background:red;">Annuler</button>
        </form>
    </div>

<!--****************************************************************************************************-->
   <!--***********************************************Ilham*****************************************************-->
   <div class="form-int" id="histForm">
    <form action="{{ route('experience.update_histoire', ['id_experience' => $id_experience, 'num_facture' => $num_facture]) }}" method="post" class="form-container">
        @csrf
        <h4 style="text-align:start;margin-top:30px">Modifier l'historisque</h4>
        {{-- <button type="button" onclick="openStory1()" class="btn"><h4 style="text-align:start;margin-top:30px">Modifier l'historisque</h4></button> --}}
        <input type="hidden" id="id_experience" name="id_experience" value="{{ $id_experience }}">
        <input type="hidden" id="num_facture" name="num_facture" value="{{ $num_facture }}">

        <div class="form-contact" style="margin-bottom:30px;margin-top:30px">
            <input type="text" style="margin:0; background:white; border:1px solid #000000; border-radius:10px" name="histoire_experience" value="{{ old('histoire_experience', $experience[0]->histoire_experience) }}">
        </div>

        <button type="submit" class="btn" style="width:100px">Enregistrer</button>
        <button type="button" class="btn cancel" onclick="closeHist()" style="width:100px; background:red;">Annuler</button> <!-- Utilisation de la fonction closeHist() -->
    </form>

</div>

<!--****************************************************************************************************-->
    <div class="form-int" id="intForm">
        <form action="{{ route('experience.createinteraction') }}" method="post" class="form-container">
            @csrf
            <h4 style="text-align:start;margin-top:30px">Ajouter une nouvelle interaction à l'experience </h4>
            <input type="hidden" id="id_experience" name="id_experience" value="{{ $id_experience }}">
            <input type="hidden" id="num_facture" name="num_facture" value="{{ $num_facture }}">

            <div class="form-contact" style="margin-bottom:20px;margin-top:30px">

            <select name="id_cnt" id="pet-select" style="margin-left: 0px; background-color: #eee; margin-bottom: 20px; width: 305px; height: 50px; float: left; border-radius: 4px;">
                <option value="">Choisissez un Contact</option>
                @foreach ($contacts as $con)
                    <option value="{{ $con->id_contact }}"{{ $loop->first ? ' selected' : '' }}>
                        {{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}
                    </option>
                @endforeach
            </select>
            <!-- <select name="id_cnt" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                <option value="">Choisissez un Contact </option>
                @foreach ($contacts as $con)
                @if ($loop->index == 0)
                    <option value="{{ $con->id_contact }}"{{old('') == $con->id_contact ? "selected" : ""}}>{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>
                @else
                    <option value="{{ $con->id_contact }}"{{old('') == $con->id_contact ? "selected" : ""}}>{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>
                @endif
                @endforeach
            </select> -->
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

            <div class="form-contact" style="margin-top:20px">
                <!-- <input type="text" name="texte" class="form-control"  placeholder="Texte de l'Interaction" style="background-color:white;border:2px black  solid"> -->
                <textarea name="texte" class="form-control" cols="30" rows="5" value="{{old('texte')}}" placeholder="Texte de l'Interaction" style="white-space: pre-line; background-color:white;border:2px black  solid  ; margin-bottom:3px"></textarea>
            </div>
            <button type="submit" class="btn" style="width:100px">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeInt()" style="width:100px">Annuler</button>
            </form>
    </div>
    <div class="form-story" id="storyForm">
        <form action="{{ route('experience.createstorytelling') }}" method="post" class="form-container">
            @csrf
            <input type="hidden" id="id_experience" name="id_experience" value="{{old('id_experience') ?? $id_experience }}">
            <input type="hidden" id="num_facture" name="num_facture" value="{{old('num_facture') ?? $num_facture }}">

            <h4 style="text-align:start;margin-top:30px">Ajouter un nouveau storytelling à l'experience </h4>
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
    <div class="form-exp" id="expForm">
        <form action="{{ route('experience.insertexistingexperimentateur') }}" method="post" class="form-container">
            @csrf
            <h4 style="text-align:start;margin-top:30px">Ajouter un experimentateur à l'experience </h4>
            <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                <input type="hidden" id="id_experience" name="id_experience" value="{{old('id_experience') ?? $id_experience }}">
                <input type="hidden" id="num_facture" name="num_facture" value="{{old('num_facture') ?? $num_facture }}">
            {{-- <select name="id_cnt" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                <option value="">Choisissez un Contact </option>
                @foreach ($id_con as $con)
                    <option value="{{ $con->id_contact }}" {{ old('id_cnt') == $con->id_contact ? 'selected' : '' }}>{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>
                @endforeach
            </select> --}}
            <datalist id="contacts" style="margin-left:0px;background-color:black;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">

                @foreach ($id_con as $con)
                    <option value="{{ $con->id_contact }}">{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>
                @endforeach
            </datalist>
            <input type="text" name="id_cnt" list="contacts"style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;border:1px solid black" placeholder="Choisissez un contact">
             <a href="javascript:openCreExp(),closeExp()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANwAAADlCAMAAAAP8WnWAAAAgVBMVEX///8AAAD7+/vz8/PLy8s7Ozv4+PjDw8Po6Oifn5/Y2Njv7+/i4uLAwMDg4ODy8vKurq5TU1OOjo5FRUVlZWXQ0NAcHBx8fHwzMzOampqHh4elpaU+Pj4QEBB2dna0tLQpKSlbW1siIiKSkpIvLy95eXlfX19sbGxMTEwZGRkNDQ0alzTIAAAG1ElEQVR4nO2di1riPBCGoeVQKWcBS6tSWFbR+7/AX9h1VSSHSb9MRv68F0D6PqU5TCaZVisSiUQikUgkEolEIpFIJBLxTpL08mw4Hmd5L0lCPwyGJB+ObsrHWfHQ/kJ9WJTrzTjrhX5AR5LxqFx023rqp7vNYBL6UYksq21t8PpgdZj3f4pgPn2y9vqgux6EfnAjw7Xpn6jhriP4Gxyub93NTuzuOqElLjOaNTT7Q7HOQpuck5evELUTW1Gvb/CMMztRbKQM9J0tWO1IXUnoXJaYT+07uyq02njrSe2kNw2plv72qHakDte1VJ7VjiyGQdSW9wxub/wK4FbyqL1RcM86Ow/mh8JRso56fK/tD4wvb8z0tX2Ga9Db8Ku9sU053HyPbSpe/P8186ZLtgb4nrAMXsK5vS3VvbqNQqq98eRxTOCYb+kpvIXJuEe3i3iaa96F9jrx6qXTfAyt9Y4Hu0Vopw/gdmLe2xGwnYzv7R9Qu3lomzMexji38OPbOSvYeNcPrXKBPchtEFrkIk8Qt2wV2uMyJULuENpCxaa5m7BB4DONB4QwMQU7HhrulQxDC2jZNpMLGFSwoVFMTNrM5BsNZiqd0M9upOscd0iEjnCfmbvKNQ8rFJmecXM7xz8mYNrVNTSR+m9CQfEj5NprFzfEOodDru2QlJMjduBY5B7pcpAgJYscfY4J6MfaXHL3VDlM6gyPHHXxA1p9M8ntaHKgnCcmOdqrQ00queRqitwW1CiXHGXTFRbvYpMjdJiwjQE2uXbf1i2HNcknN7OVw62/+eSspym4FhnlLGeYwJQFRrm2XcABmLTMKWc1GiBDlZxyVkvyNWODSDmrLgUZh2WVswiEYRZyf2GVs5il/EK2xypn8b+EZsHyyhm3IzNoc7xyxv5yytocVs4Y5MNmQTHLmcZxbGvMcoYMB/CmFbNcW98aOFeIW04/GIBP+nHL6T86cGPcctqPDp0JxS230jWGTq3nltPus6Lzz9nldMdA0SeHTXITcHu6bdaEsFPcvTfTNaX4pHubn9nbP9VC3RYlwpAmNhjkWla/QegJbtVNUTpLxgP4hEzdVa78FUpnKVNOcxqGsgoXKqeegFEONQqVU29DUhZzQuXUR+Yp6cxC5ZSHI3uEAUWqnHI/JKVctSNUTrkuIG06CpVTjuLXIFernosUsxQqp0zHJ20TCJVTPhdpHS5VTnWFw/Ka5UhByygnSO6qv7mrliPlMUiV+18O4lc9/boGOeXEOaWcuhIqp1zyJJSbfIXKqZP3KNF0oXLqO5goV8MKlVMHiCibPELl1KE9yo64UDl1UJYycxYqpw6nU5bijFdOYjZCMsKBwH7HgqXhsROrHyGkt2q2sLApe23zGRv4zuqzpjH0/Vfse+I3msaQ+c1HRG34o28bEpWqgU0l5ZfTH4HcYRvjltMkM7Tgt87JSmwD38ojKyUR/NHJSiZtYa8NZ5bTf3Lo1DZhCdzYpERmOfWs2UdzvHLmwzzQ6SWvnLlsA3QwkHZQCXeOui3viFnLpcCaCmmHA6H9pbhjnT1gyS5OObvrGYA3Woo7So08tcopZ+UGuc3sL4xytoUacEMdo5ztnXsJbD3OJ2d/SSksCMYnZ1/uDDZLYZPTRZrPQa3q2OQod2OhXh2XXEFwg706kZeatXqYRpnkapIb6v4JJrkRUa4HqQvFI3cguoGmKUIv78TcaMMi95vuRst4VsAiZwroXQRQRY9Dzu1yeMBwYFodA5qgTLw+0zyasrvRA5ihO5dWF1T/SoXT/dsn8qBFEG2gD3EfSCw39IVGpfYE13Y50rB+Jy5Y5AFdvpAN6OQNJHVDt/DVRzUAaltCL99DQl3oXEToaAeqEE/JyGfDoQTDRSasZd/taDJ6fwV6oSeEPTDFWlpppZ3TGk6FrHnYynkpcBlRwx28eLOgKnvAIqvvSHl3D16KbsvoVWrw9/YOIh7WlALaT35mCE6BpjPzeIQoRR8ZIYKacymgnB+E4x4NsgR9aISAdZETdzrA9CkKXU/d5FeyIMVXH7kO7AVYnEOW3XYsa161mbfR7RIpa0CzUZVfF5ZsA/qMpSc5g6nwMaAmugsZMh1aQcl4ZPuMvufA2JOHpZs9ydRjceeDfSqeL8BVAP5RhFc7UnkY9Q4ME0lLRuAZ2cIhb8YjS9xp15e5lyhJI9IKMqzPGGeRJAbzhn73FeskksqydI5EzCp5f8dvDKfP5PVscdcPMYN0ojeu7DuYotzkjFfHYJj0q2f9tdevt+XGdB+MaLJlvyqft4f7Yl/vXla7fdG9nS0e55vOQHTnQaSXTvJ80vtx/8BIJBKJRCIRLP8BFAGbt3t3NfEAAAAASUVORK5CYII="></a>
            </div>
            <button type="submit" class="btn" style="width:100px">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeExp()" style="width:100px">Annuler</button>
            </form>
    </div>
    <div class="form-creexp" style="width:900px;background-color:#EDEFF0" id="creexpForm">
        <form action="{{ route('experience.insertnewexperimentateur') }}" method="post" class="form-container form_container_creexp">
            @csrf
            <table style="width:100%">
                <th colspan="2"><h1 style="text-align:center;margin-top:5px;margin-bottom:5px">Création Contact</h1> </th>
                <tr >
                    <td style="width:45%; ">
                        <img src="https://www.devopssec.fr/media/cache/avatar/images/default/empty_profile.jpg" style ="margin-left:45px;margin-bottom:20px; height:280px;width:280px;float:left;border-radius:200px;border:5px #888888 solid" alt="Maxwell Admin">
                        <h5><input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" style="width:350px"></h5>
                    </td>
                    <td style="width:55%; padding-right:40px">
                        <div class="form-contact" style="margin-bottom:0px;margin-top:0px;">
                        <div class="form-contact" style="margin-top:0px">
                                <input type="text" name="Nom" class="form-control" value="{{ old('Nom') }}" placeholder="Nom" style="height:35px;background-color:white;border:2px black  solid">
                        </div>
                        <input type="hidden" id="id_experience" name="id_experience" value="{{ $id_experience }}">
                        <input type="hidden" id="num_facture" name="num_facture" value="{{ $num_facture }}">

                        <div class="form-contact" style="margin-top:0px;margin-bottom:0px">
                                <input type="text" name="Prénom" class="form-control" value="{{ old('Prénom') }}" placeholder="Prénom" style="height:35px;background-color:white;border:2px black  solid">
                        </div>
                        <div class="form-contact" style="margin-top:0px">
                                <input type="text" name="mail" class="form-control" value="{{ old('mail') }}" placeholder="Email" style="height:35px;background-color:white;border:2px black  solid">
                        </div>
                        <div class="form-contact" style="margin-top:0px">
                                <input type="text" name="tel" class="form-control" value="{{ old('tel') }}" placeholder="Tel" style="height:35px;background-color:white;border:2px black  solid">
                        </div>
                        <div class="form-contact" style="margin-top:0px">
                                <input type="text" name="adress" class="form-control" value="{{ old('adress') }}" placeholder="Adresse" style="height:35px;background-color:white;border:2px black  solid">
                        </div>
                        <div class="form-contact" style="margin-top:0px">
                                <input type="text" name="cp" class="form-control" value="{{ old('cp') }}" placeholder="Code postale" style="height:35px;background-color:white;border:2px black  solid">
                        </div>
                        <div class="form-contact" style="margin-top:0px">
                                <input type="text" name="ville" class="form-control" value="{{ old('ville') }}" placeholder="Ville" style="height:35px;background-color:white;border:2px black  solid">
                        </div>
                        <div class="form-contact" style="margin-top:0px">
                                <input type="text" name="url" class="form-control" value="{{ old('url') }}" placeholder="Url Dossier" style="height:35px;background-color:white;border:2px black  solid">
                        </div>
                        <div class="form-contact" style="margin-bottom:0px;margin-top:30px; text-align:left">
                            <label for="pet-select">Entreprise</label>
                            <select name="entreprise" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:385px;height:35px;float:left;border-radius:4px;">
                                <option value="" >Aucune</option>
                                @foreach ($nom_org as $nom)
                                <option value="{{ $id_org[$loop->index] }}" {{ old('entreprise') == $id_org[$loop->index] ? "selected" : "" }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="type" class="form-control" value="{{ old('type') }}" placeholder="Type Contact">
                        </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="form-contact" style="margin-bottom:10px;width:100%">
                <button type="submit" class="btn" style="width:100px">Appliquer</button>
                <button type="button" class="btn cancel" onclick="closeCreExp()" style="width:100px; background:red;">Annuler</button>
            </div>
        </form>
    </div>
    <div class="form-ev" id="evForm">
        <form action="{{ route('experience.insertevenement') }}" method="post" class="form-container">
            @csrf
            <h4 style="text-align:start;margin-top:30px">Ajouter/modifier un événement de l'experience </h4>
            <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                <input type="hidden" id="id_experience" name="id_experience" value="{{ $id_experience }}">
                <input type="hidden" id="num_facture" name="num_facture" value="{{ $num_facture }}">
                <input name="current_stat" type="hidden" value="{{ $statut_experience->id_statut_experience }}">
            <select name="type_evenement" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                <option value="">Choisissez un Type d'Evénement </option>
                <option value="Prise de contact" {{ old('type_evenement') == "Prise de contact" ? 'selected' : '' }}>Prise de contact</option>
                <option value="Speetch experience" {{ old('type_evenement') == "Speetch experience" ? 'selected' : '' }}>Speetch experience</option>
                <option value="Interaction (pré experience)" {{ old('type_evenement') == "Interaction (pré experience)" ? 'selected' : '' }}>Interaction (pré experience)</option>
                <option value="Reservation date" {{ old('type_evenement') == "Reservation date" ? 'selected' : '' }}>Reservation date</option>
                <option value="Record date" {{ old('type_evenement') == "Record date" ? 'selected' : '' }}>Record date</option>
                <option value="Période studio experience" {{ old('type_evenement') == "Période studio experience" ? 'selected' : '' }}>Période studio experience</option>
                <option value="Livraison chanson Experience" {{ old('type_evenement') == "Livraison chanson Experience" ? 'selected' : '' }}>Livraison chanson Experience</option>
                <option value="Sucess post Experience" {{ old('type_evenement') == "Sucess post Experience" ? 'selected' : '' }}>Sucess post Experience </option>
            </select>
            <div class="form-contact" style="margin-top:0px">
                <input type="date" name="date_evenement" value="{{ old('date_evenement') }}" placeholder="Date Evénement" class="form-control">
            </div>
            </div>

            <button type="submit" class="btn" style="width:100px">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeEv()" style="width:100px">Annuler</button>
            </form>
    </div>
    <div class="form-cont" id="contForm">
        <form action="{{ route('experience.createcontent') }}" method="post" enctype="multipart/form-data" class="form-container">
            @csrf
            <h4 style="text-align:start;margin-top:30px">Ajouter un nouveau contenu à l'experience </h4>
            <input type="hidden" id="id_experience" name="id_experience" value="{{ $id_experience }}">
            <input type="hidden" id="num_facture" name="num_facture" value="{{ $num_facture }}">

            <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                <label for="pet-select">Type de contenu</label>
            <select name="type_contenu" id="pet-select" style="margin-left: 0px; background-color: #eee; margin-bottom: 20px; width: 305px; height: 50px; float: left; border-radius: 4px;">
                {{-- <option value="storytelling">Storytelling</option> à supprimer eventuellement à voir l'impact sur le code avant suppression --}}
                <option value="bon cadeau">Bon cadeau</option>
                <option value="livrable">Livrable</option>
                <option value="media">Media</option>
                <option disabled>─────</option> <!-- Ligne horizontale simulée -->
                {{-- <option value="storytelling">Storytelling</option> à supprimer eventuellement à voir l'impact sur le code avant suppression --}}
                <option value="header">Header</option>
                <option value="pochette">Pochette</option>
                <option value="video_youtube">Video youtube</option>
                <option value="master_video_clip">Master vidéo clip</option>
                <option value="interview">Interview</option>
                <option value="mix">Mix</option>
                <option value="enregistrement_studio">Enregistrement studio</option>
                <option value="enregistrement_video">Enregistrement video</option>
                <option value="enregistrement_photo">Enregistrement photo</option>
                <option value="enregistrement_interview">Enregistrement interview</option>
                <option value="teaser_experience_musique">9/16 teaser musique</option>
                <option value="teaser_experience_clip">9/16 teaser clip</option>
                <option value="teaser_experience_interview">9/16 teaser interview</option>
                <option value="content_experience">Content experience</option>
                <option value="customer_success">Customer success</option>
                <option value="content_promo_experience"> promo experience</option>
                <option value="content_promo_lalachante">promo lalachante</option>
                <option value="content_promo_story">Story</option>
                <option value="bon_cadeau_image">Image bon cadeau</option>

            </select>

            </div>
            <div class="form-contact" style="margin-top:20px">

                <input type="text" name="nom" id='nom' class="form-control" value="{{old('nom')}}"  placeholder="Nom" style="background-color:white;border:2px black  solid">
            </div>
            <div class="form-contact" style="margin-top:20px">
                <input type="text" name="url" class="form-control" value="{{old('url')}}"  placeholder="URL de contenu" style="background-color:white;border:2px black  solid">
            </div>
            <div class="form-contact input-group mb-3" style="margin-top:20px">
                <input type="file" name="file" class="form-control" id="inputGroupFile01">
                
            </div>
            <button type="submit" class="btn" style="width:100px">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeCont()" style="width:100px">Annuler</button>
            </form>
    </div>
</div>

<STYLE>
    body {
        background: #eaeaea;
    }
    /*JM*/
    .modal-shut-down-btn:hover{
    cursor: pointer;
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
#pageSubmenu13{
        visibility:visible;
        display:block;
        }
#pageSubmenu18{
            visibility:visible;
            display:block;
        }
#M50{
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
 width:130px;
   left: -50%;
   text-align: right;
   font-size: 12px;
}
</style>
<style>
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
        z-index: 99;
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
        /* Masquez la forme Popup */
        .form-exp {
        display: none;
        position: fixed;
        left:55%;
        top: 30%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px;

      }
      .form-creexp{
        display: none;
        position: fixed;
        left:55%;
        top: 1%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px;
      }

      .form-ev{
        display: none;
        position: fixed;
        left:55%;
        top: 1%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px;
      }
      .form-cont {
        display: none;
        position: fixed;
        left:55%;
        top: 30%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px;

      }

        /* Stylez le bouton pour annuler */
        .form_container_creexp .cancel {
            background-color: #cc0000;
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

     /* ------------yasser :  form container pour form_container_creexp : cas particulier --------- */
     .form_container_creexp{
        overflow: auto;
        max-height: 80vh;
        width: 900px;
        padding: 20px;
        background-color: #EDEFF0;
        border-radius:10px ;
    }
    /* Largeur complète pour les champs de saisie */
    .form_container_creexp input[type="text"],
    .form_container_creexp input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 22px 0;
        border: none;
        background: #eee;
    }
    /* Quand les entrées sont concentrées, faites quelque chose */
    .form_container_creexp input[type="text"]:focus,
    .form_container_creexp input[type="password"]:focus {
        background-color: #ddd;
    }
    .form_container_creexp .btn {
        background-color: #4968e5;
        color: #fff;
        /* padding:; */
        border: none;
        cursor: pointer;
        width: 30%;
        margin-bottom: 0px;
        opacity: 0.8;
    }
    .interaction_date-td{
        width:250px;
        text-align: right;
    }
    .btn_plus{
        width:115px;
        display:flex;
        justify-content:space-evenly;
        align-items:center;
        cursor: pointer;
        font-weight: bold;
    }
    #formUpdInteraction{
        display: none;
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
        text-align: center;
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
    /* Ilham */
    /* Cacher le bouton "Modifier" par défaut */
.modifierButton {
    display: none;
}

/* Afficher le bouton "Modifier" lorsque survolé */
.histoire-cell:hover .modifierButton {
    display: inline-block;
} */
/* Ilham */
</style>
@endsection
