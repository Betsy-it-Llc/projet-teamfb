
@extends('layouts.navadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12" style="margin-bottom : 30px">
            <div class="pull-left">
                <h2>Liste des groupes</h2>
            </div>
            <!-- Recherche multicritère -->
            <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container" style="margin-left : 0">
                    <h6>Recherche multicritère</h6>
                    <form action="{{ route('multisearch') }}" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-40">
                                <div class="row">

                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchnom" id="nom"
                                            placeholder="Nom">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchlieu" id="lieu"
                                            placeholder="Lieu">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <input class="form-control" type="text" name="multisearchtag" id="tag"
                                            placeholder="Tag">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-30 p-0">
                                        <select data-trigger="" name="multisearchstat" class="form-control">
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
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('groupes.index') }}">Reset</a></button>
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

            <!-- Filtres groupes -->

            <div class="container" style="font-size : 12px ; margin-top : 35px ; margin-bottom : 10px">
                <div class="row">
                    <ul class="ds-btn" style="list-style : none ; display : flex">
                        <li style="margin-right : 15px ">
                            <a class="btn btn-lg btn-dark " href="{{ route('groupeavecambassadeurs') }}"
                                style=" font-size : 15px">
                                <i class="glyphicon glyphicon-dashboard pull-left"></i><span>Groupe avec
                                    ambassadeurs<br><small>
                                    <?php
                                    use Illuminate\Support\Facades\DB;

                                     $countt = DB::connection('mysql')->table('groupes')
                                        ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=',
                                         'ambassadeur_groupe.id_groupe')
                                        ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=',
                                         'utilisateur.id_utilisateur')
                                        ->whereNotNull('ambassadeur_groupe.id_ambassadeur')
                                        ->distinct()
                                        ->count('groupes.id_groupe');
                                    echo $countt;



                                    ?>
                                        Groupes</small></span></a>
                        </li>
                        <li style="margin-right : 15px">
                            <a class="btn btn-lg btn-dark" href="{{ route('groupesansambassadeurs') }}"
                                style=" font-size : 15px">
                                <i class="glyphicon glyphicon-tasks pull-left"></i><span>Groupe sans
                                    ambassadeurs<br><small>
                                        <?php
                                        $countt = DB::connection('mysql')->table('groupes')
                                        ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                        ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                        ->whereNull('ambassadeur_groupe.id_ambassadeur')
                                        ->distinct()
                                        ->count('groupes.id_groupe');
                                    echo $countt;
                                    ?> Groupes</small></span></a>

                        </li>
                        <li style="margin-right : 15px">
                            <a class="btn btn-lg btn-dark" href="{{ route('groupesanssegments.index') }}"
                                style=" font-size : 15px">
                                <i class="glyphicon glyphicon-search pull-left"></i><span>Groupe sans segments<br><small>
                                        <?php $countt = DB::connection('mysql')->table('groupes')
                                            ->select('groupes.nom')
                                            ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                            ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                            ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                            ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                            ->whereNull('segements.id_segment')
                                            ->distinct()
                                            ->count('groupes.id_groupe');
                                        echo $countt;
                                        ?> Groupes</small></span></a>
                        </li>
                        <li style="margin-right : 15px">
                            <a class="btn btn-lg btn-dark" href="{{ route('groupeavecsegmentations') }}"
                                style=" font-size : 15px">
                                <i class="glyphicon glyphicon-list pull-left"></i><span>Groupe avec
                                    segmentation<br><small><?php $countt = DB::connection('mysql')->table('groupes')
                                        ->select('groupes.id_groupe')
                                        ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                        ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                        ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                        ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                        ->whereNotNull('segements.id_segment')
                                        ->distinct()
                                        ->count('groupes.id_groupe');
                                    echo $countt;
                                    ?> Groupes</small></span></a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Filtres FIN -->

        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table">

        <form method="post">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall_g" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 40px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="{{ route('groupes.create') }}" style="margin-bottom : 14px "> Ajouter</a>
            <br>
            <p> Il y'a :<?php $countt = DB::connection('mysql')->table('groupes')

                                        ->distinct()
                                        ->count('groupes.id_groupe');
                                    echo $countt;
                                    ?> Groupes</p>
            {{--  <p> Il y'a : {{ $groupes->total() }} Groupes</p>  --}}

            <table class="table">
                <thead class="thead" style="background:#cccccc">
                    <tr>
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th>N°</th>
                        <th>ID</th>
                        <th>@sortablelink('url')</th>
                        <th>@sortablelink('nom')</th>
                        <th>@sortablelink('type')</th>
                        <th>@sortablelink('statut_integration')</th>
                        <th>@sortablelink('nb_membres')</th>
                        <th>@sortablelink('tag_recherche')</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if ($groupes->count())
                    @foreach ($groupes as $key => $value)
                        <tr>
                            <th scope="row"><input type="checkbox" name="ids[]" class="selectbox"
                                    value="{{ $value->id }}"></th>
                            <td>{{ $loop->index + 1 }}</td>
                            <td  scope="row">{{ $value->id }}</td>
                            <td> <a href="{{ \Str::limit($value->id_groupe, 45 )}}"target="_blank">URL</a></td>
                            <td>{{ \Str::limit($value->nom, 45 )}}</td>
                            <td>
                                @if ($value->type == 'Privé')
                                    <span><i class="fa-solid fas fa-lock"
                                            style="color : gray ; width : 15px ; height : 15px ; margin-right: 5px"></i>Privé</span>
                                @elseif($value->type == 'Public')
                                    <span><i class="fa-solid fas fa-lock-open"
                                            style="color : gray ; width : 15px ; height : 15px ; margin-right: 5px"></i>Public</span>
                                @endif
                            </td>
                            <td>
                                @if ($value->statut_integration == 'nouveau groupe')
                                    <span
                                        style="background :  #ccffff ; font-weight : 500 ; padding : 3px ; border-radius : 6px ">Nouveau
                                        groupe</span>
                                @elseif($value->statut_integration == 'Nouveau membre')
                                    <span
                                        style="background : #ffccff ; font-weight : 500 ; padding : 3px ; border-radius : 6px ">Nouveau
                                        membre</span>
                                @elseif($value->statut_integration == 'Adhésion demandée')
                                    <span
                                        style="background : #daffb3 ; font-weight : 500 ; padding : 3px ; border-radius : 6px ">Adhésion
                                        demandée</span>
                                @elseif($value->statut_integration == 'Hors cible')
                                    <span
                                        style="background : #ffcccc ; font-weight : 500 ; padding : 3px ; border-radius : 6px ">Hors
                                        cible</span>
                                @endif
                            </td>
                            <td>{{ $value->nb_membres }}</td>
                            <td>{{ $value->tag_recherche }}</td>
                            <td>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                    href="{{ route('groupes.show', $value->id) }}"><i style="color : #4d94ff"
                                        class="fas fa-eye"></i></a>
                                <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                    href="{{ route('groupes.edit', $value->id) }}"><i style="color : #e6ac00"
                                        class="fas fa-edit"></i></a>
                                <button formaction="{{ route('groupes.destroy', $value->id) }}"
                                    style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete ?')"><i
                                        style="color : #cc3300" class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>


        </form>

    </div>

    {!! $groupes->appends(request()->query())->links() !!}
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

        #homeSubmenu{

           visibility:visible;
           display:block;
        }
        #pageSubmenu21{
            visibility:visible;
            display:block;
        }
        #M2{
background-color: #747474;
}
    </style>
@endsection
