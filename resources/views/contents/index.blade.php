@extends('layouts.navadmin')
@section('content')
    <div class="row">
        <div class="col-lg-12" style="margin-bottom : 30px">
            <div class="pull-left">
            <center> <tr>
                <th><b style="font-size:1.5rem;color:#333333;">Liste </b></th>
                <th><b style="font-size:3rem;color:#333333">Contents Expérience</b></th>
                <th><b style="font-size:1.5rem;color:#333333">Total : {{ $totalContent }}</b></th>
              </tr><br><br>
            </div>
            <center><table style="  margin-bottom:50px;margin-top:60px">
                    <tr>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">Demandées<br> 2
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">Demandées<br> 2
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">Demandées<br> 2
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">Demandées<br> 2
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">Demandées<br> 2
                        </th>
                        <th><pre>   </pre></th>
                        <th id="dash" style="border:4px solid black;width:100px;float:right;padding:0.5rem;border-radius:30px">Demandées<br> 2
                        </th>
                        <th><pre>   </pre></th>
                        
                  
                  <th style="padding: 0 0.5rem 0  3rem ;">Semaine<br>Mois<br>Trimestre<br>Année</th>
      
                    </tr>
                </table>
            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container" style="margin-left : 0">
                <h6>Recherche multicritère</h6>
                    <form action="{{ route('contents.index') }}" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="ID ">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchmail" id="name"
                                            placeholder="Nom ">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchmail" id="name"
                                            placeholder="Nom ">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchstat" class="form-control" >
                                            <option disabled selected>Statut </option>
                                            @foreach($liste_type as $type)
                                            <option>{{$type->type}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearnb_chanson" id="nb_chanson" placeholder=" Histoire">
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('contents.index') }}">Reset</a></button>
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
                <p> Il y'a : {{ $totalContent }} Contenus
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

        <form method="post" id="contentsForm">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="{{ route('contents.create') }}" style="margin-bottom : 14px "> Ajouter</a>
            <br>


            <table class="table" style="text-align:center">
                <thead class="thead" style="background:#cccccc">
                    <tr style="white-space: nowrap;">
                        
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th scope="col">ID</th>
                        <th scope="col" style="width:125px">@sortablelink('Contact')</th>
                        <th scope="col">@sortablelink('Type Content')</th>
                        <th scope="col">@sortablelink('Description')</th>
                        <th scope="col">@sortablelink('Url Content')</th>
                        <th scope="col">@sortablelink('ID_Exp')</th>
                        <th width="170px">Action</th>
                        <th></th>
                    </tr>
                </thead>
               
                @foreach ($liste as $key => $value)
                <tr>
                    <td>
                        <input type="checkbox" name="contents[]" id="checks" class="selectbox" value="{{$value->id_content_experience}}">
                    </td>
                    <td>
                        <a href="{{ \Str::limit($value->id_content_experience)}}"target="_blank">{{ $value->id_content_experience }}</a>
                    </td>
                    <td>{{ $value->prenom }}{{ strtoupper($value->nom) }}</td>
                    <!-- <td>{{-- \Str::limit($value->contact) --}}</td> -->
                    <td>{{ $value->type }}</td>
                    <td>{{ $value->description_ }}</td>
                    <td>{{ $value->url_experience_folder }}</td>
                    <td>{{ $value->id_experience }}</td>
                    




                    <td>
                       
                        <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="contents.show/{{$value->id_content_experience}}"><i style="color : #4d94ff"
                                        class="fas fa-info"></i></a>
                        <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href=""><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                        <button formaction=""
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                    </td>
                   
                </tr>
                @endforeach
            </table>
        </form>

            {!! $liste->appends(request()->query())->links() !!}    
        
       
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
    
        var checkboxes = document.querySelectorAll('input[name="contents[]"]:checked');
        var ids = [];
    
        for (var i = 0; i < checkboxes.length; i++) {
          ids.push(checkboxes[i].value);
        }
    
        if (ids.length > 0) {
          var form = event.target.closest('form');
          form.setAttribute('action', '{{ route("contents.deleteselect") }}'); 
          form.submit(); // Soumettre le formulaire avec la nouvelle action
        } else {
          console.log('Aucun client sélectionné.');
        }
      }
    
      var deleteButton = document.querySelector('#contentsForm button[type="submit"]');
      deleteButton.addEventListener('click', confirmAndSubmit);
        </script>
    </div>
    <style>
        #pageSubmenu10{
        visibility:visible;
        display:block;
        }
        #pageSubmenu15{
        visibility:visible;
        display:block;
        }
        #pageSubmenu18{
            visibility:visible;
            display:block;
        }
        #M96{
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
    </style>
@endsection

