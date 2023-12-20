
@extends('layouts.navadmin')
@section('content')
    <!-- partial -->
    <div class="main-panel">
        <h1 style="margin-bottom : 40px">Dashboard Groupes <p> <?php
        use Illuminate\Support\Facades\DB; 
        $countt = DB::connection('mysql')->table('groupes')

            ->distinct()
            ->count('groupes.id_groupe');
        echo $countt;
        ?> Groupes</p>
        </h1>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="tab-content tab-content-basic">
                                            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                                aria-labelledby="overview">
                                                <div class="row">




                                                    <div class="col-sm-12">
                                                        <div
                                                            class="statistics-details d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <h6 class="statistics-title">Avec Amb</h6>


                                                                <h4 class="rate-percentage"><?php $countt = DB::connection('mysql')->table('groupes')
                                                                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                                    ->whereNotNull('ambassadeur_groupe.id_ambassadeur')
                                                                    ->distinct()
                                                                    ->count('groupes.id_groupe');
                                                                echo $countt;
                                                                ?>
                                                                </h4>
                                                                <p class="text-info d-flex"><a
                                                                        href="{{ route('groupeavecambassadeurs') }}">(Consulter)</a>
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <h6 class="statistics-title">Sans Amb</h6>
                                                                <h3 class="rate-percentage"><?php $countt = DB::connection('mysql')->table('groupes')
                                                                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                                    ->whereNull('ambassadeur_groupe.id_ambassadeur')
                                                                    ->distinct()
                                                                    ->count('groupes.id_groupe');
                                                                echo $countt;
                                                                ?> </h3>
                                                                <p class="text-info d-flex"><a
                                                                        href="{{ route('groupesansambassadeurs') }}">(Consulter)</a>
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <h6 class="statistics-title">Avec Seg </h6>
                                                                <h3 class="rate-percentage"><?php
                                                                $countt = DB::connection('mysql')->table('groupes')
                                                                    ->select('groupes.id_groupe')
                                                                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                                    ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                                                    ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                                                    ->whereNotNull('segements.id_segment')
                                                                    ->distinct()
                                                                    ->count('groupes.id_groupe');
                                                                echo $countt;
                                                                ?></h3>
                                                                <p class="text-info d-flex"><a
                                                                        href="{{ route('groupeavecsegmentations') }}">(Consulter)</a>
                                                                </p>

                                                            </div>
                                                            <div class="d-none d-md-block">
                                                                <h6 class="statistics-title">Sans Seg </h6>
                                                                <h3 class="rate-percentage"><?php $countt = DB::connection('mysql')->table('groupes')
                                                                    ->select('groupes.nom')
                                                                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                                    ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                                                    ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                                                    ->whereNull('segements.id_segment')
                                                                    ->distinct()
                                                                    ->count('groupes.id_groupe');
                                                                echo $countt;
                                                                ?></h3>
                                                                <p class="text-info d-flex"><a
                                                                        href="{{ route('groupesanssegments.index') }}">(Consulter)</a>
                                                                </p>

                                                            </div>
                                                            <div class="d-none d-md-block"
                                                                style="display: table;
width: 10%;transform: translateY(-7px)">
                                                                <h6 class="statistics-title">actif_supprime </h6>
                                                                <span style="display: table-cell;
width: 5%;">
                                                                    <p class="rate-percentage">Actif</p>
                                                                    <h6 class="mdi mdi-menu-down"><?php $countt = DB::connection('mysql')->table('groupes')

                                                                        ->where('groupes.actif_supprime', 'actif')
                                                                        ->distinct()
                                                                        ->count('groupes.id_groupe');
                                                                    echo $countt;
                                                                    ?></h6>

                                                                </span><span style="display: table-cell;
width: 5%;">
                                                                    <p class="rate-percentage">Suppr</p>
                                                                    <h6 class="mdi mdi-menu-down"><?php $countt = DB::connection('mysql')->table('groupes')

                                                                        ->where('groupes.actif_supprime', 'supprimé')
                                                                        ->distinct()
                                                                        ->count('groupes.id_groupe');
                                                                    echo $countt;
                                                                    ?></h6>

                                                                </span>


                                                            </div>

                                                            <div class="d-none d-md-block"
                                                                style="display: table;
