
@extends('layouts.navadmin')
@section('content')
    <div class="container">
        <h2 style="margin-bottom :25px">Segment</h2>

        <div id="content" class="content p-0">
            <div class="profile-header">
                <div class="profile-header-cover"></div>

                <div class="profile-header-content">
                    <div class="profile-header-img">
                        <img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="" />
                    </div>

                    <div class="profile-header-info">
                        <h4 class="m-t-sm"> {{ $segement->nom_segment }}</h4>
                        <p class="m-b-sm">ID segment : {{ $segement->id_segment }}</p>

                    </div>
                </div>
            </div>

            <div class="profile-container">
                <div class="row row-space-20">
                    <div class="col-md-8">
                        <div class="tab-content p-0">
                            <div class="tab-pane active show" id="profile-about">
                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Information du post</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">ID segment : </td>
                                            <td class="id_segment">
                                                {{ $segement->id_segment }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Nom :</td>
                                            <td class="id_segment">
                                                {{ $segement->nom_segment }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Thème :</td>
                                            <td class="id_segment">
                                                {{ $segement->theme }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Type :</td>
                                            <td class="id_segment">
                                                {{ $segement->type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Caractéristique :</td>
                                            <td class="id_segment">
                                                {{ $segement->caracteristique }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 hidden-xs hidden-sm">
                        <ul class="profile-info-list">
                            <thead>
                                <tr>
                                    <th colspan="2"><strong style="text-decoration : underline"> Suite</strong></th>
                                </tr>
                            </thead>
                            <li>
                                <div class="field">Description :</div>
                                <div class="id_segment">{{ $segement->description }}</div>
                            </li>
                            <li>
                                <div class="field">ID segmentation :</div>
                                <div class="id_segment">{{ $segement->id_segmentation }}{{ $segement->nom_segmentation }}
                                </div>
                            </li>
                            <li>
                                <div class="field">Nombre de groupes :</div>
                                <div class="id_segment"> <?php
                                use Illuminate\Support\Facades\DB;
                                $aaaa = $segement->id_segment;
                                $countt = DB::connection('mysql')->table('groupes')
                                    ->select('groupes.nom')
                                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                    ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                    ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                    ->where('segements.id_segment', $aaaa)
                                    ->count('groupes.id_groupe');
                                echo $countt;
                                ?> groupe</div>
                            </li>
 <li>
                                <div class="field">liste des ambassadeur  :</div>
                                <div class="id_segment"><?php
                                    $aaaa=$segement->id_segment;
 $ambs = DB::connection('mysql')->select('SELECT DISTINCT utilisateur.Nom,utilisateur.prenom FROM groupes left join ambassadeur_groupe on groupes.id_groupe = ambassadeur_groupe.id_groupe left join utilisateur on ambassadeur_groupe.id_ambassadeur= utilisateur.id_utilisateur left join segment_groupe on groupes.id_groupe =segment_groupe.id_groupe left join segements on segment_groupe.id_segment = segements.id_segment where segements.id_segment=?',[$aaaa]);

foreach ($ambs as $id_segment) {
 ?>
 <div>{{ $id_segment->prenom }}-{{ $id_segment->Nom}}</div>
  <?php
                                } ?>
 </div>
                            </li>

                        </ul>
                    </div>


                </div>
{{--  afficher la liste groupe dans la page show par chaque segments    --}}

                <div>

                    <table class="table">

                        <thead class="thead" style="background:#bfbfbf">

                            <tr>
                                <th >@sortablelink('id segment')</th>
                                <th>@sortablelink('nom segment')</th>
                                <th>@sortablelink('id groupe') </th>
                                <th>@sortablelink('nom')</th>
                                <th>@sortablelink('nb membres')</th>
                                <th>@sortablelink('type')</th>
                                <th>@sortablelink('lieu')</th>
                                <th>@sortablelink('statut_integration')</th>
                                <th>@sortablelink('nom prenom')</th>

                            </tr>
                        </thead>

 <?php $aaaa =$segement->id_segment;
 $countt = DB::connection('mysql')->table('groupes')
        ->select('segements.id_segment','segements.nom_segment','groupes.id','groupes.id_groupe','groupes.nom','groupes.nb_membres','groupes.type','groupes.lieu','groupes.statut_integration','groupes.tag_recherche','utilisateur.prenom','utilisateur.Nom')
                                            ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                            ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                            ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                            ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                            ->where('segements.id_segment',$aaaa)
                                            ->distinct('groupes.id_groupe')
                                            ->get();
                                        ?> <tr>

    @foreach ($countt as $key => $id_segment)
                            <th scope="row">{{ $id_segment->id_segment }}</th>
                            <th scope="row">{{ $id_segment->nom_segment }}</th>
                            <td> <a
                                    href="{{ \Str::limit($id_segment->id_groupe) }}"target="_blank">{{ \Str::limit($id_segment->id_groupe, 40) }}</a>
                            </td>
                            <td>{{ $id_segment->nom }}</td>
                            <td>{{ $id_segment->nb_membres }}</td>
                            <td>{{ $id_segment->type }}</td>
                            <td>{{ $id_segment->lieu }}</td>
                            <td>{{ $id_segment->statut_integration }}</td>
                            <td>{{ $id_segment->prenom }}-{{ $id_segment->Nom}}</td>

                            <td>




                                {{-- <form action="{{ route('AmbassadeurGroupe.destroy',$id_segment->id_ambassadeur) }}" method="POST">
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('AmbassadeurGroupe.show',$id_segment->id_ambassadeur) }}"><i style="color : black" class="fas fa-info"></i></a>
                        <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('AmbassadeurGroupe.edit',$id_segment->id_ambassadeur) }}"><i style="color : black"  class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')

                        <button  style="background-color : #fafafa ; border : #fafafa"  type="submit" class="btn btn-danger"><i style="color : black"   class="fas fa-trash"></i></button> --}}
                                {{-- <a style="background-color : #fff ; border : #fff" class="btn btn-info" href="{{ route('groupecampagnes.index',$id_segment->id_campagne) }}"><i style="color : #4d94ff" class="fas fa-info"></i></a> --}}
                                {{-- </form>
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
                    </table>



                </div>
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <a class="btn btn-primary" href="{{ route('segements') }}"> Back</a>
                    <a class="btn btn-success" href="" style="margin-left : 6px "> Print</a>

                    <a href="{{ route('segements.edit', $segement->id_segment) }}" style="margin-left : 6px "
                        class="btn btn-warning">Edit</a>


                </div>
            </div>
        </div>
    </div>


    <STYLE>
        body {
            background: #eaeaea;
        }

        .profile-info-list {
            padding: 0;
            margin: 0;
            list-style-type: none;
        }

        .friend-list,
        .img-grid-list {
            margin: -1px;
            list-style-type: none;
        }

        .profile-info-list>li.title {
            font-size: 0.625rem;
            font-weight: 700;
            color: #8a8a8f;
            padding: 0 0 0.3125rem;
        }

        .profile-info-list>li+li.title {
            padding-top: 1.5625rem;
        }

        .profile-info-list>li {
            padding: 0.625rem 0;
        }

        .profile-info-list>li .field {
            font-weight: 700;
        }

        .profile-info-list>li .id_segment {
            color: #666;
        }

        .profile-info-list>li.img-list a {
            display: inline-block;
        }

        .profile-info-list>li.img-list a img {
            max-width: 2.25rem;
            -webkit-border-radius: 2.5rem;
            -moz-border-radius: 2.5rem;
            border-radius: 2.5rem;
        }

        .coming-soon-cover img,
        .email-detail-attachment .email-attachment .document-file img,
        .email-sender-img img,
        .friend-list .friend-img img,
        .profile-header-img img {
            max-width: 100%;
        }

        .table.table-profile th {
            border: none;
            color: #000;
            padding-bottom: 0.3125rem;
            padding-top: 0;
        }

        .table.table-profile td {
            border-color: #c8c7cc;
        }

        .table.table-profile tbody+thead>tr>th {
            padding-top: 1.5625rem;
        }

        .table.table-profile .field {
            color: #666;
            font-weight: 600;
            width: 25%;
            text-align: right;
        }

        .table.table-profile .id_segment {
            font-weight: 500;
        }

        .profile-header {
            position: relative;
            overflow: hidden;
        }

        .profile-header .profile-header-cover {
            background: url(https://www.digitalacademy.fr/wp-content/uploads/2021/10/loei-thailand-may-10-2017-hand-holding-samsung-s8-with-mobi-1230x310.jpg) center no-repeat;
            background-size: 100% auto;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }

        .profile-header .profile-header-cover:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0, rgba(0, 0, 0, 0.85) 100%);
        }

        .profile-header .profile-header-content,
        .profile-header .profile-header-tab,
        .profile-header-img,
        body .fc-icon {
            position: relative;
        }

        .profile-header .profile-header-tab {
            background: #fff;
            list-style-type: none;
            margin: -1.25rem 0 0;
            padding: 0 0 0 8.75rem;
            border-bottom: 1px solid #c8c7cc;
            white-space: nowrap;
        }

        .profile-header .profile-header-tab>li {
            display: inline-block;
            margin: 0;
        }

        .profile-header .profile-header-tab>li>a {
            display: block;
            color: #000;
            line-height: 1.25rem;
            padding: 0.625rem 1.25rem;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.75rem;
            border: none;
        }

        .profile-header .profile-header-tab>li.active>a,
        .profile-header .profile-header-tab>li>a.active {
            color: #007aff;
        }

        .profile-header .profile-header-content:after,
        .profile-header .profile-header-content:before {
            content: "";
            display: table;
            clear: both;
        }

        .profile-header .profile-header-content {
            color: #fff;
            padding: 1.25rem;
        }

        body .fc th a,
        body .fc-ltr .fc-basic-view .fc-day-top .fc-day-number,
        body .fc-widget-header a {
            color: #000;
        }

        .profile-header-img {
            float: left;
            width: 7.5rem;
            height: 7.5rem;
            overflow: hidden;
            z-index: 10;
            margin: 0 1.25rem -1.25rem 0;
            padding: 0.1875rem;
            -webkit-border-radius: 0.25rem;
            -moz-border-radius: 0.25rem;
            border-radius: 0.25rem;
            background: #fff;
        }

        .profile-header-info h4 {
            font-weight: 500;
            margin-bottom: 0.3125rem;
        }

        .profile-container {
            padding: 1.5625rem;
        }

        @media (max-width: 967px) {
            .profile-header-img {
                width: 5.625rem;
                height: 5.625rem;
                margin: 0;
            }

            .profile-header-info {
                margin-left: 6.5625rem;
                padding-bottom: 0.9375rem;
            }

            .profile-header .profile-header-tab {
                padding-left: 0;
            }
        }

        @media (max-width: 767px) {
            .profile-header .profile-header-cover {
                background-position: top;
            }

            .profile-header-img {
                width: 3.75rem;
                height: 3.75rem;
                margin: 0;
            }

            .profile-header-info {
                margin-left: 4.6875rem;
                padding-bottom: 0.9375rem;
            }

            .profile-header-info h4 {
                margin: 0 0 0.3125rem;
            }

            .profile-header .profile-header-tab {
                white-space: nowrap;
                overflow: scroll;
                padding: 0;
            }

            .profile-container {
                padding: 0.9375rem 0.9375rem 3.6875rem;
            }

            .friend-list>li {
                float: none;
                width: auto;
            }
        }

        .profile-info-list {
            padding: 0;
            margin: 0;
            list-style-type: none;
        }

        .friend-list,
        .img-grid-list {
            margin: -1px;
            list-style-type: none;
        }

        .profile-info-list>li.title {
            font-size: 0.625rem;
            font-weight: 700;
            color: #8a8a8f;
            padding: 0 0 0.3125rem;
        }

        .profile-info-list>li+li.title {
            padding-top: 1.5625rem;
        }

        .profile-info-list>li {
            padding: 0.625rem 0;
        }

        .profile-info-list>li .field {
            font-weight: 700;
        }

        .profile-info-list>li .id_segment {
            color: #666;
        }

        .profile-info-list>li.img-list a {
            display: inline-block;
        }

        .profile-info-list>li.img-list a img {
            max-width: 2.25rem;
            -webkit-border-radius: 2.5rem;
            -moz-border-radius: 2.5rem;
            border-radius: 2.5rem;
        }

        .coming-soon-cover img,
        .email-detail-attachment .email-attachment .document-file img,
        .email-sender-img img,
        .friend-list .friend-img img,
        .profile-header-img img {
            max-width: 100%;
        }

        .table.table-profile th {
            border: none;
            color: #000;
            padding-bottom: 0.3125rem;
            padding-top: 0;
        }

        .table.table-profile td {
            border-color: #c8c7cc;
        }

        .table.table-profile tbody+thead>tr>th {
            padding-top: 1.5625rem;
        }

        .table.table-profile .field {
            color: #666;
            font-weight: 600;
            width: 25%;
            text-align: right;
        }

        .table.table-profile .id_segment {
            font-weight: 500;
        }

        .friend-list {
            padding: 0;
        }

        .friend-list>li {
            float: left;
            width: 50%;
        }

        .friend-list>li>a {
            display: block;
            text-decoration: none;
            color: #000;
            padding: 0.625rem;
            margin: 1px;
            background: #fff;
        }

        .friend-list>li>a:after,
        .friend-list>li>a:before {
            content: "";
            display: table;
            clear: both;
        }

        .friend-list .friend-img {
            float: left;
            width: 3rem;
            height: 3rem;
            overflow: hidden;
            background: #efeff4;
        }

        .friend-list .friend-info {
            margin-left: 3.625rem;
        }

        .friend-list .friend-info h4 {
            margin: 0.3125rem 0;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .friend-list .friend-info p {
            color: #666;
            margin: 0;
        }
    </STYLE>
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
