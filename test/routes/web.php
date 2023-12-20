<?php
// ressviews

use App\Http\Controllers\SegementController;
use App\Http\Controllers\SegementationController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\GroupesansambassadeurController;
use App\Http\Controllers\GroupeavecambassadeurController;
use App\Http\Controllers\GroupeavecsegmentationController;
use App\Http\Controllers\GroupesanssegmentationController;
use App\Http\Controllers\GroupesanssegmentController;
use App\Http\Controllers\QuestionadController;
use App\Http\Controllers\AdhmanuelleController;

//getviews
use App\Http\Controllers\PubliergroupeController;
use App\Http\Controllers\PartagepublicationsController;
use App\Http\Controllers\CherchepublicationsController;
use App\Http\Controllers\EngagementsController;
use App\Http\Controllers\InsightpostController;
use App\Http\Controllers\InsightpageController;
use App\Http\Controllers\ReleveinfoController;
use App\Http\Controllers\AdhesionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RelevecentController;
use App\Http\Controllers\RecherchegroupeController;
use App\Http\Controllers\PostsdashboardController;
use App\Http\Controllers\SegmentsdashboardController;
use App\Http\Controllers\WelcomedashboardController;
use App\Http\Controllers\OnboardgroupeController;
use App\Http\Controllers\OptimisationactiviteController;
use App\Http\Controllers\DashboardrequalificationgroupeController;

//Campagnes
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\CampagnesdashboardController;
use App\Http\Controllers\AnalysecampagneController;
use App\Http\Controllers\ProcesscampagneController;
use App\Http\Controllers\GroupecampagneController;

Route::get('/analysecampagne', [App\Http\Controllers\AnalysecampagneController::class, 'index'])->name('analysecampagne');
Route::get('/processcampagne', [App\Http\Controllers\ProcesscampagneController::class, 'index'])->name('processcampagne');
Route::get('/campagnesdashboard', [App\Http\Controllers\CampagnesdashboardController::class, 'index'])->name('campagnesdashboard');
Route::resource('campagnes', CampagneController::class);
Route::resource('groupecampagnes', GroupecampagneController::class);

//Posts
use App\Http\Controllers\PostMereController;
use App\Http\Controllers\PostPartageController;
use App\Http\Controllers\PostGroupeController;
use App\Http\Controllers\DashboardpostmereController;
use App\Http\Controllers\DashboardpostpartageController;
use App\Http\Controllers\DashboardpostgroupeController;
Route::get('/dashboardpostmere', [App\Http\Controllers\DashboardpostmereController::class, 'index'])->name('dashboardpostmere');
Route::get('/dashboardpostpartage', [App\Http\Controllers\DashboardpostpartageController::class, 'index'])->name('dashboardpostpartage');
Route::get('/dashboardpostgroupe', [App\Http\Controllers\DashboardpostgroupeController::class, 'index'])->name('dashboardpostgroupe');
Route::resource('postmeres', PostMereController::class);
Route::resource('postpartages', PostPartageController::class);
Route::resource('postgroupes', PostGroupeController::class);

// User
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\DashboarduserController;
use App\Http\Controllers\DashboardaudiencegroupeController;
use App\Http\Controllers\DashboardlalachanteengageController;
Route::resource('utilisateurs', UtilisateurController::class);
Route::get('/dashboarduser', [App\Http\Controllers\DashboarduserController::class, 'index'])->name('dashboarduser');
Route::get('/dashboardaudiencegroupe', [App\Http\Controllers\DashboardaudiencegroupeController::class, 'index'])->name('dashboardaudiencegroupe');
Route::get('/dashboardlalachanteengage', [App\Http\Controllers\DashboardlalachanteengageController::class, 'index'])->name('dashboardlalachanteengage');

// Performance
use App\Http\Controllers\GroupeperformanceController;
use App\Http\Controllers\CampagneperformanceController;
use App\Http\Controllers\SegmentperformanceController;
use App\Http\Controllers\SegmentationperformanceController;
use App\Http\Controllers\TeamperformanceController;
use App\Http\Controllers\AmbassadeurperformanceController;
Route::get('/groupeperformance', [App\Http\Controllers\GroupeperformanceController::class, 'index'])->name('groupeperformance');
Route::get('/campagneperformance', [App\Http\Controllers\CampagneperformanceController::class, 'index'])->name('campagneperformance');
Route::get('/segmentperformance', [App\Http\Controllers\SegmentperformanceController::class, 'index'])->name('segmentperformance');
Route::get('/segmentationperformance', [App\Http\Controllers\SegmentationperformanceController::class, 'index'])->name('segmentationperformance');
Route::get('/teamperformance', [App\Http\Controllers\TeamperformanceController::class, 'index'])->name('teamperformance');
Route::get('/ambassadeurperformance', [App\Http\Controllers\AmbassadeurperformanceController::class, 'index'])->name('ambassadeurperformance');

