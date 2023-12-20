@extends('layouts.navadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des posts partagés</h2>
                <br>
            </div>
<!-- Recherche multicritère -->
<section class="search-sec" style="margin : 20px ; font-size : 13px">
    <div class="container">
        <h6>Recherche multicritère</h6>
        <form action="{{ url('/postpartages') }}" method="get" novalidate="novalidate">
        <div class="row">
                <div class="col-lg-50">
                    <div class="row">
                        <div class="">
                            <input class="form-control" type="text" name="multisearchnom" id="ID" placeholder="ID">
                        </div>
                        <div class="">
                            <input class="form-control" type="text" name="multisearchnom" id="nom" placeholder="Titre">
                        </div>
                        <div class="">
                                        <select data-trigger="" name="multisearchetat" class="form-control" >
                                            <option disabled selected>Statut </option>
                                            <option>Accepté</option>
                                            <option>Non Accepté</option>
                                            <option>Planifiée</option>
                                            <option>En cours</option>
                                            <option>Archivée</option>
                                            <option>Terminée</option>
                                        </select>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-success wrn-btn" style="margin-left : 5px">Search</button>
                            <button type="button" class="btn btn-danger wrn-btn"><a href="{{ route('postpartages.index') }}">Reset</a></button>
                        </div>

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
        </form>
    </div>
</section>
<!-- Recherche Multicritères FIN -->
    </div>
        </div>
<br><br>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="table">

<form method="post">
    @csrf
    @method('DELETE')
    <br>
    <button type="submit" formaction="/deleteall_c" class="btn btn-danger" style="margin-bottom : 14px"  onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash" style="margin-right : 10px"></i><i class="fas fa-arrow-down"></i></button>
    <a class="btn btn-info" href="{{ route('postpartages.create') }}"  style="margin-bottom : 14px "> Ajouter</a>
    <br>
     <p> Il y'a :         {!! $postpartages->total() !!}  Posts partagés</p>

            <br>
        </div>
    </div>
   <br><br>
    <div class="table">
        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col">@sortablelink('id_post')</th>
                <th scope="col">ID Groupe</th>
                <th scope="col">@sortablelink('nom')</th>
                <th scope="col">@sortablelink('prenom')</th>
                <th scope="col">@sortablelink('message_personnalise')</th>
                <th scope="col">@sortablelink('statut')</th>
                <th scope="col">@sortablelink('id_utilisateur')</th>
                <th>Actions</th>
                <th width="150px"></th>
            </tr>
            </thead>
            @if($postpartages->count())
            @foreach ($postpartages as $key => $value)
            <tr>
                <th  scope="row">{{ $value->id_post }}</th>
                <th  scope="row">{{ $value->id_groupe }}</th>
                <td>{{ $value->nom }}</td>
                <td>{{ $value->prenom }}</td>
                <td>
                    <pre style="white-space: pre-line; text-align:left; margin:0">{{ $value->message_personnalise }}</pre>
                </td>
                <td>{{ $value->statut }}</td>
                <th  scope="row">{{ $value->id_utilisateur }}</th>
                <td>
                    <a style="background-color : #fff ; border : #fff" class="btn btn-info" href="{{ route('postpartages.index',$value->id_post) }}"><i style="color : #4d94ff" class="fas fa-eye"></i></a>
                    <a style="background-color : #fff ; border : #fff" class="btn btn-primary" href="{{ route('postpartages.edit',$value->id_post) }}"><i style="color : #e6ac00"  class="fas fa-edit"></i></a>
                    <button formaction="{{ route('postpartages.destroy',$value->id_post) }}"  style="background-color : #fff ; border : #fff"  type="submit" class="btn btn-danger" onclick="return confirm('Etes-vous sur de vouloir supprimmer ?')"><i style="color : #cc3300"   class="fas fa-trash"></i></button>
                    <a style="background-color : #fff ; border : #fff" class="btn btn-info" id="road" href="{{ route('postpartages.show',$value->id_post) }}"><i style="color : #4d94ff" class="fas fa-info"></i></a>
                </td>
            </tr>
            @endforeach
            @endif

        </table>
    </div>
        {!! $postpartages->links() !!}

        <style>
#pageSubmenu1{
visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M13{
background-color: #747474;
}
</style>
    @endsection
