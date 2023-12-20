<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- <link href="/../css/admin_style.css" rel ="stylesheet"/> -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/axios.js') }}"></script>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header" style="text-align : center">
                <h3>Lalachante Admin</h3>
                <h3 style="color:red">{{Auth::user()->name ?? "test"}}</h3>
            </div>

            <ul class="list-unstyled components">
                <li> <a href="/home" id="M00">Welcome</a> </li>
                <li> <a href="/welcomedashboard" id="M0">Welcome Dashboard</a> </li>
                <li> <a href="/accueil" id="M0000">Accueil</a> </li>
                <li> <a href="/temporaire" id="M0000">Liste parcour</a> </li>
                <li> <a href="/public" id="M000">Page Public</a> </li>
                <br>

                <!-- Activité -->

                <li style="background-color : #DEDEDE ; text-align : center ; color : black">
                    <!-- <h5>Activité<h5> -->
                    <h6 class="mon_h6"><a href="#pageSubmenu21" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau2">Activité</a></h6>
                    <ul class="collapse list-unstyled" id="pageSubmenu21">
                        <li>
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Groupe</a>
                            <ul class="collapse list-unstyled " id="homeSubmenu">
                                    <li class="menu_niveau5"> <a href="/groupesdashboard" id="M1">Dashboard groupe</a> </li>
                                    <li class="menu_niveau5"> <a href="/groupes" id="M2">Liste groupe</a> </li>
                                    <li class="menu_niveau5"> <a href="/onboardgroupe"id="M3">Onboard groupe</a> </li>
                                    <li class="menu_niveau5"> <a href="/adhmanuelles" id="M4">Adhésion manuelle</a> </li>
                                    <li class="menu_niveau5"> <a href="/questionads" id="M5">Question d'Adhésion</a> </li>
                                    <li class="menu_niveau5"> <a href="/optimisationactivite" id="M6">Optimisation Activité</a> </li>
                                    <li class="menu_niveau5"> <a href="/dashboardrequalificationgroupe" id="M7">Dashboard Re qualification Groupe</a> </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Campagne</a>
                            <ul class="collapse list-unstyled " id="pageSubmenu">
                                <li class="menu_niveau5"> <a href="/campagnesdashboard" id="M8">Dashboard Campagne </a></li>
                                <li class="menu_niveau5"> <a href="/campagnes" id="M9">Liste Campagne</a> </li>
                                <li class="menu_niveau5"> <a href="/analysecampagne" id="M10">Analyse Campagne</a> </li>
                                <li class="menu_niveau5"> <a href="/processcampagne" id="M11">Process Campagne</a> </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Post</a>
                            <ul class="collapse list-unstyled " id="pageSubmenu1">
                                <li class="menu_niveau5"> <a href="/postmeres" id="M12">Liste des Post Mère </a></li>
                                <li class="menu_niveau5"> <a href="/postpartages" id="M13">Liste des Post Partage</a> </li>
                                <li class="menu_niveau5"> <a href="/postgroupes" id="M14">Liste des Post Groupe</a> </li>
                                <li class="menu_niveau5"> <a href="/dashboardpostmere" id="M15">Dashboard Post Mere</a> </li>
                                <li class="menu_niveau5"> <a href="/dashboardpostpartage" id="M16">Dashboard Post Partage</a> </li>
                                <li class="menu_niveau5"> <a href="/dashboardpostgroupe" id="M17">Dashboard Post Groupe</a> </li>

                            </ul>
                        </li>

                        <li>
                            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">User</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu2">
                                <li class="menu_niveau5"> <a href="/utilisateurs" id="M18">User List </a></li>
                                <li class="menu_niveau5"> <a href="/dashboarduser" id="M19">Dashboard User</a> </li>
                                <li class="menu_niveau5"> <a href="/dashboardaudiencegroupe" id="M20">Dashboard Audience groupe</a> </li>
                                <li class="menu_niveau5"> <a href="/dashboardlalachanteengage" id="M21">Dashboard LalaChante engagé</a> </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Activité -->

                <!-- Analyse et stratégie -->
                <li style="background-color : #DEDEDE ; text-align : center ; color : black">
                    <!-- <h5>Analyse et stratégie<h5> -->
                    <h6 class="mon_h6"><a href="#pageSubmenu20" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau2">Analyse et stratégie</a></h6>
                    <ul class="collapse list-unstyled" id="pageSubmenu20">
                        <li>
                            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Performance</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu3">
                                <li class="menu_niveau5"> <a href="/groupeperformance" id="M22">Groupe performance</a> </li>
                                <li class="menu_niveau5"> <a href="/campagneperformance" id="M23">Compagne perforamnce</a> </li>
                                <li class="menu_niveau5"> <a href="/segmentperformance" id="M24">Segement performance</a> </li>
                                <li class="menu_niveau5">  <a href="/segmentationperformance" id="M25">Segmentation performance</a> </li>
                                <li class="menu_niveau5"> <a href="/teamperformance" id="M26">Team performance</a> </li>
                                <li class="menu_niveau5"> <a href="/ambassadeurperformance" id="M27">Ambassadeur performance</a> </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Data analyse</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu4">
                                <li class="menu_niveau5"> <a href="/analysetags" id="M28">Analyse des tags </a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Segmentation</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu5">
                                <li class="menu_niveau5"> <a href="/segmentsdashboard" id="M29">Dashboard Segment </a></li>
                                <li class="menu_niveau5"> <a href="/segementations" id="M30">Segmentation </a></li>
                                <li class="menu_niveau5"> <a href="/segements" id="M31">Segment</a> </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#pageSubmenu6" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Stratégie </a>
                            <ul class="collapse list-unstyled" id="pageSubmenu6">
                                <li class="menu_niveau5"> <a href="/dashboardstrategie" id="M32">Dashboard stratégie</a></li>
                                <li class="menu_niveau5"> <a href="/planificationcampagnes" id="M33">Planification compagnes</a> </li>
                                <li class="menu_niveau5"> <a href="/ambassadeurs" id="M34">Ambassadeur List </a> </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Analyse et stratégie -->

                <!-- Administration -->
                <li style="background-color : #DEDEDE ; text-align : center ; color : black">
                    <!-- <h5>Administration<h5> -->
                    <h6 class="mon_h6"><a href="#pageSubmenu19" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau2">Administration</a></h6>
                    <ul class="collapse list-unstyled" id="pageSubmenu19">

                        <li>
                            <a href="#pageSubmenu7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Administration</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu7">
                                <li class="menu_niveau5"> <a href="/users" id="M35"> Team</a> </li>
                                <li class="menu_niveau5"> <a href="/crud" id="M36">Crud</a> </li>
                                <li class="menu_niveau5"> <a href="/administrationlistes" id="M37">Administration des listes</a> </li>
                                <li class="menu_niveau5"> <a href="/roles" id="M60"> Roles</a> </li>
                                <li class="menu_niveau5"> <a href="/permissions" id="M61"> Permissions</a> </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#pageSubmenu8" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Page script</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu8">
                                <li class="menu_niveau5"> <a href="/publiergroupe" id="M38">0_Publier_Groupe </a></li>
                                <li class="menu_niveau5"> <a href="/partagepublications" id="M39">1_Partage_Publications</a> </li>
                                <li class="menu_niveau5"> <a href="/cherchepublications" id="M40">2_Cherche_Publications</a> </li>
                                <li class="menu_niveau5"> <a href="/engagements" id="M41">3_Engagements_Posts<br>_Partagés</a> </li>
                                <li class="menu_niveau5"> <a href="/insightspost" id="M42">4_Insights_Post_Mere </a></li>
                                <li class="menu_niveau5"> <a href="/insightspage" id="M43">5_Insights_Page_LLC</a> </li>
                                <li class="menu_niveau5"> <a href="/releveinfo" id="M44">6_Releve_Info_Groupe</a> </li>
                                <li class="menu_niveau5"> <a href="/adhesion" id="M45">7_Adhésion</a> </li>
                                <li class="menu_niveau5"> <a href="/notifications" id="M46">8_Notifications</a> </li>
                                <li class="menu_niveau5"> <a href="/relevecentposts" id="M47">9_Releve_100_Post_Groupe</a> </li>
                                <li class="menu_niveau5"> <a href="/recherchenouveauxgroupe" id="M48">10_Rechercher_nouveaux<br>_groupe</a> </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Administration -->

                <!-- Infrastructure -->
                <li style="background-color : #DEDEDE ; text-align : center ; color : black">
                    <!-- <h5>Infrastructure<h5> --> 
                    <!-- <div></div> -->
                    <h6 class="mon_h6"><a href="#pageSubmenu18"  data-toggle="collapse" aria-expanded="false"  class="dropdown-toggle menu_niveau2">Expérience</a></h6>
                    <ul class="collapse list-unstyled " id="pageSubmenu18">
                        <li>
                            <a href="#pageSubmenu10" data-toggle="collapse" aria-expanded="false"  class="dropdown-toggle menu_niveau3">App Expérience</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu10">

                                <li>
                                    <a href="#pageSubmenu14" data-toggle="collapse" aria-expanded="false" id="smen" class="dropdown-toggle menu_niveau4 ">Réservations & Facturation</a>
                                    <ul class="collapse list-unstyled" id="pageSubmenu14">
                                        <li class="menu_niveau5" id="ssmen"> <a href="/reservationclient.index" id="M49">Suivi Réservation</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/clients.index" id="M51"> Client</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/factures" id="M54">Factures</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/paiementss" id="M90">Paiements</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#pageSubmenu13" data-toggle="collapse" aria-expanded="false" id="smen" class="dropdown-toggle menu_niveau4" >Gestion des Experiences</a>
                                    <ul class="collapse list-unstyled" id="pageSubmenu13">
                                        <li class="menu_niveau5" class="menu_niveau5" id="ssmen"> <a href="/experience.index" id="M50">Expérience</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/experimentateurs.index" id="M95">Experimentateur</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/interactions.index" id="M97">Intéractions</a> </li>
                                    </ul>
                                </li>
                                
                                <li>
                                    <a href="#pageSubmenu15" data-toggle="collapse" aria-expanded="false" id="smen" class="dropdown-toggle menu_niveau4">Interaction & Contenu</a>
                                    <ul class="collapse list-unstyled" id="pageSubmenu15">
                                        <li class="menu_niveau5" id="ssmen"> <a href="/contents.index" id="M96">Contents Expérience</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/storytellings.index" id="M98">Storytellings</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/bonscadeau.index" id="M57">Bon Cadeau</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#pageSubmenu16" data-toggle="collapse" aria-expanded="false" id="smen" class="dropdown-toggle menu_niveau4">Produit Offres & Promotions</a>
                                    <ul class="collapse list-unstyled" id="pageSubmenu16">
                                        <li class="menu_niveau5" id="ssmen"> <a href="/produitservice.index" id="M53">Produit</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/packs.index" id="M56">Pack</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/remises.index" id="M92">Remise</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/codespromo.index" id="M99">Codes Promo</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#pageSubmenu17" data-toggle="collapse" aria-expanded="false" id="smen" class="dropdown-toggle menu_niveau4">Contacts & Relations</a>
                                    <ul class="collapse list-unstyled" id="pageSubmenu17">
                                        <li class="menu_niveau5" id="ssmen"> <a href="/contacts.index" id="M52">Contact</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/entreprises.index" id="M91">Entreprise</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/partenaires.index" id="M93">Partenaire</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/intervenants.index" id="M94">Intervenant</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#pageSubmenu23" data-toggle="collapse" aria-expanded="false" id="smen" class="dropdown-toggle menu_niveau4">Administration Exp</a>
                                    <ul class="collapse list-unstyled" id="pageSubmenu23">
                                        <li class="menu_niveau5" id="ssmen"> <a href="/maileclipse/mailables" id="M91">Email Template</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#pageSubmenu24" data-toggle="collapse" aria-expanded="false" id="smen" class="dropdown-toggle menu_niveau4">Contribution</a>
                                    <ul class="collapse list-unstyled" id="pageSubmenu24">
                                        <li class="menu_niveau5" id="ssmen"> <a href="/cagnottes.index" id="M70">Cagnottes</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/contributions.index" id="M71">Contributions</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/contributeurs.index" id="M72">Contributeurs</a> </li>
                                        <li class="menu_niveau5" id="ssmen"> <a href="/cagnottecategories.index" id="M72">Cagnotte Catégories</a> </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu11" data-toggle="collapse" aria-expanded="false"  class="dropdown-toggle menu_niveau3">Evènement</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu11">
                                <li class="menu_niveau5"> <a href="/"></a> </li>
                                <li class="menu_niveau5"> <a href="/"></a> </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu12" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Automation</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu12">
                                <li class="menu_niveau5"> <a href="/notif.index" id="M55">Notification</a> </li>
                                <li class="menu_niveau5"> <a href="/">Automat</a> </li>
                            </ul>
                        </li>
                    </ul>    
                </li>
                <!-- Infrastructure -->
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="{{ route('logout') }}" class="download">Déconnexion</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <!--

            ICI

