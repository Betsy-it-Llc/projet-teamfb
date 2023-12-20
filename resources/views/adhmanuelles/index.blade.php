@extends('layouts.navadmin')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des groupes non adhérés</h2>
            </div>

<!-- Recherche multicritère --> 
<section class="search-sec" style="margin : 20px ; font-size : 13px">
    <div class="container" style="margin-left : 0">
    <h6>Recherche multicritère</h6>
        <form action="/multisearch_adh" method="get" novalidate="novalidate">
        <div class="row">
                <div class="col-lg-40">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-30 p-0">
                            <input class="form-control" type="text" name="multisearchnom" id="nom" placeholder="Nom">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchstatutadh" class="form-control" >
                                            <option disabled selected>Statut </option>
                                            <option>Non adhéré</option>
                                            <option>A validé</option>
                                        </select>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-success wrn-btn" style="margin-left : 5px">Search</button>
                            <button type="button" class="btn btn-danger wrn-btn"><a href="{{ route('adhmanuelles') }}">Reset</a></button>
                        </div>
                   
                    </div>
                </div>
               

            </div>
        </form>
    </div>
    </section>
<!-- Recherche Multicritères FIN -->


            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('adhmanuelles.create') }}"> Ajouter</a>
            <BR>
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
        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">ID ambassadeur</th>
                <th scope="col">Statut d'adhésion</th>
                <th scope="col">Nombre de membres</th>
                <th scope="col">Tag de recherche</th>
                <th width="150px"></th>
            </tr>
            </thead>
            @foreach ($adhmanuelles as $key => $value)
            <tr>
                <td><a style="color : blue" href="{{ $value->id_groupe }}">URL</a></td>
                <td>{{ $value->nom }}</td>
                <td>{{ $value->id_ambassadeur }}</td>
                <td>
                @if($value->statut_adhesion == 'non adhéré')
                <span style="background :  #ff9999 ; padding : 3px ; border-radius : 6px ">Non adhéré</span>                
                @else
                <span style="background : #b3ffd9 ; padding : 3px ; border-radius : 6px ">A validé</span>                
                @endif
                </td>
                <td>{{ $value->nb_membres }}</td>
                <td>{{ $value->tag_recherche }}</td>
                <td>
                    <form action="{{ route('adhmanuelles.destroy',$value->id) }}" method="POST">  
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('adhmanuelles.show',$value->id) }}"><i style="color : black" class="fas fa-info"></i></a>    
                        <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('adhmanuelles.edit',$value->id) }}"><i style="color : black"  class="fas fa-edit"></i></a>   
                        @csrf
                        @method('DELETE')      
                        <button  style="background-color : #fafafa ; border : #fafafa"  type="submit" class="btn btn-danger"><i style="color : black"   class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>  
    </div>
    <style>

#homeSubmenu{

   visibility:visible;
   display:block;
}
#pageSubmenu21{
            visibility:visible;
            display:block;
        }
#M4{
background-color: #747474;
}
</style>
    @endsection