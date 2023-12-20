@extends('layouts.navadmin')
@section('content')
<div class="container">
    <h2 style="margin-bottom :25px">Info Groupe</h2>

    <div id="content" class="content p-0">
        <div class="profile-header">
            <div class="profile-header-cover"></div>

            <div class="profile-header-content">
                <div class="profile-header-img">
                    <img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="" />
                </div>

                <div class="profile-header-info">
                    <h4 class="m-t-sm">{{ $groupe->nom }}</h4>
                    <p class="m-b-sm">Groupe {{ $groupe->actif_supprime }}</p>
                    <a href="{{ $groupe->id_groupe }}" class="btn btn-xs btn-primary mb-3">Visiter</a>

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
                                        <th colspan="2">Information du groupe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="field">Nom du groupe : </td>
                                        <td class="value">
                                            {{ $groupe->nom }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">ID groupe :</td>
                                        <td class="value">
                                            {{ \Str::limit($groupe->id_groupe, 60) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Personnalisation :</td>
                                        <td class="value">
                                            {{ $groupe->personnalisation }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Nombre de membres :</td>
                                        <td class="value">
                                            {{ $groupe->nb_membres }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Thème :</td>
                                        <td class="value">
                                            {{ $groupe->theme }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Type :</td>
                                        <td class="value">
                                            {{ $groupe->type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Statut d'intégration :</td>
                                        <td class="value">
                                            {{ $groupe->statut_integration }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Actif/Supprimé :</td>
                                        <td class="value">
                                            {{ $groupe->actif_supprime }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Fréquence post par mois :</td>
                                        <td class="value">
                                            {{ $groupe->frequence_post_mois }}
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
                            <div class="field">Statut relevé :</div>
                            <div class="value">{{ $groupe->statut_releve }}</div>
                        </li>
                        <li>
                            <div class="field">Date relevé :</div>
                            <div class="value">{{ $groupe->date_releve }}</div>
                        </li>
                        <li>
                            <div class="field">Format groupe :</div>
                            <div class="value">{{ $groupe->format_groupe }}</div>
                        </li>
                        <li>
                            <div class="field">Réglementation:</div>
                            <div class="value">{{ $groupe->reglementation }}</div>
                        </li>
                        <li>
                            <div class="field">Lieu:</div>
                            <div class="value">
                                {{ $groupe->lieu }}
                            </div>
                        </li>
                        <li>
                            <div class="field">Tag recherché :</div>
                            <div class="value">
                                {{ $groupe->tag_recherche }}
                            </div>
                        </li>

                    </ul>
                    <br>
                    <h2>Ambassadeurs</h2>
                    <br>
                    <a class="btn btn-success" data-toggle="modal" data-target="#ModalLoginForm" href="" style="margin-bottom : 14px "> Ajouter ambassadeur</a>

                    <br>
                    <div id="ModalLoginForm" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Ajouter un ambassadeur </h2>
                                </div>
                                <div class="modal-body">
                                    <form method="get" action="">
                                        <input type="hidden" name="_token" value="">
                                        <div class="form-group">
                                            <label class="control-label">Nom segment</label>
                                            <div>
                                                <select name="farah1" class="form-control">
                                                    <?php
                                                    use Illuminate\Support\Facades\DB;

                                                    $ambs = DB::connection('mysql')->select('select id_ambassadeur  , login from ambassadeurs  ');

                                                    foreach ($ambs as $amb => $am) {
                                                    ?>
                                                        <option name="" value=" {{ $am->id_ambassadeur }} "> {{ $am->id_ambassadeur }} - {{ $am->login }}</option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div>
                                                {{-- <a class="btn btn-success" href="{{ route('groupes.create') }}" style="margin-bottom : 14px "> Ajouter Segment</a> --}}

                                                <input type="submit" name="submit1" class="btn btn-success">

                                            </div>
                                        </div>
                                    </form>


                                    <?php


                                    ?>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->



                    </form>

                    <?php
                    if (isset($_GET['submit1'])) {
                        if (!empty($_GET['farah1'])) {
                            $selected1 = $_GET['farah1'];
                            echo 'You have chosen: ' . $selected1;
                            $id_g = $groupe->id_groupe;
                            //echo $r1->id_segment;
                            //dd($selected);
                            //echo($id_g);
                            $array = explode(",", $selected1);

                            // print_r($array);
                            // dd();

                            $array1 = explode(",", $id_g);



                            DB::connection('mysql')->enableQueryLog();

                            DB::connection('mysql')->table('ambassadeur_groupe')->insert([
                                'id_groupe' => $array1[0],
                                'id_ambassadeur' => $array[0]
                            ]);





                            $query = DB::connection('mysql')->getQueryLog();
                            print_r($query);

                            //$insert1=DB::insert(' INSERT INTO ambassadeur_groupe( id_groupe ) VALUES ?' ,'[$id_g]',);
                            //// this is the query !
                            //2 insert

                        } else {
                            echo 'Please select the value.';
                        }
                    }

                    ?>



                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th scope="col">Ambassadeur</th> -->
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $idg = $groupe->id_groupe;
                            $arraytest = explode(',', $idg);
                            //dd($arraytest);
                            $new = DB::connection('mysql')->select(
                                'select id_ambassadeur from ambassadeur_groupe where id_groupe=?',
                                [$arraytest[0]]
                            );

                            $rows = DB::connection('mysql')->select("SELECT utilisateur.prenom, utilisateur.nom
                                                FROM utilisateur JOIN ambassadeur_groupe
                                                ON utilisateur.id_ambassadeur = ambassadeur_groupe.id_ambassadeur
                                                WHERE id_groupe=?", [$arraytest[0]]);
                            //en ayant rajouter une colonne id_ambassadeur dans la table utilisateur
                            //en ayant rempli que ceux qui sont ambassadeurs avec la même valeur que id_utilisateur
                            //ou que id_ambassadeur présent dans la table ambassadeur_groupe
                            //or à la base ce n'étais pas le cas avant que je modifie la table utilisateur

                            ?>
                            <?php
                            foreach ($rows as $row => $a) {
                            ?>
                                <tr>

                                    <td> {{ $a->prenom }} </td>
                                    <td> {{ $a->nom }} </td>


                                    <td>
                                        <form method="post">
                                            @csrf
                                            @method('DELETE')

                                            <?php foreach($new as $abc => $ab){ ?><?php }?>
                                            <button formaction="{{ route('deleteAmbassadeur', $ab->id_ambassadeur) }} " style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete ?')"><i style="color : #cc3300" class="fas fa-trash"></i> </button>

                                            {{-- <a href="delete.php?id=<?php echo $data['id']; ?>">Delete</a> --}}

                                            {{-- <a href={{"delete/".$r->id_segment}}>Delete</a> --}}
                                            {{-- <button formaction="{{ route('deleteseg') }}" style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete ')"><i style="color : #cc3300" class="fas fa-trash"></i></button> --}}

                                        </form>
                                    </td>
                                </tr>


                        </tbody>
                    <?php
                          }   ?>
                    </table>

                    <strong>
                        <p>liste des segments et segmentations correspondantes : </p>
                    </strong>



                    <a class="btn btn-success" data-toggle="modal" data-target="#ModalLoginForm1" href="" style="margin-bottom : 14px "> Ajouter segment</a>
                    <br>


                    <!-- Modal HTML Markup -->
                    <div id="ModalLoginForm1" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Ajouter un segment </h2>
                                </div>
                                <div class="modal-body">
                                    <form method="get" action="">
                                        <input type="hidden" name="_token" value="">
                                        <div class="form-group">

                                            <label for="id_segment" style="  color:red; font-style: italic;font-weight: bold;"></label>
                                            <div>
                                                <select name="id_segment" class="form-control">
                                                    <?php
                                                    $ambs = DB::connection('mysql')->select('select id_segment ,nom_segment  from segements  ');

                                                    foreach ($ambs as $amb => $am) {
                                                    ?>
                                                        <option name="id_segment" value=" {{ $am->id_segment }} "> {{ $am->id_segment }} - {{ $am->nom_segment }}</option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{-- <label class="control-label">Nom Segmentation</label>
                                                <div>
                                                    <select name="type" id="pet-select" class="form-control">
                                                        {{-- <?php

                                                                if (isset($_GET['nom_segment'])) :
                                                                    $req2 = DB::connection('mysql')->select(
                                                                        'select * from segements as s
                                                            join segementations as sg on s.id_segmentation=sg.nom_segmentation
                                                             where s.nom_segment=?',
                                                                        [$_GET['nom_segment']],
                                                                    );
                                                                endif;


                                                                ?>
                                                        <?php
                                                        foreach ($req2 as $re2 => $r2) {

                                                        ?>
                                                        <option value="">{{$r2->nom_segmentation}} </option>
                                        <?php
                                                        } ?>
                                        </select> --}}
                                        </div>
                                </div>

                                <div class="form-group">
                                    <div>
                                        {{-- <a class="btn btn-success" href="{{ route('groupes.create') }}" style="margin-bottom : 14px "> Ajouter Segment</a> --}}

                                        <input type="submit" name="submit" class="btn btn-success">

                                    </div>
                                </div>
                                </form>


                                <?php


                                ?>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->



                </form>

                <?php
                if (isset($_GET['submit'])) {
                    if (!empty($_GET['id_segment'])) {
                        $selected = $_GET['id_segment'];
                        echo 'You have chosen: ' . $selected;
                        $id_g = $groupe->id_groupe;
                        $array1 = explode(",", $id_g);

                        //echo $r1->id_segment;
                        //dd($selected);
                        echo ($id_g);
                        DB::connection('mysql')->table('segment_groupe')->insert([
                            'id_groupe' => $array1[0],
                            'id_segment' => $selected
                        ]);

                        //$res=User::find($id)->delete();


                        //$insert1=DB::connection('mysql')->insert(' INSERT INTO segment_groupe( id_groupe ,id_segment ) VALUES ?,?' , ('[$id_g]',$selected),);
                        //$insert2=DB::connection('mysql')->insert('INSERT INTO segment_groupe(id_segment) VALUES ?',[$r1->id_segment],);

                    } else {
                        echo 'Please select the value.';
                    }
                }
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Segment </th>
                            <th scope="col">Nom Segment</th>

                            <th scope="col">ID Segmentation</th>
                            <th scope="col">Nom Segmentation</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $aaaa = $groupe->id;
                        $req = DB::connection('mysql')->select('select *
                from segementations as st join segements as s
                on st.nom_segmentation=s.nom_segmentation join segment_groupe as sg on sg.id_segment=s.id_segment
                join groupes as g on g.id_groupe=sg.id_groupe
                where g.id=? ', [$aaaa]);
                        ?>
                        <?php
                        foreach ($req as $re => $r) {

                        ?>

                            <tr>
                                <td name="var2"> <?php echo $r->id_segment; ?></td>
                                <td><?php echo $r->nom_segment; ?></td>
                                <td><?php echo $r->id_segmentation; ?></td>
                                <td>hkj<?php echo $r->nom_segmentation; ?>hkjh</td>
                                <td>
                                    <form method="delete">
                                        @csrf
                                        @method('DELETE')

                                        <button formaction="{{ route('deleteSegment', $r->id_segment) }} " style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete ?')"><i style="color : #cc3300" class="fas fa-trash"></i> </button>

                                        {{-- <input type="submit" name="submit1" value="Delete" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete ?')" > --}}
                                        {{-- <button formaction="{{ route('segementationsDelete', $r->id_segmentation) }}"
                                        style="background-color : #fff ; border : #fff" type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete ?')"><i style="color : #cc3300" class="fas fa-trash"></i></button> --}}

                                        {{-- <a href={{"delete/".$r->id_segment}}>Delete</a> --}}
                                        {{-- <button formaction="{{ route('deleteseg') }}" style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete ')"><i style="color : #cc3300" class="fas fa-trash"></i></button> --}}
                                    </form>
                                </td>
                            </tr>

                    </tbody>
                <?php
                        }
                ?>
                </table>

            </div>


        </div>
        <div class="h-100 d-flex align-items-center justify-content-center">
            <a class="btn btn-primary" href="{{ route('groupes.index') }}"> Back</a>
            <a class="btn btn-success" href="" style="margin-left : 6px "> Print</a>
            <a href="{{ route('groupes.edit', $groupe->id) }}" style="margin-left : 6px " class="btn btn-warning">Edit</a>


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

    .profile-info-list>li .value {
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

    .table.table-profile .value {
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

    .profile-info-list>li .value {
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

    .table.table-profile .value {
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