// Data Analyse
use App\Http\Controllers\AnalysetagsController;
Route::get('/analysetags', [App\Http\Controllers\AnalysetagsController::class, 'index'])->name('analysetags');

// Stratégie
use App\Http\Controllers\AmbassadeurController;
use App\Http\Controllers\DashboardstrategieController;
use App\Http\Controllers\PlanificationcampagnesController;
Route::resource('ambassadeurs', AmbassadeurController::class);
Route::get('/dashboardstrategie', [App\Http\Controllers\DashboardstrategieController::class, 'index'])->name('dashboardstrategie');
Route::get('/planificationcampagnes', [App\Http\Controllers\PlanificationcampagnesController::class, 'index'])->name('planificationcampagnes');


// Administration
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\AdministrationlistesController;
Route::resource('users', UserController::class);
Route::get('/administrationlistes', [App\Http\Controllers\AdministrationlistesController::class, 'index'])->name('administrationlistes');
Route::get('/crud', [App\Http\Controllers\CrudController::class, 'index'])->name('crud');







//Auth
Auth::routes();

// Ressource
Route::resource('segements', SegementController::class);
Route::resource('segementations', SegementationController::class);

Route::resource('deleteseg', SegementationController::class);
Route::resource('groupes', GroupeController::class);
Route::resource('groupesansambassadeurs', GroupesansambassadeurController::class);
Route::resource('groupeavecambassadeurs', GroupeavecambassadeurController::class);
Route::resource('groupeavecsegmentations', GroupeavecsegmentationController::class);
Route::resource('groupesanssegmentations', GroupesanssegmentationController::class);
Route::resource('groupesanssegments', GroupesanssegmentController::class);
Route::resource('questionads', QuestionadController::class);
Route::resource('adhmanuelles', AdhmanuelleController::class);


// Get
Route::get('logout', '\App\Http\Controllers\auth\LoginController@logout');
Route::get('/', function () { return view('auth/login'); });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ambassadeurs
Route::get('ambassadeurs', [AmbassadeurController::class, 'getAll'])->name('ambassadeurs');

// groupes
Route::get('groupeavecambassadeurs', [GroupeavecambassadeurController::class, 'getAllAvecAmb'])->name('groupeavecambassadeurs');
Route::get('groupesansambassadeurs', [GroupesansambassadeurController::class, 'getAllSansAmb'])->name('groupesansambassadeurs');
Route::get('groupeavecsegmentations', [GroupeavecsegmentationController::class, 'getAllAvecSeg'])->name('groupeavecsegmentations');
//Route::get('subindex', [GroupeavecsegmentationController::class, 'subindex'])->name('subindex');

//Route::get('groupecampagnes', [GroupecampagneController::class, 'getcampagnes'])->name('groupecampagnes');



// Segment + segmentation
Route::get('segements', [SegementController::class, 'getAllSegment'])->name('segements');
Route::get('segements.show/{id_segment}', [SegementController::class,'show'])->name('segements.show');
Route::get('segements', [SegementController::class,'store'])->name('segements');
Route::get('segements', [SegementController::class, 'getAllSegment'])->name('segements');
Route::get('segementations', [SegementationController::class, 'getAllSegmentation'])->name('segementations');
Route::any('segementationsDelete/{id}', [SegementationController::class, 'delete'])->name('segementationsDelete');
Route::any('deleteAmbassadeur/{id}', [AmbassadeurController::class, 'deleteAmbassadeur'])->name('deleteAmbassadeur');
Route::any('deleteSegment/{id}', [SegementController::class, 'deleteSegment'])->name('deleteSegment');
Route::any('cherchSeg/{id}', [GroupecampagneController::class, 'cherchSeg'])->name('cherchSeg');

Route::get('groupesanssegmentations', [GroupesanssegmentationController::class, 'getAllSansSegmentation'])->name('groupesanssegmentations');
//nouveau : 

// Adhésion
Route::get('adhmanuelles', [AdhmanuelleController::class, 'getAll_adh'])->name('adhmanuelles');
Route::get('questionads', [QuestionadController::class, 'getAll_quad'])->name('questionads');
Route::get('segements.show/{id_segment}', [SegementController::class,'show'])->name('segements.show');
Route::get('segements.show/{id_segment}', [SegementController::class,'show'])->name('segements.show');

