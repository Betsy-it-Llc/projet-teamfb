@extends('layouts.navadmin')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des questions d'adhésion</h2>
                <br>
            </div>

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('questionads.create') }}"> Ajouter</a>
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
                <th scope="col">N°</th>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Theme</th>
                <th scope="col">Nombre de membres</th>
                <th scope="col">ID question</th>
                <th scope="col">Question adhérant</th>
                <th width="150px"></th>
            </tr>
            </thead>
            @foreach ($questionads as $key => $value)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $value->id_groupe }}</td>
                <td>{{ $value->nom }}</td>
                <td>{{ $value->theme }}</td>
                <td>{{ $value->nb_membres }}</td>
                <td>{{ $value->id_question }}</td>
                <td>{{ \Str::limit($value->question , 140) }}</td>
                <td>
                    <form action="{{ route('questionads.destroy',$value->id) }}" method="POST">  
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('questionads.show',$value->id) }}"><i style="color : black" class="fas fa-info"></i></a>    
                        <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('questionads.edit',$value->id) }}"><i style="color : black"  class="fas fa-edit"></i></a>   
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
#M5{
background-color: #747474;
}
</style>
    @endsection