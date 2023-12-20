<?php

namespace routes;

use App\Models\Segement;
use App\Livewire\Counter;
use App\Models\Entreprise;
use App\Mail\MailBonCadeau;
use App\Livewire\Contribuer;
use App\Livewire\Information;
use App\Http\Controllers\Drive;
use App\Models\Experimentateur;
// ressviews
use App\Http\Controllers\Facture;
use App\Models\ambassadeurGroupe;
use App\Http\Controllers\Paiement;
use App\Http\Controllers\experience;
use App\Models\experienceApp\Remise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\experienceApp\Content;
use App\Models\Groupeavecambassadeur;
use Illuminate\Support\Facades\Route;
use App\Models\experienceApp\Codepromo;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackController;

//getviews
use App\Http\Controllers\produitservice;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\experienceApp\Partenaire;
use App\Http\Controllers\NotifController;
use App\Models\experienceApp\Interaction;
use App\Models\experienceApp\Intervenant;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\RemiseController;
use App\Http\Controllers\StripeController;
use App\Models\experienceApp\Storytelling;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\AdhesionController;
use App\Http\Controllers\CagnotteController;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PostMereController;
use App\Http\Controllers\SegementController;
use App\Http\Controllers\BonCadeauController;
use App\Http\Controllers\CodepromoController;
use App\Http\Controllers\ParametreController;
use App\Mail\MailConfirmationExperimentateur;
use App\Http\Controllers\Auth\LoginController;

//Campagnes
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\experienceController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostGroupeController;
use App\Http\Controllers\QuestionadController;

use App\Http\Controllers\RelevecentController;
use App\Http\Controllers\ReleveinfoController;

use App\Http\Controllers\TemporaireController;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Controllers\AdhmanuelleController;
use App\Http\Controllers\AmbassadeurController;
use App\Http\Controllers\AnalysetagsController;
use App\Http\Controllers\EngagementsController;

use App\Http\Controllers\GoogleDriveController;

use App\Http\Controllers\InsightpageController;
use App\Http\Controllers\InsightpostController;
use App\Http\Controllers\InteractionController;

use App\Http\Controllers\IntervenantController;
use App\Http\Controllers\PostPartageController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ContributeurController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\EspaceClientController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StorytellingController;

use App\Http\Controllers\DashboarduserController;
use App\Http\Controllers\OnboardgroupeController;

use App\Http\Controllers\PubliergroupeController;
use App\Http\Controllers\SegementationController;
use App\Http\Controllers\StripeWebhookController;

use App\Http\Controllers\GoogleCalendarController;

use App\Http\Controllers\GroupecampagneController;
use App\Http\Controllers\PostsdashboardController;

use App\Http\Controllers\produitserviceController;
use App\Http\Controllers\RolePermissionController;

use App\Http\Controllers\segementGroupeController;
use App\Http\Controllers\AnalysecampagneController;

use App\Http\Controllers\ExperimentateurController;
use App\Http\Controllers\ProcesscampagneController;
use App\Http\Controllers\RecherchegroupeController;
use App\Http\Controllers\TeamperformanceController;

use App\Http\Controllers\GroupesdashboardController;
use App\Http\Controllers\UtilisateurCauseController;
use App\Http\Controllers\UtilisateurLoginController;

use App\Http\Controllers\WelcomedashboardController;
use App\Http\Controllers\ambassadeurGroupeController;
use App\Http\Controllers\CagnotteCategorieController;
use App\Http\Controllers\DashboardpostmereController;

use App\Http\Controllers\FormulaireWebhookController;
use App\Http\Controllers\GroupeperformanceController;
use App\Http\Controllers\GroupesanssegmentController;
use App\Http\Controllers\ReservationclientController;
use App\Http\Controllers\SegmentsdashboardController;
use App\Http\Controllers\CampagnesdashboardController;
use App\Http\Controllers\DashboardstrategieController;
use App\Http\Controllers\SegmentperformanceController;
use App\Http\Controllers\CampagneperformanceController;

use App\Http\Controllers\CherchepublicationsController;
use App\Http\Controllers\DashboardpostgroupeController;
use App\Http\Controllers\PartagepublicationsController;


use App\Http\Controllers\UtilisateurRegisterController;
use App\Http\Controllers\AdministrationlistesController;
use App\Http\Controllers\DashboardpostpartageController;


use App\Http\Controllers\OptimisationactiviteController;
use App\Http\Controllers\UtilisateurAffichageController;
use App\Http\Controllers\UtilisateurRechercheController;
use App\Http\Controllers\UtilisateurTransfereController;

use App\Http\Controllers\GroupeavecambassadeurController;
use App\Http\Controllers\GroupesansambassadeurController;
use App\Http\Controllers\UtilisateurExperienceController;
use App\Http\Controllers\AmbassadeurperformanceController;
use App\Http\Controllers\GroupeavecsegmentationController;
use App\Http\Controllers\GroupesanssegmentationController;
use App\Http\Controllers\PlanificationcampagnesController;
use App\Http\Controllers\UtilisateurRestitutionController;
use App\Http\Controllers\controllerTest\ControllerPageTest;
use App\Http\Controllers\DashboardaudiencegroupeController;
use App\Http\Controllers\SegmentationperformanceController;
use App\Http\Controllers\UtilisateurContributionController;
use App\Http\Controllers\DashboardlalachanteengageController;
use App\Http\Controllers\UtilisateurCreationProjetController;
use App\Http\Controllers\UtilisateurAchatExperienceController;
use App\Http\Controllers\DashboardrequalificationgroupeController;
use App\Http\Controllers\utilisateurAuth\UtilisateurShowConfirmController;
use App\Http\Controllers\utilisateurAuth\UtilisateurForgotPasswordController;
use App\Http\Controllers\WebhooksController;

Route::middleware(['auth', 'permission:access Activité'])->group(function () {
    Route::get('/analysecampagne', [AnalysecampagneController::class, 'index'])->name('analysecampagne');
    Route::get('/processcampagne', [ProcesscampagneController::class, 'index'])->name('processcampagne');
    Route::get('/campagnesdashboard', [CampagnesdashboardController::class, 'index'])->name('campagnesdashboard');
    Route::get('/groupesdashboard', [GroupesdashboardController::class, 'index'])->name('groupesdashboard');
    Route::get('/onboardgroupe', [OnboardgroupeController::class, 'index'])->name('onboardgroupe');
    Route::get('/optimisationactivite', [OptimisationactiviteController::class, 'index'])->name('optimisationactivite');
});




Route::middleware(['auth', 'permission:access Activité'])->group(function () {
    Route::get('groupecampagnes.index/{id_campagne}', [GroupecampagneController::class, 'index'])->name('groupecampagnes.index');
    //Route::post('groupecampagnes', [GroupecampagneController::class, 'cherchSeg'])->name('groupecampagnes');
    Route::post('groupecampagnes', [GroupecampagneController::class, 'insert'])->name('groupecampagnes.insert');
    // Route::get('/cherchSeg', [GroupecampagneController::class, 'cherchSeg'])->name('cherchSeg');
    //Route::post('groupecampagnes', [GroupecampagneController::class, 'store'])->name('groupecampagnes.store');
    Route::get('AjoutSegments', [GroupecampagneController::class, 'AjoutSegments'])->name('groupecampagnes.AjoutSegments');
    Route::any('cherchSeg/{id}', [GroupecampagneController::class, 'cherchSeg'])->name('cherchSeg');
    Route::get('/multisearch_camp', [CampagneController::class, 'multisearch_camp'])->name('multisearch_camp');
    Route::delete('/deleteall_c', [CampagneController::class, 'deleteall_c'])->name('deleteall_c');
    Route::resource('campagnes', CampagneController::class);
    Route::resource('groupecampagnes', GroupecampagneController::class);
});

//Posts


Route::get('/welcomedashboard', [WelcomedashboardController::class, 'index'])->name('welcomedashboard')->middleware('auth');

Route::middleware(['auth', 'permission:access Activité'])->group(function () {
    Route::get('/dashboardpostmere', [DashboardpostmereController::class, 'index'])->name('dashboardpostmere');
    Route::get('/dashboardpostpartage', [DashboardpostpartageController::class, 'index'])->name('dashboardpostpartage');
    Route::get('/dashboardpostgroupe', [DashboardpostgroupeController::class, 'index'])->name('dashboardpostgroupe');
    Route::resource('postmeres', PostMereController::class);
    Route::resource('postpartages', PostPartageController::class);
    Route::resource('postgroupes', PostGroupeController::class);
});
// User


Route::middleware(['auth', 'permission:access Activité'])->group(function () {
    Route::resource('utilisateurs', UtilisateurController::class);
    Route::get('/dashboarduser', [DashboarduserController::class, 'index'])->name('dashboarduser');
    Route::get('/dashboardaudiencegroupe', [DashboardaudiencegroupeController::class, 'index'])->name('dashboardaudiencegroupe');
    Route::get('/dashboardlalachanteengage', [DashboardlalachanteengageController::class, 'index'])->name('dashboardlalachanteengage');
});
// Performance


Route::middleware(['auth', 'permission:access Analyse et stratégie'])->group(function () {
    Route::get('/groupeperformance', [GroupeperformanceController::class, 'index'])->name('groupeperformance');
    Route::get('/campagneperformance', [CampagneperformanceController::class, 'index'])->name('campagneperformance');
    Route::get('/segmentperformance', [SegmentperformanceController::class, 'index'])->name('segmentperformance');
    Route::get('/segmentationperformance', [SegmentationperformanceController::class, 'index'])->name('segmentationperformance');
    Route::get('/teamperformance', [TeamperformanceController::class, 'index'])->name('teamperformance');
    Route::get('/ambassadeurperformance', [AmbassadeurperformanceController::class, 'index'])->name('ambassadeurperformance');
});
// Data Analyse

Route::get('/analysetags', [AnalysetagsController::class, 'index'])->middleware(['auth', 'permission:access Analyse et stratégie'])->name('analysetags');

// Stratégie


Route::middleware(['auth', 'permission:access Analyse et stratégie'])->group(function () {
    Route::resource('ambassadeurs', AmbassadeurController::class);
    Route::get('/dashboardstrategie', [DashboardstrategieController::class, 'index'])->name('dashboardstrategie');
    Route::get('/planificationcampagnes', [PlanificationcampagnesController::class, 'index'])->name('planificationcampagnes');
    Route::get('/segmentsdashboard', [SegmentsdashboardController::class, 'index'])->name('segmentsdashboard');
});

