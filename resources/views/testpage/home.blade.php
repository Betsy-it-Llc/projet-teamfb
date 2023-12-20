@extends('layouts.appwithtailwind')

@section('content')

  <body>
    <div style="display: flex; flex-direction: column; width: 100%; gap: 2rem">
      <!-- ------------------------------navbar-------------------------------------- -->
      <div
        class="container"
        style="
          display: flex;
          align-items: center;
          justify-content: space-between;
          align-items: center;
        "
      >
        <h2>logo</h2>
        <div style="display: flex; align-items: center">
          <ul
            style="
              font-size: 20px;
              display: flex;
              gap: 4rem;
              list-style: none;
              align-items: center;
            "
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
      <!-- ---------------------------section validation-------------------------------------- -->
      <div style="align-items: end; display: flex; width: 100%; height: 50px">
        <a
          href="#"
          style="
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 8%;
            font-size: 20px;
            color: black;
            background: rgb(202, 200, 200);
            height: 50px;
            width: 50px;
            border-radius: 50%;
          "
        >
          <i class="fa fa-arrow-left" style="font-size: 20px"></i
        ></a>
      </div>
      <div
        style="
          display: flex;
          justify-content: center;
          width: 100%;
          height: 100px;
          flex-direction: column;
          align-items: center;
        "
      >
        <h1 style="font-weight: bolder">Contributions</h1>
        <span style="display: flex; margin-top: -5px; font-size: 18px"
          >Projet</span
        >
      </div>

      <!-- --------------------------------transfert--------------------------------- -->
      <div
        style="
          display: flex;
          gap: 1rem;
          width: 100%;
          margin: auto;
          margin-top: -30px;
        "
      >
        <div
          class="card"
          style="
            display: flex;
            width: 20%;
            height: 150px;
            margin-left: 70%;
            margin-top: -50px;
          "
        >
          <div
            class="card-body"
            style="
              display: flex;
              flex-direction: column;
              justify-content: center;
              margin: auto;
            "
          >
            <h5 class="card-title" style="font-size: 50px">8€</h5>
            <h6 class="card-title">Montant disponible</h6>
          </div>
        </div>
      </div>
      <!-- ------------------------------end transfert------------------------ -->

      <div style="display: flex; width: 70%; margin: auto">
        <h7
          style="
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
          "
        >
          <i class="fa fa-arrow-right"></i>
          <span style="margin-left: 10px"> Obtenir un versement immédiat </span>
        </h7>
      </div>

      <!-- --------------------------table------------------------------- -->
      <div style="display: flex; width: 50%; margin: auto; margin-top: 2%">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">Contributions</th>
              <th scope="col">Contributeur</th>
              <th scope="col">Projet</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>5€</td>
              <td>Otto</td>
              <td>Experience1</td>
            </tr>
            <tr>
              <td>2€</td>
              <td>Thornton</td>
              <td>Experience2</td>
            </tr>
            <tr>
              <td>1€</td>
              <td>Otto</td>
              <td>Experience3</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- ---------------------------button--------------------------- -->
      <div
        style="
          display: flex;
          width: 70%;
          margin: auto;
          margin-bottom: 20px;
          margin-top: 4%;
        "
      >
        <button
          class="btn"
          style="background: rgb(216, 212, 212); margin: auto"
        >
          Télécharger la liste
        </button>
      </div>
    </div>
@endsection