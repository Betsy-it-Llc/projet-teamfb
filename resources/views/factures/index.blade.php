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
                <th><b style="font-size:3rem;color:#333333">Facture</b></th>
                <th><b style="font-size:1.5rem;color:#333333">Total : {{ $totalFac }}</b></th>
              </tr><br><br>
                <center><table style="  margin-bottom:50px;margin-top:60px">
                    <tr>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">
                            <label for="demandé"> Demandé</label>        
                            <input type="radio" name="statut" id="demandé" value="demandé" class="invisible-radio">                    <br>
                            <?php
                            $nb = count(DB::connection('mysql2')->table('factures')
    ->join('facture_statut_notification', 'factures.num_facture', '=', 'facture_statut_notification.num_facture')
    ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
    ->where('facture_statut.id_facture_statut', 1)
    ->where('facture_statut_notification.id_notification', function ($query) {
        $query->select(DB::raw('MAX(id_notification)'))
            ->from('facture_statut_notification')
            ->whereRaw('factures.num_facture = facture_statut_notification.num_facture');
    })
    ->get()
    );
    echo $nb;
                            ?>
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">
                            <label for="envoyé"> Envoyé </label>
                            <input type="radio" name="statut" id="envoyé" value="envoyé" class="invisible-radio">
                            <br> 
                            <?php
                            $nb = count(DB::connection('mysql2')->table('notification')
    ->where('type', 'facture')
    ->where('contenu_notification', 'LIKE', '%envoyé%')
    ->get());
    echo $nb;
                            ?>
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">
                            <label for="non_payé"> Non payé</label>
                            <input type="radio" name="statut" id="non_payé" value="non_payé" class="invisible-radio">
                            <br> 
                            <?php
                            $nb = count(DB::connection('mysql2')->table('factures')
    ->join('facture_statut_notification', 'factures.num_facture', '=', 'facture_statut_notification.num_facture')
    ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
    ->where('facture_statut.id_facture_statut', 3)
    ->where('facture_statut_notification.id_notification', function ($query) {
        $query->select(DB::raw('MAX(id_notification)'))
            ->from('facture_statut_notification')
            ->whereRaw('factures.num_facture = facture_statut_notification.num_facture');
                })->get()
    );
    echo $nb;     
                           ?>
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">
                            <label for="partiellement_payé"> Partiellement payé </label>
                            <input type="radio" name="statut" id="partiellement_payé" value="partiellement_payé" class="invisible-radio">
                            <br> 
                            <?php
                            $nb = count(DB::connection('mysql2')->table('factures')
    ->join('facture_statut_notification', 'factures.num_facture', '=', 'facture_statut_notification.num_facture')
    ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
    ->where('facture_statut.id_facture_statut', 5)
    ->where('facture_statut_notification.id_notification', function ($query) {
        $query->select(DB::raw('MAX(id_notification)'))
            ->from('facture_statut_notification')
            ->whereRaw('factures.num_facture = facture_statut_notification.num_facture');
    })
    ->get()
    );
    echo $nb;
                            ?>
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">
                            <label for="payé"> Payé </label>
                            <input type="radio" name="statut" id="payé" value="payé" class="invisible-radio">
                            <br> 
                            <?php
                            $nb = count(DB::connection('mysql2')->table('factures')
    ->join('facture_statut_notification', 'factures.num_facture', '=', 'facture_statut_notification.num_facture')
    ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
    ->where('facture_statut.id_facture_statut', 6)
    ->where('facture_statut_notification.id_notification', function ($query) {
        $query->select(DB::raw('MAX(id_notification)'))
            ->from('facture_statut_notification')
            ->whereRaw('factures.num_facture = facture_statut_notification.num_facture');
    })
    ->get()
    );
    echo $nb;
                            ?>
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">
                            <label for="annulé"> Annulé </label>
                            <input type="radio" name="statut" id="annulé" value="annulé" class="invisible-radio">
                            <br> 
                            <?php
                            $nb = count(DB::connection('mysql2')->table('factures')
    ->join('facture_statut_notification', 'factures.num_facture', '=', 'facture_statut_notification.num_facture')
    ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
    ->where('facture_statut.id_facture_statut', 9)
    ->where('facture_statut_notification.id_notification', function ($query) {
        $query->select(DB::raw('MAX(id_notification)'))
            ->from('facture_statut_notification')
            ->whereRaw('factures.num_facture = facture_statut_notification.num_facture');
    })
    ->get()
    );
    echo $nb;
                            ?>
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">
                            <label for="remboursé"> Remboursé </label>
                            <input type="radio" name="statut" id="remboursé" value="remboursé" class="invisible-radio">
                            <br> 
                            <?php
                            $nb = count(DB::connection('mysql2')->table('factures')
    ->join('facture_statut_notification', 'factures.num_facture', '=', 'facture_statut_notification.num_facture')
    ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
    ->where('facture_statut.id_facture_statut', 7)
    ->where('facture_statut_notification.id_notification', function ($query) {
        $query->select(DB::raw('MAX(id_notification)'))
            ->from('facture_statut_notification')
            ->whereRaw('factures.num_facture = facture_statut_notification.num_facture');
    })
    ->get()
    );
    echo $nb;
                            ?>
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">
                            <label for="avoir">Avoir</label>
                            <input type="radio" name="statut" id="avoir" value="avoir" class="invisible-radio">
                            <br> 
                            <?php
                            $nb = count(DB::connection('mysql2')->table('factures')
    ->join('facture_statut_notification', 'factures.num_facture', '=', 'facture_statut_notification.num_facture')
    ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
    ->where('facture_statut.id_facture_statut', 8)
    ->where('facture_statut_notification.id_notification', function ($query) {
        $query->select(DB::raw('MAX(id_notification)'))
            ->from('facture_statut_notification')
            ->whereRaw('factures.num_facture = facture_statut_notification.num_facture');
    })
    ->get()
    );
    echo $nb;
                            ?>
                        </th>
                        <th><pre>   </pre></th>
                        
                        
                  
                  <th style="padding: 0 0.5rem 0  3rem ;"><label for="periode-semaine">Semaine</label>
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
            {{-- @dd($data) --}}
            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container" style="margin-left : 0">
                <h6>Recherche multicritère</h6>
                    <form action="{{ route('factures.index') }}" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">

                                    <div id="BTN" >
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="N° Facture">
                                    </div>
                                    <div id="BTN">
                                        <input class="form-control" type="text" name="multisearchmail" id="email"
                                            placeholder="Description">
                                    </div>
                                    <div id="BTN">
                                        <input class="form-control" type="text" name="multisearchtel" id="tel"
                                            placeholder="Nb experimentateur">
                                    </div>
                                    <div id="BTN">
                                        <input class="form-control" type="text" name="multisearnb_chanson" id="nb_chanson" placeholder="Nb chanson">
                                    </div>
                                    <div id="BTN">
                                            <select data-trigger="" name="multisearchstat" class="form-control" >
                                                <option disabled selected>Statut </option>
                                                @foreach($liste_statut_facture as $statut)
                                                    <option>{{ $statut->statut_facture }}</option>
                                                @endforeach
                                            </select>

                                    </div>
                                    <div id="BTN" style="width:300px">
                                        <button type="submit" class="btn btn-success wrn-btn" style="width:80px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn" style="width:80px"><a
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
                            <a class="btn btn-info" href="{/{ route('') }}"> Ajouter</a>
                        </div>
                        <p> Il y'a : <?php
                        /*use Illuminate\Support\Facades\DB;
                        $countt=DB::connection('mysql2')->table('factures')->count();
                        echo ($countt);*/
                        ?> Factures</p>
                    </div>-->
                    <div>
                        <p> Il y'a : {{ $totalFac }} Factures
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

        <form method="post" id="factureForm">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
                    @php
                        $id_contacts = [];
                        $id_autre_prest = [];
                    @endphp
            <a class="btn btn-success" href="{{ route('facture.create') }}" style="margin-bottom : 14px "> Ajouter</a>
            <br>


            <table class="table" style="text-align:center">
                <thead class="thead" style="background:#cccccc">
                    <tr style=" white-space: nowrap;">
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th scope="col">ID</th>
                        <th scope="col">@sortablelink('Prenom Nom')</th>
                        <!-- <th scope="col">@sortablelink('Nom')</th> -->
                        <th scope="col">@sortablelink('Email')</th>
                        <th scope="col">@sortablelink('Tel')</th>
                        <th scope="col">@sortablelink('Créer le')</th>
                        <th scope="col">@sortablelink('Montant')</th>
                        <th scope="col">@sortablelink('Statut')</th>
                        <th scope="col">@sortablelink('Retard')</th>
                        <th scope="col">@sortablelink('nb_pay')</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>

                @foreach ($data as $key => $value)
                <tr>
                    @php
                        $stat_fact = $statut_facture->firstWhere('num_facture',$value->num_facture);
                        
                        $retard = false;
                        if (is_null($date_reservation->firstWhere('num_facture',$value->num_facture))) 
                        {
                            $date="-";
                        }
                        else {
                            $date=$date_reservation->firstWhere('num_facture',$value->num_facture)->date_statut;
                             $date = Carbon\Carbon::parse($date)->format('Y m d H:i:s');
                        }
                        $echeance_fact = $dates_echeance->firstWhere('num_facture',$value->num_facture);
                    @endphp
                      <td scope="row">
                        <input type="checkbox" name="factures[]" id="checks" class="selectbox" value="{{$value->num_facture}}">
                    </td>
                    <td>
                        <a href=""target="_blank">{{ $value->num_facture }}</a>
                    </td>
                    <td>{{ $value->prenom }} {{ strtoupper($value->nom)  }}</td>
                    <!-- <td>{{ $value->nom }}</td> -->
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->tel }}</td>
                    <td> {{ $date }}</td>
                    <td>{{ $value->prix_facture }} €</td>
                    <!-- ----------- statut -------- -->
                    <td>
                        @if($value->statut_facture == 'Payée')
                       <span style="background : #b3ffd9 ; padding : 3px ; border-radius : 6px ">{{$value->statut_facture }}</span>
                       @elseif($value->statut_facture == 'Partiellement payée')
                       <span  style="background : #ffa500 ; padding : 3px ; border-radius : 6px ">{{ $value->statut_facture }}</span>
                       @else
                       <span>{{ $stat_fact->statut_facture }}</span>
                       @endif
                    </td>
                    <!-- ----------- retard -------- -->
                    @if (is_null($echeance_fact))
                        <td>{{ '-' }}</td>
                    @elseif(is_null($echeance_fact->date_echeance))
                        <td>{{ '-' }}</td>
                    @else
                        @php
                        $date_echeance= new DateTime($echeance_fact->date_echeance);
                        $date_courante= New DateTime('now');
                        $date_courante->setTime(0,0,0,0);
                        $timediff = $date_echeance->diff($date_courante,true)->d;
                        if ($date_courante>$date_echeance) {
                            $retard=true;
                        }
                        else {
                            $retard=false;
                        }
                        @endphp
                        <td>
                            @if($retard)
                                @if($retard == true)
                                <span style="background :  #ff9999 ; padding : 3px ; border-radius : 6px ">{{ $timediff }}</span>                
                                @else
                                <span style="background : #b3ffd9 ; padding : 3px ; border-radius : 6px ">{{ $timediff }}</span>                
                                @endif
                            @endif
                        </td>
                    @endif
                    <!-- -----------nbr paiement-------- -->
                    <td>{{ $value->nb_paiement }}</td>
                    <!-- -----------action-------- -->
                    <td>
                        @if (($stat_fact->id_facture_statut==1)||($stat_fact->id_facture_statut==2)||($stat_fact->id_facture_statut==11))
                            <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                            href="{{ route('facture.valider',['num_facture'=>$value->num_facture,'id_facture_statut'=>$stat_fact->id_facture_statut]) }}"
                            onclick="return confirm('Etes-vous sure de vouloir valider la Facture ?')"><i style="color : #4d94ff"
                                class="fas fa-check"></i></a>
                        @else
                            <i style="color : grey" class="fas fa-check fa-lg"></i>
                        @endif
                        @if ((($stat_fact->id_facture_statut>=3)&&($stat_fact->id_facture_statut<=6))||($stat_fact->id_facture_statut==10))
                            <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                href="{{ route('facture.envoyer',['num_facture'=>$value->num_facture,'id_facture_statut'=>$stat_fact->id_facture_statut]) }}"
                                onclick="return confirm('Etes-vous sure de valider l\'envoie de la Facture ?')"><i style="color : #4ddbff"
                                    class="fas fa-paper-plane"></i></a>
                        @else
                            <i style="color : grey" class="fas fa-paper-plane fa-lg"></i>
                        @endif
                        <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                            href="/factures/{{ $value->num_facture }}"><i style="color : #4d94ff"
                                class="fas fa-info"></i></a>
                        <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href=""><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                        <button formaction="{{ route('factures.destroy',['facture'=>$value->num_facture]) }}"
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
    <style>
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
        #M54{
            
        background-color: #747474;
        }
        #dash{
            padding: 0 0 0 0.5rem;
            font-size:0.75rem;
            table-layout: fixed;
            width: 90px;
            text-align:center;
            text-color:#333333;
            
        }
        #BTN{
            padding: 0 0.5rem 0 0;
            width:150px;
        }
        .invisible-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

