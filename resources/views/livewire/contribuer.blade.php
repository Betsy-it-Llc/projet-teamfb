<div>
    <head>
        @if($experience->visibility=='unlisted')
            <meta name="robots" content="noindex, nofollow">
        @endif
        {{-- share-this --}}
        <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6514397ce1f72300199c7dc4&product=sticky-share-buttons&source=platform" async="async"></script>
        {{-- fontawesome library cdn --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- bootstrap library cdn --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <!-- NAVBAR -->
    <div>
        <header>
            <nav class=" navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid ">
                  <a class="navbar-brand" href="#">Expérience</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Contributeurs</a>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
        </header>
            <main class="container my-2">
                <div class="row text-center tags-color h1 ">
                        <p class="col tags-bg-color mx-1">Expérience</p>
                        <p class="col tags-bg-color mx-1">Passion</p>
                        <p class="col tags-bg-color mx-1">Solidaire</p>
                        <p class="col tags-bg-color mx-1">Ensemble</p>
                        <p class="col tags-bg-color mx-1">Urban</p>
                        <p class="col tags-bg-color mx-1">Pop</p>
                </div>
                <hr>
                @isset($cagnotte)
                    <h1 class="text-center tags-color text-break" style="font-size:4rem;">{{$experience->nom_experience}}<br><span class="h4">{{$cagnotte->categorie->nom}}</span></h1>
                @else
                    <h1 class="text-center tags-color text-break">Pas de titres, pas de catégories<h1>
                @endisset
                <h2 class="tags-color tags-bg-color mx-1 d-inline-block p-2">L'Expérience</h2>
                <iframe width="100%" height="600px" src="https://www.youtube.com/embed/{{$videoId}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <div class="d-flex justify-content-around my-4">
                   {{-- share-this --}}
                   <div class="sharethis-sticky-share-buttons"></div>
                    <div class="d-flex flex-wrap d-none">
                        <div class="mx-2">like</div>
                        <div class="mx-2">com</div>
                        <div class="mx-2">partage</div>
                    </div>
                    <a type="button" class="btn text-white" style="background-color: #FE2C55">Suivre</a>
                </div>
                    <section class="row">
                        <div class="col-12 col-lg-9">
                            @isset($videoPrincipale)
                                <h3>{{$experience->nom_experience}} Cover "{{$videoPrincipale->titre}}" l'Expérience LalaChante</h3>
                                @else
                                <h3>Aucun titre disponible</h3>
                            @endisset
                            @if (empty($storytelling) && isset($storytelling))
                                <p>{{$storytelling->description}}</p>
                            @else
                                <p>Aucun texte dispnible</p>
                            @endif
                            
                            <div class="text-center ">
                                <button type="button" class="btn btn-primary btn-lg my-5 rounded rounded-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Je Contribue</button>
                            </div>
                        </div>
                        <div class="col">
                            @isset($photoExperience1)
                                <div>
                                    <div style="width:100%;height:200px">
                                        <img style="width:100%;height:200px" src="{{$photoExperience1->getUrl()}}" alt="photo expérience">
                                    </div>
                                </div>
                                @else
                                    <div>Aucune photo d'experiences disponible</div>
                                
                            @endisset
                            <div class="d-flex justify-content-center align-items-center cagnotte-bg my-2" style="width: 100%;height:200px">
                                @persist('cagnotte')
                                <livewire:cagnotte :$cagnotte :$contributeurs :$objectifCagnotte :$pourcentageAvancementCagnotte :$idExperience />
                                @endpersist()
                            </div>
                        </div>
                    </section>
                    <section class="row col-lg-12">
                        <div class="col-12 col-lg-7">
                            <h3 class="tags-bg-color tags-color  p-2 h2">L'interview</h3>
                            @if (!empty($videoIdInterview))
                                    <video style="width:100%;height:400px;" controls controlsList="nodownload" width="auto" height="auto">
                                        <source src="https://drive.google.com/uc?export=download&id={{$videoIdInterview}}" type='video/mp4'>
                                    </video>
                                @else
                                    <div>il n'y a pas de videos d'interview</div>
                            @endif
                            <br>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary btn-sm my-2 rounded rounded-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Je Contribue</button>
                            </div>
                            <h4>Share Projet</h4>
                            <div class="row d-flex justify-content-center">
                                @isset($photoExperience2)
                                    <div class="col col-4 my-2 d-flex align-items-center">
                                        <img style="width:100%" height="auto" src="{{$photoExperience2->getUrl()}}" alt="photo expérience">
                                    </div>
                                @else
                                    <div class="col col-4 my-2 d-flex align-items-center">
                                        Pas de photos disponibles
                                    </div>
                                @endisset
                                
                                @if (!empty($fileId))
                                    <video style="width: calc(9/16 * 400px);height: 400px;" controls width="auto" height="300">
                                        <source src="https://drive.google.com/uc?export=download&id={{$fileId}}" type='video/mp4'>
                                    </video>
                                @else
                                    <div>il n'y a pas encore de videos dans l'emplacement 1</div>
                                @endif
                                @if (!empty($fileId_2))
                                    <video style="width: calc(9/16 * 400px);height: 400px;" controls width="auto" height="300">
                                        <source src="https://drive.google.com/uc?export=download&id={{$fileId_2}}" type='video/mp4'>
                                    </video>
                                    @else
                                    <div>il n'y a pas encore de videos dans l'emplacement 2</div>
                                @endif
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary btn-sm my-2 rounded rounded-5" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btnJeContribue">Je Contribue</button>
                            </div>
                            <h4>Contributeur</h4>
                            <div class="col">
                                <div class="d-flex justify-content-between p-2 tipeur-bg">
                                    <p><b>Top tipeurs</b></p>
                                    <a href="#">Voir tout</a>
                                </div>
                               <div class="d-flex flex-wrap justify-content-center tipeur-bg p-2" >
                                @isset($contributeurApercu)
                                    @foreach ($contributeurApercu->reverse() as $contributeur)
                                        @if ($contributeur->is_anonymous===0)
                                        <figure class="rounded-circle"   style="width:100px;">
                                            <img class="rounded-circle"  style="width:90%;" src="https://img.freepik.com/vecteurs-libre/modele-couverture-album-degrade_23-2150597431.jpg?w=826&t=st=1695726185~exp=1695726785~hmac=e14889f2d09e2bddb652fd3298cf8c4b8f327056f8ef8929e1c14cbe7e5aaa12" alt="">
                                            <figcaption>{{$contributeur->prenom}}  {{$contributeur->nom}}</figcaption>
                                        </figure>
                                        @else
                                        <figure class="rounded-circle"   style="width:100px;">
                                            <img class="rounded-circle"  style="width:90%;" src="https://img.freepik.com/vecteurs-libre/modele-couverture-album-degrade_23-2150597431.jpg?w=826&t=st=1695726185~exp=1695726785~hmac=e14889f2d09e2bddb652fd3298cf8c4b8f327056f8ef8929e1c14cbe7e5aaa12" alt="">
                                            <figcaption>Contributeur  Anonyme</figcaption>
                                        </figure>
                                        @endif
                                    @endforeach
                                @else
                                    <div>Aucun contributeur disponible</div>   
                                @endisset
                               </div>
                            </div>
                        </div>
                        <div class="col col-lg-5 col-md-12">
                            <h3 class="tags-bg-color tags-color d-inline-block p-2 h2">Commentaire</h3>
                            <livewire:cagnotte-commentaire :$idExperience/>
                        </div>
                        <div class="mt-4">
                            <h3 class="tags-color tags-bg-color d-inline-block p-2 h2">Autres Expériences</h3>
                            <div class="row d-flex flex-wrap justify-content-center">
                                @isset($autresExperiencesEtInfos)
                                    @foreach ($autresExperiencesEtInfos as $item)
                                    @if (count($item->getMedia('prod/header'))>0)
                                        @php
                                            $item->url=$item->getFirstMedia('prod/header')->getUrl()
                                        @endphp
                                    @else
                                        @php
                                            $item->url = 'https://www.lalachante.fr/wp-content/uploads/2022/10/Affiche-Chant-jeunes-1-480x679-1.webp';
                                        @endphp
                                    @endif
                                        <figure class="col col-12 d-flex justify-content-center align-items-center"  style="width:200px;height:200px;">
                                            <a class="text-decoration-none text-dark my-2" style="width:200px;height:200px" href="{{ URL::to('contribution/'.$item->id_experience)}}">
                                                <img   style="width:100%;object-fit:fill" src="{{$item->url}}" alt="{{$item->nom_experience}}">
                                                <figcaption class="text-center">{{$item->nom_experience}}</figcaption>
                                            </a> 
                                        </figure>
                                    @endforeach
                                @else
                                    <div class="col col-12"  style="width:200px;">
                                        Aucunes autres expériences disponibles
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </section>
                </main>
    </div>
    <!-- Modal -->
    <div class="modal fade shadow" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center cagnotte-bg my-2" style="width: 100%; height: 200px">

                        <livewire:cagnotte :$cagnotte :$contributeurs :$objectifCagnotte :$pourcentageAvancementCagnotte :$idExperience />

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <style>
        .tipeur-bg{
            background-color: #FBFBFC;
        }
        .cagnotte-bg{
            background-color: #FFF9F8
        }
        .tags-color{
            color: #42A5F5
        }
        .tags-bg-color{
            background-color: #ECF6FE
        }
        h4{
            color: #8EC351;
        }
    </style>


</div>



