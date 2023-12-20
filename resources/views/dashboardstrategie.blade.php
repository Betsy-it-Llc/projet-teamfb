
@extends('layouts.navadmin')
@section('content')
    <!-- partial -->
    <div class="main-panel">
        <h1 style="margin-bottom : 40px">Dashbaord stratégie</h1>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="statistics-details d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="statistics-title">Nombres de ambassadeur </p>
                                                <h3 class="rate-percentage"><?php
                                                use Illuminate\Support\Facades\DB;
                                                $countt = DB::connection('mysql')->table('ambassadeurs')->count();
                                                echo $countt;

                                                ?> </h3>
                                                <p class="text-info d-flex"><a href="/ambassadeurs">(Consulter)</a></p>
                                            </div>

                                            <div>
                                                <p class="statistics-title">groupe avec ambassadeur </p>
                                                <h3 class="rate-percentage"><?php

                                                $countt = DB::connection('mysql')->table('groupes')
                                                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=',
                                                     'ambassadeur_groupe.id_groupe')
                                                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur',
                                                     '=', 'utilisateur.id_utilisateur')
                                                    ->whereNotNull('ambassadeur_groupe.id_ambassadeur')
                                                    ->distinct()
                                                    ->count('groupes.id_groupe');
                                                echo $countt;

                                                ?></h3>
                                                <p class="text-info d-flex"><a
                                                        href="{{ route('groupeavecambassadeurs') }}">(Consulter)</a></p>
                                            </div>
                                            <div>
                                                <p class="statistics-title">groupe sans ambassadeur</p>
                                                <h3 class="rate-percentage"><?php $countt = DB::connection('mysql')->table('groupes')
                                                    ->leftjoin('ambassadeur_groupe', 'groupes.id_groupe', '=', 'ambassadeur_groupe.id_groupe')
                                                    ->leftjoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur', '=', 'utilisateur.id_utilisateur')
                                                    ->whereNull('ambassadeur_groupe.id_ambassadeur')
                                                    ->distinct()
                                                    ->count('groupes.id_groupe');
                                                echo $countt;
                                                ?></h3>
                                                <p class="text-info d-flex"><a
                                                        href="{{ route('groupesansambassadeurs') }}">(Consulter)</a></p>
                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Liste des Z</p>
                                                <h3 class="rate-percentage">non renseigné </h3>
                                                <p class="text-info d-flex"><a href="">(Consulter)</a></p>
                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">New Sessions</p>
                                                <h3 class="rate-percentage">68.8</h3>
                                                <p class="text-info d-flex"><a href="">(Consulter)</a></p>
                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Avg. Time on Site</p>
                                                <h3 class="rate-percentage">2m:35s</h3>
                                                <p class="text-info d-flex"><a href="">(Consulter)</a></p>
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
                                                        <div class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">Statistiques des
                                                                    campagnes</h4>
                                                                <h6 class="card-subtitle card-subtitle-dash">Lorem Ipsum is
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
                                            <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                <div class="card bg-primary card-rounded">
                                                    <div class="card-body pb-0">
                                                        <h4 class="card-title card-title-dash text-white mb-4">Status
                                                            Summary</h4>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="status-summary-ight-white mb-1">Closed Value</p>
                                                                <h2 class="text-info">357</h2>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="status-summary-chart-wrapper pb-4">
                                                                    <canvas id="status-summary"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                                                    <div class="circle-progress-width">
                                                                        <div id="totalVisitors"
                                                                            class="progressbar-js-circle pr-2"></div>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-small mb-2">Total Visitors</p>
                                                                        <h4 class="mb-0 fw-bold">26.80%</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="circle-progress-width">
                                                                        <div id="visitperday"
                                                                            class="progressbar-js-circle pr-2"></div>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-small mb-2">Visits per day</p>
                                                                        <h4 class="mb-0 fw-bold">9065</h4>
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
                                    <div class="col-12 col-lg-6 col-xxl-9 d-flex" style="margin-top : 30px">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Campagnes XXX</h5>
                                            </div>
                                            <table class="table table-hover my-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="d-none d-xl-table-cell">Start Date</th>
                                                        <th class="d-none d-xl-table-cell">End Date</th>
                                                        <th>Status</th>
                                                        <th class="d-none d-md-table-cell">Assignee</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Project Apollo</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Fireball</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Hades</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Nitro</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-warning">In progress</span></td>
                                                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Phoenix</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project X</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Romeo</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Christina Mason</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Wombat</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-warning">In progress</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-xxl-9 d-flex" style="margin-top : 30px">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Campagnes YYY</h5>
                                            </div>
                                            <table class="table table-hover my-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="d-none d-xl-table-cell">Start Date</th>
                                                        <th class="d-none d-xl-table-cell">End Date</th>
                                                        <th>Status</th>
                                                        <th class="d-none d-md-table-cell">Assignee</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Project Apollo</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Fireball</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Hades</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Nitro</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-warning">In progress</span></td>
                                                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Phoenix</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project X</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Romeo</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Christina Mason</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Wombat</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-warning">In progress</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-xxl-9 d-flex" style="margin-top : 30px">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Campagnes ZZZ</h5>
                                            </div>
                                            <table class="table table-hover my-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="d-none d-xl-table-cell">Start Date</th>
                                                        <th class="d-none d-xl-table-cell">End Date</th>
                                                        <th>Status</th>
                                                        <th class="d-none d-md-table-cell">Assignee</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Project Apollo</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Fireball</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Hades</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Nitro</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-warning">In progress</span></td>
                                                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Phoenix</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project X</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Romeo</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-success">Done</span></td>
                                                        <td class="d-none d-md-table-cell">Christina Mason</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project Wombat</td>
                                                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                                                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                                                        <td><span class="badge bg-warning">In progress</span></td>
                                                        <td class="d-none d-md-table-cell">William Harris</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <style>
#pageSubmenu6{
visibility:visible;
display:block;
}
#pageSubmenu20{
    visibility:visible;
    display:block;
}
#M32{
background-color: #747474;
}
</style>
                            @endsection
