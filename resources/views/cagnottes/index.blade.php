@extends('layouts.navadmin')

@section('content')


    <title>Liste Cagnottes</title>
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
                <th><b style="font-size:3rem;color:#333333">Cagnotte</b></th>
                <th><b style="font-size:1.5rem;color:#333333">Total : variable total </b></th>
              </tr><br><br>
                <center>
                    <table style="  margin-bottom:50px;margin-top:60px">
                    <tr>
                        <th id="dash" style="border:4px solid black;  float:right ;border-radius:30px">
                        <label for="intervenant">KPI</label>
                        <input type='radio'name='profil' id="intervenant" value='intervenant' class='invisible-radio'>
                        <br> 
                        nombre kpi
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;  float:right ;border-radius:30px">
                        <label for="partenaire">kpi</label>
                        <input type='radio'name='profil' id="partenaire" value='partenaire' class='invisible-radio'>
                        <br> 
                        nombre kpi
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
                    <form action="{{ url ('/contributeurs.index') }}" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="Nom Cagnotte">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="Nrb Contributions">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchmail" id="mail"
                                            placeholder="Nrb Contributeur">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchmail" id="mail"
                                            placeholder="Createur">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchtel" id="tel"
                                            placeholder="Date">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('contributions.index') }}">Reset</a></button>
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
                {{-- a checker pour $totalCount --}}
                <p> Il y'a : {{$totalCagnottes}} Cagnottes
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


        <form method="post" id='clientsForm'>
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
                        <!-- <th>N°</th> -->
                        <th>ID</th>
                        <th>@sortablelink('Nom Cagnotte')</th>
                        <th>@sortablelink('Type')</th>
                        <th>@sortablelink('Montant Cible')</th>
                        <th>@sortablelink('Début')</th>
                        <th>@sortablelink('Fin')</th>
                        <th>@sortablelink('Montant')</th>
                        <th>@sortablelink('Nbr Contributeur')</th>
                        <th>@sortablelink('Nbr Contribution')</th>
                        <th>@sortablelink('Créateur')</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>

                    @foreach ($cagnottes as $cagnotte)
                    <tr>
                        <th scope="row"><input type="checkbox" name="ids[]" class="selectbox"
                                    value="{{$cagnotte->id_cagnotte}}"></th>
                            <td> <a href="#"target="_blank">{{$cagnotte->id_cagnotte}}</a></td>

                            <td>{{$cagnotte->titre}}</td>
                            <td>{{ $cagnotte->projet->types_Projet->valeur }}</td>
                            <td>{{$cagnotte->projet->objectif_financier}}</td>
                            <td>{{ date('Y-m-d', strtotime($cagnotte->projet->date_creation)) }}</td>
                            @if (!empty($cagnotte->projet->date_fin) && $cagnotte->projet->date_fin != '0000-00-00')
                                <td>{{ date('Y-m-d', strtotime($cagnotte->projet->date_fin)) }}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$cagnotte->montant_actuel}}</td>
                            <td>{{ $cagnotte->contributions->pluck('id_contact')->unique()->count() }}</td>
                            <td>{{ $cagnotte->contributions->count() }}</td>
                            <td>
                                @if($cagnotte->contacts->first())
                                    {{ $cagnotte->contacts->first()->nom }} {{ $cagnotte->contacts->first()->prenom }}
                                @else
                                    Aucun contact disponible
                                @endif
                            </td>

                            <td>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="{{ route('cagnottes.show', ['id_cagnotte' => $cagnotte->id_cagnotte]) }}"><i style="color : #4d94ff"
                                        class="fas fa-info"></i></a>
                                    <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="#"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                <button formaction="#"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                            </td>
                    </tr>
                    @endforeach

            </table>

        </form>

  

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
        #dash{
    padding:1rem;
    font-size:0.9rem;
    table-layout: fixed;
    width:120px;
    text-align:center;
    color:#101;
    border:100px;


}
    </style>
<script>
    function confirmAndSubmit(event) {
        event.preventDefault(); // Empêche le formulaire de se soumettre normalement

        var checkboxes = document.querySelectorAll('input[name="clients[]"]:checked');
        var ids = [];

        for (var i = 0; i < checkboxes.length; i++) {
          ids.push(checkboxes[i].value);
        }

        if (ids.length > 0) {
          var form = event.target.closest('form');
          form.setAttribute('action', '{{ route("clients.deleteselect") }}');
          form.submit(); // Soumettre le formulaire avec la nouvelle action
        } else {
          console.log('Aucun client sélectionné.');
        }
      }

      var deleteButton = document.querySelector('#clientsForm button[type="submit"]');
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
  
      window.location.href = "{{ route('clients.index') }}" + (queryString ? '?' + queryString : '');
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
@endsection