-->
                </div>
            </nav>
            <main>
                <div class="container-fluid px-5">

                    <div class="row">
                        @yield('content')
                    </div>



            </main>

        </div>
    </div>
    <script>
        import axios from 'axios';
        window.axios = axios;

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
    </script>
    <!-- Style -->
    <style>
        @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

        body {
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
            font-size: 12px
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            font-weight: 300;
            line-height: 1.7em;
            color: #999;
        }
        #smen{
            margin-left:-13px;
            font-weight:500;
            background-color:#61686b;;
        }
        

        a,
        a:hover,
        a:focus {
            color: inherit;
            text-decoration: none;
            transition: all 0.5s;
        }

        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 40px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-btn {
            box-shadow: none;
            outline: none !important;
            border: none;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 40px 0;
        }

        /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #616161;
            color: #fff;
            transition: all 0.5s;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #333333;
            color: #17a2b8
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }
        /* -------------------------yasser-------------------------------------- */
        .mon_h6{
            height: 37px;
        }
        .menu_niveau2:hover{
            background-color: #333333 !important;
        }
        .menu_niveau2 ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background: #333333;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }
        /* ----------------------- */
        .menu_niveau3{
            text-align: left!important;
            padding-left: 10px !important;
            background-color: #61686b !important;
        }
        .menu_niveau3:hover{
            background-color: #333333 !important;
        }
        .menu_niveau3 ul li a {
            text-align: left!important;
            padding-left: 10px !important;
        }
        /* --------------------- */
        .menu_niveau4{
            text-align: left!important;
            padding-left: 30px !important;
            background-color: #756d6d !important;
        }
        .menu_niveau4:hover{
            background-color: #333333 !important;
        }
        /* ---------------------- */
        .menu_niveau5{
            text-align: left!important;
            /* padding-left: 30px !important; */
        }
        /* ------------------------yasser---------------------------------------- */
        #sidebar ul li a:hover {
            color: #fff;
        }
        
        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background: #333333;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #808080;
            color: #fff;
        }
        

        ul.CTAs {
            padding: 20px;
        }

        ul.CTAs a {
            text-align: center;
            font-size: 0.9em !important;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        a.download {
            background: #17a2b8;
            color: #fff;
        }

        a.article,
        a.article:hover {
            background: 5 !important;
            color: #fff !important;
        }


        /* ---------------------------------------------------
            CONTENT STYLE
        ----------------------------------------------------- */

        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.5s;
        }

        /* ---------------------------------------------------
            MEDIAQUERIES
        ----------------------------------------------------- */

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #sidebarCollapse span {
                display: none;
            }
        }
    </style>
 <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

</body>

</html>
