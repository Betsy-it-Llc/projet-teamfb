<!doctype html>
<html lang="fr">
<head>
    @include('layouts.partials._head') <!-- Inclusion du partial pour la section head -->
</head>
<body style="background-color:#F9F9F9 " class="items-center ">
    @include('layouts.partials._navbar') <!-- Inclusion du partial de la barre de navigation -->

    @include('layouts.partials._container') <!-- Utilisation du layout -->

    @vite('resources/js/app.js')
    @vite('resources/js/blade-app.js')
    @yield('scripts')

</body>
</html>

