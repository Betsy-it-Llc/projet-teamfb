@extends('layouts.navadmin')
@section('content')
<title>Modification intéraction</title>
<div class="container">
        <form action="{{ route('interactions.update') }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" id="id_interaction" name="id_interaction" value="{{ $data[0]->id_interaction }}">
            @if($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
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
    <div class="row gutters">
        
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:420px;margin-left:350px">
                <div class="card-body"style="margin-right:0px">
                <center> <h1 style="margin-bottom:40px"> Modification de Intéraction</h1>
           
                <div class="form-contact" style="margin-bottom:30px;margin-top:60px">
                  

                    <select  name="id_contact" id="pet-select" style="background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                        @foreach ($id_con as $con)
                            @if ($con->id_contact==$data[0]->id_contact)
                                <option value="{{ $con->id_contact }}" {{old('id_contact') == $con->id_contact ? "selected" : ""}}>{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }} </option>    
                            @else
                                <option value="{{ $con->id_contact }}"{{old('id_contact') == $con->id_contact ? "selected" : ""}}>{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>    
                            @endif
                        @endforeach
                    </select>
                    </div>
                    <div class="form-contact" style="margin-bottom:30px">
                    <select name="id_experience" id="pet-select" style="background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                        @if (is_null($data_exp))
                            <option value="" selected>Aucune Experience</option>
                            @foreach ($id_exp as $exp)
                                <option value="{{ $exp->id_experience }}"{{old('id_experience') == $exp->id_experience ? "selected" : ""}}>{{ $exp->id_experience }} - {{ $exp->nom_experience }}</option>    
                            @endforeach
                        @else
                            <option value="{{ $data_exp->id_experience }}" selected>{{ $data_exp->id_experience }} - {{ $data_exp->nom_experience }}</option>   
                            @foreach ($id_exp as $exp)
                                <option value="{{ $exp->id_experience }}" {{old('id_experience') == $exp->id_experience ? "selected" : ""}}>{{ $exp->id_experience }} - {{ $exp->nom_experience }}</option>    
                            @endforeach
                        @endif

                    </select>
                    </div>
                    <!-- -------------------------tags--------------- -->
                    <div style="width: 100%; background-color: white; border: 2px black solid; border-radius: 4px; margin: 0; resize: none; overflow: hidden;" >
                        <div id="tag_selectionned"></div>
                        <input  style="margin:0; background:none; width:100%" placeholder="Cherchez un tag" type="text" id="select_tag_int">
                    </div>
                    <!--  -->
                    <div id="affichage_tag_selected_inter" style="border-radius:4px; padding:10px;  ">
                    </div>
                    <!-- -------------------------tags--------------- -->
                    <div class="form-contact" style="margin-top:30px">
                    <h6 style="color:black; display: flex; justify-content:left;  ">Description</h6>
                    </div>
                    <div class="form-contact" >
                        <!-- <input type="text" name="texte" class="form-control" value="{{ $data[0]->texte}}" style=" white-space: normal;width:385px;height:80px;border:2px #888888  solid;margin-bottom:20px"> -->
                        <textarea name="texte" class="form-control" value="{{old('texte')}}"  style=" white-space: pre-line; border:2px #888888  solid;margin-bottom:20px" cols="30" rows="5"> {{$data[0]->texte}}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-info" style="margin-left:0px">Modifier</button>
                    <a class="btn btn-danger" href="{{ route('interactions.index') }}" style="margin-left:30px"> Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<!-- ----------------------yasser---------------- -->
<script>
    $(document).ready(function() {
        var searched_tag                = document.getElementById('select_tag_int');
        var div_affichage               = document.getElementById('affichage_tag_selected_inter');
        var zone_affichage_dans_barre   = document.getElementById('tag_selectionned');
        var id_interaction_to_edit      = "{{$data[0]->id_interaction}}";
        var data = @json($les_tags_lier_avec_inter);
        // --------------------
        data.forEach(function(element) {
            if(element.id_interaction == id_interaction_to_edit){
                console.log(element);
                let index = 1 + zone_affichage_dans_barre.childElementCount;
                let afficher_dans_la_barre = document.createElement("div");
                afficher_dans_la_barre.style.margin = "2px";
                afficher_dans_la_barre.style.padding = "2px";
                afficher_dans_la_barre.style.border = "1px solid black";
                afficher_dans_la_barre.style.borderRadius = "3px"
                afficher_dans_la_barre.style.width = "fit-content";
                afficher_dans_la_barre.style.display = "inline-block";
                afficher_dans_la_barre.style.whiteSpace = "nowrap";

                afficher_dans_la_barre.innerText = element.tag
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
                checkbox.value = element.id_tag_interaction;
                checkbox.id = "le_tag_" + index;
                checkbox.name = "le_tag_" + index;
                // ---------------------------------
                afficher_dans_la_barre.appendChild(btn_croix)
                afficher_dans_la_barre.appendChild(checkbox)
                zone_affichage_dans_barre.appendChild(afficher_dans_la_barre)
                // ---------------------------------
                btn_croix.onclick = function(){
                    zone_affichage_dans_barre.removeChild(afficher_dans_la_barre);
                }

            }
        });
        suggestion_tag_inter_update(searched_tag, div_affichage, zone_affichage_dans_barre )
    });
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
<!-- ----------------------yasser---------------- -->


<style>

    body {
        margin: 0;
        color: #2e323c;
        background: #f5f6fa;
        position: relative;
        height: 100%;
        width : 100%;
    }

    .account-settings .user-profile {
        margin: 0 0 1rem 0;
        padding-bottom: 1rem;
        text-align: center;
    }
    .account-settings .user-profile .user-avatar {
        margin: 0 0 1rem 0;
    }
    .account-settings .user-profile .user-avatar img {
        width: 90px;
        height: 90px;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
    }
    .account-settings .user-profile h5.user-name {
        margin: 0 0 0.5rem 0;
    }
    .account-settings .user-profile h6.user-email {
        margin: 0;
        font-size: 0.8rem;
        font-weight: 400;
        color: #9fa8b9;
    }
    .account-settings .about {
        margin: 2rem 0 0 0;
        text-align: center;
    }
    .account-settings .about h5 {
        margin: 0 0 15px 0;
        color: #007ae1;
    }
    .account-settings .about p {
        font-size: 0.825rem;
    }
    .form-control {
        border: 1px solid #cfd1d8;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        font-size: .825rem;
        background: #ffffff;
        color: #2e323c;
    }

    .card {
        background: #DEDEDE;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }
    .form-control{
    background-color:;
    border-radius:4px;
    border-color:black;
    }

</style>
<style>
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
    #M97{
        background-color: #747474;
    }
</style>
@endsection
