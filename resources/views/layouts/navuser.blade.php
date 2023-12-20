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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
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
                <h3>Nom organisation ou Prenom</h3>
                <h3 style="color:red">Nom Prenom</h3>
            </div>

            <ul class="list-unstyled components">
                <li> <a href="/home" id="M00">Accueil</a> </li>
                <li> <a href="/utilisateur/contribution/suivipaiement" id="M0">Suivi Paiement</a> </li>
                
                <br>

                <!-- Suivi Paiment -->
                <li style="background-color : #DEDEDE ; text-align : center ; color : black">
                    <!-- Mon compte -->
                    <h6 class="mon_h6"><a href="#pageSubmenu19" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau2">Mon Compte</a></h6>
                    <ul class="collapse list-unstyled" id="pageSubmenu19">

                        <li>
                            <a href="#pageSubmenu7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menu_niveau3">Mon compte</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu7">
                                <li class="menu_niveau5"> <a href="#" id="M35"> Page Organisation</a> </li>
                                <li class="menu_niveau5"> <a href="#" id="M36">Versement</a> </li>
                                <li class="menu_niveau5"> <a href="/utilisateur/contribution/parametre" id="M37">Paramètre</a> </li>
                                <li class="menu_niveau5"> <a href="/utilisateur/contribution/droit" id="M60"> Droit d'accès</a> </li>
                            </ul>
                        </li>
                <!-- Mon compte -->

              

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="{{ route('utilisateur.logout') }}" class="download">Déconnexion</a>
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
