@extends('layouts.navadmin')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-bottom : 10px">
            <div class="pull-left">
                <h2>Liste des groupes sans segmentations</h2>
            </div>
    
    <!-- Recherche multicritère -->
    <section class="search-sec" style="margin : 20px ; font-size : 13px">
    <div class="container" style="margin-left : 0">
    <h6>Recherche multicritère</h6>
        <form action="{{ route('multisearch_g_s_segmentation') }}" method="get" novalidate="novalidate">
            <div class="row">
                <div class="col-lg-40">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                            <input class="form-control" type="text" name="multisearchnom" id="nom" placeholder="Nom">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                            <input class="form-control" type="text" name="multisearchlieu" id="lieu" placeholder="Lieu">
                        </div>
                         <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                            <input class="form-control" type="text" name="multisearchtag" id="tag" placeholder="Tag">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchstat" class="form-control" >
                                            <option disabled selected>Statut </option>
                                            <option>Nouveau groupe</option>
                                            <option>Nouveau membre</option>
                                            <option>Hors cible</option>
                                            <option>Adhésion demandée</option>
                                        </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchtype" class="form-control">
                                          <option disabled selected>Type </option>
                                          <option>Privé</option>
                                          <option>Public</option>
                                        </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                            <button type="submit" class="btn btn-success wrn-btn" style="margin-left : 5px">Search</button>
                            <button type="button" class="btn btn-danger wrn-btn"><a href="{{ route('groupesanssegmentations') }}">Reset</a></button>
                        </div>
                   
                    </div>
                </div>
               
                <div style="margin-top : 20px">
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

            <div class="pull-right">
                <br>
                <a class="btn btn-success" href="{{ route('groupesanssegmentations.create') }}"> Ajouter</a>
                <a class="btn btn-info" href="{{ route('segementations') }}"> Retour</a>
            </div>
            <br>
        </div>
    </div>
   <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table">
    <p> Il y'a : {{ $groupesanssegmentations->total() }} Groupes</p>
        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Type</th>
                <th scope="col">Statut d'intégration</th>
                <th scope="col">Nombre de membres</th>
                <th scope="col">Tag Recherche</th>
                <th scope="col">Ambassadeur</th>
                <th width="150px"></th>
            </tr>
            </thead>
            @foreach ($groupesanssegmentations as $key => $value)
            <tr>
                <th  scope="row">{{ ++$i }}</th>
                <td><a style="color : blue" href="{{ $value->id_groupe }}">URL</a></td>
                <td>{{ \Str::limit($value->nom, 20) }}</td>
                <td>
                @if($value->type == 'Privé')
                <span><i class="fa-solid fas fa-lock" style="color : gray ; width : 15px ; height : 15px ; margin-right: 5px"></i>Privé</span>                
                @elseif($value->type == 'Public')
                <span><i class="fa-solid fas fa-lock-open" style="color : gray ; width : 15px ; height : 15px ; margin-right: 5px"></i>Public</span>                
                @endif
                </td>
                <td>
                @if($value->statut_integration == 'nouveau groupe')
                <span style="background :  #ccffff ; font-weight : 500 ; padding : 3px ; border-radius : 6px ">Nouveau groupe</span>                
                @elseif($value->statut_integration == 'Nouveau membre')
                <span style="background : #ffccff ; font-weight : 500 ; padding : 3px ; border-radius : 6px ">Nouveau membre</span>                
                @elseif($value->statut_integration == 'Adhésion demandée')
                <span style="background : #daffb3 ; font-weight : 500 ; padding : 3px ; border-radius : 6px ">Adhésion demandée</span>                
                @elseif($value->statut_integration == 'Hors cible')
                <span style="background : #ffcccc ; font-weight : 500 ; padding : 3px ; border-radius : 6px ">Hors cible</span>                
                @endif
                </td>
                <td>{{ $value->nb_membres }}</td>
                <td>{{ $value->tag_recherche }}</td>
                <td>{{ $value->prenom_amba }} {{ $value->nom_amba }}</td>
                <td>
                    <form action="{{ route('groupesanssegmentations.destroy',$value->id) }}" method="POST">  
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('groupesanssegmentations.show',$value->id) }}"><i style="color : black" class="fas fa-info"></i></a>    
                        <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('groupesanssegmentations.edit',$value->id) }}"><i style="color : black"  class="fas fa-edit"></i></a>   
                        @csrf
                        @method('DELETE')      

                        <button  style="background-color : #fafafa ; border : #fafafa"  type="submit" class="btn btn-danger"><i style="color : black"   class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>  
        {!! $groupesanssegmentations->appends(request()->query())->links() !!}

    </div>
    <style>
#pageSubmenu1{
visibility:visible;
display:block;
}
</style>
    @endsection