// Administration



Route::middleware(['auth', 'permission:access Administration'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/administrationlistes', [AdministrationlistesController::class, 'index'])->name('administrationlistes');
    Route::get('/crud', [CrudController::class, 'index'])->name('crud');
});
//Auth
Auth::routes();

// Ressource

Route::middleware(['auth', 'permission:access Analyse et stratégie'])->group(function () {
    Route::resource('segements', SegementController::class);
    Route::resource('ambassadeurs', AmbassadeurController::class);
    Route::resource('segementations', SegementationController::class);
    Route::resource('deleteseg', SegementationController::class);
});

Route::middleware(['auth', 'permission:access Activité'])->group(function () {

    Route::resource('groupes', GroupeController::class);
    Route::resource('groupesansambassadeurs', GroupesansambassadeurController::class);
    Route::resource('groupeavecambassadeurs', GroupeavecambassadeurController::class);
    Route::resource('groupeavecsegmentations', GroupeavecsegmentationController::class);
    Route::resource('groupesanssegmentations', GroupesanssegmentationController::class);
    Route::resource('groupesanssegments', GroupesanssegmentController::class);
    Route::resource('questionads', QuestionadController::class);
    Route::resource('adhmanuelles', AdhmanuelleController::class);
    Route::resource('AmbassadeurGroupe', ambassadeurGroupeController::class);

    Route::get('groupeavecambassadeurs', [GroupeavecambassadeurController::class, 'index'])->name('groupeavecambassadeurs');
    Route::get('groupesansambassadeurs', [GroupeController::class, 'getAllSansAmb'])->name('groupesansambassadeurs');
    Route::get('groupeavecsegmentations', [GroupeavecsegmentationController::class, 'index'])->name('groupeavecsegmentations');
    Route::get('groupesanssegmentations', [GroupesanssegmentationController::class, 'getAllSansSegmentation'])->name('groupesanssegmentations');

    Route::get('adhmanuelles', [AdhmanuelleController::class, 'getAll_adh'])->name('adhmanuelles');
    Route::get('questionads', [QuestionadController::class, 'getAll_quad'])->name('questionads');

    Route::get('/multisearch', [GroupeController::class, 'multisearch'])->name('multisearch');
    Route::get('/multisearch_sans_amb', [GroupesansambassadeurController::class, 'multisearch_sans_amb'])->name('multisearch_sans_amb');
    Route::get('/multisearch_amb', [GroupeavecambassadeurController::class, 'multisearch_amb'])->name('multisearch_amb');
    Route::get('/multisearch_utilisateurs', [UtilisateurController::class, 'multisearch_utilisateurs'])->name('multisearch_utilisateurs');
    Route::get('/multisearch_g_s_segmentation', [GroupesanssegmentationController::class, 'multisearch_g_s_segmentation'])->name('multisearch_g_s_segmentation');
    Route::get('/multisearch_g_a_segmentation', [GroupeavecsegmentationController::class, 'multisearch_g_a_segmentation'])->name('multisearch_g_a_segmentation');
    Route::get('/multisearch_s_segment', [GroupesanssegmentController::class, 'multisearch_s_segment'])->name('multisearch_s_segment');
    Route::get('/multisearch_adh', [AdhmanuelleController::class, 'multisearch_adh'])->name('multisearch_adh');

    Route::get('/get_campagne_encours', [HomeController::class, 'get_campagne_encours'])->name('get_campagne_encours');
    Route::get('/get_campagne_terminee', [HomeController::class, 'get_campagne_terminee'])->name('get_campagne_terminee');
    Route::get('/get_campagne_archivee', [HomeController::class, 'get_campagne_archivee'])->name('get_campagne_archivee');
    Route::get('/get_campagne_planifiee', [HomeController::class, 'get_campagne_planifiee'])->name('get_campagne_planifiee');
    Route::get('/get_campagne_idee', [HomeController::class, 'get_campagne_idee'])->name('get_campagne_idee');

    Route::delete('/deleteall', [UserController::class, 'deleteall'])->name('deleteall');
    Route::delete('/deleteall_g', [GroupeController::class, 'deleteall_g'])->name('deleteall_g');

    Route::post('/recup/{ids}', 'App\Http\Controllers\GroupecampagneController@recup')->name('recup');
    Route::post('/mettre-a-jour-statut', 'App\Http\Controllers\GroupecampagneController@mettreAJourStatut');

    // Route::post('/ajax/request', 'AjaxController@sendRequest');
    Route::post('/ajaxupdate/{ids}', 'App\Http\Controllers\GroupecampagneController@ajaxupdate')->name('ajaxupdate');

    Route::get('groupecampagnes?id_campagne={id_campagne}', [GroupecampagneController::class, 'index'])->name('redirection');

    Route::get('/supprimer/{id?}/{id_campagne?}', 'App\Http\Controllers\GroupecampagneController@supprimer')->name('groupe.delete');

    Route::get('/dashboardrequalificationgroupe', [DashboardrequalificationgroupeController::class, 'index'])->name('dashboardrequalificationgroupe');
});



// Get
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware(['auth']);
Route::get('/', function () {
    return view('auth/login');
});
// Login Experience
Route::get('experience.login', function () {
    return view('experience.login');
})->name('experience.login');
Route::post('experience.verifierlogin', [experienceController::class, 'verifierlogin'])->name('experience.verifierlogin');
Route::get('experience.loginnewcontact', [experienceController::class, 'loginnewcontact'])->name('experience.loginnewcontact');
Route::get('experience.loginexistingcontact', [experienceController::class, 'loginexistingcontact'])->name('experience.loginexistingcontact');


Route::get('/home', [HomeController::class, 'index'])->middleware(['auth'])->name('home');
// ambassadeur_groupe

// Route::get('AmbassadeurGroupe.index/{id_utilisateur}', [ambassadeurGroupeController::class, 'index'])->name('AmbassadeurGroupe.index');
// Route::get('AmbassadeurGroupe', [ambassadeurGroupeController::class, 'destroy'])->name('AmbassadeurGroupe');
// Route::get('AmbassadeurGroupe', [ambassadeurGroupeController::class, 'getAllGroupeAmb'])->name('ambassadeurs');
// //Route::get('ambassadeurs', [AmbassadeurController::class, 'getAll'])->name('ambassadeurs');
// Route::get('AmbassadeurGroupe', [ambassadeurGroupeController::class, 'show'])->name('AmbassadeurGroupe.show');
// Route::get('AmbassadeurGroupe', [ambassadeurGroupe::class, 'edit'])->name('AmbassadeurGroupe.edit');

// ambassadeurs
Route::middleware(['auth', 'permission:access Analyse et stratégie'])->group(function () {
    Route::get('/searchamb', [AmbassadeurController::class, 'searchamb'])->name('searchamb');

    Route::get('ambassadeurs', [SegementController::class, 'getAllamb'])->name('ambassadeurs');
    //Route::get('ambassadeurs', [AmbassadeurController::class, 'getAll'])->name('ambassadeurs');
    Route::get('ambassadeurs', [AmbassadeurController::class, 'show'])->name('ambassadeurs.show');
    Route::get('ambassadeurs', [AmbassadeurController::class, 'edit'])->name('ambassadeurs.edit');
    //Route::get('ambassadeurs', [AmbassadeurController::class, 'index'])->name('ambassadeurs.index');
    Route::get('ambassadeurs', [AmbassadeurController::class, 'destroy'])->name('ambassadeurs');
    Route::get('ambassadeurs', [AmbassadeurController::class, 'index'])->name('ambassadeurs');
    Route::get('ambassadeurs.groupeamb/{id_ambassadeur}', [AmbassadeurController::class, 'groupeamb'])->name('ambassadeurs.groupeamb');

    // Route::get('ambassadeurs.groupeamb/{$id_ambassadeur}', [AmbassadeurController::class, 'groupeamb'])->name('ambassadeurs.groupeamb/{$id_ambassadeur}');
    // Route::get('ambassadeurs', [AmbassadeurController::class, 'index2'])->name('ambassadeurs');
    // groupes
    //Route::get('groupes.show', [GroupeController::class, 'delete'])->name('groupes.show');

    //Route::get('subindex', [GroupeavecsegmentationController::class, 'subindex'])->name('subindex');

    // Segment + segmentation
    //Route::any('segements.update', [SegementController::class,'update'])->name('segements.update');
    //Route::get('segements.edit', [SegementController::class,'edit'])->name('segements.edit');
    Route::get('segements.groupeseg', [SegementController::class, 'groupeseg'])->name('segements.groupeseg');

    //Route::get('groupe.show/{id}', [segementGroupeController::class, 'destroy'])->name('groupes.show');
    Route::get('segements', [SegementController::class, 'getAllSegment'])->name('segements');
    //Route::any('segements/{id_segment}', [SegementController::class,'show'])->name('segements');
    Route::get('segements', [SegementController::class, 'store'])->name('segements');
    //Route::get('groupes.show/{id}',[SegementController::class,'delete'])->name('groupes');
    Route::get('segements', [SegementController::class, 'getAllSegment'])->name('segements');
    Route::get('segementations', [SegementationController::class, 'getAllSegmentation'])->name('segementations');
    Route::any('segementationsDelete/{id}', [SegementationController::class, 'delete'])->name('segementationsDelete');
    Route::any('deleteAmbassadeur/{id}', [AmbassadeurController::class, 'deleteAmbassadeur'])->name('deleteAmbassadeur');
    Route::any('deleteSegment/{id}', [SegementController::class, 'deleteSegment'])->name('deleteSegment');

    //Route::any('groupes/{id}', [GroupeController::class, 'deleteSegment'])->name('groupes');
    //Route::delete('groupes/{segment_groupe}',[EtudiantControllers::class,'delete'])->name('groupes.supprimer');
    //Route::any('groupeDelete/{id}', [SegementationController::class, 'delete'])->name('groupeDelete');

    //nouveau :

    // Adhésion

    //Route::get('segements.show/{id_segment}', [SegementController::class,'show'])->name('segements.show');
    //Route::get('segements.show/{id_segment}', [SegementController::class,'show'])->name('segements.show');

    Route::get('/searchsegment', [SegementController::class, 'searchsegment'])->name('searchsegment');







    //Route::get('/deleteseg/{id_segmentation}', [App\Http\Controllers\SegementationController::class, 'deleteseg'])->name('deleteseg');
    //new route
    // Route::get('segementations.show/{id_segmentation}',[App\Http\Controllers\SegementationController::class,'show'])->name('segementations.show');
    Route::get('delete/{id}', [SegementationController::class, 'delete'])->name('delete');
    Route::get('delete/{id}', [AmbassadeurController::class, 'delete'])->name('delete');

    // Route::get('segementations.groupeseg', [SegementationController::class, 'showgrpseg'])->name('segementations.showgrpseg');
    //Route::delete('destroy', [App\Http\Controllers\GroupeController::class, 'destroy'])->name('groupes.destroy');

    // Route::get('groupecampagnes.index', [GroupecampagneController::class, 'index'])->name('groupecampagnes.index');
    // Route::post('groupecampagnes.index', [GroupecampagneController::class, 'update'])->name('groupecampagnes.update');



});