width: 10%;transform: translateY(-7px)">
                                                                <h6 class="statistics-title">Type </h6>
                                                                <span style="display: table-cell;
width: 5%;">
                                                                    <p class="rate-percentage">Privée</p>
                                                                    <h6 class="mdi mdi-menu-down"><?php $countt = DB::connection('mysql')->table('groupes')

                                                                        ->where('groupes.type', 'privé')
                                                                        ->distinct()
                                                                        ->count('groupes.id_groupe');
                                                                    echo $countt;
                                                                    ?></h6>

                                                                </span><span style="display: table-cell;
width: 5%;">
                                                                    <p class="rate-percentage">public</p>
                                                                    <h6 class="mdi mdi-menu-down"><?php $countt = DB::connection('mysql')->table('groupes')

                                                                        ->where('groupes.type', 'public')
                                                                        ->distinct()
                                                                        ->count('groupes.id_groupe');
                                                                    echo $countt;
                                                                    ?></h6>

                                                                </span>


                                                            </div>
                                                            <div class="d-none d-md-block"
                                                                style="display: table;
width: 10%;transform: translateY(-7px);">
                                                                <h6 class="statistics-title">Statut relevé </h6>
                                                                <span style="display: table-cell;
width: 5%;">
                                                                    <p class="rate-percentage">scrappé</p>
                                                                    <h6 class="mdi mdi-menu-down"><?php $countt = DB::connection('mysql')->table('groupes')

                                                                        ->where('groupes.statut_releve', 'scrappé')
                                                                        ->distinct()
                                                                        ->count('groupes.id_groupe');
                                                                    echo $countt;
                                                                    ?></h6>

                                                                </span><span style="display: table-cell;
