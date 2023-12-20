
@extends('layouts.navadmin')
@section('content')
    <!-- partial -->
    <div class="main-panel">

        <h1 style="margin-bottom : 40px">Dashboard Campagnes</h1>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-12">
                                            <div
                                                class="statistics-details d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="statistics-title">toutale campagne </p>


                                                    <h3 class="rate-percentage"><?php
                                                    use Illuminate\Support\Facades\DB; 
                                                    $countt = DB::connection('mysql')->table('campagnes')

                                        ->distinct()
                                        ->count('campagnes.id_campagne');
                                    echo $countt;
                                    ?></h3>
                                                    <p class="text-danger d-flex"><i
                                                            class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                                                </div>
                                                <div>
                                                    <p class="statistics-title">campagne groupe </p>
                                                    <h3 class="rate-percentage"><?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                        ->distinct()
                                        ->count('campagne_groupe.id_groupe');
                                    echo $countt;
                                    ?></h3>
                                                    <p class="text-success d-flex"><i
                                                            class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                                                </div>
                                                 <div class="d-none d-md-block"
                                                                style="display: table;
width: 10%;transform: translateY(-7px)">
                                                                <h6 class="statistics-title">traitement_publication </h6>
                                                                <span style="display: table-cell;
width: 5%;">
                                                                    <p class="rate-percentage">manuel</p>
                                                                    <h6 class="mdi mdi-menu-down"><?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.traitement_publication', 'manuel')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?></h6>

                                                                </span><span style="display: table-cell;
