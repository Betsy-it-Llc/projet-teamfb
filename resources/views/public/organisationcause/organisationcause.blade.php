<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organisation Cause</title>

    @vite('resources/sass/app.scss')

    <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> --}}

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  
</head>
<body>
 
<!-- START SECTION EN-TETE -->
<div class="bg-gray-300 p-4">
    <h1 class="text-center text-2xl">En tête</h1>
</div>
<!-- END SECTION EN-TETE -->

<!-- START SECTION MENU -->
<x-organisationcause.menu />
<!-- END SECTION MENU -->

<!-- START SECTION HEADER -->
<x-organisationcause.header />
<!-- END SECTION HEADER -->

<!-- END SECTION ABOUT -->
<x-organisationcause.about />
<!-- END SECTION ABOUT -->

<!-- END SECTION ENGAGEMENT -->
<x-organisationcause.engagement />
<!-- END SECTION ENGAGEMENT -->

<!-- START SECTION SOUTENIR -->
<x-organisationcause.soutenir />
<!-- END SECTION SOUTENIR -->

<!-- START SECTION SOUTIENS -->
<x-organisationcause.soutiens />
<!-- END SECTION SOUTIENS -->

<!-- START SECTION EXPERIENCE -->
<x-organisationcause.experience />
<!-- END SECTION EXPERIENCE -->

<!-- START SECTION FOOTER 1 -->
<x-organisationcause.footer />
<!-- END SECTION FOOTER 1 -->

<!-- START SECTION FOOTER 2 -->
<div class="bg-gray-300 p-4">
    <h1 class="text-center text-2xl">Footer 2</h1>
</div>
<!-- END SECTION FOOTER 2 -->
    
</body>
</html>