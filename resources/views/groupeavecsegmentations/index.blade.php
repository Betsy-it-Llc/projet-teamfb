@extends('layouts.navadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des groupes avec segmentations</h2>
            </div>

            <!-- Recherche multicritère -->
    <section class="search-sec" style="margin : 20px ; font-size : 13px">
    <div class="container" style="margin-left : 0">
    <h6>Recherche multicritère</h6>
        <form action="{{ route('multisearch_g_a_segmentation') }}" method="get" novalidate="novalidate">
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
                            <button type="button" class="btn btn-danger wrn-btn"><a href="{{ route('groupeavecsegmentations') }}">Reset</a></button>
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

            <div class="pull-right" style="margin-bottom : 10px">
            <br>
                <a class="btn btn-success" href="{{ route('groupeavecsegmentations.create') }}"> Ajouter</a>
                <a class="btn btn-info" href="{{ route('groupes.index') }}"> Retour</a>
            </div>
          <p> Il y'a : {{ $groupeavecsegmentations->total() }} Groupes</p>

        </div>
    </div>
   <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table">
        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID</th>
                <th scope="col">@sortablelink('nom')</th>
                <th scope="col">@sortablelink('type')</th>
                <th scope="col">@sortablelink('statut_integration')</th>
                <th scope="col">@sortablelink('nb_membres')</th>
                <th scope="col">@sortablelink('tag_recherche')</th>
                <th scope="col">Prénom</th>
                <th width="150px"></th>
            </tr>
            </thead>
            @if($groupeavecsegmentations->count())
            @foreach ($groupeavecsegmentations as $key => $value)
            <tr>
                <th  scope="row">{{++$i}}</th>
                <td><a style="color : blue" href="{{ $value->id_groupe }}"target="_blank">URL</a></td>
                <td>{{ $value->nom }}</td>
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

                <td>{{ $value->prenom }}</td>
                <td>
                    <form action="{{ route('groupeavecsegmentations.destroy',$value->id) }}" method="POST">
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('groupes.show',$value->id) }}"><i style="color : black" class="fas fa-info"></i></a>
   <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="{{ route('groupes.edit', $value->id) }}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>                        @csrf
                        @method('DELETE')

                        <button  style="background-color : #fafafa ; border : #fafafa"  type="submit" class="btn btn-danger"><i style="color : black"   class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif

        </table>
        {!! $groupeavecsegmentations->appends(request()->query())->links() !!}

    </div>
    <style>
#pageSubmenu{
visibility:visible;
display:block;
}
#pageSubmenu19{
    visibility:visible;
    display:block;
}
</style>
    @endsection
