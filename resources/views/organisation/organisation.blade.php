@extends('layouts.app')
@section('content')
    <main>
            <div class="container-xxl bg-primary" style="height: 15rem; display: flex; align-items: end;justify-content: center; font-size: 40px; font-weight: bold;">Resto Coeur</div>

    <div class="mt-5" style="display: flex; gap: 1rem; ">
        <div class="col-sm-6" style="width: 60%; margin-left: 13%;">
          <div class="">
            <div class="card-body" style="display: flex; flex-direction: column; gap: 3REM;">
                <div class="description">
              <h5 class="card-title" style="font-size: 25px; font-weight: bold;">Description du projet</h5>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quasi dolore maxime voluptatem esse obcaecati ea quidem porro alias, neque officiis cum itaque hic soluta! Assumenda reiciendis dolorum nisi ratione!. Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias officia minima nisi, deserunt consectetur placeat quo delectus veritatis quaerat magni error repellat soluta tempore ipsa quasi id ullam temporibus consequatur!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati molestias, possimus unde et aut saepe, beatae labore, tempore iusto consequatur numquam? Praesentium pariatur expedita itaque quae cupiditate tempora. Cumque, dolorem.
              </p>
            </div>
            <div class="description" style="display: flex; gap: 3rem; width: 100%; height: 100%;">
              <div class="presentation" style="width: 40%;">
                <h5 class="card-title" style="font-size: 25px; font-weight: bold;">presentation Projet</h5>
                  <iframe width="100%"  src="https://www.youtube.com/embed/fekRpRMFwZ0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>    
            <div class="detail" style="width: 60%;">
                <h5 class="card-title" style="font-size: 25px; font-weight: bold;">Qui Nous Sommes ?</h5>
                <p class="card-text mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur mollitia eveniet tempora distinctio, dolore ullam aliquid explicabo autem ipsum nostrum, corporis a necessitatibus illum perspiciatis eos, maiores aut dolorum eius?With supporting text below as a natural lead-in to additional content.</p>
            
            </div>
            </div>
              <div class="description">
                <h5 class="card-title" style="font-size: 25px; font-weight: bold;">Pourquoi ?</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam ipsum esse explicabo culpa fuga 
                    sequi molestiae, tempore natus, aliquid accusamus distinctio deleniti similique, dolores labore. Provident, consequuntur maiores. Expedita, eligendi.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- -------------------------------------------section Soutiens ---------------------------------->
        <div class="col-sm-2" style="width: 25%;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="font-size: 40px; font-weight: bold;">Soutiens</h5>
             <div class="flex" style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; flex-direction: column; gap: 1REM;">
                    <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Organisation</h5>
                    <div>
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        </div>
                    
                </div>
                <div>
                    <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Experimentateur</h5>
                    <div>
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.png')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        <img src="{{ asset('/img/image.jpg')}}" alt="" style=" height: 50px; width: 50px; border-radius: 50%;">
                        </div>
                </div>
                <div>
                    <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Actualité</h5>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore tenetur nulla, consectetur vero, exercitationem quae officia praesentium voluptas eligendi corporis placeat totam,
                        alias ab excepturi ducimus esse quibusdam eos iure.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ---------------------------------------------end section soutiens------------------------------- -->

      <!-- ------------------------------------------------------section video------------------------------------- -->
    <div class="mt-5" style="margin-left: 13%; display: flex; width: 60%">
      <div class="" style="display: flex; flex-direction: column">
        <div style="margin-left: 2%; font-size: 25px; font-weight: bold;">Experience</div>
        <div class="card-body" style="display: flex; gap: 1rem">
          <div class="card-body border" >
            <iframe width="100%"  src="https://www.youtube.com/embed/fekRpRMFwZ0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

            <span>Lorem ipsum dolor sit amet consectetur adipisicing </span>
          </div>
                    <div class="card-body border" >
            <iframe width="100%"  src="https://www.youtube.com/embed/fekRpRMFwZ0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

            <span>Lorem ipsum dolor sit amet consectetur adipisicing </span>
          </div>
          <div class="card-body border" >
            <iframe width="100%"  src="https://www.youtube.com/embed/fekRpRMFwZ0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

            <span>Lorem ipsum dolor sit amet consectetur adipisicing </span>
          </div>
        </div>
      </div>
    </div>

    </main>

@endsection