@extends('layouts.navadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12" style="margin-bottom : 30px">
            <div class="pull-left">
                <h2>Notification</h2>
            </div>
            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container" style="margin-left : 0">
                    <h6>Recherche multicritère</h6>
                    <form action="{{ route('notif.index') }}" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchstatut" id="statut"
                                            placeholder="Statut">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchdate" id="date"
                                            placeholder="Date">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchsearch" id="search"
                                            placeholder="Recherche">
                                    </div>
                                    <!-- <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchstat" class="form-control">
                                            <option disabled selected>Statut </option>
                                            <option>Nouveau groupe</option>
                                            <option>Nouveau membre</option>
                                            <option>Hors cible</option>
                                            <option>Adhésion demandée</option>
                                        </select>
                                    </div> -->
                                    <!-- <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchtype" class="form-control">
                                            <option disabled selected>Type </option>
                                            <option>Privé</option>
                                            <option>Public</option>
                                        </select>
                                    </div> -->
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="<?php //{{ route('groupes.index') }}?>">Reset</a></button>
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
                            </div>
                            <!-- <div style="margin-top : 20px; float: left">
                                <label for="perPage" style="font-size : 14px; font-weight : 500">Nombre de Lignes</label>
                                <select data-trigger="" name="perPage" id="perPage" style="width : 50px" onchange="this.form.submit();">
                                    {{--  <option>{{$groupes->perPage()}} </option>  --}}
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                    <option>250</option>
                                </select>
                            </div> -->
                        </div>
                    </form>
                </div>
            </section>
            <!-- Recherche Multicritères FIN -->
            <!-- Filtres groupes -->
            <!-- Filtres FIN -->
            <div>
                <p> Il y'a : <?php
                    use Illuminate\Support\Facades\DB;
                    $countt=DB::connection('mysql3')->table('notification')->count();echo ($countt);?> Notifications
                </p>
            </div>
        </div>
    </div>

    <div class="table">
        <form method="post">
            @csrf
            @method('DELETE')
            <!-- <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="<?php //{{ route('groupes.create') }}?>" style="margin-bottom : 14px "> Ajouter</a> -->
            <br>
            <table class="table">
                <thead class="thead" >
                    <tr>
                        <th>@sortablelink('date')</th>
                        <th>@sortablelink('statut')</th>
                        <th>@sortablelink('automation')</th>
                        <th>@sortablelink('message')</th>
                        <th>@sortablelink('url_workflow')</th>
                        <!-- <th>@sortablelink('tag_recherche')</th> -->
                        <!-- <th></th> -->
                    </tr>
                </thead>
                    @foreach ($data as $key => $value)
                        <tr>
                            <td>{{ $value->date }} </td>
                            <td>
                                {{ $value->statut }}
                            </td>
                            <td>{{ $value->automation }}</td>
                            <td>
                                {{ $value->message }}
                            </td>
                            <td>{{ $value->url_workflow}}</td>
                            <!-- <td>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="<?php //{{ route('groupes.show', $value->id) }}?>"><i style="color : #4d94ff"
                                        class="fas fa-eye"></i></a>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="<?php //{{ route('groupes.edit', $value->id) }}?>"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                <button formaction="<?php //{{ route('groupes.destroy', $value->id) }}?>"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                            </td> -->
                        </tr>
                    @endforeach
            </table>
        </form>
    </div>

    {!! $data->appends(request()->query())->links() !!}
    <script type="text/javascript">
        $('.selectall').click(function() {
            $('.selectbox').prop('checked', $(this).prop('checked'));
            $('.selectall2').prop('checked', $(this).prop('checked'));
        })
        $('.selectall2').click(function() {
            $('.selectbox').prop('checked', $(this).prop('checked'));
            $('.selectall').prop('checked', $(this).prop('checked'));
        })
        $('.selectbox').change(function() {
            var total = $('.selectbox').length;
            var number = $('.selectbox:checked').length;
            if (total == number) {
                $('.selectall').prop('checked', true);
                $('.selectall2').prop('checked', true);
            } else {
                $('.selectall').prop('checked', false);
                $('.selectall2').prop('checked', false);

            }
        })
    </script>
    <style>
#pageSubmenu12{
visibility:visible;
display:block;
}
#pageSubmenu18{
visibility:visible;
display:block;
}
#M55{
background-color: #747474;
}
</style>
@endsection
