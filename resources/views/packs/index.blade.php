@extends('layouts.navadmin')
@section('content')

<head>
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
                <th><b style="font-size:3rem;color:#333333">Packs</b></th>
                <th><b style="font-size:1.5rem;color:#333333">Total : {{$totalPack}}</b></th>
              </tr><br><br>
              <table style="  margin-bottom:50px;">
              <tr>
            <th id="dash" style="color:#333333;border:4px solid #333333; float:right;border-radius:30px">
                <label for="statut-actif">Actif</label>
                <input type="radio" name="statut" id="statut-actif" value="actif" class="invisible-radio">
                <br>
                {{$count_actif}}
              </th>
              <th><pre>   </pre></th>
              <th id="dash" style="color:#333333;border:4px solid #333333; float:right;border-radius:30px">
                <label for="statut-inactif">Inactif</label>
                <input type="radio" name="statut" id="statut-inactif" value="inactif" class="invisible-radio">
                <br>
                {{$count_inactif}}
              </th>
              <th><pre>   </pre></th>
              <th id="dash" style="color:#333333;border:4px solid #333333; float:right;border-radius:30px">
                <label for="statut-archivé">Archivé</label>
                <input type="radio" name="statut" id="statut-archivé" value="archivé" class="invisible-radio">
                <br>
                {{$count_archive}}
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
                    <form action="{{ route('packs.index') }}" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="ID ">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchmail" id="name"
                                            placeholder="Nom Pack">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchtel" id="prix"
                                            placeholder="Prix">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchtel" id="prix"
                                            placeholder="Prix">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchstat" class="form-control" >
                                            <option disabled selected>Statut </option>
                                            @foreach($liste_statut as $statut)
                                            <option>{{$statut->statut}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('packs.index') }}">Reset</a></button>
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
                        <p> Il y'a : {{ $totalPack }} Packs
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

        <form method="post" id="packsForm">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="{{ route('packs.create') }}" style="margin-bottom : 14px "> Ajouter</a>
            <a class="btn btn-primary" href="{{route('packs.saveallprices')}}"style="margin-bottom : 14px "> Enregistrer</a> 
            <br>


            <table class="table" style="text-align:center">
                <thead class="thead" style="background:#cccccc">
                    <tr style=" white-space: nowrap;">
                        
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th scope="col">ID</th>
                        <th scope="col">@sortablelink('Nom')</th>
                        <th scope="col">@sortablelink('Prix')</th>
                        <th scope="col">@sortablelink('Abstract')</th>
                        <th scope="col">@sortablelink('Date de creation')</th>
                        <th scope="col">@sortablelink('Statut')</th>
                        <th scope="col">@sortablelink('Stripe')</th>
                        <th style="width:190px">Action</th>
                        <th></th>
                    </tr>
                </thead>
                @php
                    /*
                        <tr>
                    <td>
                        <a href=""target="_blank">ID Produit</a>
                    </td>
                    <td>Nom Produit</td>
                    <td>Abstract</td>
                    <td>Prix</td>
                    <td>Categorie</td>
                    <td>Date Creation}}</td>
                    <td>Statut</td>


                    <!--<td>{/{ \Str::limit($value->id_stripe, 45) }}</td>
                    {/{ \Str::limit($value->experimentateur, 45) }}</td>-->



                    <td>
                        
                        <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="{{ route('packs.show') }}"><i style="color : #4d94ff"
                                        class="fas fa-info"></i></a>
                        <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="{{ route('packs.edit') }}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                        <button formaction="{{ route('packs.destroy') }}"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                    </td>
                </tr>
                    */
                @endphp
                
                
                @foreach ($data as $key => $value)
                    <tr >
                        <td scope="row">
                            <input type="checkbox" name="packs[]" id="checks" class="selectbox" value="{{$value->id_pack}}">
                        </td>
                        <td>
                            <a href="{{ \Str::limit($value->id_pack)}}"target="_blank">{{ $value->id_pack }}</a>
                        </td>
                        <td>{{ $value->nom }}</td>
                        <td>{{ $value->prix}} €</td>
                        <td>{{ $value->abstract }}</td>
                        <td>{{ Carbon\Carbon::parse($value->date_creation )->format('Y m d H:i')}}</td>
                        <td>{{ $value->statut }}</td>
                        <td>
                            @if (!empty($value->url_stripe_pack))
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                href="{{ $value->url_stripe_pack }}"><img src="{{ asset('img/stripe.png') }}" style="width:1em;height:1em;" ></a>
                                @endif
                        </td>


                        <!--<td>{/{ \Str::limit($value->id_stripe, 45) }}</td>
                        {/{ \Str::limit($value->experimentateur, 45) }}</td>-->



                        <td>
                            
                            <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                        href="{{route('packs.show',['id_pack'=>$value->id_pack])}}"><i style="color : #4d94ff"
                                            class="fas fa-info"></i></a>
                            <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                        href="/packs.edit/{{ $value->id_pack }}"><i style="color : #e6ac00"
                                            class="fas fa-edit"></i></a>
                            <button formaction="{{ route('packs.destroy', $value->id_pack) }}"
                                        style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete ?')"><i
                                            style="color : #cc3300" class="fas fa-trash"></i></button>
                        </td>
                       
                    </tr>
                @endforeach
            

            </table>
        </form>
        {!! $data->appends(request()->query())->links() !!}

    </div>
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

        function confirmAndSubmit(event) {
            event.preventDefault();
        
            var checkboxes = document.querySelectorAll('input[name="packs[]"]:checked');
            var ids = [];
        
            for (var i = 0; i < checkboxes.length; i++) {
              ids.push(checkboxes[i].value);
            }
        
            if (ids.length > 0) {
              var form = event.target.closest('form');
              form.setAttribute('action', '{{ route("packs.deleteselect") }}'); 
              form.submit(); // Soumettre le formulaire avec la nouvelle action
            } else {
              console.log('Aucun client sélectionné.');
            }
          }
        
          var deleteButton = document.querySelector('#packsForm button[type="submit"]');
          deleteButton.addEventListener('click', confirmAndSubmit);
    
    </script>

      
      <script>
        // Écouteurs d'événements pour les changements d'état des boutons radio
        var statutRadios = document.querySelectorAll('input[name="statut"]');
        var periodeRadios = document.querySelectorAll('input[name="periode"]');
      
        for (var i = 0; i < statutRadios.length; i++) {
          statutRadios[i].addEventListener('change', updateSelection);
        }
      
        for (var i = 0; i < periodeRadios.length; i++) {
          periodeRadios[i].addEventListener('change', updateSelection);
        }
      
        // Fonction de mise à jour de la sélection
        function updateSelection() {
          var statutSelectionne = document.querySelector('input[name="statut"]:checked');
          var periodeSelectionnee = document.querySelector('input[name="periode"]:checked');
      
          // Réinitialiser la couleur de fond de tous les labels
          var labels = document.querySelectorAll('label');
          labels.forEach(function(label) {
            label.style.backgroundColor = 'white'; // Remplacez 'white' par la couleur de fond initiale
          });
      
          // Changer la couleur de fond du label correspondant au statut sélectionné
          if (statutSelectionne) {
            var labelStatut = document.querySelector('label[for="' + statutSelectionne.id + '"]');
            labelStatut.style.backgroundColor = 'green'; // Remplacez 'green' par la couleur souhaitée
          }
      
          // Changer la couleur de fond du label correspondant à la période sélectionnée
          if (periodeSelectionnee) {
            var labelPeriode = document.querySelector('label[for="' + periodeSelectionnee.id + '"]');
            labelPeriode.style.backgroundColor = 'green'; // Remplacez 'green' par la couleur souhaitée
          }
      
          // Rediriger vers la page avec la période et le statut sélectionnés en utilisant les paramètres d'URL
          var params = new URLSearchParams();
          if (periodeSelectionnee) {
            params.set('periode', periodeSelectionnee.value);
          }
          if (statutSelectionne) {
            params.set('statut', statutSelectionne.value);
          }
          var queryString = params.toString();
      
          window.location.href = "{{ route('packs.index') }}" + (queryString ? '?' + queryString : '');
        }
      
        // Récupérer les paramètres d'URL lors du chargement de la page
        window.addEventListener('load', function() {
          var urlParams = new URLSearchParams(window.location.search);
          var periodeParam = urlParams.get('periode');
          var statutParam = urlParams.get('statut');
      
          // Rétablir la sélection par défaut en utilisant les paramètres d'URL
          if (periodeParam) {
            document.querySelector('input[name="periode"][value="' + periodeParam + '"]').checked = true;
            document.querySelector('label[for="periode_' + periodeParam + '"]').style.backgroundColor = 'green'; // Remplacez 'green' par la couleur souhaitée
          }
      
          if (statutParam) {
            document.querySelector('input[name="statut"][value="' + statutParam + '"]').checked = true;
            document.querySelector('label[for="statut_' + statutParam + '"]').style.backgroundColor = 'green'; // Remplacez 'green' par la couleur souhaitée
          }
        });
      </script>
      
      
      
    
    <style>
    .invisible-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    label{
        cursor:pointer;
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
#M56{
background-color: #747474;
}
#dash{
    padding:1rem;
    font-size:0.9rem;
    table-layout: fixed;
    width:90px;
    text-align:center;
    color:#101;
    border:100px;
   
    
}
</style>
@endsection

