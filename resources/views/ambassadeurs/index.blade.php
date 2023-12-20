@extends('layouts.navadmin')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Liste des ambassadeurs</h2>
            <br>
        </div>


        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('ambassadeurs.create') }}">Ajouter</a>
        </div>
        <div class="col" style="margin : 25px">
            <form action="/searchamb" method="get" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-50">
                        <div class="row">
                            <div class="">
                                <input class="form-control" type="text" name="search" id="nom" placeholder="nom">
                            </div>
                            <div class="">
                                <input class="form-control" type="text" name="auth" id="authentification_facebook" placeholder="authentification">
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-success wrn-btn" style="margin-left : 5px">Search</button>
                                {{-- <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('ambassadeurs.index') }}">Reset</a></button> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </form>
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
    <table class="table">
        <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th width="5px">ID</th>
                <th width="5px">Nom</th>
                <th width="5px">Prenom</th>
                <th width="5px">Login</th>
                <th width="5px">Mot de passe</th>
                <th width="5px">Authentification</th>
                <th width="5px">Url utilisateur</th>
                <th width="5px">Groupe</th>
                <th width="200px"></th>
            </tr>
        </thead>
        @foreach ($ambassadeurs as $ambassadeur)
        <tr>
            <th scope="row">{{ $ambassadeur->id_ambassadeur }}</th>
            <td>{{ $ambassadeur->Nom }}</td>
            <td>{{ $ambassadeur->prenom }}</td>
            <td>{{ $ambassadeur->login }}</td>
            <td>{{ $ambassadeur->mdp }}</td>

            <td>{{ \Str::limit($ambassadeur->authentification_facebook, 45) }}</td>
            <td> <a href="{{ $ambassadeur->url_utilisateur }}" target="_blank">{{ \Str::limit($ambassadeur->url_utilisateur, 25) }}</a>
            </td>
            <td><?php

                // use Illuminate\Support\Facades\DB;

                $aaaa = $ambassadeur->id_ambassadeur;
                $countt = DB::connection('mysql')->table('groupes')
                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                    ->select('groupes.id', 'groupes.nom', 'groupes.nb_membres', 'groupes.type', 'groupes.lieu', 'groupes.statut_integration', 'groupes.tag_recherche', 'utilisateur.prenom')
                    ->where('ambassadeur_groupe.id_ambassadeur', $aaaa)
                    ->distinct()
                    ->count('groupes.id_groupe');
                echo $countt;
                ?> </td>
            <td>
                <form action="{{ route('ambassadeurs.destroy', $ambassadeur->id_ambassadeur) }}" method="POST">
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('ambassadeurs.show', $ambassadeur->id_ambassadeur) }}"><i style="color : #4d94ff" class="fas fa-eye"></i></a>
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('ambassadeurs.edit', $ambassadeur->id_ambassadeur) }}"><i style="color : black" class="fas fa-edit"></i></a>
                    @csrf
                    @method('DELETE')

                    <button style="background-color : #fafafa ; border : #fafafa" type="submit" class="btn btn-danger"><i style="color : black" class="fas fa-trash"></i></button>
                    {{-- <a style="background-color : #fff ; border : #fff" class="btn btn-info" href="{{ route('ambassadeurs.groupeamb/{$id_ambassadeur}',$ambassadeur->id_ambassadeur) }}"><i style="color : #4d94ff" class="fas fa-info"></i></a> --}}
                    <a style="background-color : #fff ; border : #fff" class="btn btn-info" href="{{ route('ambassadeurs.groupeamb',['id_ambassadeur'=>$ambassadeur->id_ambassadeur]) }}"><i style="color : #4d94ff" class="fas fa-info"></i></a>

                </form>
            </td>
            {{-- <td>
                    <form action="{{ route('deleteAmbassadeur',$ambassadeur->id_utilisateur) }}" method="POST">
            <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('ambassadeurs.show',$ambassadeur->id_utilisateur) }}"><i style="color : black" class="fas fa-info"></i></a>
            <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('ambassadeurs.edit',$ambassadeur->id_utilisateur) }}"><i style="color : black" class="fas fa-edit"></i></a>
            @csrf
            @method('DELETE')
            <button style="background-color : #fafafa ; border : #fafafa" type="submit" class="btn btn-danger"><i style="color : black" class="fas fa-trash"></i></button>
            </form>
            </td> --}}
        </tr>
        @endforeach
    </table>
</div>
<style>
#pageSubmenu6{
visibility:visible;
display:block;
}
#M34{
background-color: #747474;
}
#pageSubmenu20{
    visibility:visible;
    display:block;
}
</style>
@endsection