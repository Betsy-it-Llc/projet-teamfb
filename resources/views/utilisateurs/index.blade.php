
@extends('layouts.navadmin')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des utilisateurs</h2>
            </div>

<!-- Recherche multicritère -->
<section class="search-sec" style="margin : 20px ; font-size : 13px">
    <div class="container" style="margin-left : 0">
    <h6>Recherche multicritère</h6>
        <form action="{{ route('multisearch_utilisateurs') }}" method="get" novalidate="novalidate">
        <div class="row">
                <div class="col-lg-40">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                            <input class="form-control" type="text" name="multisearchid" id="id" placeholder="ID">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                            <input class="form-control" type="text" name="multisearchNom" id="Nom" placeholder="Nom">
                        </div>
                         <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                            <input class="form-control" type="text" name="multisearchprenom" id="prenom" placeholder="prenom">
                        </div>
                          <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                            <input class="form-control" type="text" name="multisearprofil" id="profil" placeholder="profil">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchgenre" class="form-control" >
                                            <option disabled selected>Sexe </option>
                                            <option>Homme</option>
                                            <option>Femme</option>
                                        </select>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-success wrn-btn" style="margin-left : 5px">Search</button>
                            <button type="button" class="btn btn-danger wrn-btn"><a href="{{ route('utilisateurs.index') }}">Reset</a></button>
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



            <!--<div class="pull-right" style="margin-bottom : 10px">
                <a class="btn btn-info" href="{/{ route('utilisateurs.create') }}"> Ajouter</a>
            </div>
            <p> Il y'a : <?php
            /*use Illuminate\Support\Facades\DB;
            $countt=DB::connection('mysql')->table('utilisateur')->count();
            echo ($countt);
            */?> Utilisateurs</p>
            </div>-->
    </div>
   <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<form method="post">
    @csrf
    @method('DELETE')
    <br>
    <button type="submit" formaction="/deleteall_c" class="btn btn-danger" style="margin-bottom : 14px"  onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash" style="margin-right : 10px"></i><i class="fas fa-arrow-down"></i></button>
    <a class="btn btn-info" href="{{ route('utilisateurs.create') }}"  style="margin-bottom : 14px "> Ajouter</a>
    <br>
        <p> Il y'a :         {!! $utilisateurs->total() !!}  utilisateurs</p>

            <br>
        </div>
    </div>
    <br><br>
    <div class="table">
        <table class="table">
            <thead class="thead">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">@sortablelink('Nom')</th>
                <th scope="col">@sortablelink('prenom')</th>
                <th scope="col">@sortablelink('genre')</th>
                <th scope="col">@sortablelink('profil')</th>
                <th scope="col">Url utilisateur</th>
                <th width="150px"></th>
            </tr>
            </thead>
            @if($utilisateurs->count())
            @foreach ($utilisateurs as $key => $value)
            <tr>
                <td>{{ $value->id_utilisateur }}</a></td>
                <td>{{ $value->Nom }}</td>
                <td>{{ $value->prenom }}</td>
                <td>{{ $value->genre }}</td>
                   <td>{{ $value->profil }}</td>
                                    <td> <a href="{{ \Str::limit($value->url_utilisateur)}}"target="_blank">{{ $value->url_utilisateur }}</a></td>
                <td>
                    <form action="{{ route('utilisateurs.destroy',$value->id_utilisateur) }}" method="POST">
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('utilisateurs.show',$value->id_utilisateur) }}"><i style="color : black" class="fas fa-info"></i></a>
                        <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('utilisateurs.edit',$value->id_utilisateur) }}"><i style="color : black"  class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')

                        <button  style="background-color : #fafafa ; border : #fafafa"  type="submit" class="btn btn-danger"><i style="color : black"   class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>

    </div>
        {!! $utilisateurs->appends(request()->query())->links() !!}

        <style>
#pageSubmenu2{
visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M18{
background-color: #747474;
}
</style>
    @endsection