width: 5%;">
                                                                    <p class="rate-percentage">Jarvee</p>
                                                                    <h6 class="mdi mdi-menu-down"><?php $countt = DB::connection('mysql')->table('groupes')

                                                                        ->where('groupes.statut_releve', 'Jarvee')
                                                                        ->distinct()
                                                                        ->count('groupes.id_groupe');
                                                                    echo $countt;
                                                                    ?></h6>

                                                                </span>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-8 d-flex flex-column">
                                                        <div class="row flex-grow">
                                                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                                <div class="card card-rounded">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="d-sm-flex justify-content-between align-items-start">
                                                                            <div>
                                                                                <h4 class="card-title card-title-dash">
                                                                                    Statistiques des groupes
                                                                                </h4>
                                                                                <h6
                                                                                    class="card-subtitle card-subtitle-dash">
                                                                                    Lorem Ipsum is
                                                                                    simply dummy text of the printing</h6>
                                                                                <br>
                                                                                <br>
                                                                                <p>Nombres de groupes privée</p>
                                                                            </div>
                                                                            <div id="performance-line-legend"></div>
                                                                        </div>
                                                                        <div class="chartjs-wrapper mt-5">
                                                                            <canvas id="performaneLine"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 d-flex flex-column">
                                                        <div class="row flex-grow">
                                                            <div class="col-12 grid-margin stretch-card">
                                                                <div class="card card-rounded">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div
                                                                                    class="d-flex justify-content-between align-items-center mb-3">
                                                                                    <div>
                                                                                        <h4
                                                                                            class="card-title card-title-dash">
                                                                                            Statut d'intégration </h4>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mt-3">
                                                                                    <div
                                                                                        class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                                        <div class="d-flex">

                                                                                            <div class="wrapper ms-3">
                                                                                                <p
                                                                                                    class="ms-1 mb-1 fw-bold">
                                                                                                    nouveau groupe</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-muted text-small">
                                                                                            <?php $countt = DB::connection('mysql')->table('groupes')

                                                                                                ->where('groupes.statut_integration', 'nouveau groupe')
                                                                                                ->distinct()
                                                                                                ->count('groupes.id_groupe');
                                                                                            echo $countt;
                                                                                            ?> groupe
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                                        <div class="d-flex">

                                                                                            <div class="wrapper ms-3">
                                                                                                <p
                                                                                                    class="ms-1 mb-1 fw-bold">
                                                                                                    nouveau membre</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-muted text-small">
                                                                                            <?php $countt = DB::connection('mysql')->table('groupes')

                                                                                                ->where('groupes.statut_integration', 'nouveau membre')
                                                                                                ->distinct()
                                                                                                ->count('groupes.id_groupe');
                                                                                            echo $countt;
                                                                                            ?> groupe
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                                        <div class="d-flex">

                                                                                            <div class="wrapper ms-3">
                                                                                                <p
                                                                                                    class="ms-1 mb-1 fw-bold">
                                                                                                    adhésion demandée</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-muted text-small">
                                                                                            <?php $countt = DB::connection('mysql')->table('groupes')

                                                                                                ->where('groupes.statut_integration', 'adhésion demandée')
                                                                                                ->distinct()
                                                                                                ->count('groupes.id_groupe');
                                                                                            echo $countt;
                                                                                            ?> groupe
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                                        <div class="d-flex">

                                                                                            <div class="wrapper ms-3">
                                                                                                <p
                                                                                                    class="ms-1 mb-1 fw-bold">
                                                                                                    Hors cible </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-muted text-small">
                                                                                            <?php $countt = DB::connection('mysql')->table('groupes')

                                                                                                ->where('groupes.statut_integration', 'Hors cible')
                                                                                                ->distinct()
                                                                                                ->count('groupes.id_groupe');
                                                                                            echo $countt;
                                                                                            ?> groupe
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top : 30px">
                                                    <div class="col-12 col-lg-6 col-xxl-9 d-flex"
                                                        style="margin-top : 30px">
                                                        <div class="card flex-fill">
                                                            <div class="card-header">
                                                                <h5 class="card-title mb-0">Tag recherché</h5>
                                                            </div>
                                                            <table class="table table-hover my-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th class="d-none d-xl-table-cell">Nombre de groupe
                                                                        </th>

                                                                    </tr>
                                                                </thead> <?php
                                                                $countt = DB::connection('mysql')->table('groupes')

                                                                    ->wherenotnull('groupes.tag_recherche')
                                                                    ->distinct()
                                                                    ->get('groupes.tag_recherche');
                                                                ?>
                                                                @foreach ($countt as $key => $tag_recherche)
                                                                    <tr>

                                                                        <td class="d-none d-xl-table-cell">
                                                                            {{ $tag_recherche->tag_recherche }}</td>

                                                                        <td class="d-none d-xl-table-cell">

                                                                            <?php $tag_recherche = DB::connection('mysql')->select('SELECT count(id_groupe)   FROM `groupes` WHERE tag_recherche  is not null ');
                                                                            $tag_recherche = json_decode(json_encode($tag_recherche), true);
                                                                            $countt = DB::connection('mysql')->table('groupes')

                                                                                ->wherenotnull('groupes.tag_recherche', '')
                                                                                ->distinct()
                                                                                ->count('groupes.id_groupe', $tag_recherche);
                                                                            echo $countt;
                                                                            ?>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>



                                                    <!-- partial -->
                                                    <div class="main-panel">
                                                        <div style="border-bottom: 3px solid #111;margin-top: 50px;">
                                                        </div>
                                                        <h1 style="margin-bottom : 40px">Dashboard Groupes</h1>
                                                        <div class="content-wrapper">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="home-tab">
                                                                        <div class="tab-content tab-content-basic">
                                                                            <div class="tab-pane fade show active"
                                                                                id="overview" role="tabpanel"
                                                                                aria-labelledby="overview">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div
                                                                                            class="statistics-details d-flex align-items-center justify-content-between">
                                                                                            <div>
                                                                                                <p
                                                                                                    class="statistics-title">
                                                                                                    Groupe avec ambassadeur
                                                                                                </p>
                                                                                                <h3
                                                                                                    class="rate-percentage">
                                                                                                    <?php $countt = DB::connection('mysql')->table('groupes')
                                                                                                        ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                                                                        ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                                                                        ->whereNotNull('ambassadeur_groupe.id_ambassadeur')
                                                                                                        ->distinct()
                                                                                                        ->count('groupes.id_groupe');
                                                                                                    echo $countt; ?>
                                                                                                </h3>
                                                                                                <p
                                                                                                    class="text-info d-flex">
                                                                                                    <a
                                                                                                        href="">(Consulter)</a>
                                                                                                </p>
                                                                                            </div>

                                                                                            <div>
                                                                                                <p
                                                                                                    class="statistics-title">
                                                                                                    Groupe sans ambassadeur
                                                                                                </p>
                                                                                                <h3
                                                                                                    class="rate-percentage">
                                                                                                    <?php $countt = DB::connection('mysql')->table('groupes')
                                                                                                        ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                                                                        ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                                                                        ->whereNull('ambassadeur_groupe.id_ambassadeur')
                                                                                                        ->distinct()
                                                                                                        ->count('groupes.id_groupe');
                                                                                                    echo $countt; ?>
                                                                                                </h3>
                                                                                                <p
                                                                                                    class="text-info d-flex">
                                                                                                    <a
                                                                                                        href="">(Consulter)</a>
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p
                                                                                                    class="statistics-title">
                                                                                                    Groupe sans
                                                                                                    segmentation</p>
                                                                                                <h3
                                                                                                    class="rate-percentage">
                                                                                                    <?php $countt = DB::connection('mysql')->table('groupes')
                                                                                                        ->select('groupes.nom')
                                                                                                        ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                                                                        ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                                                                        ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                                                                                        ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                                                                                        ->whereNull('segements.id_segment')
                                                                                                        ->distinct()
                                                                                                        ->count('groupes.id_groupe');
                                                                                                    echo $countt; ?>
                                                                                                </h3>
                                                                                                <p
                                                                                                    class="text-info d-flex">
                                                                                                    <a
                                                                                                        href="">(Consulter)</a>
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="d-none d-md-block">
                                                                                                <p
                                                                                                    class="statistics-title">
                                                                                                    Groupe avec segment</p>
                                                                                                <h3
                                                                                                    class="rate-percentage">
                                                                                                    <?php $countt = DB::connection('mysql')->table('groupes')
                                                                                                        ->select('groupes.nom')
                                                                                                        ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                                                                        ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                                                                        ->leftjoin('segment_groupe', 'groupes.id_groupe', '=', 'segment_groupe.id_groupe')
                                                                                                        ->leftjoin('segements', 'segment_groupe.id_segment', '=', 'segements.id_segment')
                                                                                                        ->whereNotNull('segements.id_segment')
                                                                                                        ->distinct()
                                                                                                        ->count('groupes.id_groupe');
                                                                                                    echo $countt; ?>
                                                                                                </h3>
                                                                                                <p
                                                                                                    class="text-info d-flex">
                                                                                                    <a
                                                                                                        href="">(Consulter)</a>
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="d-none d-md-block">
                                                                                                <p
                                                                                                    class="statistics-title">
                                                                                                    New
                                                                                                    Sessions</p>
                                                                                                <h3
                                                                                                    class="rate-percentage">
                                                                                                    68.8</h3>
                                                                                                <p
                                                                                                    class="text-info d-flex">
                                                                                                    <a
                                                                                                        href="">(Consulter)</a>
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="d-none d-md-block">
                                                                                                <p
                                                                                                    class="statistics-title">
                                                                                                    Avg. Time on Site</p>
                                                                                                <h3
                                                                                                    class="rate-percentage">
                                                                                                    2m:35s</h3>
                                                                                                <p
                                                                                                    class="text-info d-flex">
                                                                                                    <a
                                                                                                        href="">(Consulter)</a>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-lg-8 d-flex flex-column">
                                                                                        <div class="row flex-grow">
                                                                                            <div
                                                                                                class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                                                                <div
                                                                                                    class="card card-rounded">
                                                                                                    <div class="card-body">
                                                                                                        <div
                                                                                                            class="d-sm-flex justify-content-between align-items-start">
                                                                                                            <div>
                                                                                                                <h4
                                                                                                                    class="card-title card-title-dash">
                                                                                                                    Statistiques
                                                                                                                    des
                                                                                                                    groupes
                                                                                                                </h4>
                                                                                                                <h6
                                                                                                                    class="card-subtitle card-subtitle-dash">
                                                                                                                    Lorem
                                                                                                                    Ipsum
                                                                                                                    is
                                                                                                                    simply
                                                                                                                    dummy
                                                                                                                    text
                                                                                                                    of the
                                                                                                                    printing
                                                                                                                </h6>
                                                                                                                <br>
                                                                                                                <br>
                                                                                                                <p>Nombres
                                                                                                                    de
                                                                                                                    groupes
                                                                                                                    privée
                                                                                                                </p>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                id="performance-line-legend">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="chartjs-wrapper mt-5">
                                                                                                            <canvas
                                                                                                                id="performaneLine"></canvas>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-lg-4 d-flex flex-column">
                                                                                        <div class="row flex-grow">
                                                                                            <div
                                                                                                class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                                                                <div
                                                                                                    class="card bg-primary card-rounded">
                                                                                                    <div
                                                                                                        class="card-body pb-0">
                                                                                                        <h4
                                                                                                            class="card-title card-title-dash text-white mb-4">
                                                                                                            Status Summary
                                                                                                        </h4>
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            <div
                                                                                                                class="col-sm-4">
                                                                                                                <p
                                                                                                                    class="status-summary-ight-white mb-1">
                                                                                                                    Closed
                                                                                                                    Value
                                                                                                                </p>
                                                                                                                <h2
                                                                                                                    class="text-info">
                                                                                                                    357</h2>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-sm-8">
                                                                                                                <div
                                                                                                                    class="status-summary-chart-wrapper pb-4">
                                                                                                                    <canvas
                                                                                                                        id="status-summary"></canvas>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                                                                <div
                                                                                                    class="card card-rounded">
                                                                                                    <div class="card-body">
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            <div
                                                                                                                class="col-sm-6">
                                                                                                                <div
                                                                                                                    class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                                                                                                    <div
                                                                                                                        class="circle-progress-width">
                                                                                                                        <div id="totalVisitors"
                                                                                                                            class="progressbar-js-circle pr-2">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        <p
                                                                                                                            class="text-small mb-2">
                                                                                                                            Total
                                                                                                                            Visitors
                                                                                                                        </p>
                                                                                                                        <h4
                                                                                                                            class="mb-0 fw-bold">
                                                                                                                            26.80%
                                                                                                                        </h4>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-sm-6">
                                                                                                                <div
                                                                                                                    class="d-flex justify-content-between align-items-center">
                                                                                                                    <div
                                                                                                                        class="circle-progress-width">
                                                                                                                        <div id="visitperday"
                                                                                                                            class="progressbar-js-circle pr-2">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        <p
                                                                                                                            class="text-small mb-2">
                                                                                                                            Visits
                                                                                                                            per
                                                                                                                            day
                                                                                                                        </p>
                                                                                                                        <h4
                                                                                                                            class="mb-0 fw-bold">
                                                                                                                            9065
                                                                                                                        </h4>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row"
                                                                                    style="margin-top : 30px">
                                                                                    <div class="col-12 col-lg-6 col-xxl-9 d-flex"
                                                                                        style="margin-top : 30px">
                                                                                        <div class="card flex-fill">
                                                                                            <div class="card-header">
                                                                                                <h5
                                                                                                    class="card-title mb-0">
                                                                                                    Groupes avec
                                                                                                    ambassadeurs</h5>
                                                                                            </div>
                                                                                            <table
                                                                                                class="table table-hover my-0">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Name</th>
                                                                                                        <th
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            Start
                                                                                                            Date</th>
                                                                                                        <th
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            End Date
                                                                                                        </th>
                                                                                                        <th>Status</th>
                                                                                                        <th
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Assignee
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td>Project Apollo
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Vanessa
                                                                                                            Tucker</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Fireball
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-danger">Cancelled</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Hades
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Sharon
                                                                                                            Lessman</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Nitro
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-warning">In
                                                                                                                progress</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Vanessa
                                                                                                            Tucker</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Phoenix
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project X</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Sharon
                                                                                                            Lessman</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Romeo
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Christina Mason
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Wombat
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-warning">In
                                                                                                                progress</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-lg-6 col-xxl-9 d-flex"
                                                                                        style="margin-top : 30px">
                                                                                        <div class="card flex-fill">
                                                                                            <div class="card-header">
                                                                                                <h5
                                                                                                    class="card-title mb-0">
                                                                                                    Groupes sans
                                                                                                    ambassadeurs</h5>
                                                                                            </div>
                                                                                            <table
                                                                                                class="table table-hover my-0">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Name</th>
                                                                                                        <th
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            Start
                                                                                                            Date</th>
                                                                                                        <th
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            End Date
                                                                                                        </th>
                                                                                                        <th>Status</th>
                                                                                                        <th
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Assignee
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td>Project Apollo
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Vanessa
                                                                                                            Tucker</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Fireball
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-danger">Cancelled</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Hades
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Sharon
                                                                                                            Lessman</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Nitro
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-warning">In
                                                                                                                progress</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Vanessa
                                                                                                            Tucker</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Phoenix
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project X</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Sharon
                                                                                                            Lessman</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Romeo
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Christina Mason
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Wombat
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-warning">In
                                                                                                                progress</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-lg-6 col-xxl-9 d-flex"
                                                                                        style="margin-top : 30px">
                                                                                        <div class="card flex-fill">
                                                                                            <div class="card-header">
                                                                                                <h5
                                                                                                    class="card-title mb-0">
                                                                                                    Groupes avec
                                                                                                    segmentations</h5>
                                                                                            </div>
                                                                                            <table
                                                                                                class="table table-hover my-0">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Name</th>
                                                                                                        <th
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            Start
                                                                                                            Date</th>
                                                                                                        <th
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            End Date
                                                                                                        </th>
                                                                                                        <th>Status</th>
                                                                                                        <th
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Assignee
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td>Project Apollo
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Vanessa
                                                                                                            Tucker</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Fireball
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-danger">Cancelled</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Hades
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Sharon
                                                                                                            Lessman</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Nitro
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-warning">In
                                                                                                                progress</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Vanessa
                                                                                                            Tucker</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Phoenix
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project X</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Sharon
                                                                                                            Lessman</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Romeo
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Christina Mason
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Wombat
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-warning">In
                                                                                                                progress</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-lg-6 col-xxl-9 d-flex"
                                                                                        style="margin-top : 30px">
                                                                                        <div class="card flex-fill">
                                                                                            <div class="card-header">
                                                                                                <h5
                                                                                                    class="card-title mb-0">
                                                                                                    Groupe sans
                                                                                                    segmentations</h5>
                                                                                            </div>
                                                                                            <table
                                                                                                class="table table-hover my-0">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Name</th>
                                                                                                        <th
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            Start
                                                                                                            Date</th>
                                                                                                        <th
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            End Date
                                                                                                        </th>
                                                                                                        <th>Status</th>
                                                                                                        <th
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Assignee
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td>Project Apollo
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Vanessa
                                                                                                            Tucker</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Fireball
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-danger">Cancelled</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Hades
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Sharon
                                                                                                            Lessman</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Nitro
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-warning">In
                                                                                                                progress</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Vanessa
                                                                                                            Tucker</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Phoenix
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project X</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Sharon
                                                                                                            Lessman</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Romeo
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-success">Done</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            Christina Mason
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Project Wombat
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            01/01/2021</td>
                                                                                                        <td
                                                                                                            class="d-none d-xl-table-cell">
                                                                                                            31/06/2021</td>
                                                                                                        <td><span
                                                                                                                class="badge bg-warning">In
                                                                                                                progress</span>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="d-none d-md-table-cell">
                                                                                                            William
                                                                                                            Harris</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
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
#M1{
    background-color: #747474;
}


</style>
@endsection
