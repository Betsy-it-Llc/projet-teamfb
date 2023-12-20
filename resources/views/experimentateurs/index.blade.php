@extends('layouts.navadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12" style="margin-bottom : 40px">
            <div class="pull-left">
            <center> <tr>
                <th><b style="font-size:1.5rem;color:#333333;">Liste </b></th>
                <th><b style="font-size:3rem;color:#333333">Expérimentateurs</b></th>
                <th><b style="font-size:1.5rem;color:#333333">Total : {{ $totalExprmt }}</b></th>
              </tr><br><br>
            </div>
            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container" style="margin-left : 0">
                    <h6>Recherche multicritère</h6>
                    <form action="{{ url ('/experimentateurs.index') }}" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="Nom">
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
                                        <input class="form-control" type="text" name="multisearchtel" id="tel"
                                            placeholder="Tel">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchstat" class="form-control">
                                            <option disabled selected>Statut </option>
                                            @foreach($liste_personna as $personna)
                                                <option>{{$personna->personna}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('experimentateurs.index') }}">Reset</a></button>
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
                <p> Il y'a : {{ $totalExprmt }} experimentateurs
                </p>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    </div>
    
    <div class="table">

        <form method="post" id="experimentateursForm">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="{{ route('experimentateurs.create') }}" style="margin-bottom : 14px "> Ajouter</a>
            <br>


            <table class="table"  style="text-align:center">
                <thead class="thead" style="background:#cccccc">
                    <tr style="white-space: nowrap;">
                       
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th>ID</th>
                        <th>@sortablelink('nom prenom')</th>
                        <!-- <th>@sortablelink('prenom')</th> -->
                        <th>@sortablelink('Num Exp')</th>
                        <th>@sortablelink('tel')</th>
                        <th>@sortablelink('email')</th>
                        <th>@sortablelink('adresse')</th>
                        <!-- <th>@sortablelink('Id Exp')</th> -->
                        <th>@sortablelink('Date de creation')</th>
                        <th>@sortablelink('Personna')</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <!-- @foreach ($data as $key => $value)
                        <tr>
                        @php
                            if (is_null($con_notif->firstWhere('id_contact',$value->id_contact))) 
                            {
                                $date="";
                            }
                            else {
                                $date=$con_notif->firstWhere('id_contact',$value->id_contact)->date_creation;
                            }
                        @endphp -->
                         <!-- <td>{{ $value->id_contact }}</td>
                            <td>{{$value->nom}}</td>
                            <td>
                                {{$value->prenom}}
                            </td>
                            <td>{{ $value->tel }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->adresse }}</td>
                            <td>{{ $value->id_experience }}</td>
                          <td>{{ $value->numero_experience}}</td>
                          <td>{{ $value->personna}}</td>  
                            <td>{{ $date }}</td>
                           
                            <td>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="/experimentateurs.show/{{$value->id_contact}}"><i style="color : #4d94ff"
                                        class="fas fa-info"></i></a>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="{{ route('experimentateurs.edit', $value->id_contact) }}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                <button formaction="{{ route('experimentateurs.destroy', ['id_contact'=>$value->id_contact,'id_experience'=>$value->id_experience]) }}"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach -->
<!-- ------------------------------------------------ yassser ------------------------------------------------------------  -->
                <!-- pour trier dans l'ordre decroissant de la date de creation !  -->
                <tbody>
                        @foreach ($data->sortByDesc(function($value) use ($con_notif) {
                            if (is_null($con_notif->firstWhere('id_contact',$value->id_contact))) {
                                return "";
                            } else {
                                return $con_notif->firstWhere('id_contact',$value->id_contact)->date_creation;
                            }
                        }) as $key => $value)
                            <tr>
                                @php
                                    if (is_null($con_notif->firstWhere('id_contact',$value->id_contact))) {
                                        $date="";
                                    } else {
                                        $date=$con_notif->firstWhere('id_contact',$value->id_contact)->date_creation;
                                    }
                                @endphp
                                 <td scope="row">
                                    <input type="checkbox" name="experimentateurs[]" id="checks" class="selectbox" value="{{$value->id_contact}}">
                                </td>
                                <td>{{ $value->id_contact }}</td>
                                <td>{{ $value->prenom }} {{ strtoupper($value->nom) }} </td>
                                <!-- <td>{{ $value->prenom }}</td> -->
                                <td>{{ $value->numero_experience }}</td>
                                <td>{{ $value->tel }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->adresse }}, {{ $value->code_postal }} </td>
                                <!-- <td>{{ $value->id_experience }}</td> -->
                                <td>{{ \Carbon\Carbon::parse($date)->format('Y m d') }}</td>
                                <td>{{ $value->personna }}</td>  

                                
                                

                                <td>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="/experimentateurs.show/{{$value->id_contact}}"><i style="color : #4d94ff"
                                        class="fas fa-info"></i></a>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="{{ route('experimentateurs.edit', $value->id_contact) }}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                <button formaction="{{ route('experimentateurs.destroy', ['id_contact'=>$value->id_contact,'id_experience'=>$value->id_experience]) }}"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                            </td>
                           
                            </tr>
                        @endforeach
                    </tbody>
            </table>


        </form>
            {!! $data->appends(request()->query())->links() !!}

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
        #M95{
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
    <script>

        function confirmAndSubmit(event) {
            event.preventDefault(); // Empêche le formulaire de se soumettre normalement
        
            var checkboxes = document.querySelectorAll('input[name="experimentateurs[]"]:checked');
            var ids = [];
        
            for (var i = 0; i < checkboxes.length; i++) {
              ids.push(checkboxes[i].value);
            }
        
            if (ids.length > 0) {
              var form = event.target.closest('form');
              form.setAttribute('action', '{{ route("experimentateurs.deleteselect") }}'); 
              form.submit(); // Soumettre le formulaire avec la nouvelle action
            } else {
              console.log('Aucun client sélectionné.');
            }
          }
        
          var deleteButton = document.querySelector('#experimentateursForm button[type="submit"]');
          deleteButton.addEventListener('click', confirmAndSubmit);
        </script>
@endsection