width: 5%;">
                                                                    <p class="rate-percentage">automatique</p>
                                                                    <h6 class="mdi mdi-menu-down"><?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.traitement_publication', 'automatique')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?></h6>

                                                                </span>


                                                            </div>
                                                <div>
                                                    <p class="statistics-title">campagne groupe </p>
                                                    <h3 class="rate-percentage">{{ 2 }}</h3>
                                                    <p class="text-success d-flex"><i
                                                            class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="row flex-grow">
                                                <div class="col-12 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center mb-3">
                                                                        <div>
                                                                            <h4 class="card-title card-title-dash">
                                                                                statut_publication </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        posté</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_publication', 'posté')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        non posté</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                                               <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_publication', 'non posté')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        non trouvé</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                       <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_publication', 'non trouvé')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        Blacklist </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                    <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_publication', 'Blacklist')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        En attente</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                               <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_publication', 'En attente')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        No seg 2 </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                    <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_publication', 'No seg 2')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        select </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                                <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_publication', 'select')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        Blacklist Dout</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                              <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_publication', 'select')

                                                                                    ->count('campagne_groupe.id_groupe');
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
                                            <div class="row flex-grow">
                                                <div class="col-12 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center mb-3">
                                                                        <div>
                                                                            <h4 class="card-title card-title-dash">
                                                                               statut_recherche </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                       cherché</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_recherche', 'cherché')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        trouvé</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_recherche', 'trouvé')

                                                                                    ->count('campagne_groupe.id_groupe');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        non cherché</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                <?php $countt = DB::connection('mysql')->table('campagne_groupe')

                                                                                    ->where('campagne_groupe.statut_recherche', 'non cherché')

                                                                                    ->count('campagne_groupe.id_groupe');
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
                                             <div class="row flex-grow">
                                                <div class="col-12 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center mb-3">
                                                                        <div>
                                                                            <h4 class="card-title card-title-dash">
                                                                               etat</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                      Terminée</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                <?php $countt = DB::connection('mysql')->table('campagnes')

                                                                                    ->where('campagnes.etat', 'Terminée')

                                                                                    ->count('campagnes.id_campagne');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                        Idée</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                <?php $countt = DB::connection('mysql')->table('campagnes')

                                                                                    ->where('campagnes.etat', 'Idée')

                                                                                    ->count('campagnes.id_campagne');
                                                                                echo $countt;
                                                                                ?> groupe
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                            <div class="d-flex">

                                                                                <div class="wrapper ms-3">
                                                                                    <p class="ms-1 mb-1 fw-bold">
                                                                                       Archivée</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted text-small">
                                                                                <?php $countt = DB::connection('mysql')->table('campagnes')

                                                                                    ->where('campagnes.etat', 'Archivée')

                                                                                    ->count('campagnes.id_campagne');
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
                                    </div>
                                </div>

                            </div>
                            <!-- partial -->
                            <div class="main-panel">
                                <div style="border-bottom: 3px solid #111;margin-top: 50px;"> </div>
                                <h1 style="margin-bottom : 40px">Dashboard Campagnes</h1>
                                <div class="content-wrapper">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="home-tab">
                                                <div class="tab-content tab-content-basic">
                                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                                        aria-labelledby="overview">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div
                                                                    class="statistics-details d-flex align-items-center justify-content-between">
                                                                    <div>
                                                                        <p class="statistics-title">Nombres de
                                                                            campagnes</p>
                                                                        <h3 class="rate-percentage"><?php $countt = DB::connection('mysql')->table('campagnes')->count();
                                                                        echo $countt; ?>
                                                                        </h3>
                                                                        <p class="text-info d-flex"><a
                                                                                href="/campagnes">(Consulter)</a></p>
                                                                    </div>

                                                                    <div>
                                                                        <p class="statistics-title">Liste des X</p>
                                                                        <h3 class="rate-percentage">non renseigné</h3>
                                                                        <p class="text-info d-flex"><a
                                                                                href="">(Consulter)</a></p>
                                                                    </div>
                                                                    <div>
                                                                        <p class="statistics-title">Liste des Y</p>
                                                                        <h3 class="rate-percentage">non renseigné </h3>
                                                                        <p class="text-info d-flex"><a
                                                                                href="">(Consulter)</a></p>
                                                                    </div>
                                                                    <div class="d-none d-md-block">
                                                                        <p class="statistics-title">Liste des Z</p>
                                                                        <h3 class="rate-percentage">non renseigné </h3>
                                                                        <p class="text-info d-flex"><a
                                                                                href="">(Consulter)</a></p>
                                                                    </div>
                                                                    <div class="d-none d-md-block">
                                                                        <p class="statistics-title">New Sessions</p>
                                                                        <h3 class="rate-percentage">68.8</h3>
                                                                        <p class="text-info d-flex"><a
                                                                                href="">(Consulter)</a></p>
                                                                    </div>
                                                                    <div class="d-none d-md-block">
                                                                        <p class="statistics-title">Avg. Time on Site
                                                                        </p>
                                                                        <h3 class="rate-percentage">2m:35s</h3>
                                                                        <p class="text-info d-flex"><a
                                                                                href="">(Consulter)</a></p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-8 d-flex flex-column">
                                                                <div class="row flex-grow">
                                                                    <div
                                                                        class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                                        <div class="card card-rounded">
                                                                            <div class="card-body">
                                                                                <div
                                                                                    class="d-sm-flex justify-content-between align-items-start">
                                                                                    <div>
                                                                                        <h4
                                                                                            class="card-title card-title-dash">
                                                                                            Statistiques des campagnes
                                                                                        </h4>
                                                                                        <h6
                                                                                            class="card-subtitle card-subtitle-dash">
                                                                                            Lorem Ipsum is simply dummy
                                                                                            text of the printing</h6>
                                                                                        <br>
                                                                                        <br>
                                                                                        <p>Nombres de groupes privée</p>
                                                                                    </div>
                                                                                    <div id="performance-line-legend">
                                                                                    </div>
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
                                                                    <div
                                                                        class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                                        <div class="card bg-primary card-rounded">
                                                                            <div class="card-body pb-0">
                                                                                <h4
                                                                                    class="card-title card-title-dash text-white mb-4">
                                                                                    Status Summary</h4>
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <p
                                                                                            class="status-summary-ight-white mb-1">
                                                                                            Closed Value</p>
                                                                                        <h2 class="text-info">357</h2>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
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
                                                                        <div class="card card-rounded">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="col-sm-6">
                                                                                        <div
                                                                                            class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                                                                            <div
                                                                                                class="circle-progress-width">
                                                                                                <div id="totalVisitors"
                                                                                                    class="progressbar-js-circle pr-2">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-small mb-2">
                                                                                                    Total Visitors</p>
                                                                                                <h4 class="mb-0 fw-bold">
                                                                                                    26.80%</h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <div
                                                                                            class="d-flex justify-content-between align-items-center">
                                                                                            <div
                                                                                                class="circle-progress-width">
                                                                                                <div id="visitperday"
                                                                                                    class="progressbar-js-circle pr-2">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-small mb-2">
                                                                                                    Visits per day</p>
                                                                                                <h4 class="mb-0 fw-bold">
                                                                                                    9065</h4>
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
                                                                        <h5 class="card-title mb-0">Campagnes XXX</h5>
                                                                    </div>
                                                                    <table class="table table-hover my-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th class="d-none d-xl-table-cell">
                                                                                    Start Date</th>
                                                                                <th class="d-none d-xl-table-cell">End
                                                                                    Date</th>
                                                                                <th>Status</th>
                                                                                <th class="d-none d-md-table-cell">
                                                                                    Assignee</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Project Apollo</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Vanessa Tucker</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Fireball</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-danger">Cancelled</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Hades</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Sharon Lessman</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Nitro</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span class="badge bg-warning">In
                                                                                        progress</span></td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Vanessa Tucker</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Phoenix</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project X</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Sharon Lessman</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Romeo</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Christina Mason</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Wombat</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span class="badge bg-warning">In
                                                                                        progress</span></td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6 col-xxl-9 d-flex"
                                                                style="margin-top : 30px">
                                                                <div class="card flex-fill">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title mb-0">Campagnes YYY</h5>
                                                                    </div>
                                                                    <table class="table table-hover my-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th class="d-none d-xl-table-cell">
                                                                                    Start Date</th>
                                                                                <th class="d-none d-xl-table-cell">End
                                                                                    Date</th>
                                                                                <th>Status</th>
                                                                                <th class="d-none d-md-table-cell">
                                                                                    Assignee</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Project Apollo</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Vanessa Tucker</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Fireball</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-danger">Cancelled</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Hades</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Sharon Lessman</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Nitro</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span class="badge bg-warning">In
                                                                                        progress</span></td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Vanessa Tucker</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Phoenix</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project X</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Sharon Lessman</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Romeo</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Christina Mason</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Wombat</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span class="badge bg-warning">In
                                                                                        progress</span></td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6 col-xxl-9 d-flex"
                                                                style="margin-top : 30px">
                                                                <div class="card flex-fill">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title mb-0">Campagnes ZZZ</h5>
                                                                    </div>
                                                                    <table class="table table-hover my-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th class="d-none d-xl-table-cell">
                                                                                    Start Date</th>
                                                                                <th class="d-none d-xl-table-cell">End
                                                                                    Date</th>
                                                                                <th>Status</th>
                                                                                <th class="d-none d-md-table-cell">
                                                                                    Assignee</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Project Apollo</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Vanessa Tucker</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Fireball</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-danger">Cancelled</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Hades</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Sharon Lessman</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Nitro</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span class="badge bg-warning">In
                                                                                        progress</span></td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Vanessa Tucker</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Phoenix</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project X</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Sharon Lessman</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Romeo</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Christina Mason</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Wombat</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span class="badge bg-warning">In
                                                                                        progress</span></td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6 col-xxl-9 d-flex"
                                                                style="margin-top : 30px">
                                                                <div class="card flex-fill">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title mb-0">Campagnes FFF</h5>
                                                                    </div>
                                                                    <table class="table table-hover my-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th class="d-none d-xl-table-cell">
                                                                                    Start Date</th>
                                                                                <th class="d-none d-xl-table-cell">End
                                                                                    Date</th>
                                                                                <th>Status</th>
                                                                                <th class="d-none d-md-table-cell">
                                                                                    Assignee</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Project Apollo</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Vanessa Tucker</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Fireball</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-danger">Cancelled</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Hades</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Sharon Lessman</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Nitro</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span class="badge bg-warning">In
                                                                                        progress</span></td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Vanessa Tucker</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Phoenix</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project X</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Sharon Lessman</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Romeo</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span
                                                                                        class="badge bg-success">Done</span>
                                                                                </td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    Christina Mason</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Project Wombat</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    01/01/2021</td>
                                                                                <td class="d-none d-xl-table-cell">
                                                                                    31/06/2021</td>
                                                                                <td><span class="badge bg-warning">In
                                                                                        progress</span></td>
                                                                                <td class="d-none d-md-table-cell">
                                                                                    William Harris</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
<style>

#pageSubmenu{

visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M8{
background-color: #747474;
}
</style>
@endsection
