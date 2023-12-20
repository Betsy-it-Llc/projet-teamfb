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
        <div class="col-lg-12" style="margin-bottom : 30px">
        <div class="pull-left">
              <center> <tr>
                <th><b style="font-size:1.5rem;color:#333333;">Liste </b></th>
                <th><b style="font-size:3rem;color:#333333">Remise & Promo</b></th>
                <th><b style="font-size:1.5rem;color:#333333">Total : {{$totalRem}}</b></th>
              </tr><br><br>
            </div>
            <div class="col-lg-12" style="margin-bottom : 30px; ">
                <center> 
                <!-- <form action="/remises.index" method="get"> -->
                    @csrf
                    <table style="margin-bottom: 50px; ">
                        <tr style="display: flex; align-items: center;">
                            <form id="statutForm" action="/remises.index" method="get">
                            @csrf
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
                                <!-- -------------------- -->
                            <td style="margin-right:10px">
                                <form id="periodeForm" action="/remises.index" ethod="get">
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
                            <!-- <td>
                                <button class="btn btn-success wrn-btn" type="submit">Valider</button>
                            </td> -->
                        </tr>
                    </table>
                <!-- </form> -->
            </div>
            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container" style="margin-left : 0">
                <h6>Recherche multicritère</h6>
                    <form action="{{ route('remises.index') }}" method="get" novalidate="novalidate">
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
                                        <select data-trigger="" name="multisearchtype" class="form-control" >
                                            <option disabled selected>type </option>
                                            @foreach($liste_type as $type)
                                            <option>{{$type->type_remise}}</option>
                                            @endforeach
                                        </select>
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
                                                href="">Reset</a></button>
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
                        <p> Il y'a : {{ $totalRem }} Remises
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

        <form method="post" id="remisesForm">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="{{ route('remises.create') }}" style="margin-bottom : 14px "> Ajouter</a>
            <a class="btn btn-primary" href="{{route('remises.saveall')}}"style="margin-bottom : 14px "> Enregistrer</a> 
            <br>


            <table class="table" style="text-align:center">
                <thead class="thead" style="background:#cccccc">
                    <tr style=" white-space: nowrap;">
                        
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th scope="col">ID</th>
                        <th scope="col">@sortablelink('Nom')</th>
                        <th scope="col">@sortablelink('Type')</th>
                        <th scope="col">@sortablelink('Taux')</th>
                        <th scope="col">@sortablelink('Montant')</th>
                        <th scope="col">@sortablelink('Date de début')</th>
                        <th scope="col">@sortablelink('Date d\'expiration')</th>  
                        <th scope="col">@sortablelink('Statut')</th>
                        <th style="width:190px">Action</th>
                    </tr>
                </thead>
                {{-- @dd($data); --}}
                
                @foreach ($data as $key => $value)
                <tr>
                    <td scope="row">
                        <input type="checkbox" name="remises[]" id="checks" class="selectbox" value="{{$value->id_remise}}">
                    </td>
                    <td>
                        {{ $value->id_remise }}
                    </td>
                    <td>{{ $value->nom_remise }}</td>
                    <td>{{ $value->type_remise }}</td>
                    <td><?php if($value->taux==null){ echo "0";}else{ echo $value->taux;}?>%</td>
                    <td><?php if($value->montant==null){ echo "0";}else{ echo $value->montant;}?> €</td>
                    <td>{{ Carbon\Carbon::parse($value->date_debut )->format('Y m d')}}</td>
                    <td>{{ Carbon\Carbon::parse($value->date_fin )->format('Y m d')}}</td>
                    <td>{{ $value->statut }}</td>



                    <td>
                        
                        <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="/remises.show/{{$value->id_remise}}"><i style="color : #4d94ff"
                                        class="fas fa-info"></i></a>
                        <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="/remises.edit/{{$value->id_remise}}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                   
                        {{-- <button formaction="{{ route('remises.destroy',['id_remise'=>$value->id_remise]) }}"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button> --}}

                    <button formaction="{{ route('remises.destroy',['id_remise'=>$value->id_remise]) }}"
                        style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete ?')"><i
                            style="color : #cc3300" class="fas fa-trash"></i></button>
                    </td>
                   
                </tr>
                {{-- @dd($value->id_remise) --}}
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
    
        var checkboxes = document.querySelectorAll('input[name="remises[]"]:checked');
        var ids = [];
    
        for (var i = 0; i < checkboxes.length; i++) {
          ids.push(checkboxes[i].value);
        }
    
        if (ids.length > 0) {
          var form = event.target.closest('form');
          form.setAttribute('action', '{{ route("remises.deleteselect") }}'); 
          form.submit(); // Soumettre le formulaire avec la nouvelle action
        } else {
          console.log('Aucun client sélectionné.');
        }
    }
    
    var deleteButton = document.querySelector('#remisesForm button[type="submit"]');
    deleteButton.addEventListener('click', confirmAndSubmit);


</script>
<!--  -->
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
<style>
    .invisible-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
        
    }

</style>




<style>
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
    #M92{
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
@endsection