Route::get('/searchsegment', [App\Http\Controllers\SegementController::class, 'searchsegment'])->name('searchsegment');
Route::get('/multisearch', [App\Http\Controllers\GroupeController::class, 'multisearch'])->name('multisearch');
Route::get('/multisearch_sans_amb', [App\Http\Controllers\GroupesansambassadeurController::class, 'multisearch_sans_amb'])->name('multisearch_sans_amb');
Route::get('/multisearch_amb', [App\Http\Controllers\GroupeavecambassadeurController::class, 'multisearch_amb'])->name('multisearch_amb');
Route::get('/multisearch_utilisateurs', [App\Http\Controllers\UtilisateurController::class, 'multisearch_utilisateurs'])->name('multisearch_utilisateurs');
Route::get('/multisearch_g_s_segmentation', [App\Http\Controllers\GroupesanssegmentationController::class, 'multisearch_g_s_segmentation'])->name('multisearch_g_s_segmentation');
Route::get('/multisearch_g_a_segmentation', [App\Http\Controllers\GroupeavecsegmentationController::class, 'multisearch_g_a_segmentation'])->name('multisearch_g_a_segmentation');
Route::get('/multisearch_s_segment', [App\Http\Controllers\GroupesanssegmentController::class, 'multisearch_s_segment'])->name('multisearch_s_segment');
Route::get('/multisearch_camp', [App\Http\Controllers\CampagneController::class, 'multisearch_camp'])->name('multisearch_camp');
Route::get('/multisearch_adh', [App\Http\Controllers\AdhmanuelleController::class, 'multisearch_adh'])->name('multisearch_adh');

Route::get('/get_campagne_encours', [App\Http\Controllers\HomeController::class, 'get_campagne_encours'])->name('get_campagne_encours');
Route::get('/get_campagne_terminee', [App\Http\Controllers\HomeController::class, 'get_campagne_terminee'])->name('get_campagne_terminee');
Route::get('/get_campagne_archivee', [App\Http\Controllers\HomeController::class, 'get_campagne_archivee'])->name('get_campagne_archivee');
Route::get('/get_campagne_planifiee', [App\Http\Controllers\HomeController::class, 'get_campagne_planifiee'])->name('get_campagne_planifiee');
Route::get('/get_campagne_idee', [App\Http\Controllers\HomeController::class, 'get_campagne_idee'])->name('get_campagne_idee');


//Scripts
Route::get('/publiergroupe', [App\Http\Controllers\PubliergroupeController::class, 'index'])->name('publiergroupe');
Route::get('/partagepublications', [App\Http\Controllers\PartagepublicationsController::class, 'index'])->name('partagepublications');
Route::get('/cherchepublications', [App\Http\Controllers\CherchepublicationsController::class, 'index'])->name('cherchepublications');
Route::get('/engagements', [App\Http\Controllers\EngagementsController::class, 'index'])->name('engagements');
Route::get('/insightspost', [App\Http\Controllers\InsightpostController::class, 'index'])->name('insightspost');
Route::get('/insightspage', [App\Http\Controllers\InsightpageController::class, 'index'])->name('insightspage');
Route::get('/releveinfo', [App\Http\Controllers\ReleveinfoController::class, 'index'])->name('releveinfo');
Route::get('/adhesion', [App\Http\Controllers\AdhesionController::class, 'index'])->name('adhesion');
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications');
Route::get('/relevecentposts', [App\Http\Controllers\RelevecentController::class, 'index'])->name('relevecentposts');
Route::get('/recherchenouveauxgroupe', [App\Http\Controllers\RecherchegroupeController::class, 'index'])->name('recherchenouveauxgroupe');
Route::get('/groupesdashboard', [App\Http\Controllers\GroupesdashboardController::class, 'index'])->name('groupesdashboard');
Route::get('/segmentsdashboard', [App\Http\Controllers\SegmentsdashboardController::class, 'index'])->name('segmentsdashboard');
Route::get('/welcomedashboard', [App\Http\Controllers\WelcomedashboardController::class, 'index'])->name('welcomedashboard');
Route::get('/onboardgroupe', [App\Http\Controllers\OnboardgroupeController::class, 'index'])->name('onboardgroupe');
Route::get('/optimisationactivite', [App\Http\Controllers\OptimisationactiviteController::class, 'index'])->name('optimisationactivite');
Route::get('/dashboardrequalificationgroupe', [App\Http\Controllers\DashboardrequalificationgroupeController::class, 'index'])->name('dashboardrequalificationgroupe');

Route::delete('/deleteall', [App\Http\Controllers\UserController::class, 'deleteall'])->name('deleteall');
Route::delete('/deleteall_c', [App\Http\Controllers\CampagneController::class, 'deleteall_c'])->name('deleteall_c');
Route::delete('/deleteall_g', [App\Http\Controllers\GroupeController::class, 'deleteall_g'])->name('deleteall_g');
//Route::get('/deleteseg/{id_segmentation}', [App\Http\Controllers\SegementationController::class, 'deleteseg'])->name('deleteseg');
//new route 
Route::get('delete/{id}',[App\Http\Controllers\SegementationController::class,'delete'])->name('delete');
Route::get('delete/{id}',[App\Http\Controllers\AmbassadeurController::class,'delete'])->name('delete');