</style>
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
    event.preventDefault(); // Empêche le formulaire de se soumettre normalement

    var checkboxes = document.querySelectorAll('input[name="factures[]"]:checked');
    var ids = [];

    for (var i = 0; i < checkboxes.length; i++) {
      ids.push(checkboxes[i].value);
    }

    if (ids.length > 0) {
      var form = event.target.closest('form');
      form.setAttribute('action', '{{ route("factures.deleteselect") }}'); 
      form.submit(); // Soumettre le formulaire avec la nouvelle action
    } else {
      console.log('Aucune réservation sélectionnée.');
    }
  }

  var deleteButton = document.querySelector('#factureForm button[type="submit"]');
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
        labelStatut.style.backgroundColor = 'green'; 
        
      }
  
      // Changer la couleur de fond du label correspondant à la période sélectionnée
      if (periodeSelectionnee) {
        var labelPeriode = document.querySelector('label[for="' + periodeSelectionnee.id + '"]');
        labelPeriode.style.backgroundColor = 'green'; 
      }
  
      // Rediriger vers la page avec la période et le statut sélectionnés en utilisant les paramètres d'URL
      var params = new URLSearchParams();
      if (statutSelectionne) {
        params.set('statut', statutSelectionne.value);
      }
      if (periodeSelectionnee) {

        params.set('periode', periodeSelectionnee.value);
      }
      var queryString = params.toString();
  
      window.location.href = "{{ route('factures.index') }}" + (queryString ? '?' + queryString : '');
    }
  
    // Récupérer les paramètres d'URL lors du chargement de la page
    window.addEventListener('load', function() {
      var urlParams = new URLSearchParams(window.location.search);
      var statutParam = urlParams.get('statut');
      var periodeParam = urlParams.get('periode');
  
      // Rétablir la sélection par défaut en utilisant les paramètres d'URL
      if (statutParam) {
        document.querySelector('input[name="statut"][value="' + statutParam + '"]').checked = true;
        document.querySelector('label[for="' + statutParam + '"]').style.backgroundColor = 'green'; // Remplacez 'green' par la couleur souhaitée
      }
  
      if (periodeParam) {
        document.querySelector('input[name="periode"][value="' + periodeParam + '"]').checked = true;
        document.querySelector('label[for="' + periodeParam + '"]').style.backgroundColor = 'green'; // Remplacez 'green' par la couleur souhaitée
      }
    });
</script>
@endsection