Route::middleware(['auth', 'permission:access Administration'])->group(function () {
    //Scripts
    Route::get('/publiergroupe', [PubliergroupeController::class, 'index'])->name('publiergroupe');
    Route::get('/partagepublications', [PartagepublicationsController::class, 'index'])->name('partagepublications');
    Route::get('/cherchepublications', [CherchepublicationsController::class, 'index'])->name('cherchepublications');
    Route::get('/engagements', [EngagementsController::class, 'index'])->name('engagements');
    Route::get('/insightspost', [InsightpostController::class, 'index'])->name('insightspost');
    Route::get('/insightspage', [InsightpageController::class, 'index'])->name('insightspage');
    Route::get('/releveinfo', [ReleveinfoController::class, 'index'])->name('releveinfo');
    Route::get('/adhesion', [AdhesionController::class, 'index'])->name('adhesion');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/relevecentposts', [RelevecentController::class, 'index'])->name('relevecentposts');
    Route::get('/recherchenouveauxgroupe', [RecherchegroupeController::class, 'index'])->name('recherchenouveauxgroupe');
    Route::get('/searchuser', [UserController::class, 'searchuser'])->name('searchuser');

    //Roles et Premissions
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('rolepermissions', RolePermissionController::class);
    Route::post('givepermission/{id_role}', [RolePermissionController::class, 'allow'])->name('givepermission');
    Route::delete('revokepermission/{id_role}/{id_permission}', [RolePermissionController::class, 'revoke'])->name('revokepermission');
    Route::delete('revokeallpermissions/{id_role}', [RolePermissionController::class, 'revokeall'])->name('revokeallpermissions');
});



