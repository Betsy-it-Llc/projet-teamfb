@extends('layouts.navadmin')
@section('content')
   
    <div class="row">
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
        <div style="clear: right;" class="open-btn">
            <button class="open-button" onclick="openForm()">
                <center><img style="margin-top:-6px;margin-right:5px;height:30px;border-radius:4px"
                        src="data:image/png;base64,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"><b
                        style="color:black;font-size:1.5em">Ajouter Code</b>
            </button>
        </div>
        <div class="login-popup">
            <div class="form-popup" id="popupForm">
                <form action="{{ route('codespromo.store') }}" method="post" class="form-container">
                    @csrf
                    <h2>Création Code Promo</h2>
                    <div class="form-contact" style="margin-bottom:20px">
                        <select name="id_remise" id="pet-select"
                            style="margin-left:100px;background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                            <option value="" selected>Choisissez une remise </option>
                            @foreach ($remises as $rem)
                                <option value="{{ $rem->id_remise }}"{{old('id_remise')== $rem->id_remise ? "selected" : ""}}> {{ $rem->id_remise }} - {{ $rem->nom_remise }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="code" class="form-control" value="old('code')" placeholder="Code"
                            style="width:385px;margin-left:100px;border:2px #888888  solid">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="nb_utilisation" class="form-control" value="old('nb_utilisation')" placeholder="Nb d'utilisation"
                            style="width:385px;margin-left:100px;border:2px #888888  solid">
                    </div>
                    <button type="submit" class="btn">Enregistrer</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="notification is-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-lg-12" style="margin-bottom : 30px">
        <div class="pull-left">
            <center>
                <tr>
                    <th><b style="font-size:1.5rem;color:#333333;">Liste </b></th>
                    <th><b style="font-size:3rem;color:#333333">Promo</b></th>
                    <th><b style="font-size:1.5rem;color:#333333">Total : {{ $totalCodeP }}</b></th>
                </tr><br><br>
                <!-- <table style="  margin-bottom:50px;">
                    <tr>
                        <th id="dash"
                            style="color:black;border-bottom:4px solid black;border-top:4px solid black;  float:right ;border-radius:30px;">
                            Actif<br> <?php
                            //$nb=count(DB::connection('mysql2')->select('SELECT * from remise where statut ="Activé"'));
                            $nb = 11;
                            echo $nb;
                            ?></th>
                        <th>
                            <pre>   </pre>
                        </th>
                        <th id="dash"
                            style="color:black;border-bottom:4px solid black;border-top:4px solid black;  float:right ;border-radius:30px">
                            Inactif<br> <?php
                            //$nb=count(DB::connection('mysql2')->select('SELECT * from remise where statut ="Desactivé"'));
                            $nb = 11;
                            echo $nb;
                            ?></th>
                        <th>
                            <pre>   </pre>
                        </th>
                        <th id="dash"
                            style="color:black;border-bottom:4px solid black;border-top:4px solid black;  float:right ;border-radius:30px">
                            Brouillon<br> <?php
                            //$nb=count(DB::connection('mysql2')->select('SELECT * from remise where statut ="Brouillon"'));
                            $nb = 11;
                            echo $nb;
                            ?></th>
                        <th>
                            <pre>   </pre>
                        </th>
                        <th id="dash"
                            style="color:black;border-bottom:4px solid black;border-top:4px solid black;  float:right ;border-radius:30px">
                            Programmé<br> <?php
                            //$nb=count(DB::connection('mysql2')->select('SELECT * from remise where statut ="Programmé"'));
                            $nb = 11;
                            echo $nb;
                            ?></th>
                        <th>
                            <pre>   </pre>
                        </th>
                        <th id="dash"
                            style="color:black;border-bottom:4px solid black;border-top:4px solid black;  float:right ;border-radius:30px">
                            Expiré<br> <?php
                            ///$nb=count(DB::connection('mysql2')->select('SELECT * from remise where statut ="Expiré"'));
                            $nb = 11;
                            echo $nb;
                            ?></th>
                        <th style="padding: 0 0.5rem 0  3rem ;">Semaine<br>Mois<br>Trimestre<br>Année</th>

                    </tr>
                </table> -->
        </div>
        <div class="col-lg-12" style="margin-bottom : 30px; ">
            <center> 
            <form action="/remises.index" method="get">
                @csrf
                <table style="margin-bottom: 50px; ">
                    <tr style="display: flex; align-items: center;">
                        <form id="statutForm" action="/codespromo.index" method="get">
                        @csrf
                        {{-- @dd($count_stats) --}}
                            @foreach($count_stats as $statut => $count)
                                <th id="dash{{ $loop->index }}" class="radio-item" style="border: 4px solid black; width: 120px; float: right; padding: 0.5rem; border-radius: 30px; text-align:center;">
                                    <label>
                                        <input onclick="selectionner('dash{{ $loop->index }}','{{ $loop->index }}')" class="invisible-radio" type="radio" name="statut_experience" value="{{ $statut }}">
                                        <input type="hidden" id="{{ $loop->index }}" name="ma_periode" value="{{ $count['date'] }}"> <!-- Récupérer la date ici -->
                                        <span style="white-space: nowrap; cursor: pointer;">{{ $statut }}</span>
                                    </label>
                                    <br>{{ $count['count'] }} <!-- Récupérer le comptage ici -->
                                </th>
                                <th><pre>   </pre></th>
                            @endforeach
                        </form>
                        <td style="margin-right:10px">
                            <form id="periodeForm" action="/codespromo.index" method="get">
                                @csrf
                                <b>
                                    <label id="periode1" class="periode_chose">
                                        <input onclick="fun_periode('periode1')" class="invisible-radio" type="radio" name="periode" value="oneWeek">
                                        <span style="white-space: nowrap; cursor: pointer;">Semaine</span>
                                    </label>
                                </b>
                                <br>
                                <b>
                                    <label id="periode2" class="periode_chose">
                                        <input onclick="fun_periode('periode2')" class="invisible-radio" type="radio" name="periode" value="oneMonth">
                                        <span style="white-space: nowrap; cursor: pointer;">Mois</span>
                                    </label>
                                </b>
                                <br>
                                <b>
                                    <label id="periode3" class="periode_chose">
                                        <input onclick="fun_periode('periode3')" class="invisible-radio" type="radio" name="periode" value="oneQuarter">
                                        <span style="white-space: nowrap; cursor: pointer;">Trimestre</span>
                                    </label>
                                </b>
                                <br>
                                <b>
                                    <label id="periode4" class="periode_chose">
                                        <input onclick="fun_periode('periode4')" class="invisible-radio" type="radio" name="periode" value="oneYear">
                                        <span style="white-space: nowrap; cursor: pointer;">Année</span>
                                    </label>
                                </b>
                                <br>
                                <b>
                                    <label id="periode5" class="periode_chose">
                                        <input onclick="fun_periode('periode5')" class="invisible-radio" type="radio" name="periode" value="all">
                                        <span style="white-space: nowrap; cursor: pointer;">All</span>
                                    </label>
                                </b>
                            </form>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- Recherche multicritère -->
        <section class="search-sec" style="margin : 20px ; font-size : 13px">
            <div class="container" style="margin-left : 0">
                <h6>Recherche multicritère</h6>
                <form action="{{ route('codespromo.index') }}" method="get" novalidate="novalidate">
                    <div class="row">
                        <div class="col-lg-40">
                            <div class="row">

                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <input class="form-control" type="text" name="multisearchnom" id="nom"
                                        placeholder="ID ">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <input class="form-control" type="text" name="multisearchmail" id="name"
                                        placeholder="Nom Produit">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <input class="form-control" type="text" name="multisearchmail" id="name"
                                        placeholder="Nom Produit">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <select data-trigger="" name="multisearchremise" class="form-control" >
                                        <option disabled selected>Nom remise</option>
                                        @foreach($liste_nom_remise as $type)
                                        <option>{{$type->nom_remise}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <select data-trigger="" name="multisearchstat" class="form-control" >
                                        <option disabled selected>Statut </option>
                                        @foreach($liste_statut as $statut)
                                        <option>{{$statut->statut_code}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <button type="submit" class="btn btn-success wrn-btn"
                                        style="margin-left : 5px">Search</button>
                                    <button type="button" class="btn btn-danger wrn-btn"><a
                                            href="">Reset</a></button>
                                </div>

                            </div>
                        </div>
                        <div style="margin-top : 20px">
                            <label for="perPage" style="font-size : 14px; font-weight : 500">Nombre de Lignes</label>
                            <select data-trigger="" name="perPage" id="perPage" style="width : 50px"
                                onchange="this.form.submit()">
                                <option value="10" {{ Request::get('perPage') == '10' ? 'selected' : '' }}>10</option>
                                <option value="25" {{ Request::get('perPage') == '25' ? 'selected' : '' }}>25</option>
                                <option value="50" {{ Request::get('perPage') == '50' ? 'selected' : '' }}>50</option>
                                <option value="100" {{ Request::get('perPage') == '100' ? 'selected' : '' }}>100
                                </option>
                                <option value="250" {{ Request::get('perPage') == '250' ? 'selected' : '' }}>250
                                </option>
                                <option value="9000000" {{ Request::get('perPage') == '9000000' ? 'selected' : '' }}>All
                                </option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>
        </section>
        <!-- Recherche Multicritères FIN -->

        <!--<div>
                        <div>
                            <div class="pull-right" style="margin-bottom : 10px">
                                <a class="btn btn-info" href="{/{ route('facture.create') }}"> Ajouter</a>
                            </div>
                            <p> Il y'a : <?php
                            /*use Illuminate\Support\Facades\DB;
                        $countt=DB::connection('mysql2')->table('factures')->count();
                        echo ($countt);*/
                            ?> Factures</p>
                        </div>-->
        <div>
            <p> Il y'a : {{ $totalCodeP }} Codes Promo
            </p>
        </div>
    </div>
    </div>
    <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table">

        <form method="post" id="codespromoForm">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>


            <br>


            <table class="table" style="text-align:center">
                <thead class="thead" style="background:#cccccc">
                    <tr style=" white-space: nowrap;">

                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th scope="col">ID</th>
                        <th scope="col">@sortablelink('Code')</th>
                        <th scope="col">@sortablelink('Remise')</th>
                        <th scope="col">@sortablelink('Taux')</th>
                        <th scope="col">@sortablelink('Montant')</th>
                        <th scope="col">@sortablelink('Nombre')</th>
                        <th scope="col">@sortablelink('Date de creation')</th>
                        <th scope="col">@sortablelink('Date d\'expiration')</th>
                        <th scope="col">@sortablelink('Statut')</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                {{-- @dd($data) --}}
                @foreach ($data as $key => $value)
                    <tr>
                        <td scope="row">
                            <input type="checkbox" name="codespromo[]" id="checks" class="selectbox" value="{{$value->id_code}}">
                        </td>
                        <td> {{ $value->id_code }} </td>
                        <td> {{ $value->code }} </td>
                        <td>{{ $value->nom_remise }}</td>
                        <td><?php if ($value->taux == null) {
                            echo '0';
                        } else {
                            echo $value->taux;
                        } ?>%</td>
                        <td><?php if ($value->montant == null) {
                            echo '0';
                        } else {
                            echo $value->montant;
                        } ?> €</td>
                        <td>{{ $value->nb_utilisation }}</td>
                        <td>{{ Carbon\Carbon::parse($value->date_debut )->format('Y m d')}}</td>
                        <td> {{ Carbon\Carbon::parse($value->date_fin )->format('Y m d')}}</td>
                        <td>{{ $value->statut_code }}</td>


                        <!--<td>{/{ \Str::limit($value->id_stripe, 45) }}</td>
                        {/{ \Str::limit($value->experimentateur, 45) }}</td>-->



                        <td>
                            <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                href="/codespromo.show/{{ $value->id_code }}"><i style="color : #4d94ff"
                                    class="fas fa-info"></i></a>
                            <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                href="/codespromo.edit/{{ $value->id_code }}"><i style="color : #e6ac00"
                                    class="fas fa-edit"></i></a>
                            <button formaction="{{ route('codespromo.destroy', ['id_remise' => $value->id_code]) }}"
                                style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete ?')"><i style="color : #cc3300"
                                    class="fas fa-trash"></i></button>
                        </td>

                    </tr>
                @endforeach
            </table>
        </form>
        {!! $data->appends(request()->query())->links() !!}

<script>
    $('.selectall').click(function(){
        $('.selectbox').prop('checked',$(this).prop('checked'));
        $('.selectall2').prop('checked',$(this).prop('checked'));
    })
    $('.selectall2').click(function(){
        $('.selectbox').prop('checked',$(this).prop('checked'));
        $('.selectall').prop('checked',$(this).prop('checked'));
    })
    $('.selectbox').change(function(){
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if(total == number){
            $('.selectall').prop('checked',true);
            $('.selectall2').prop('checked',true);
        } else {
            $('.selectall').prop('checked',false);
            $('.selectall2').prop('checked',false);

        }
    })
    
    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
                          
    function confirmAndSubmit(event) {
        event.preventDefault();
    
        var checkboxes = document.querySelectorAll('input[name="codespromo[]"]:checked');
        var ids = [];
    
        for (var i = 0; i < checkboxes.length; i++) {
          ids.push(checkboxes[i].value);
        }
    
        if (ids.length > 0) {
          var form = event.target.closest('form');
          form.setAttribute('action', '{{ route("codespromo.deleteselect") }}'); 
          form.submit(); // Soumettre le formulaire avec la nouvelle action
        } else {
          console.log('Aucun code sélectionné.');
        }
      }
    
      var deleteButton = document.querySelector('#codespromoForm button[type="submit"]');
      deleteButton.addEventListener('click', confirmAndSubmit);


</script>

<script>
    function selectionner(le_param_selected, ma_periode) {
        var radios = document.querySelectorAll('.radio-item');
        var ma_periode = document.getElementById(ma_periode);
        var selectedRadio = document.getElementById(le_param_selected);

        // Réinitialiser la couleur de tous les boutons radio
        radios.forEach(function(radio) {
            radio.style.backgroundColor = '';
        });

        selectedRadio.style.backgroundColor = '#9ec99d';
        document.getElementById("statutForm").submit();        
    }

    function fun_periode(periode_chosed){
        var radios = document.querySelectorAll('.periode_chose');
        
        var selectedRadio = document.getElementById(periode_chosed);

        // Réinitialiser la couleur de tous les boutons radio
        radios.forEach(function(radio) {
            radio.style.backgroundColor = '';
        });

        // Appliquer la couleur uniquement au bouton radio sélectionné
        selectedRadio.style.backgroundColor = '#9ec99d';

        document.getElementById("periodeForm").submit();
    }
</script>
<!--  -->
<style>
    .invisible-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
        
    }

</style>


<style>
      /* Fixez le bouton sur le côté gauche de la page the button on the left side of the page */
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
        left:55%;
        top: 25%;
        transform: translate(-45%, 5%);
       
      }
      /* Styles pour le conteneur de la forme */
      .form-container {
        width: 650px;
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
    #M99{
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

        #dash {
            padding: 1rem;
            font-size: 0.9rem;
            table-layout: fixed;
            width: 120px;
            text-align: center;
            color: #101;
            border: 100px;


        }
    </style>
@endsection
