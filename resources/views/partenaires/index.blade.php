@extends('layouts.navadmin')

@section('content')
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
<title>Partenaires</title>
    <div class="row">
        <div class="col-lg-12" style="margin-bottom : 40px">
            <div class="pull-left">
            <center> <tr>
                <th><b style="font-size:1.5rem;color:#333333;">Liste </b></th>
                <th><b style="font-size:3rem;color:#333333">Partenaires</b></th>
                <th><b style="font-size:1.5rem;color:#333333">Total : {{ $totalPartenaire }}</b></th>
              </tr><br><br>
            </div>
            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container" style="margin-left : 0">
                    <h6>Recherche multicritère</h6>
                    <form action="{{ route('partenaires.index') }}" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="Nom">
                                    </div>
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
                                        <select data-trigger="" name="multisearchtype" class="form-control">
                                            <option disabled selected>Statut </option>
                                            @foreach($liste_type as $type)
                                            <option>{{$type->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('partenaires.index') }}">Reset</a></button>
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
                <p> Il y'a : {{ $totalPartenaire }} partenaires
                </p>
            </div>
        </div>
    </div>
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}
    <div class="table">

        <form method="post" id="partenairesForm">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="/partenaires.create" style="margin-bottom : 14px "> Ajouter</a>
            <br>


            <table class="table"  style="text-align:center">
                <thead class="thead" style="background:#cccccc">
                    <tr style=" white-space: nowrap;">
                       
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th>ID</th>
                        <th>@sortablelink('prenom Nom')</th>
                        <th>@sortablelink('Spécialité')</th>
                        <th>@sortablelink('tel')</th>
                        <th>@sortablelink('email')</th>
                        <th>@sortablelink('adresse')</th>
                        <!-- <th>@sortablelink('id_contact')</th> -->
                        <th>@sortablelink('date de creation')</th>
                        <th>@sortablelink('type')</th>                      
                        <th>Action</th>
                    </tr>
                </thead>
                
                    @foreach ($data as $key => $value)
                        <tr>
                            @php
                            if (is_null($value->partenaire_date_creation)) 
                            {
                                $date="";
                            }
                            else {
                                $date=$value->partenaire_date_creation;
                                $date = Carbon\Carbon::parse($date)->format('Y m d H:i:s');
                            }
                            @endphp
                              <td scope="row">
                                <input type="checkbox" name="partenaires[]" id="checks" class="selectbox" value="{{$value->id_partenaire}}">
                            </td>
                            <td>{{ $value->id_partenaire }}</td>
                            <td>{{$value->prenom}} {{ strtoupper($value->nom)}}</td>
                            <td>{{ $value->fonction }}</td>
                            <td>{{ $value->tel }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->adresse }}</td>
                            <!-- <td>{{ $value->id_contact }}</td>   -->
                            <td>{{ $date }}</td>
                          <td>{{ $value->type }}</td>
                          
                           
                            <td>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="/partenaires.show/{{$value->id_partenaire}}"><i style="color : #4d94ff"
                                        class="fas fa-info"></i></a>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="{{ route('partenaires.edit', $value->id_partenaire) }}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                <button formaction="{{ route('partenaires.destroy', $value->id_partenaire) }}"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    <!-- -------------------- yasser : n''est plus utile car tri fait sur id ------------------------------ -->
                        <!-- @php
                            $sortedData = $data->sortByDesc(function ($item) use ($con_notif) {
                                return $con_notif->firstWhere('id_contact', $item->id_contact)->date_creation ?? '';
                            });
                        @endphp
                        @foreach ($sortedData as $key => $value)
                            @php
                                $date = $con_notif->firstWhere('id_contact', $value->id_contact)->date_creation ?? '';
                            @endphp
                                <tr>
                                    @php
                                    if (is_null($con_notif->firstWhere('id_contact',$value->id_contact))) 
                                    {
                                        $date="$\con_notif is null";
                                    }
                                    else {
                                        $date=$con_notif->firstWhere('id_contact',$value->id_contact)->date_creation;
                                    }
                                    @endphp
                                <td>{{ $value->id_partenaire }}</td>
                                    <td>{{$value->nom}}</td>
                                    <td>
                                        {{$value->prenom}}
                                    </td>
                                    <td>{{ $value->tel }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->adresse }}</td>
                                    <td>{{ $value->id_contact }}</td>  
                                    <td>{{ $date }}</td>
                                <td>{{ $value->type }}</td>
                                <td>{{ $value->fonction }}</td>
                                
                                    <td>
                                        <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                            href="/partenaires.show/{{$value->id_partenaire}}"><i style="color : #4d94ff"
                                                class="fas fa-info"></i></a>
                                        <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                            href="{{ route('partenaires.edit', $value->id_partenaire) }}"><i style="color : #e6ac00"
                                                class="fas fa-edit"></i></a>
                                        <button formaction="{{ route('partenaires.destroy', $value->id_partenaire) }}"
                                            style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete ?')"><i
                                                style="color : #cc3300" class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                        @endforeach -->
                    <!-- -------------------- yasser fin ------------------------------ -->        
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
            function confirmAndSubmit(event) {
        event.preventDefault();
    
        var checkboxes = document.querySelectorAll('input[name="partenaires[]"]:checked');
        var ids = [];
    
        for (var i = 0; i < checkboxes.length; i++) {
          ids.push(checkboxes[i].value);
        }
    
        if (ids.length > 0) {
          var form = event.target.closest('form');
          form.setAttribute('action', '{{ route("partenaires.deleteselect") }}'); 
          form.submit(); // Soumettre le formulaire avec la nouvelle action
        } else {
          console.log('Aucun client sélectionné.');
        }
      }
    
      var deleteButton = document.querySelector('#partenairesForm button[type="submit"]');
      deleteButton.addEventListener('click', confirmAndSubmit);


        </script>
    </div>
    <style>
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
        #M93{
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