//Dossier Client
Route::middleware(['auth', 'permission:access Infrastructure'])->group(function () {

    //Dossier Contact
    Route::get('/contacts.create', [ContactController::class, 'create'])->name('contacts.create');
    Route::get('/contacts.show/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/contacts.edit/{contact}', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::post('/contacts.store', [ContactController::class, 'store'])->name('contacts.store');
    Route::put('/contacts.update/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::get('/contacts.index', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts.multisearch', [ContactController::class, 'multisearch'])->name('contacts.multisearch');
    Route::delete('/contacts.destroy/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts.createinteraction', [ContactController::class, 'createInteraction'])->name('contacts.createinteraction');
    Route::post('/contacts.createstorytelling', [ContactController::class, 'createStorytelling'])->name('contacts.createstorytelling');
    // -------------Ilham-----------------
    Route::post('/contacts.createpersonna', [ContactController::class, 'createPersonna'])->name('contacts.createpersonna');
    // -------------Ilham-----------------
    //Route::post('/codespromo.clients.createcodeparrain', [ClientController::class, 'createcodeparrain'])->name('clients.createcodeparrain');
    Route::post('/codespromo.clients.createcodeparrain/{contact}', [ClientController::class, 'createcodeparrain'])->name('clients.createcodeparrain');
    Route::post('/codespromo.clients.createcode/{contact}', [ClientController::class, 'createcode'])->name('clients.createcode');

    // ---------------yasser-----------------
    Route::delete('/contacts.destroystorytelling/{story}/{contact}', [ContactController::class, 'destroyStorytelling'])->name('contacts.destroystorytelling');

    Route::delete('/contacts.deleteselect', [ContactController::class, 'deleteSelect'])->name('contacts.deleteselect');


    //Clients
    Route::resource('/clients', ClientController::class);
    Route::get('/clients.create', [ClientController::class, 'create'])->name('clients.create');
    Route::get('/clients.show/{id_contact}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients.edit/{id_contact}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::post('/clients.store', [ClientController::class, 'store'])->name('clients.store');
    Route::put('/clients.update/{id_contact}', [ClientController::class, 'update'])->name('clients.update');
    Route::get('/clients.index', [ClientController::class, 'index'])->name('clients.index');
    Route::delete('/clients.destroy/{id_contact}', [ClientController::class, 'destroy'])->name('clients.destroy'); ///{id_experience}
    Route::post('/clients.createinteraction', [ClientController::class, 'createInteraction'])->name('clients.createinteraction');
    Route::post('/clients.createstorytelling', [ClientController::class, 'createStorytelling'])->name('clients.createstorytelling');
    // Route::post('/clients.createcodeparrain', [ClientController::class, 'createcodeparrain'])->name('clients.createcodeparrain');

    // ---------------------yasser-------
    Route::delete('/clients.destroyinteraction/{id_interaction}/{id_contact}', [ClientController::class, 'destroyInteraction'])->name('clients.destroyinteraction');
    Route::delete('/clients.destroystorytelling/{story}/{id_contact}', [ClientController::class, 'destroyStorytelling'])->name('clients.destroystorytelling');
    Route::delete('/clients.deleteselect', [ClientController::class, 'deleteSelect'])->name('clients.deleteselect');


    //Entreprise
    Route::resource('/entreprises', EntrepriseController::class);
    Route::get('/entreprises.create', [EntrepriseController::class, 'create'])->name('entreprises.create');
    Route::post('/entreprises.store', [EntrepriseController::class, 'store'])->name('entreprises.store');
    Route::get('/entreprises.show/{id_organisation}', [EntrepriseController::class, 'show'])->name('entreprises.show');
    Route::get('/entreprises.edit/{id_organisation}', [EntrepriseController::class, 'edit'])->name('entreprises.edit');
    Route::put('/entreprises.update/{id_organisation}', [EntrepriseController::class, 'update'])->name('entreprises.update');
    Route::get('/entreprises.index', [EntrepriseController::class, 'index'])->name('entreprises.index');
    Route::delete('/entreprises.destroy/{id_organisation}', [EntrepriseController::class, 'destroy'])->name('entreprises.destroy');
    Route::post('/entreprises.insertremise', [EntrepriseController::class, 'insertremise'])->name('entreprises.insertremise');
    Route::post('/entreprises/createremise', [EntrepriseController::class, 'createRemise'])->name('entreprises.createremise');
    Route::delete('/entreprises.deleteselect', [EntrepriseController::class, 'deleteSelect'])->name('entreprises.deleteselect');



    // ---------------yasser-----------------
    Route::delete('/entreprises.destroystorytelling/{story}/{id_organisation}', [EntrepriseController::class, 'destroyStorytelling'])->name('entreprises.destroystorytelling');

    //Remise
    Route::resource('/remises', RemiseController::class);
    Route::get('/remises.create', [RemiseController::class, 'create'])->name('remises.create');
    Route::get('/remises.show/{id_remise}', [RemiseController::class, 'show'])->name('remises.show');
    Route::post('/remises.show/{id_remise}', [RemiseController::class, 'show']);
    Route::get('/remises.edit/{id_remise}', [RemiseController::class, 'edit'])->name('remises.edit');
    Route::put('/remises.update', [RemiseController::class, 'update'])->name('remises.update');
    Route::post('/remises.store', [RemiseController::class, 'store'])->name('remises.store');
    Route::get('/remises.index', [RemiseController::class, 'index'])->name('remises.index');
    Route::delete('remises.destroy/{id_remise}', [RemiseController::class, 'destroy'])->name('remises.destroy');

    // -----------
    Route::get('/remises.change_statut/{id_remise}/{statut}', [RemiseController::class, 'change_statut'])->name('remises.change_statut');
    Route::post('/remises.modif_descrip', [RemiseController::class, 'modif_descrip'])->name('remises.modif_descrip');
    Route::get('/remises.saveall', [RemiseController::class, 'saveall'])->name('remises.saveall');

    Route::get('/remises.insertpack/{id_remise}', [RemiseController::class, 'insertPack'])->name('remises.insertpack');
    Route::post('/remises.addpack', [RemiseController::class, 'addPack'])->name('remises.addpack');
    Route::get('/remises.insertproduct/{id_remise}', [RemiseController::class, 'insertProduct'])->name('remises.insertproduct');
    Route::post('/remises.addproduct', [RemiseController::class, 'addProduct'])->name('remises.addproduct');
    Route::get('/remises.removepack/{id_remise}/{id_pack}', [RemiseController::class, 'removePack'])->name('remises.removepack');
    Route::get('/remises.removeproduct/{id_remise}/{id_produit}', [RemiseController::class, 'removeProduct'])->name('remises.removeproduct');
    Route::delete('/remises.deleteselect', [RemiseController::class, 'deleteSelect'])->name('remises.deleteselect');



    //Reservation client
    Route::get('/reservationclient.create', [ReservationclientController::class, 'create'])->name('reservationclient.create');
    Route::get('/reservationclient.show/{experience}', [ReservationclientController::class, 'show'])->name('reservationclient.show');
    Route::get('/reservationclient.edit/{experience}', [ReservationclientController::class, 'edit'])->name('reservationclient.edit');
    Route::post('/reservationclient.store', [ReservationclientController::class, 'store'])->name('reservationclient.store');
    Route::get('/reservationclient.update', [ReservationclientController::class, 'update'])->name('reservationclient.update');
    Route::get('/reservationclient.index', [ReservationclientController::class, 'store'])->name('reservationclient.store');
    Route::get('/reservationclient.index', [ReservationclientController::class, 'index'])->name('reservationclient.index');
    Route::delete('/reservationclient.destroy/{facture}', [ReservationclientController::class, 'destroy'])->name('reservationclient.destroy');
    Route::get('/reservationclient.valider/{num_facture}/{id_facture_statut}', [ReservationclientController::class, 'valider'])->name('reservationclient.valider');
    Route::get('/reservationclient.envoyer/{num_facture}/{id_facture_statut}', [ReservationclientController::class, 'envoyer'])->name('reservationclient.envoyer');
    Route::post('/reservationclient.createinteraction', [ReservationclientController::class, 'createInteraction'])->name('reservationclient.createinteraction');
    Route::post('/reservationclient.createstorytelling', [ReservationclientController::class, 'createStorytelling'])->name('reservationclient.createstorytelling');
    Route::delete('/reservationclient.destroyinteraction/{id_interaction}/{num_facture}', [ReservationclientController::class, 'destroyInteraction'])->name('reservationclient.destroyinteraction');
    Route::delete('/reservationclient.destroystorytelling/{story}/{num_facture}', [ReservationclientController::class, 'destroyStorytelling'])->name('reservationclient.destroystorytelling');
    Route::put('/reservationclient.updateclient/{id_contact}', [ReservationclientController::class, 'updateClient'])->name('reservationclient.updateclient');
    Route::get('/reservationclient.clienttoexperimentateur/', [ReservationclientController::class, 'clientToExperimentateur'])->name('reservationclient.clienttoexperimentateur');
    // --------------------
    Route::get('/reservationclient.multisearch', [ReservationclientController::class, 'multisearch'])->name('reservationclient.multisearch');
    Route::delete('/reservationclient.deleteselect', [ReservationclientController::class, 'deleteSelect'])->name('reservationclient.deleteselect');



    //Partenaires
    Route::get('/partenaires.create', [PartenaireController::class, 'create'])->name('partenaires.create');
    Route::get('/partenaires.show/{id_partenaire}', [PartenaireController::class, 'show'])->name('partenaires.show');
    Route::get('/partenaires.edit/{id_partenaire}', [PartenaireController::class, 'edit'])->name('partenaires.edit');
    Route::put('/partenaires.update', [PartenaireController::class, 'update'])->name('partenaires.update');
    Route::post('/partenaires.store', [PartenaireController::class, 'store'])->name('partenaires.store');
    Route::get('/partenaires.index', [PartenaireController::class, 'index'])->name('partenaires.index');
    Route::delete('/partenaires.destroy/{id_partenaire}', [PartenaireController::class, 'destroy'])->name('partenaires.destroy');
    Route::post('/partenaires.createinteraction', [PartenaireController::class, 'createInteraction'])->name('partenaires.createinteraction');
    Route::post('/partenaires.createstorytelling', [PartenaireController::class, 'createStorytelling'])->name('partenaires.createstorytelling');
    Route::post('/partenaires.updatedesc', [PartenaireController::class, 'updatedesc'])->name('partenaires.updatedesc');
    // ---------------------yasser-------------------
    Route::delete('/partenaires.destroyinteraction/{id_interaction}/{id_partenaire}', [PartenaireController::class, 'destroyInteraction'])->name('partenaires.destroyinteraction');
    Route::delete('/partenaires.destroystorytelling/{story}/{id_partenaire}', [PartenaireController::class, 'destroyStorytelling'])->name('partenaires.destroystorytelling');

    Route::delete('/partenaires.deleteselect', [PartenaireController::class, 'deleteSelect'])->name('partenaires.deleteselect');


    //Intervenants
    Route::get('/intervenants.create', [IntervenantController::class, 'create'])->name('intervenants.create');
    Route::get('/intervenants.show/{id_intervenant_}', [IntervenantController::class, 'show'])->name('intervenants.show');
    Route::get('/intervenants.edit/{id_intervenant_}', [IntervenantController::class, 'edit'])->name('intervenants.edit');
    Route::put('/intervenants.update', [IntervenantController::class, 'update'])->name('intervenants.update');
    Route::post('/intervenants.store', [IntervenantController::class, 'store'])->name('intervenants.store');
    Route::get('/intervenants.index', [IntervenantController::class, 'index'])->name('intervenants.index');
    Route::delete('/intervenants.destroy/{id_intervenant_}', [IntervenantController::class, 'destroy'])->name('intervenants.destroy');
    Route::post('/intervenants.createinteraction', [IntervenantController::class, 'createInteraction'])->name('intervenants.createinteraction');
    Route::post('/intervenants.createstorytelling', [IntervenantController::class, 'createStorytelling'])->name('intervenants.createstorytelling');
    Route::post('/intervenants.updatedesc', [IntervenantController::class, 'updatedesc'])->name('intervenants.updatedesc');
    // ----------------------------yasser-----------------------
    Route::delete('/intervenants.destroyinteraction/{id_interaction}/{id_intervenant_}', [IntervenantController::class, 'destroyInteraction'])->name('intervenants.destroyinteraction');
    Route::delete('/intervenants.destroystorytelling/{story}/{id_intervenant_}', [IntervenantController::class, 'destroystorytelling'])->name('intervenants.destroystorytelling');

    Route::delete('/intervenants.deleteselect', [IntervenantController::class, 'deleteSelect'])->name('intervenants.deleteselect');


    //Experimentateurs
    Route::get('/experimentateurs.create', [ExperimentateurController::class, 'create'])->name('experimentateurs.create');
    Route::get('/experimentateurs.show/{id_contact}', [ExperimentateurController::class, 'show'])->name('experimentateurs.show');
    Route::get('/experimentateurs.edit/{id_contact}', [ExperimentateurController::class, 'edit'])->name('experimentateurs.edit');
    Route::put('/experimentateurs.update/{id_contact}', [ExperimentateurController::class, 'update'])->name('experimentateurs.update');
    Route::get('/experimentateurs.store', [ExperimentateurController::class, 'store'])->name('experimentateurs.store');
    Route::get('/experimentateurs.index', [ExperimentateurController::class, 'index'])->name('experimentateurs.index');
    Route::delete('/experimentateurs.destroy/{id_contact}/{id_experience}', [ExperimentateurController::class, 'destroy'])->name('experimentateurs.destroy');
    Route::post('/experimentateurs.createinteraction', [ExperimentateurController::class, 'createInteraction'])->name('experimentateurs.createinteraction');
    Route::post('/experimentateurs.createstorytelling', [ExperimentateurController::class, 'createStorytelling'])->name('experimentateurs.createstorytelling');
    Route::delete('/experimentateurs.destroyinteraction/{id_interaction}/{id_contact}', [ExperimentateurController::class, 'destroyInteraction'])->name('experimentateurs.destroyinteraction');
    Route::delete('/experimentateurs.destroystorytelling/{story}/{id_contact}', [ExperimentateurController::class, 'destroyStorytelling'])->name('experimentateurs.destroystorytelling');
    Route::delete('/experimentateurs.deleteselect', [ExperimentateurController::class, 'deleteSelect'])->name('experimentateurs.deleteselect');



    //ContentsExperience
    Route::get('/contents.create', [ContentController::class, 'create'])->name('contents.create');
    Route::get('/contents.show/{id_content_experience}', [ContentController::class, 'show'])->name('contents.show');
    Route::get('/contents.edit', [ContentController::class, 'edit'])->name('contents.edit');
    Route::get('/contents.update', [ContentController::class, 'update'])->name('contents.update');
    Route::get('/contents.store', [ContentController::class, 'store'])->name('contents.store');
    Route::get('/contents.index', [ContentController::class, 'index'])->name('contents.index');
    Route::delete('/contents.destroy', [ContentController::class, 'destroy'])->name('contents.destroy');
    Route::delete('/contents.deleteselect', [ContentController::class, 'deleteSelect'])->name('contents.deleteselect');


    //Interactions

    Route::get('/interactions.index', [InteractionController::class, 'index'])->name('interactions.index');
    Route::get('/interactions.edit/{id_interaction}', [InteractionController::class, 'edit'])->name('interactions.edit');
    Route::delete('/interactions.destroy/{id_interaction}', [InteractionController::class, 'destroy'])->name('interactions.destroy');
    Route::post('/interactions.store', [InteractionController::class, 'store'])->name('interactions.store');
    Route::put('/interactions.update', [InteractionController::class, 'update'])->name('interactions.update');
    // ----------------yasser---------------------
    Route::get('/interactions.update_show_interaction/{id_interaction}', [InteractionController::class, 'update_show_interaction'])->name('interactions.update_show_interaction');
    Route::put('/interactions.updated_interaction', [InteractionController::class, 'updated_interaction'])->name('interactions.updated_interaction');
    Route::get('/interactions.liste_tags/{expression}', [InteractionController::class, 'liste_tags'])->name('interactions.liste_tags');
    Route::delete('/interactions.deleteselect', [InteractionController::class, 'deleteSelect'])->name('interactions.deleteselect');

    //Ilham
    // Route::get('/personnas.liste_tags/{expression}', [PersonnaController::class, 'liste_tags'])->name('personnas.liste_tags');
    Route::get('/personnas.liste_tags/{expression}', [\App\Http\Controllers\PersonnaController::class, 'liste_tags'])->name('personnas.liste_tags');
    //Ilham

    //Storytellings

    Route::get('/storytellings.index', [StorytellingController::class, 'index'])->name('storytellings.index');
    Route::get('/storytellings.edit/{story}', [StorytellingController::class, 'edit'])->name('storytellings.edit');
    Route::put('/storytellings.update', [StorytellingController::class, 'update'])->name('storytellings.update');
    Route::post('/storytellings.store', [StorytellingController::class, 'store'])->name('storytellings.store');
    Route::delete('/storytellings.destroy/{story}', [StorytellingController::class, 'destroy'])->name('storytellings.destroy');
    // ----------------yasser---------------------
    Route::get('/storytellings.edit_show_storytelling/{story}', [StorytellingController::class, 'edit_show_storytelling'])->name('storytellings.edit_show_storytelling');
    Route::put('/storytellings.update_show_storytelling', [StorytellingController::class, 'update_show_storytelling'])->name('storytellings.update_show_storytelling');
    Route::get('/storytellings.liste_tags/{expression}', [StorytellingController::class, 'liste_tags'])->name('storytellings.liste_tags');
    Route::delete('/storytellings.deleteselect', [StorytellingController::class, 'deleteSelect'])->name('storytellings.deleteselect');


    //CodeProm

    Route::resource('/codespromo', CodepromoController::class);
    Route::get('/codespromo.create', [CodepromoController::class, 'create'])->name('codespromo.create');
    Route::get('/codespromo.show/{id_code}', [CodepromoController::class, 'show'])->name('codespromo.show');
    Route::post('/codespromo.show/{id_code}', [CodepromoController::class, 'show'])->name('codespromo.show');
    Route::get('/codespromo.edit/{id_remise}', [CodepromoController::class, 'edit'])->name('codespromo.edit');
    Route::put('/codespromo.update', [CodepromoController::class, 'update'])->name('codespromo.update');
    Route::post('/codespromo.store', [CodepromoController::class, 'store'])->name('codespromo.store');
    Route::get('/codespromo.index', [CodepromoController::class, 'index'])->name('codespromo.index');
    Route::delete('/codespromo.destroy/{id_remise}', [CodepromoController::class, 'destroy'])->name('codespromo.destroy');
    // -----------
    Route::get('/codespromo.change_statut/{id_code}/{statut}', [CodepromoController::class, 'change_statut'])->name('codespromo.change_statut');
    Route::post('/codespromo.modif_descrip', [CodepromoController::class, 'modif_descrip'])->name('codespromo.modif_descrip');
    Route::delete('/codespromo.deleteselect', [CodepromoController::class, 'deleteSelect'])->name('codespromo.deleteselect');

    //Notification

    Route::get('/notif.index', [NotifController::class, 'index'])->middleware(['auth'])->name('notif.index');

    //Facture

    Route::resource('/factures', FactureController::class);

    Route::get('/factures.create', [FactureController::class, 'create'])->name('facture.create');
    Route::get('/factures.validate', [FactureController::class, 'valid'])->name('facture.validate');
    Route::get('/factures.show/{facture}', [FactureController::class, 'show'])->name('facture.show');
    Route::any('/factures.show/{facture}', [FactureController::class, "updateDescreption"])->name("factures.update_description");
    Route::get('/factures.edit/{facture}', [FactureController::class, 'edit'])->name('facture.edit');
    Route::post('/factures.store', [FactureController::class, 'store'])->name('facture.store');
    Route::post('/factures.storebrouillon', [FactureController::class, 'storeBrouillon'])->name('facture.storebrouillon');
    Route::post('/factures.storeandenvoyer', [FactureController::class, 'storeAndEnvoyer'])->name('facture.storeandenvoyer');
    Route::post('factures.insertexistingcontact', [FactureController::class, 'insertExistingContact'])->name('facture.insertexistingcontact');
    Route::post('factures.insertnewcontact', [FactureController::class, 'insertNewContact'])->name('facture.insertnewcontact');
    Route::post('factures.removecontact/{id_con}', [FactureController::class, 'removeContact'])->name('facture.removecontact');
    Route::post('factures.insertexistingautreprestation', [FactureController::class, 'insertExistingAutrePrestation'])->name('facture.insertexistingautreprestation');
    Route::post('factures.insertnewautreprestation', [FactureController::class, 'insertNewAutrePrestation'])->name('facture.insertnewautreprestation');
    Route::post('factures.insertpackexperience', [FactureController::class, 'insertPackExperience'])->name('facture.insertpackexperience');
    Route::post('factures.removepackexperience', [FactureController::class, 'removePackExperience'])->name('facture.removepackexperience');
    Route::post('factures.removeautreprestation', [FactureController::class, 'removeAutrePrestation'])->name('facture.removeautreprestation');
    Route::post('factures.createpack', [FactureController::class, 'createPack'])->name('facture.createpack');
    Route::post('factures.setuppaiements', [FactureController::class, 'setupPaiements'])->name('facture.setuppaiements');
    Route::post('factures.insertpaiements', [FactureController::class, 'insertPaiements'])->name('facture.insertpaiements');
    Route::post('factures.createremise', [FactureController::class, 'createRemise'])->name('facture.createremise');
    Route::post('factures.insertremise', [FactureController::class, 'insertRemise'])->name('facture.insertremise');
    Route::post('factures.insertcode', [FactureController::class, 'insertCode'])->name('facture.insertcode');
    Route::post('factures.createcode', [FactureController::class, 'createCode'])->name('facture.createcode');
    Route::post('factures.cancelremise', [FactureController::class, 'cancelRemise'])->name('facture.cancelremise');
    Route::post('factures.insertdescription', [FactureController::class, 'insertDescription'])->name('facture.insertdescription');
    Route::get('/factures.update', [FactureController::class, 'update'])->name('facture.update');
    Route::get('/factures.index', [FactureController::class, 'index'])->name('facture.index');
    //Route::get('/factures.index', [FactureController::class, 'store'])->name('facture.store');
    //Route::delete('/factures.destroy', [FactureController::class, 'destroy'])->name('facture.destroy');
    Route::get('/factures.valider/{num_facture}/{id_facture_statut}', [FactureController::class, 'valider'])->name('facture.valider');
    Route::get('/factures.envoyer/{num_facture}/{id_facture_statut}', [FactureController::class, 'envoyer'])->name('facture.envoyer');
    Route::post('/factures.createinteraction', [FactureController::class, 'createInteraction'])->name('factures.createinteraction');
    Route::post('/factures.createstorytelling', [FactureController::class, 'createStorytelling'])->name('factures.createstorytelling');
    // ----------------------
    Route::post('/factures.modif_client_dans_facture', [FactureController::class, 'modif_client_dans_facture'])->name('factures.modif_client_dans_facture');
    Route::delete('/factures.deleteselect', [FactureController::class, 'deleteSelect'])->name('factures.deleteselect');


    //Produit Service

    Route::resource('/produitservice', produitserviceController::class);

    Route::get('/produitservice.create', [produitserviceController::class, 'create'])->name('produitservice.create');
    Route::get('/produitservice.validate', [produitserviceController::class, 'valid'])->name('produitservice.validate');
    Route::get('/produitservice.show/{produitservice}', [produitserviceController::class, 'show'])->name('produitservice.show');
    Route::post('/produitservice.show/{produitservice}', [produitserviceController::class, 'show']);
    Route::get('/produitservice.edit/{produitservice}', [produitserviceController::class, 'edit'])->name('produitservice.edit');
    Route::post('/produitservice.store', [produitserviceController::class, 'store'])->name('produitservice.store');
    Route::put('/produitservice.update/{produitservice}', [produitserviceController::class, 'update'])->name('produitservice.update');
    Route::get('/produitservice.index', [produitserviceController::class, 'index'])->name('produitservice.index');
    Route::delete('/produitservice.destroy/{produitservice}', [produitserviceController::class, 'destroy'])->name('produitservice.destroy');
    // -----------
    Route::get('/produitservice.change_statut/{produitservice}/{statut}', [produitserviceController::class, 'change_statut'])->name('produitservice.change_statut');
    Route::get('/produitservice.saveallprices', [produitserviceController::class, 'saveallprices'])->name('produitservice.saveallprices');
    Route::post('/produitservice.statutprix',  [produitserviceController::class, 'statutprix'])->name('produitservice.statutprix');
    Route::post('/produitservice.addnewprice', [ProduitServiceController::class, 'addnewprice'])->name('produitservice.addnewprice');
    Route::post('/produitservice.modif_stock', [ProduitServiceController::class, 'modifStockProduit'])->name('produitservice.modif_stock');
    Route::delete('/produitservice.deleteselect', [produitserviceController::class, 'deleteSelect'])->name('produitservice.deleteselect');
    Route::patch('/produitservice.archiver/{id_produit}', [produitServiceController::class, 'archiver'])->name('produitservice.archiver');


    //Experience

    Route::resource('/experience', experienceController::class);

    Route::get('/experience.create', [experienceController::class, 'create'])->name('experience.create');
    Route::get('/experience.validate', [experienceController::class, 'valid'])->name('experience.validate');
    Route::get('/experience.show/{id_experience}/{num_facture}', [experienceController::class, 'show'])->name('experience.show');
    // Route::post('/experience.show/{id_experience}/{num_facture}', [ExperienceController::class, "updateName"])->name("experience.update_name");
    Route::post('/experience.update_histoire/{id_experience}/{num_facture}', [ExperienceController::class, "updateNameHistoire"])->name("experience.update_histoire");
    Route::post('/experience.update_name/{id_experience}/{num_facture}', [ExperienceController::class, "updateName"])->name("experience.update_name");
    Route::get('/experience/{id_experience}/{num_facture}/Folders', [ExperienceController::class, 'show'])->name('experience.show.folders');
    Route::get('/experience.edit/{id_experience}/{num_facture}', [experienceController::class, 'edit'])->name('experience.edit');
    Route::put('/experience.updatereservation', [experienceController::class, 'updateDateReservation'])->name('experience.updatedatereservation');
    Route::post('/experience.store', [experienceController::class, 'store'])->name('experience.store');
    Route::put('/experience.update/{id_experience}/{num_facture}', [experienceController::class, 'update'])->name('experience.update');
    Route::get('/experience.index', [experienceController::class, 'index'])->name('experience.index');
    Route::delete('/experience.destroy', [experienceController::class, 'destroy'])->name('experience.destroy');
    Route::post('/experience.createinteraction', [experienceController::class, 'createInteraction'])->name('experience.createinteraction');
    Route::post('/experience.createstorytelling', [experienceController::class, 'createStorytelling'])->name('experience.createstorytelling');
    Route::delete('/experience.destroyinteraction/{id_interaction}/{id_experience}/{num_facture}', [experienceController::class, 'destroyInteraction'])->name('experience.destroyinteraction');
    Route::delete('/experience.destroystorytelling/{story}/{id_experience}/{num_facture}', [experienceController::class, 'destroyStorytelling'])->name('experience.destroystorytelling');
    Route::post('/experience.insertexistingexperimentateur', [experienceController::class, 'insertExistingExperimentateur'])->name('experience.insertexistingexperimentateur');
    Route::post('/experience.insertnewexperimentateur', [experienceController::class, 'insertNewExperimentateur'])->name('experience.insertnewexperimentateur');
    Route::get('/experience.clienttoexperimentateur/{id_experience}/{num_facture}/{id_contact}', [experienceController::class, 'clientToExperimentateur'])->name('experience.clienttoexperimentateur');
    Route::post('/experience.insertevenement', [experienceController::class, 'insertEvenement'])->name('experience.insertevenement');
    Route::post('/experience.createcontent', [experienceController::class, 'createContent'])->name('experience.createcontent');
    Route::delete('/experience.deleteselect', [experienceController::class, 'deleteSelect'])->name('experience.deleteselect');



    //Paiement

    Route::resource('/paiementss', PaiementController::class);
    Route::get('/paiementss.index', [PaiementController::class, 'index'])->name('paiementss.index');
    Route::get('/paiementss.create', [PaiementController::class, 'create'])->name('paiements.create');
    Route::get('/paiementss.validate', [PaiementController::class, 'valid'])->name('paiements.validate');
    Route::get('/paiementss.show/{paiement}', [PaiementController::class, 'show'])->name('paiements.show');
    Route::get('/paiementss.edit/{paiement}', [PaiementController::class, 'edit'])->name('paiements.edit');
    Route::post('/paiementss.store', [PaiementController::class, 'store'])->name('paiements.store');
    Route::get('/paiementss.update', [PaiementController::class, 'update'])->name('paiements.update');
    Route::get('/paiementss.index', [PaiementController::class, 'store'])->name('paiements.store');
    Route::delete('/paiementss.destroy', [PaiementController::class, 'destroy'])->name('paiements.destroy');
    Route::get('/paiementss.valider/{paiement}', [PaiementController::class, 'valider'])->name('paiements.valider');
    // ---------
    Route::post('/paiementss.mode_paiement', [PaiementController::class, 'mode_paiement'])->name('paiements.mode_paiement');
    Route::delete('/paiementss.deleteselect', [PaiementController::class, 'deleteSelect'])->name('paiements.deleteselect');


    //Pack

    Route::resource('/packs', PackController::class);

    Route::get('/packs.create', [PackController::class, 'create'])->name('packs.create');
    Route::get('/packs.validate', [PackController::class, 'valid'])->name('packs.validate');
    Route::get('/packs.show', [PackController::class, 'show'])->name('packs.show');
    Route::post('/packs.show', [PackController::class, 'show']);
    Route::get('/packs.edit/{pack}', [PackController::class, 'edit'])->name('packs.edit');
    Route::post('/packs.store', [PackController::class, 'store'])->name('packs.store');
    Route::put('/packs.update', [PackController::class, 'update'])->name('packs.update');
    Route::get('/packs.index', [PackController::class, 'index'])->name('packs.index');
    Route::delete('/packs.destroy/{pack}', [PackController::class, 'destroy'])->name('packs.destroy');
    // -----------
    Route::get('/packs.change_statut/{pack}/{statut}', [PackController::class, 'change_statut'])->name('packs.change_statut');
    Route::get('/packs.saveallprices', [PackController::class, 'saveallprices'])->name('packs.saveallprices');
    Route::post('/packs.statutprix',  [PackController::class, 'statutprix'])->name('packs.statutprix');
    Route::post('/pack.modif_stock', [PackController::class, 'modifStock'])->name('pack.modif_stock');
    Route::post('/packs.addnewprice', [PackController::class, 'addnewprice'])->name('packs.addnewprice');
    Route::delete('/packs.deleteselect', [PackController::class, 'deleteSelect'])->name('packs.deleteselect');
    Route::patch('/packs.archiver/{id_produit}', [PackController::class, 'archiver'])->name('packs.archiver');


    //Bon Cadeau

    Route::resource('/bonscadeau', BonCadeauController::class);

    Route::get('/bonscadeau.create', [BonCadeauController::class, 'create'])->name('bonscadeau.create');
    Route::get('/bonscadeau.validate', [BonCadeauController::class, 'valid'])->name('bonscadeau.validate');
    Route::get('/bonscadeau.show', [BonCadeauController::class, 'show'])->name('bonscadeau.show');
    Route::get('/bonscadeau.edit', [BonCadeauController::class, 'edit'])->name('bonscadeau.edit');
    Route::post('/bonscadeau.store', [BonCadeauController::class, 'store'])->name('bonscadeau.store');
    Route::get('/bonscadeau.update', [BonCadeauController::class, 'update'])->name('bonscadeau.update');
    Route::get('/bonscadeau.index', [BonCadeauController::class, 'index'])->name('bonscadeau.index');
    Route::get('/bonscadeau.index/{id_bon}', [BonCadeauController::class, 'store'])->name('bonscadeau.store');
    Route::delete('/bonscadeau.destroy', [BonCadeauController::class, 'destroy'])->name('bonscadeau.destroy');
    Route::delete('/bonscadeau.deleteselect', [BonCadeauController::class, 'deleteSelect'])->name('bonscadeau.deleteselect');
});

//Contributeurs 

Route::resource('/contributeurs', ContributeurController::class);

Route::get('/contributeurs.index', [ContributeurController::class, 'index'])->name('contributeurs.index');
Route::get('/contributeurs.show/{id_contact}', [ContributeurController::class, 'show'])->name('contributeurs.show');
Route::get('/contributeurs.edit/{id}', [ContributeurController::class, 'edit'])->name('contributeurs.edit');
Route::post('/contributeurs.store', [ContributeurController::class, 'store'])->name('contributeurs.store');
Route::put('/contributeurs.update', [ContributeurController::class, 'update'])->name('contributeurs.update');
Route::delete('/contributeurs/{id}', [ContributeurController::class, 'destroy'])->name('contributeurs.destroy');

// contributions

Route::resource('/contributions', ContributionController::class);

Route::get('/contributions.index', [ContributionController::class, 'index'])->name('contributions.index');
Route::get('/contributions.show/{id_contributions}', [ContributionController::class, 'show'])->name('contributions.show');
Route::get('/contributions.edit/{id}', [ContributionController::class, 'edit'])->name('contributions.edit');
Route::post('contributions.store', [ContributionController::class, 'store'])->name('contributions.store');
Route::put('contributions.update', [ContributeurController::class, 'update'])->name('contributions.update');
Route::delete('/contributions/{id}', [ContributeurController::class, 'destroy'])->name('contributions.destroy');


//Cagnottes
Route::resource('/cagnottes', CagnotteController::class);

Route::get('/cagnottes.index', [CagnotteController::class, 'index'])->name('cagnottes.index');
Route::get('/cagnottes.show/{id_cagnotte}', [CagnotteController::class, 'show'])->name('cagnottes.show');
Route::get('/cagnottes.edit/{id}', [CagnotteController::class, 'edit'])->name('cagnottes.edit');
Route::post('/cagnottes.store', [CagnotteController::class, 'store'])->name('cagnottes.store');
Route::put('/cagnottes.update', [CagnotteController::class, 'update'])->name('cagnottes.update');
Route::delete('/cagnottes/{id}', [CagnotteController::class, 'destroy'])->name('cagnottes.destroy');


// Cagnote Catégorie
Route::resource('/cagnottecategories', CagnotteCategorieController::class);

Route::get('/cagnottecategories.index', [CagnotteCategorieController::class, 'index'])->name('cagnottecategories.index');
Route::get('/cagnottecategories.show/{id_categorie}', [CagnotteCategorieController::class, 'show'])->name('cagnottecategories.show');
Route::get('/cagnottecategories.edit/{id_categorie}', [CagnotteCategorieController::class, 'edit'])->name('cagnottecategories.edit');
Route::get('/cagnottecategories.create', [CagnotteCategorieController::class, 'create'])->name('cagnottecategories.create');
Route::post('/cagnottecategories.store', [CagnotteCategorieController::class, 'store'])->name('cagnottecategories.store');
Route::put('/cagnottecategories/{id_categorie}', [CagnotteCategorieController::class, 'update'])->name('cagnottecategories.update');
Route::delete('/cagnottecategories/{id_categorie}', [CagnotteCategorieController::class, 'destroy'])->name('cagnottecategories.destroy');


// Utilisateur Espace Client

Route::middleware(['auth', 'permission:access Espace Client'])->group(function () {
    // EspaceClient
    Route::get('/temporaire', [EspaceClientController::class, 'temporaire'])->name('temporaire');
    Route::get('/accueil', [EspaceClientController::class, 'accueil'])->name('accueil');
    Route::post('/accueil', [EspaceClientController::class, 'accueil'])->name('accueil.post');
});


Route::middleware(['auth', 'permission:access Mon Compte'])->group(function () {
    Route::get('/utilisateur/monCompte', [UtilisateurContributionController::class, 'compte'])->name('utilisateur.compte');
    Route::get('/utilisateur/operation', [UtilisateurContributionController::class, 'operation'])->name('utilisateur.operation');

    Route::get('/utilisateur/parametre', [UtilisateurContributionController::class, 'parametre'])->name('utilisateur.parametre');
    Route::get('/utilisateur/information', [UtilisateurContributionController::class, 'information'])->name('utilisateur.information');
    Route::put('/utilisateur/enregistrer', [UtilisateurContributionController::class, 'enregistrerModification'])->name('modification.enregistrer');
    Route::get('/utilisateur/droit', [UtilisateurContributionController::class, 'droit'])->name('utilisateur.droit');
    Route::post('/ajout-administrateur', [UtilisateurCauseController::class, 'linkNewUserToCause'])->name('linkNewUserToCause');
    Route::get('/utilisateur/notif', [UtilisateurContributionController::class, 'notif'])->name('utilisateur.notif');
    Route::post('/utilisateur/notif-update', [ParametreController::class, 'updateNotificationPage'])->name('utilisateur.notif-update');
    Route::get('/utilisateur/identite', [UtilisateurContributionController::class, 'identite'])->name('utilisateur.identite');
    Route::post('/utilisateur/identite', [UtilisateurContributionController::class, 'identite']);
});

Route::middleware(['auth', 'permission:access Securite'])->group(function () {
    Route::get('/utilisateur/securite', [UtilisateurContributionController::class, 'securite'])->name('utilisateur.securite');

    Route::post('/utilisateur/securite', [UtilisateurContributionController::class, 'updatePassword'])->name('utilisateur.updatePassword');
});


Route::middleware(['auth', 'permission:access Cagnottes'])->group(function () {
    Route::get('/utilisateur/cagnottes', [UtilisateurContributionController::class, 'cagnotte'])->name('utilisateur.cagnotte');
});

Route::middleware(['auth', 'permission:access Mes Experiences'])->group(function () {
    Route::get('/utilisateur/mesExperiences', [UtilisateurExperienceController::class, 'mesexperience'])->name('utilisateur.compte.experience');
    Route::get('/utilisateur/detail-experience/{id_experience}', [UtilisateurExperienceController::class, 'detailexperience'])->name('utilisateur.detailexperience');
});
Route::middleware(['auth', 'permission:access Mes Projets'])->group(function () {
    Route::get('/utilisateur/mesprojets', [UtilisateurContributionController::class, 'mesprojet'])->name('utilisateur.compte.projet');
});
Route::middleware(['auth', 'permission:access Mes Causes Projets'])->group(function () {
    Route::get('/utilisateur/mescauseprojet', [UtilisateurContributionController::class, 'mescauseprojet'])->name('utilisateur.compte.causeprojet');
});

//Restitution

Route::middleware(['auth', 'permission:access Restitution'])->group(function () {
    Route::get('/utilisateur/restitution', [UtilisateurRestitutionController::class, 'restitution'])->name('utilisateur.restitution');
});
Route::middleware(['auth', 'permission:access Contributions'])->group(function () {
    Route::get('/utilisateur/contribution/{idCagnotte}', [UtilisateurRestitutionController::class, 'contribution'])->name('utilisateur.contribution');
});
Route::middleware(['auth', 'permission:access Suivi Paiement'])->group(function () {
    Route::get('/utilisateur/contributionAllCagnotte', [UtilisateurRestitutionController::class, 'suivi'])->name('utilisateur.contribution.suivipaiement');
});
Route::middleware(['auth', 'permission:access Contibuteurs All cagnotte'])->group(function () {
    Route::get('/utilisateur/contributeurAllCagnotte', [UtilisateurRestitutionController::class, 'contributeur'])->name('utilisateur.contribution.contributeur');
});
Route::middleware(['auth', 'permission:access Contibuteurs cagnotte'])->group(function () {
    Route::get('/utilisateur/contributeur-cagnotte/{id_cagnotte}', [UtilisateurRestitutionController::class, 'contributeurcagnotte'])->name('utilisateur.contributeur.cagnotte');
});
Route::middleware(['auth', 'permission:access Validation'])->group(function () {
    Route::get('/utilisateur/validation', [UtilisateurRestitutionController::class, 'validation'])->name('utilisateur.restituion.validation');
});

Route::middleware(['auth', 'permission:access Recuperer Fonds'])->group(function () {
    Route::get('/utilisateur/recuperationDesfond', [UtilisateurRestitutionController::class, 'recuperation'])->name('utilisateur.recuperation');
});

//Transfert
Route::middleware(['auth', 'permission:access Transfert'])->group(function () {
    Route::get('/utilisateur/choixCagnotteTransfere', [UtilisateurTransfereController::class, 'choixcagnotte'])->name('utilisateur.choixcagnotte');
    Route::post('/utilisateur/choixCagnotteTransfere', [UtilisateurTransfereController::class, 'choixcagnotteid'])->name('utilisateur.choixcagnotteid');
    Route::get('/utilisateur/transfere', [UtilisateurTransfereController::class, 'showtransfere'])->name('utilisateur.transfere');
    Route::post('/utilisateur/transfere', [UtilisateurTransfereController::class, 'transfere'])->name('utilisateur.transfere');
    Route::get('/utilisateur/validationTransfere', [UtilisateurTransfereController::class, 'validationtransfere'])->name('utilisateur.validationtransfere');
});

//Soutenir 
Route::middleware(['auth', 'permission:access Soutenir'])->group(function () {
    Route::get('/utilisateur/soutenirProjet', [UtilisateurRechercheController::class, 'soutienprojet'])->name('utilisateur.soutenirprojet');
    Route::get('/utilisateur/soutenirCause', [UtilisateurRechercheController::class, 'soutiencause'])->name('utilisateur.soutenircause');
    Route::get('/utilisateur/soutenirOrganisation', [UtilisateurRechercheController::class, 'soutienorganisation'])->name('utilisateur.soutenirorganisation');
    Route::get('/utilisateur/SoutenirExperience', [UtilisateurRechercheController::class, 'soutienexperience'])->name('utilisateur.soutenirexperience');

    Route::get('/utilisateur/soutenir/{id_projet}', [UtilisateurCauseController::class, 'recapsoutenir'])->name('utilisateur.recapsoutenir');

    Route::get('/utilisateur/choix-soutien/{id_projet}', [UtilisateurCauseController::class, 'choixsoutien'])->name('utilisateur.choixsoutien');

    Route::get('/utilisateur/cause/lier-cagnotte/{id_projet}', [UtilisateurCauseController::class, 'liercagnotte'])->name('utilisateur.causeliercagnotte');
    Route::get('/utilisateur/cause/recap-lier-cagnotte/{id_projet}/{id_cagnotte}', [UtilisateurCauseController::class, 'recapliercagnotte'])->name('utilisateur.recapliercagnotte');

    Route::get('/utilisateur/cause/tranfert-cagnotte/{id_projet}', [UtilisateurCauseController::class, 'tranfertcagnotte'])->name('utilisateur.transfertcagnotte');
    Route::get('/utilisateur/cause/reacap-transfert/{id_projet}/{id_cagnotte}', [UtilisateurCauseController::class, 'recaptranfertcagnotte'])->name('utilisateur.recaptransfertcagnotte');

    Route::get('/utilisateur/cause/don-cagnotte/{id_projet}', [UtilisateurCauseController::class, 'doncagnotte'])->name('utilisateur.doncagnotte');
    Route::get('/utilisateur/cause/recap-don-cagnotte/{id_projet}/{id_cagnotte}', [UtilisateurCauseController::class, 'recapdoncagnotte'])->name('utilisateur.recapdoncagnotte');
});

// incription cause
Route::get('/utilisateur/cause/inscription', [UtilisateurCauseController::class, 'inscription'])->name('utilisateur.causeinscription');
Route::post('/utilisateur/cause/inscription', [UtilisateurCauseController::class, 'store'])->name('utilisateur.causeinscriptioncreate');
Route::get('/utilisateur/cause/inscriptionconfirmation', [UtilisateurCauseController::class, 'confirmation'])->name('utilisateur.causeconfirmation');


// Utilisateur connection

Route::get('/utilisateur/connection', [UtilisateurLoginController::class, 'index'])->name('utilisateur.connection');
Route::post('/utilisateur/login', [UtilisateurLoginController::class, 'login'])->name('utilisateur.login');
Route::post('/utilisateur/logout', [UtilisateurLoginController::class, 'logout'])->name('utilisateur.logout');
Route::get('/utilisateur/inscription', [UtilisateurRegisterController::class, 'register'])->name('utilisateur.inscription');
Route::get('/utilisateur/inscriptiontype', [UtilisateurLoginController::class, 'registertypechoice'])->name('utilisateur.typechoice');
Route::post('/utilisateur/store', [UtilisateurRegisterController::class, 'store'])->name('utilisateur.store');
Route::get('/utilisateur/motdepassoublie', [UtilisateurForgotPasswordController::class, 'forgotPass'])->name('utilisateur.motdepasseoublie');
Route::get('/utilisateur/envoiconfirmation', [UtilisateurShowConfirmController::class, 'showconfirmation'])->name('utilisateur.showconfirm');
Route::post('/sendResetPasswordMail', [UtilisateurForgotPasswordController::class, 'sendResetLinkEmail'])->name('utilisateur.sendresetpassword');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Auth::routes(['verify' => true]);


//Achat experience 
Route::middleware(['auth', 'permission:access Achats'])->group(function () {
    Route::get('/utilisateur/produitetpack', [UtilisateurAchatExperienceController::class, 'produitpack'])->name('utilisateur.produitpack');
    Route::get('/utilisateur/choixPack', [UtilisateurAchatExperienceController::class, 'pack'])->name('utilisateur.pack');
    Route::get('/utilisateur/choixExperience', [UtilisateurAchatExperienceController::class, 'experience'])->name('utilisateur.experience');
    Route::get('utilisateur/pack/{id_pack}', [UtilisateurAchatExperienceController::class, 'detailpack'])->name('utilisateur.detailpack');
    Route::get('utilisateur/produitservice/{id_produit}', [UtilisateurAchatExperienceController::class, 'detailProduitService'])->name('utilisateur.detailproduitservice');
    Route::get('/utilisateur/panier/{id_panier}', [UtilisateurAchatExperienceController::class, 'panier'])->name('utilisateur.panier');
    Route::get('/utilisateur/paiement/{id_panier}', [UtilisateurAchatExperienceController::class, 'paiement'])->name('utilisateur.paiement');
    Route::get('/utilisateur/validationAchat/{id_panier}', [UtilisateurAchatExperienceController::class, 'recapachat'])->name('utilisateur.recapachat');
    Route::get('/utilisateur/addtocart/{item}/{type}/{nb_participants?}/{nb_titres?}/{quantity?}', [UtilisateurAchatExperienceController::class, 'addToCart'])->name('utilisateur.addtocart');
    Route::get('/utilisateur/payAchat/{id_panier}', [UtilisateurAchatExperienceController::class, 'payAchat'])->name('utilisateur.payachat');
    Route::post('/utilisateur/ajoutpackaupanier', [UtilisateurAchatExperienceController::class, 'addToCartpackFromForm'])->name('utilisateur.addToCartPackFromForm');
    Route::post('/utilisateur/ajoutproduitaupanier', [UtilisateurAchatExperienceController::class, 'addToCartProduitFromForm'])->name('utilisateur.addToCartProduitFromForm');
    Route::delete('utilisateur/panier/supprimer-produit/{produit}/{facture}', [PanierController::class, 'supprimerProduitDuPanier'])->name('panier.supprimerProduit');
    Route::delete('/panier/supprimer-pack/{pack_experience}/{facture}', [PanierController::class, 'supprimerPackDuPanier'])->name('panier.supprimerPack');
    Route::delete('/supprimer-tout/{facture}', [PanierController::class, 'supprimerPanierComplet'])->name('panier.supprimerTout');
    Route::put('/panier/modifierNombrePersonnes/{facture}', [PanierController::class, 'modifierNombrePersonnes'])->name('panier.modifierNombrePersonnes');
    Route::put('/panier/modifierNombreTitres/{facture}', [PanierController::class, 'modifierNombreTitres'])->name('panier.modifierNombreTitres');
    Route::put('/panier/modifier-quantite-personnes/{facture}/{pack}', [PanierController::class, 'modifierQuantitePersonnes'])->name('panier.modifierQuantitePersonnes');
    Route::put('/panier/modifier-quantite-titres/{facture}/{pack}', [PanierController::class, 'modifierQuantiteTitres'])->name('panier.modifierQuantiteTitres');
    Route::put('/panier/modifierQuantiteProduit/{facture}/{produit}',  [PanierController::class, 'modifierQuantiteProduit'])->name('panier.modifierQuantiteProduit');
});


//page affichage 

Route::get('/utilisateur/affichageExperience', [UtilisateurAffichageController::class, 'experience'])->name('utilisateur.affichage.experience');
Route::get('/utilisateur/affichageProjet', [UtilisateurAffichageController::class, 'projet'])->name('utilisateur.affichage.projet');
Route::get('/utilisateur/affichageCause', [UtilisateurAffichageController::class, 'cause'])->name('utilisateur.affichage.cause');
Route::get('/utilisateur/affichageCagnotte', [UtilisateurAffichageController::class, 'cagnotte'])->name('utilisateur.affichage.cagnotte');
Route::get('/utilisateur/affichageCExperimentateur', [UtilisateurAffichageController::class, 'experimentateur'])->name('utilisateur.affichage.experimentateur');

// Page public

Route::get('/public', [EspaceClientController::class, 'public'])->name('public');

//Recherche 

Route::get('/utilisateur/rechecheProjet', [UtilisateurRechercheController::class, 'searchprojet'])->name('utilisateur.searchprojet');
Route::get('/utilisateur/rechercheCause', [UtilisateurRechercheController::class, 'searchcause'])->name('utilisateur.searchcause');
Route::get('/utilisateur/rechercheOrganisation', [UtilisateurRechercheController::class, 'searchorganisation'])->name('utilisateur.searchorganisation');
Route::get('/utilisateur/rechercheExperience', [UtilisateurRechercheController::class, 'searchexperience'])->name('utilisateur.searchexperience');


//Creation projet 
Route::middleware(['auth', 'permission:access Creation Projets'])->group(function () {
    Route::get('/creation_projet/type', [UtilisateurCreationProjetController::class, 'type'])->name('creation.type');
    Route::post('/creation_projet/type', [UtilisateurCreationProjetController::class, 'posttype'])->name('creation.type.post');

    Route::get('/creation_projet/etape2', [UtilisateurCreationProjetController::class, 'etape2'])->name('creation.etape2');
    Route::post('/creation_projet/etape2', [UtilisateurCreationProjetController::class, 'postetape2'])->name('creation.etape2.post');

    Route::get('/creation_projet/etape3', [UtilisateurCreationProjetController::class, 'etape3'])->name('creation.etape3');
    Route::post('/creation_projet/etape3', [UtilisateurCreationProjetController::class, 'postetape3'])->name('creation.etape3.post');

    Route::get('/creation_projet/etape4', [UtilisateurCreationProjetController::class, 'etape4'])->name('creation.etape4');
    Route::post('/creation_projet/etape4', [UtilisateurCreationProjetController::class, 'postetape4'])->name('creation.etape4.post');

    Route::get('/creation_projet/etape5', [UtilisateurCreationProjetController::class, 'etape5'])->name('creation.etape5');
    Route::post('/creation_projet/etape5', [UtilisateurCreationProjetController::class, 'postetape5'])->name('creation.etape5.post');
});




//Roles


Route::middleware(['auth'])->group(function () {
    Route::get('/role.initvalues', [RoleController::class, 'addDummy'])->name('role.initvalues');
    Route::get('/role/setroledummy', [RoleController::class, 'setUserRoleDummy'])->name('role.setroledummy');
});



//Permissions



Route::middleware(['auth'])->group(function () {
    Route::get('/permission.initvalues', [PermissionController::class, 'addDummy'])->name('permission.initvalues');
    Route::get('/permission/setpermissiondummy', [PermissionController::class, 'setRolePermissionDummy'])->name('permission.setpermissiondummy');
});

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
Route::post('/formulaire/webhook', [FormulaireWebhookController::class, 'handleWebhook']);

Route::get('/test-mail', function () {
    $email = new MailConfirmationExperimentateur();
    Mail::to('harenait.lalachante@gmail.com')
        ->send($email);
    return $email;
});

Route::get('/test-notif', function () {

    $url = 'https://discordapp.com/api/webhooks/1048269916849045544/7DPB-mDRZujlT-WbEedYC8mGJnkdr3I1zTlMtoFodIavpejYTrKAKR3SVBobArOZeIR_';
    $data = array(
        'content' => 'Hello, world!'
    );
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === false) {
        // Gérer l'erreur de l'envoi du message
    } else {
        // Message envoyé avec succès
    }
});


Route::get('/getToken', [ContactController::class, 'getToken']);
Route::get('/google/calendar/auth', [GoogleCalendarController::class, 'auth'])->name('google.calendar.auth');
Route::get('/oauth2callback', [GoogleCalendarController::class, 'callback'])->name('oauth2callback');
Route::get('/test-calendar', [GoogleCalendarController::class, 'testCreateEvent']);

Route::get('/drive-login', [GoogleDriveController::class, 'redirectToDrive'])->name('drive.login');
Route::get('/drive.callback', [GoogleDriveController::class, 'handleDriveCallback'])->name('drive.callback');
Route::get('getDescription', [BaseController::class, 'getDescription'])->name('getDescription');

Route::get('test/create-checkout/{id_experience}/{id_contact}/{montant}', [StripeController::class, 'createCheckoutwithExperience'])->name('createCheckoutwithExperience');
Route::post('/check-contact', [StripeController::class, 'checkContact'])->name('checkContact');


Route::get('/afficher-tous-les-clients', [ClientController::class, 'afficherTousLesClients']);
Route::get('/create-experience-folder/{id_experience}/{num_facture}', [experienceController::class, 'createExperienceFolder'])->name('create-experience-folder');
Route::get('/fill-project-experience', [experienceController::class, 'fillExperienceProject'])->name('create-all-experiences-project');

// LIVEWIRE

Route::get('/counter', Counter::class);
Route::get('/contribution/{idExperience}', Contribuer::class)
    ->where('idExperience', '[0-9]+')->name('contributions'); // Exemple de contrainte : seulement des chiffres
Route::get('/information/{idExperience}/{montant}', [Information::class, 'information'])->name('information');
Route::post('/information/{idExperience}/{montant}', [Information::class, 'traiterFormulaire'])->name('traiterFormulaire');


// PAGE POUR DAVY il 
/** !!! IMPORTANT
 * va changer la fonction anonyme en controlleur c'est juste pour l'integration
 */
Route::get('/organisation/organisation', function () {
    return view('organisation.organisation');
})->name('show-organisation');


//upload test
Route::get('/drive', [Drive::class, 'test'])->name('drive');
Route::get('/create_docs_local', [FileController::class, 'createDocs'])->name('createDocs');
Route::get('/get_files_urls', [FileController::class, 'getFilesUrls'])->name('get_files_urls');
Route::get('/list_files', [FileController::class, 'listFolders'])->name('list_files');

Route::get('/link/{cagnotte}/{projet_cause}', [CagnotteController::class, 'linkMyCagnotte'])->name('linkMyCagnotte');
Route::post('/link', [CagnotteController::class, 'linkMyCagnotte'])->name('linkMyCagnotte');

Route::get('/unlink/{cagnotte}/{projet_cause}', [CagnotteController::class, 'unlinkMyCagnotte'])->name('unlinkMyCagnotte');

Route::get('/transfert/{cagnotte}/{projet_cause}', [CagnotteController::class, 'transferMyCagnotte'])->name('transferMyCagnotte');
Route::post('/transfert', [CagnotteController::class, 'transferMyCagnotte'])->name('transferMyCagnotte');

Route::get('/donate/{cagnotte}/{projet_cause}/{montant}', [CagnotteController::class, 'donateByCagnotte'])->name('donateMyCagnotte');
Route::post('/donate', [CagnotteController::class, 'donateByCagnotte'])->name('donateMyCagnotte');

Route::post('/ajout-administrateur', [UtilisateurCauseController::class, 'linkNewUserToCause'])->name('linkNewUserToCause');
Route::get('/setvisibility/{experience}/{visibility}', [experienceController::class, 'setVisibility'])->name('setVisibility');
Route::get('/auth/google', [UtilisateurLoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [UtilisateurLoginController::class, 'handleGoogleCallback']);
Route::get('/hideMyCagnotte/{cagnotte}', [CagnotteController::class, 'hideMyCagnotte']);
Route::get('/hideMyCagnotteTotal/{cagnotte}', [CagnotteController::class, 'hideMyCagnotteTotal']);
Route::get('/hideMyCagnotteContributeurs/{cagnotte}', [CagnotteController::class, 'hideMyCagnotteContributeurs']);
Route::get('/showMyCagnotte/{cagnotte}', [CagnotteController::class, 'showMyCagnotte']);
Route::get('/showMyCagnotteTotal/{cagnotte}', [CagnotteController::class, 'showMyCagnotteTotal']);
Route::get('/showMyCagnotteContributeurs/{cagnotte}', [CagnotteController::class, 'showMyCagnotteContributeurs']);
Route::get('/create_experience_plus', [experienceController::class, 'createExperiencePlus']);
Route::get('/createFactureByCSV', [FactureController::class, 'createFactureByCSV']);
Route::post('/handleBonCadeau',[WebhooksController::class,'handleBonCadeau'])->name('handleBonCadeau');



// Route temporaire pour visualiser la template de la vue cause
Route::get('/organisationcause' , function(){
    return view('public/organisationcause/organisationcause');
});