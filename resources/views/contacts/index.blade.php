@extends('layouts.navadmin')
@section('content')
   
<title>Liste Contacts</title>
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
        <div class="col-lg-12" style="margin-bottom : 30px">
            <div class="pull-left">
            <center> <tr>
                <th><b style="font-size:1.5rem;color:#333333;">Liste </b></th>
                <th><b style="font-size:3rem;color:#333333">Contacts</b></th>
                <th><b style="font-size:1.5rem;color:#333333">Total : {{ $totalContact }}</b></th>
              </tr><br><br>
                <center>
                    <table style="  margin-bottom:50px;margin-top:60px">
                    <tr>
                        <th id="dash" style="border:4px solid black;  float:right ;border-radius:30px">
                        <label for="intervenant">Intervenant</label>
                        <input type='radio'name='profil' id="intervenant" value='intervenant' class='invisible-radio'>
                        <br> 
                        {{$count_intervenant}}
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;  float:right ;border-radius:30px">
                        <label for="partenaire">Partenaire</label>
                        <input type='radio'name='profil' id="partenaire" value='partenaire' class='invisible-radio'>
                        <br> 
                        {{$count_partenaire}}
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;  float:right ;border-radius:30px">
                        <label for="prospect">Prospect</label>
                        <input type='radio'name='profil' id="prospect" value='prospect' class='invisible-radio'>
                        <br> 
                        {{$count_prospect}}
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;  float:right ;border-radius:30px">
                        <label for='client'>Client</label>
                        <input type='radio'name='profil' id="client" value='client' class='invisible-radio'>
                        <br> 
                        {{$count_client}}
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;  float:right ;border-radius:30px">
                        <label for="user">Experimentateur</label>
                        <input type='radio'name='profil' id="user" value='user' class='invisible-radio'>
                        <br> 
                        {{$count_exp}}
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;  float:right ;border-radius:30px">
                        <label for="client-user">Client Experimentateur</label>
                        <input type='radio' name='profil' id="client-user" value='client-user' class='invisible-radio'>
                        <br> 
                        {{$count_client_exp}}
                        </th>
                        <th><pre>   </pre></th>                                               
                  
                        <th style="padding: 0 0.5rem 0  3rem ;">
                            <label for="periode-semaine">Semaine</label>
                            <input type="radio" name="periode" id="periode-semaine" value="semaine" class="invisible-radio">
                            <br>
                            <label for="periode-mois">Mois</label>
                            <input type="radio" name="periode" id="periode-mois" value="mois" class="invisible-radio">
                            <br>
                            <label for="periode-trimestre">Trimestre</label>
                            <input type="radio" name="periode" id="periode-trimestre" value="trimestre" class="invisible-radio">
                            <br>
                            <label for="periode-annee">Année</label>
                            <input type="radio" name="periode" id="periode-annee" value="annee" class="invisible-radio">
                            <br>
                            <label for="periode-all">All</label>
                            <input type="radio" name="periode" id="periode-all" value="all" class="invisible-radio">
                          </th>
      
                    </tr>
                </table>
            </div>
            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container" style="margin-left : 0">
                    <h6>Recherche multicritère</h6>
                    <form action="/contacts.index" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="Nom">
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchprenom" id="prenom"
                                            placeholder="Prenom">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchmail" id="mail"
                                            placeholder="Mail">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchtel" id="tel"
                                            placeholder="Tel">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchprofile" class="form-control" >
                                            <option disabled selected>Profil</option>
                                            @foreach($liste_profile as $profile)
                                            <option>{{$profile->profil}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('contacts.index') }}">Reset</a></button>
                                    </div>

                                </div>
                            </div>
                            <div  style="margin-top : 20px">
                                <label for="perPage" style="font-size : 14px; font-weight : 500">Nombre de Lignes</label>
                                <select data-trigger="" name="perPage" id="perPage" style="width : 50px"  onchange="this.form.submit()">
                                    <option value="10" {{ Request::get('perPage') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ Request::get('perPage') == '25' ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ Request::get('perPage') == '50' ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ Request::get('perPage') == '100' ? 'selected' : '' }}>100</option>
                                    <option value="250" {{ Request::get('perPage') == '250' ? 'selected' : '' }}>250</option>
                                    <option value="9000000" {{ Request::get('perPage') == '9000000' ? 'selected' : '' }}>All</option>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
            </section>
            <!-- Recherche Multicritères FIN -->
            <div>
                <p> Il y'a : {{ $totalContact }} Contacts
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

        <form method="post" id="contactsForm">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="{{ route('contacts.create') }}" style="margin-bottom : 14px "> Ajouter</a>
            <br>


            <table class="table" style="text-align:center">
                <thead class="thead" style="background:#cccccc">
                    <tr style=" white-space: nowrap;">
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th>ID</th>
                        <th>@sortablelink('prenom Nom')</th>
                        <!-- <th>@sortablelink('prenom')</th> -->
                        <th>@sortablelink('tel')</th>
                        <th>@sortablelink('email')</th>
                        <th>@sortablelink('adresse')</th>
                        <th>@sortablelink('profile')</th>
                        <th>@sortablelink('date de creation')</th>
                        <th>@sortablelink('stripe')</th>
                        <th  style="width:14%">Action</th>
                        <th></th>
                    </tr>
                </thead>
                {{-- @dd($data) --}}
                    @foreach ($data as $key => $value)
                        @php
                            /* if ( is_null($con_experience->firstWhere('id_contact',$value->id_contact))) 
                                {
                                    $profil="";
                                }
                                else {
                                    $profil=$con_experience->firstWhere('id_contact',$value->id_contact)->profil;
                            }*/
                            /* <!-- ----------------------------------------- --> */
                            if (is_null($con_notif->firstWhere('id_contact',$value->id_contact))) 
                                {
                                    $date="";
                                }
                                else {
                                    $date=$con_notif->firstWhere('id_contact',$value->id_contact)->date_creation;
                                    $date = Carbon\Carbon::parse($date)->format('Y m d H:i');
                                }
                           
                        @endphp
                        <tr>
                            <th scope="row"><input type="checkbox" name="contacts[]" class="selectbox"
                                    value="{{ $value->id_contact }}"></th>
                            <td> <a href="{{ \Str::limit($value->id_contact)}}"target="_blank">{{ $value->id_contact }}</a></td>
                            <td>{{ \Str::limit($value->prenom, 45) }} {{ strtoupper(\Str::limit($value->nom, 45)) }}</td>
                            <td>{{ $value->tel }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->adresse }}, {{ $value->code_postal }}</td>
                            <td>{{ $value->profil }}</td>
                            <td>{{ $date }}</td>
                            <td>
                                @if (!empty($value->url_client_stripe))
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                href="{{ $value->url_client_stripe }}"><img src="{{ asset('storage/img/stripe.png') }}" style="width:1em;height:1em;" ></a>
                                @endif
                            </td>
                            <td>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="/contacts.show/{{$value->id_contact}}"><i style="color : #4d94ff"
                                        class="fas fa-info"></i></a>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="/contacts.edit/{{$value->id_contact}}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                <button formaction="/contacts.destroy/{{ $value->id_contact }}"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach

            </table>


        </form>
        {!! $data->appends(request()->query())->links() !!}

        @php
            //         {!! $data->links() !!}

        @endphp
        <script type="text/javascript">
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

            function confirmAndSubmit(event) {
        event.preventDefault();
    
        var checkboxes = document.querySelectorAll('input[name="contacts[]"]:checked');
        var ids = [];
    
        for (var i = 0; i < checkboxes.length; i++) {
          ids.push(checkboxes[i].value);
        }
    
        if (ids.length > 0) {
          var form = event.target.closest('form');
          form.setAttribute('action', '{{ route("contacts.deleteselect") }}'); 
          form.submit(); // Soumettre le formulaire avec la nouvelle action
        } else {
          console.log('Aucun client sélectionné.');
        }
      }
    
      var deleteButton = document.querySelector('#contactsForm button[type="submit"]');
      deleteButton.addEventListener('click', confirmAndSubmit);


        </script>
                    <script>
                        // Écouteurs d'événements pour les changements d'état des boutons radio
                        var profilRadios = document.querySelectorAll('input[name="profil"]');
                        var periodeRadios = document.querySelectorAll('input[name="periode"]');
                      
                        for (var i = 0; i < profilRadios.length; i++) {
                          profilRadios[i].addEventListener('change', updateSelection);
                        }
                      
                        for (var i = 0; i < periodeRadios.length; i++) {
                          periodeRadios[i].addEventListener('change', updateSelection);
                        }
                      
                        // Fonction de mise à jour de la sélection
                        function updateSelection() {
                          var profilSelectionne = document.querySelector('input[name="profil"]:checked');
                          var periodeSelectionnee = document.querySelector('input[name="periode"]:checked');
                      
                          // Réinitialiser la couleur de fond de tous les labels
                          var labels = document.querySelectorAll('label');
                          labels.forEach(function(label) {
                            label.style.backgroundColor = 'white'; // Remplacez 'white' par la couleur de fond initiale
                          });
                      
                          // Changer la couleur de fond du label correspondant au profil sélectionné
                          if (profilSelectionne) {
                            var labelProfil = document.querySelector('label[for="' + profilSelectionne.id + '"]');
                            labelProfil.style.backgroundColor = 'green'; 
                          }
                      
                          // Changer la couleur de fond du label correspondant à la période sélectionnée
                          if (periodeSelectionnee) {
                            var labelPeriode = document.querySelector('label[for="' + periodeSelectionnee.id + '"]');
                            labelPeriode.style.backgroundColor = 'green'; 
                          }
                      
                          // Rediriger vers la page avec la période et le profil sélectionnés en utilisant les paramètres d'URL
                          var params = new URLSearchParams();
                          if (profilSelectionne) {
                            params.set('profil', profilSelectionne.value);
                          }
                          if (periodeSelectionnee) {
        
                            params.set('periode', periodeSelectionnee.value);
                          }
                          var queryString = params.toString();
                      
                          window.location.href = "{{ route('contacts.index') }}" + (queryString ? '?' + queryString : '');
                        }
                      
                        // Récupérer les paramètres d'URL lors du chargement de la page
                        window.addEventListener('load', function() {
                          var urlParams = new URLSearchParams(window.location.search);
                          var profilParam = urlParams.get('profil');
                          var periodeParam = urlParams.get('periode');
                      
                          // Rétablir la sélection par défaut en utilisant les paramètres d'URL
                          if (profilParam) {
                            document.querySelector('input[name="profil"][value="' + profilParam + '"]').checked = true;
                            document.querySelector('label[for="' + profilParam + '"]').style.backgroundColor = 'green'; // Remplacez 'green' par la couleur souhaitée
                          }
                      
                          if (periodeParam) {
                            document.querySelector('input[name="periode"][value="' + periodeParam + '"]').checked = true;
                            document.querySelector('label[for="' + periodeParam + '"]').style.backgroundColor = 'green'; // Remplacez 'green' par la couleur souhaitée
                          }
                        });
                    </script>
    </div>
    <style>
        .invisible-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
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
        #M52{
        background-color: #747474;
        }
        #dash{
    padding:1rem;
    font-size:0.9rem;
    table-layout: fixed;
    width:160px;
    text-align:center;
    color:#101;
    border:100px;
   
    
}
    </style>
@endsection