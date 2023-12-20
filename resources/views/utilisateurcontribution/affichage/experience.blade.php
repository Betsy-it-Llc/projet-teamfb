@extends('layouts.app')
@section('content')
    <main>
    <div style="display: flex; flex-direction: column; width: 100%; gap: 2rem">
 <div
      class="container-fluid"
      style="display: flex; flex-direction: column; gap: 3rem"
    >
      <!-- ----------------------------------navbar------------------------------------- -->
      <div
        style="
          display: flex;
          align-items: center;
          justify-content: space-between;
        "
      >
        <h2>logo</h2>
        <div style="display: flex">
          <ul
            style="font-size: 20px; display: flex; gap: 4rem; list-style: none"
          >
            <li>
              <a style="text-decoration: none; color: black" href="#"
                >Créer un projet</a
              >
            </li>
            <li>
              <a style="text-decoration: none; color: black" href="#"
                >Créer une cagnote</a
              >
            </li>
          </ul>
        </div>
      </div>

      <!-- ------------------------------------header banner--------------------------------- -->
      <div style="display: flex; height: 400px; width: 90%; margin: auto">
        <img
          src="ANALYSE.jpg"
          alt=""
          style="display: flex; height: 100%; width: 100%; border-radius: 10px"
        />
      </div>

      <!-- -------------------------------------button creer un projet------------------------------- -->
      <div
        style="
          display: flex;
          height: 45px;
          width: 90%;
          margin: auto;
          justify-content: end;
        "
      >
        <button
          class="btn"
          style="
            width: 15%;
            border-radius: 5px;
            margin-right: 10%;
            background: rgb(230, 228, 228);
            border: none;
          "
        >
          Créer un projet
        </button>
      </div>

      <!-- --------------------------------------section detail title---------------------------- -->
      <div
        style="
          border-radius: 5px;
          display: flex;
          width: 90%;
          margin: auto;
          background: rgb(244, 247, 247);
        "
      >
        Aliquam. Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Aliquid quaerat velit aut eligendi nihil voluptatibus mollitia explicabo
        iste unde beatae illum laborum deleniti accusamus sequi voluptatem,
        deserunt architecto rem ab. Lorem ipsum dolor sit, amet consectetur
        adipisicing elit. Consequatur praesentium corporis quae quod ab alias
        vitae quis temporibus, dolore dicta optio. Expedita a alias vitae
        asperiores eligendi facere sapiente sequi! Lorem ipsum dolor sit, amet
        consectetur adipisicing elit. Obcaecati assumenda deserunt sed
        dignissimos eaque ut voluptas. Ratione nisi cupiditate labore laborum
        vitae placeat inventore, reprehenderit aut dolorem minus. Praesentium,
        sint. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
        minus cupiditate nihil at quidem reiciendis modi tempore eaque voluptate
        amet impedit non quos magni nam optio doloremque, delectus eveniet eos?
      </div>

      <!--------------------------------------------projet----------------------------------- -->
      <h1 style="border-radius: 10px; display: flex; width: 90%; margin: auto">
        Projets
      </h1>
      <div style="background: rgb(250, 248, 248); width: 90%; margin: auto">
        <div class="container">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-4">
                    <!--  -->
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card" style="height: 300px; width: 300px">
                          <div class="card-body">
                            <img
                              src="noel.webp"
                              alt="Image 1"
                              style="height: 80%; width: 100%"
                            />
                            <p>
                              Lorem ipsum dolor sit amet consectetur,
                              adipisicing elit.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--  -->
                  </div>
                  <div class="col-4">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card" style="height: 300px; width: 300px">
                          <div class="card-body">
                            <img
                              src="noel.webp"
                              alt="Image 1"
                              style="height: 80%; width: 100%"
                            />
                            <p>
                              Lorem ipsum dolor sit amet consectetur,
                              adipisicing elit.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card" style="height: 300px; width: 300px">
                          <div class="card-body">
                            <img
                              src="noel.webp"
                              alt="Image 1"
                              style="height: 80%; width: 100%"
                            />
                            <p>
                              Lorem ipsum dolor sit amet consectetur,
                              adipisicing elit.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row">
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card" style="height: 300px; width: 300px">
                          <div class="card-body">
                            <img
                              src="noel.webp"
                              alt="Image 1"
                              style="height: 80%; width: 100%"
                            />
                            <p>
                              Lorem ipsum dolor sit amet consectetur,
                              adipisicing elit.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card" style="height: 300px; width: 300px">
                          <div class="card-body">
                            <img
                              src="noel.webp"
                              alt="Image 1"
                              style="height: 80%; width: 100%"
                            />
                            <p>
                              Lorem ipsum dolor sit amet consectetur,
                              adipisicing elit.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card" style="height: 300px; width: 300px">
                          <div class="card-body">
                            <img
                              src="noel.webp"
                              alt="Image 1"
                              style="height: 80%; width: 100%"
                            />
                            <p>
                              Lorem ipsum dolor sit amet consectetur,
                              adipisicing elit.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <a
              class="carousel-control-prev"
              href="#myCarousel"
              role="button"
              data-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
                style="margin-left: -200px"
              ></span>
              <span class="sr-only">Previous</span>
            </a>
            <a
              class="carousel-control-next"
              href="#myCarousel"
              role="button"
              data-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
                style="margin-left: 100px"
              ></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <div
        style="
          display: flex;
          height: 45px;
          width: 90%;
          margin: auto;

          justify-content: center;
        "
      >
        <button
          class="btn"
          style="
            border: none;
            width: 20%;
            border-radius: 5px;
            background: rgb(230, 228, 228);
          "
        >
          Participer a un projet
        </button>
      </div>

      <!-- -----------------------------contribution--------------------------------- -->
      <h1 style="border-radius: 5px; display: flex; width: 90%; margin: auto">
        Contribuer sur un projet
      </h1>
      <div>
        <div
          style="
            border-radius: 10px;
            background: rgb(250, 249, 249);
            width: 90%;
            margin: auto;
          "
        >
          <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="row">
                    <div class="col-4">
                      <!--  -->
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card" style="height: 300px; width: 300px">
                            <div class="card-body">
                              <img
                                src="noel.webp"
                                alt="Image 1"
                                style="height: 80%; width: 100%"
                              />
                              <p>
                                Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--  -->
                    </div>
                    <div class="col-4">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card" style="height: 300px; width: 300px">
                            <div class="card-body">
                              <img
                                src="noel.webp"
                                alt="Image 1"
                                style="height: 80%; width: 100%"
                              />
                              <p>
                                Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card" style="height: 300px; width: 300px">
                            <div class="card-body">
                              <img
                                src="noel.webp"
                                alt="Image 1"
                                style="height: 80%; width: 100%"
                              />
                              <p>
                                Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card" style="height: 300px; width: 300px">
                            <div class="card-body">
                              <img
                                src="noel.webp"
                                alt="Image 1"
                                style="height: 80%; width: 100%"
                              />
                              <p>
                                Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card" style="height: 300px; width: 300px">
                            <div class="card-body">
                              <img
                                src="noel.webp"
                                alt="Image 1"
                                style="height: 80%; width: 100%"
                              />
                              <p>
                                Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card" style="height: 300px; width: 300px">
                            <div class="card-body">
                              <img
                                src="noel.webp"
                                alt="Image 1"
                                style="height: 80%; width: 100%"
                              />
                              <p>
                                Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <a
                class="carousel-control-prev"
                href="#myCarousel"
                role="button"
                data-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                  style="margin-left: -200px"
                ></span>
                <span class="sr-only">Previous</span>
              </a>
              <a
                class="carousel-control-next"
                href="#myCarousel"
                role="button"
                data-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                  style="margin-left: 100px"
                ></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div
        style="
          display: flex;
          height: 45px;
          width: 90%;
          margin: auto;

          justify-content: center;
        "
      >
        <button
          class="btn"
          style="
            border: none;
            width: 15%;
            border-radius: 5px;
            background: rgb(230, 228, 228);
          "
        >
          Contribuer
        </button>
      </div>
    </div>
    </main>

@endsection