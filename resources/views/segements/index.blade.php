
@extends('layouts.navadmin')

@section('content')
    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des segments</h2>
            </div>

            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container">
                    <h6>Recherche multicritère</h6>
                    <form action="/searchsegment" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-50">
                                <div class="row">
                                    <div class="">
                                        <input class="form-control" type="text" name="search" id="nom"
                                            placeholder="Nom">
                                    </div>
                                     <div class="">
                                        <input class="form-control" type="text" name="nom_segmentation" id="nom_segmentation"
                                            placeholder="segmentation">
                                    </div>

                                    <div class="">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        {{--  <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('campagnes.index') }}">Reset</a></button>  --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- Recherche Multicritères FIN -->
            <div class="pull-right" style="margin-bottom : 30px">
                <br>
                <a class="btn btn-info" href="{{ route('segements.create') }}"> Ajouter</a>
            </div>
        </div>
        <p> Il y'a :<?php
        use Illuminate\Support\Facades\DB; 
        $countt = DB::connection('mysql')->table('segements')


                                        ->count('segements.id_segment');
                                    echo $countt;
                                    ?> segements</p>
    </div>

    @if ($message = Session::get('success'))
        S
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table">
        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
                <tr>
                    <th width="10px" scope="col">ID</th>
                    <th width="10px">Nom</th>
                    <th width="10px">Thème</th>
                    <th width="10px">Type</th>
                    <th width="10px">Caractéristique</th>
                    <th width="10px">Description</th>
                    <th width="10px">nom segmentation</th>
                    <th width="10px">Groupe</th>
                    <th width="150px"> Action</th>
                </tr>
            </thead>
            @foreach ($segements as $segement)
                <tr>
                    <th scope="row">{{ $segement->id_segment }}</th>
                    <td>{{ $segement->nom_segment }}</td>
                    <td>{{ $segement->theme }}</td>
                    <td>{{ $segement->type }}</td>
                    <td>{{ \Str::limit($segement->caracteristique, 20) }}</td>
                    <td>
                        <pre style="white-space: pre-line; text-align:left; margin:0">{{ \Str::limit($segement->description, 30) }}</pre>
                    </td>
                    <td>{{ $segement->nom_segmentation }}</td>
                    <td><?php
                                $aaaa =$segement->id_segment;
                                $countt = DB::connection('mysql')->table('groupes')
                                    ->select('groupes.nom')
                                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                    ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                    ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                    ->where('segements.id_segment', $aaaa)
                                     ->distinct()
                                    ->count('groupes.id_groupe');
                                echo $countt;
                                ?> </td>
                    <td>
                        <form action="" method="POST">
                            {{-- <a style="background-color : #fff ; border : #fff" class="btn btn-primary" href="{{ \Illuminate\Support\Facades\URL::route('segements.edit',['segements' => $segement->id_segment] ) }}"><i style="color : #e6ac00"  class="fas fa-edit"></i></a> --}}

                            <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info"
                                href="{{ route('segements.show', $segement->id_segment) }}"><i style="color : #4d94ff"
                                        class="fas fa-eye"></i></a>
                            <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary"
                                href="{{ route('segements.edit', $segement->id_segment) }}"><i style="color : black"
                                    class="fas fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button formaction="{{ route('segements.destroy', $segement->id_segment) }}"
                                style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete ?')"><i style="color : #cc3300"
                                    class="fas fa-trash"></i></button>
                            <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                href="{{ route('segements.groupeseg', $segement->id_segment)}}"><i
                                    style="color : #4d94ff" class="fas fa-info"></i></a>

                        </form>
                    </td>
                </tr>
            @endforeach
            {{--  {{ $segements->links() }}  --}}
        </table>

    </div>
    <style>
#pageSubmenu5{
visibility:visible;
display:block;
}
#pageSubmenu20{
    visibility:visible;
    display:block;
}
#M31{
background-color: #747474;
}
</style>
@endsection
