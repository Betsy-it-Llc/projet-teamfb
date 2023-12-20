
@extends('layouts.navadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                   <?php
                    use Illuminate\Support\Facades\DB;
                    $ambs = DB::connection('mysql')->select('select id_segment, nom_segment  from  segements  ');



            ?>
 @foreach ($ambs as $amb )
                <h2>Liste des segement groupe de {{ $amb->nom_segment}} </h2>

                <br>
 @endforeach

<p> Il y'a : {{$groupeavecsegmentations->total()}} Groupes</p>
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
            <?php
 // $groupeavecsegmentations = DB::connection('mysql')->table('groupes')
    //         ->leftjoin('ambassadeur_groupe', 'ambassadeur_groupe.id_groupe', '=', 'groupes.id_groupe')
    //         ->leftjoin('ambassadeurs','ambassadeur_groupe.id_ambassadeur', '=', 'ambassadeurs.id_ambassadeur')
    //         ->leftjoin('utilisateur','utilisateur.id_utilisateur','=','ambassadeurs.id_ambassadeur')
    //         ->whereIn('ambassadeurs.id_ambassadeur',   $id_ambassadeur)
    //        //->whereColumn('ambassadeurs.id_ambassadeur','id_ambassadeur')
    //       // ->selectRaw('id_groupe * ? as groupes ')
    //     //   ->lazyById()->each(function ($ambassadeurs) {
    //     //     DB::connection('mysql')->table('groupes')
    //     //     ->leftjoin('ambassadeur_groupe', 'ambassadeur_groupe.id_groupe', '=', 'groupes.id_groupe')
    //     //     ->leftjoin('ambassadeurs','ambassadeur_groupe.id_ambassadeur', '=', 'ambassadeurs.id_ambassadeur')
    //     //     ->leftjoin('utilisateur','utilisateur.id_utilisateur','=','ambassadeurs.id_ambassadeur')
    //     //         ->where('id', $ambassadeurs->id)
    //     //        ;
    //     // })
    //         ->paginate(20);
// $groupeavecsegmentations=DB::connection('mysql')->select('SELECT distinct groupes.id_groupe FROM groupes
  //  left join ambassadeur_groupe on ambassadeur_groupe.id_groupe = groupes.id_groupe
    //left join ambassadeurs on ambassadeur_groupe.id_ambassadeur=ambassadeurs.id_ambassadeur
    //left join utilisateur on utilisateur.id_utilisateur=ambassadeurs.id_ambassadeur
   // WHERE ambassadeurs.id_ambassadeur= ?') ;



    // On attache les valeurs




            ?>
            <tr>
             <th>N°</th>
                <th>@sortablelink('id segment')</th>
                <th>@sortablelink('nom segment')</th>
                <th>@sortablelink('id groupe') </th>
                <th>@sortablelink('nom')</th>
                <th>@sortablelink('nb membres')</th>
                <th>@sortablelink('type')</th>
                <th>@sortablelink('lieu')</th>
                <th>@sortablelink('statut_integration')</th>
                <th>@sortablelink('prenom')</th>

            </tr>
            </thead>
  @if($groupeavecsegmentations->count())

            @foreach ($groupeavecsegmentations as $key => $value)
            <tr>
            <td>{{ $loop->index+1}}</td>
                 <th  scope="row">{{ $value->id_segment}}</th>
    <th  scope="row">{{ $value->nom_segment}}</th>
             <td> <a href="{{ \Str::limit($value->id_groupe)}}"target="_blank">{{ \Str::limit($value->id_groupe,40) }}</a></td>
                <td>{{ $value->nom}}</td>
                <td>{{ $value->nb_membres}}</td>
                <td>{{ $value->type }}</td>
                <td>{{ $value->lieu }}</td>
                <td>{{ $value->statut_integration }}</td>
                 <td>{{ $value->prenom }}-{{ $value->Nom }}</td>
   <td>
                    {{--  <form action="{{ route('AmbassadeurGroupe.destroy',$value->id_ambassadeur) }}" method="POST">
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('AmbassadeurGroupe.show',$value->id_ambassadeur) }}"><i style="color : black" class="fas fa-info"></i></a>
                        <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('AmbassadeurGroupe.edit',$value->id_ambassadeur) }}"><i style="color : black"  class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')

                        <button  style="background-color : #fafafa ; border : #fafafa"  type="submit" class="btn btn-danger"><i style="color : black"   class="fas fa-trash"></i></button>
                      --}}
                     {{--  <a style="background-color : #fff ; border : #fff" class="btn btn-info" href="{{ route('groupecampagnes.index',$value->id_campagne) }}"><i style="color : #4d94ff" class="fas fa-info"></i></a>  --}}
                    {{--  </form>
                </td>
                {{--  <td>
                    <form action="{{ route('deleteAmbassadeur',$ambassadeurGroupe->id_utilisateur) }}" method="POST">
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('AmbassadeurGroupe.show',$ambassadeurGroupe->id_utilisateur) }}"><i style="color : black" class="fas fa-info"></i></a>
                        <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('AmbassadeurGroupe.edit',$ambassadeurGroupe->id_utilisateur) }}"><i style="color : black"  class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button  style="background-color : #fafafa ; border : #fafafa"  type="submit" class="btn btn-danger"><i style="color : black"   class="fas fa-trash"></i></button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
@endif
        </table>
    </div>
      {!! $groupeavecsegmentations->links() !!}
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
