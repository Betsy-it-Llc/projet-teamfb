@extends('layouts.navadmin')
@section('content')

    <div class="row">
        <div style="clear: right;" class="open-btn">
            <button class="open-button" onclick="openForm()">
                <center><img style="margin-top:-6px;margin-right:5px;height:30px;border-radius:4px"
                        src="data:image/png;base64,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"><b
                        style="color:black;font-size:1.5em">Ajouter Intéraction</b>
            </button>
        </div>
        <div class="login-popup">
            <div class="form-popup" id="popupForm">
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
                <form action="{{ route('interactions.store') }}" method="post" class="form-container">
                    @csrf
                    <h2>Création Intéraction </h2>
                    <div class="form-contact" style="margin-bottom:20px">
                        <datalist id="contacts" style="margin-left:100px;background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                       
                            @foreach ($id_con as $con)
                                <option value="{{ $con->id_contact }}">{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>    
                            @endforeach
                        </datalist>
                        <input type="text" name="id_contact" list="contacts"style="margin-left:100px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;border:1px solid black" placeholder="Choisissez un contact">
                    </div>
                    <div class="form-contact" style="margin-bottom:20px">
                        <select name="id_experience" id="pet-select"
                            style="margin-left:100px;background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                            <option value="">Aucune Experience</option>
                            @foreach ($id_exp as $exp)
                                <option
                                    value="{{ $exp->id_experience }}"{{ old('id_experience') == $exp->id_experience ? 'selected' : '' }}>
                                    {{ $exp->id_experience }} - {{ $exp->nom_experience }}</option>
                            @endforeach
                        </select>
                    </div>
                    @php
                        /*
                          <div class="form-contact" style="margin-bottom:20px">
                    <select name="type_interaction" id="pet-select" style="margin-left:100px;background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                        <option>Choisissez le Type d'Interaction</option>
                        <option value="type1">type1</option>
                        <option value="type2">type2</option>
                        <option value="type3">type3</option>
                        <option value="type4">type4</option>
                        <option value="type5">type5</option>
                    </select>
                    </div>
                        */
                    @endphp
                    <!-- -------------------------tags--------------- -->
                    <div style="margin-left:100px;margin-right:120px;">
                        <div style=" width: 100%; background-color: white; border: 2px #888888 solid; border-radius: 4px; margin: 0; resize: none; overflow: hidden;" >
                            <div id="tag_selectionned"></div>
                            <input  style="margin:0; background:none;" placeholder="Cherchez un tag" type="text" id="select_tag_int">
                        </div>
                        <!--  -->
                        <div id="affichage_tag_selected_inter" style="border-radius:4px; padding:10px;  ">
                        </div>
                    </div>
                    
                    <!-- -------------------------tags--------------- -->
                    <!-- <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="type_interaction" class="form-control" value="{{old('type_interaction')}}"  placeholder="Type Interaction" style="width:385px; margin-left:100px; border:2px #888888  solid">
                    </div> -->
                    <div class="form-contact" style="margin-top:20px">
                        <h6 style="color:black; display: flex; justify-content:left; margin-left:100px ">Description</h6>
                    </div>
                    <div class="form-contact" >
                        <!-- <input type="text" name="Expérimentateur" class="form-control" value="{{old('texte')}}"   style="width:385px;height:200px;margin-left:100px;border:2px #888888  solid"> -->
                        <textarea name="texte" class="form-control" cols="30" rows="5" style="width:385px;height:200px;margin-bottom: 10px    ;margin-left:100px;border:2px #888888  solid"> {{old('texte')}}</textarea>
                    </div>

                    <button type="submit" class="btn">Enregistrer</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12" style="margin-bottom : 40px">
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
        <div class="pull-left">
            <center>
                <tr>
                    <th><b style="font-size:1.5rem;color:#333333;">Liste </b></th>
                    <th><b style="font-size:3rem;color:#333333">Interactions</b></th>
                    <th><b style="font-size:1.5rem;color:#333333">Total : {{ $totalInt }}</b></th>
                </tr><br><br>
        </div>
        <!-- Recherche multicritère -->
        <section class="search-sec" style="margin : 20px ; font-size : 13px">
            <div class="container" style="margin-left : 0">
                <h6>Recherche multicritère</h6>
                <form action="{{ url('/interactions.index') }}" method="get" novalidate="novalidate">
                    <div class="row">
                        <div class="col-lg-40">
                            <div class="row">

                                <div class="col-lg-1 col-md-1 col-sm-30 p-0">
                                    <input class="form-control" type="text" name="multisearchnom" id="nom"
                                        placeholder="Nom">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <input class="form-control" type="text" name="multisearchmail" id="mail"
                                        placeholder="Mail">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <input class="form-control" type="text" name="multisearchmail" id="mail"
                                        placeholder="Mail">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <input class="form-control" type="text" name="multisearchtel" id="tel"
                                        placeholder="Tel">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-30 p-0">
                                    <div onclick="ouvrir_tags()"  class="form-control" style="width:100%; display:flex; justify-content:space-between; align-items: center;cursor:pointer">
                                        Tags
                                        <svg fill="#000000" height="10px" width="10px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                            viewBox="0 0 330 330" xml:space="preserve">
                                            <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393
                                                c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393
                                                s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                    <button type="submit" class="btn btn-success wrn-btn"
                                        style="margin-left : 5px">Search</button>
                                    <button type="button" class="btn btn-danger wrn-btn"><a
                                            href="{{ route('interactions.index') }}">Reset</a></button>
                                </div>
                            </div>
                            <!-- -----------ne pas effacer c'est pour afficher le resultat du select---------------- -->
                            <div  class="row">
                                <div class="col-lg-1 col-md-1 col-sm-30 p-0">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                </div>
                                <div id="affichage_tag_in_select"  style="display:none" class="col-lg-3 col-md-3 col-sm-30 p-0">
                                    <div class="form-control" style="display:block; overflow: auto; height: 150px; ">
                                        <input type="hidden" name="tags_test" value="none" style="display: none;">
                                        @foreach($liste_tags as $index => $tags)
                                            <div style=" white-space: nowrap;">
                                                <input type="checkbox" name="tags_{{$index}}" value="{{ $tags->id_tag_interaction }}">
                                                <label for="option1">{{ $tags->tag }}</label>
                                            </div>
                                        @endforeach                                        
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                </div>
                            </div>
                            <!-- -----------ne pas effacer c'est pour afficher le resultat du select---------------- -->

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
        <div>
            <p> Il y'a : {{ $totalInt }} interactions
            </p>
        </div>
    </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table">

        <form method="post" id="interactionsForm">
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
                        <th>ID</th>
                        <th>@sortablelink('ID_Exp')</th>
                        <th>@sortablelink('Date')</th>
                        <th>@sortablelink('tag')</th>
                        <!-- <th>@sortablelink('Type intéraction')</th> -->
                        <th>@sortablelink('Prénom Nom')</th>
                        <!-- <th>@sortablelink('Prénom')</th> -->
                        <th>@sortablelink('Descritpion')</th>
                        <th>Action</th>
                    </tr>
                </thead>

                    @foreach ($data as $key => $value)
                        <tr>
                            <td scope="row">
                                <input type="checkbox" name="interactions[]" id="checks" class="selectbox" value="{{$value->id_interaction}}">
                            </td>
                            <td>{{ $value->id_interaction }}</td>
                            <td>{{ $value->id_experience }}</td>
                            <td>{{ Carbon\Carbon::parse($value->date_heure)->format('Y m d H:i:s')}}</td>
                            <td>
                            @foreach($liste_tags as $tag)
                                @if($tag->id_tag_interaction == $value->id_tag_interaction)
                                    {{ $tag->tag }}
                                @endif
                            @endforeach
                            </td>
                         
                            <td>{{ $contacts->firstWhere('id_contact', $value->id_contact)->prenom }} {{ strtoupper($contacts->firstWhere('id_contact', $value->id_contact)->nom) }}</td>
                            <td>
                                <pre style="white-space: pre-line; text-align:left; margin:0">{{ $value->texte }}</pre>
                            </td>

                            <td>

                                <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="/interactions.edit/{{ $value->id_interaction }}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                <button formaction="/interactions.destroy/{{ $value->id_interaction }}"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i style="color : #cc3300"
                                        class="fas fa-trash"></i></button>
                            </td>
                          
                        </tr>
                    @endforeach

            </table>


        </form>

        {!! $data->appends(request()->query())->links() !!}
</div>
<script type="text/javascript">
    $('.selectall').click(function() {
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall2').prop('checked', $(this).prop('checked'));
    })
    $('.selectall2').click(function() {
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall').prop('checked', $(this).prop('checked'));
    })
    $('.selectbox').change(function() {
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if (total == number) {
            $('.selectall').prop('checked', true);
            $('.selectall2').prop('checked', true);
        } else {
            $('.selectall').prop('checked', false);
            $('.selectall2').prop('checked', false);

        }
    }) 
</script>
<script>
    function openForm() {
        var popupForm = document.getElementById("popupForm");
        popupForm.style.display = "block";
        suggestion_tag_inter(popupForm);
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
</script>


<!-- ------------------------------------------------------------------- -->

<script>
    var liste_ouvert_fermer = 0;
    function ouvrir_tags(){
        // alert("hello")
        if (liste_ouvert_fermer == 0 ) {
            var zone_affichage = document.getElementById('affichage_tag_in_select');
            zone_affichage.style.display = "block"
            liste_ouvert_fermer = 1 ;
        }else  {
            var zone_affichage = document.getElementById('affichage_tag_in_select');
            zone_affichage.style.display = "none"
            liste_ouvert_fermer = 0 ;
        }
    }
    //---------------------------------barre de recherche : interaction-------------------7



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
    }
</script>
<script>
    function confirmAndSubmit(event) {
        event.preventDefault();
    
        var checkboxes = document.querySelectorAll('input[name="interactions[]"]:checked');
        var ids = [];
    
        for (var i = 0; i < checkboxes.length; i++) {
          ids.push(checkboxes[i].value);
        }
    
        if (ids.length > 0) {
          var form = event.target.closest('form');
          form.setAttribute('action', '{{ route("interactions.deleteselect") }}'); 
          form.submit(); // Soumettre le formulaire avec la nouvelle action
        } else {
          console.log('Aucun client sélectionné.');
        }
      }
    
      var deleteButton = document.querySelector('#interactionsForm button[type="submit"]');
      deleteButton.addEventListener('click', confirmAndSubmit);
    </script>
<!-- -------------------------------------------------------------------- -->

    <style>
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
            left: 55%;
            top: 10%;
            transform: translate(-45%, 5%);

        }

        /* Styles pour le conteneur de la forme */
        .form-container {
            overflow: auto;
            max-height: 80vh;
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

        #pageSubmenu13 {
            visibility: visible;
            display: block;
        }

        #pageSubmenu18 {
            visibility: visible;
            display: block;
        }

        #M97 {
            background-color: #747474;
        }

        #dash {
            padding: 1rem;
            font-size: 0.9rem;
            table-layout: fixed;
            width: 160px;
            text-align: center;
            color: #101;
            border: 100px;
        }
    </style>
@endsection
