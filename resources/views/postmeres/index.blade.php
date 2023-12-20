@extends('layouts.navadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des posts mères</h2>
                <br>
            </div>
<!-- Recherche multicritère -->
<section class="search-sec" style="margin : 20px ; font-size : 13px">
    <div class="container">
        <h6>Recherche multicritère</h6>
        <form action="{{ url('/postmeres') }}" method="get" novalidate="novalidate">
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
                                            <option>Cible</option>
                                            <option>Planifiée</option>
                                            <option>En cours</option>
                                            <option>Archivée</option>
                                            <option>Terminée</option>
                                        </select>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-success wrn-btn" style="margin-left : 5px">Search</button>
                            <button type="button" class="btn btn-danger wrn-btn"><a href="{{ route('postmeres.index') }}">Reset</a></button>
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
<form method="post">
    @csrf
    @method('DELETE')
    <br>
    <button type="submit" formaction="/deleteall_c" class="btn btn-danger" style="margin-bottom : 14px"  onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash" style="margin-right : 10px"></i><i class="fas fa-arrow-down"></i></button>
    <a class="btn btn-info" href="{{ route('postmeres.create') }}"  style="margin-bottom : 14px "> Ajouter</a>
    <br>
        <p> Il y'a :         {!! $postmeres->total() !!}  Posts mères</p>

        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col"><input type="checkbox" class="selectall"></th>
                <th>N°</th>
                <th scope ="col">@sortablelink('id_post')</th>
                <th>ID Campagne</th>
                <th>Lien</th>
                <th>@sortablelink('statut_scrappe')</th>
                <th>@sortablelink('titre')</th>
                <th>@sortablelink('hashtag')</th>
                <th>@sortablelink('portee')</th>
                <th>@sortablelink('interaction')</th>
                <th>Actions</th>
            </tr>
            </thead>

            @foreach ($postmeres as $key => $value)
            <tr>
                <th scope="row"><input type="checkbox" name="ids[]" class="selectbox"
                    value="{{ $value->id_post }}">
                </th>
                <td>{{ ++$i }}</td>
                <th  scope="row">{{ $value->id_post }}</th>
                <th  scope="row">{{ $value->id_campagne }}</th>
                <td  style="color : blue"><a href="<?php $value->url_post ?>">URL</a></td>
                <td>{{ $value->statut_scrappe }}</td>
                <td>{{ $value->titre }}</td>
                <td>{{ $value->hashtag }}</td>
                <td>{{ $value->portee }}</td>
                <td>{{ \Str::limit($value->interaction, 60) }}</td>
                <td>
                    <a style="background-color : #fff ; border : #fff" class="btn btn-info" href="{{ route('postmeres.index',$value->id_post) }}"><i style="color : #4d94ff" class="fas fa-eye"></i></a>
                    <a style="background-color : #fff ; border : #fff" class="btn btn-primary" href="{{ route('postmeres.edit',$value->id_post) }}"><i style="color : #e6ac00"  class="fas fa-edit"></i></a>
                    <button formaction="{{ route('postmeres.destroy',$value->id_post) }}"  style="background-color : #fff ; border : #fff"  type="submit" class="btn btn-danger" onclick="return confirm('Etes-vous sur de vouloir supprimmer ?')"><i style="color : #cc3300"   class="fas fa-trash"></i></button>
                    <a style="background-color : #fff ; border : #fff" class="btn btn-info" id="road" href="{{ route('postmeres.show',$value->id_post) }}"><i style="color : #4d94ff" class="fas fa-info"></i></a>
                </td>
            </tr>
            @endforeach

        </table>
    </div>
</form>
    {!! $postmeres->links() !!}

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
        </script>
        <style>
#pageSubmenu1{
visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M12{
background-color: #747474;
}
</style>
@endsection
