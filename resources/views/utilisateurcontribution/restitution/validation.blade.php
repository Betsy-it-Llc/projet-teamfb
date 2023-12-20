@extends('layouts.app')
@section('content')
    <main>
    <div style="display: flex; flex-direction: column; width: 100%; gap: 2rem">
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
            margin-left: 2%;
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
        <h1 style="font-weight: bolder">Validation</h1>
        <span
          style="
            display: flex;
            margin-top: -5px;
            margin-left: 15%;
            font-size: 18px;
          "
          >Transfère de compte</span
        >
      </div>

      <!-- --------------------------------transfert--------------------------------- -->
      <div style="display: flex; gap: 1rem; width: 70%; margin: auto">
        <div class="card" style="width: 45%; height: 200px">
          <div
            class="card-body"
            style="
              display: flex;
              flex-direction: column;
              justify-content: center;
              margin: auto;
            "
          >
            <h5 class="card-title">Cagnotte</h5>
            <h5 class="card-title" style="font-size: 50px">{{$montantTotalCagnottes}}€</h5>
            <h6 class="card-title">Montant disponible</h6>
          </div>
        </div>

        <div class="" style="width: 10%; height: 200px; display: flex">
          <div
            class="card-body"
            style="display: flex; justify-content: center; align-items: center"
          >
            <h1>
              <i class="fa fa-angle-right"></i>
            </h1>
          </div>
        </div>

        <div class="card" style="width: 45%; height: 200px">
          <div
            class="card-body"
            style="
              display: flex;
              flex-direction: column;
              justify-content: center;
              margin: auto;
            "
          >
            <h5 class="card-title">Compte LalaChante</h5>
            <h5 class="card-title" style="font-size: 50px">{{ $soldeContact }} €</h5>
            <h6 class="card-title">Montant disponible</h6>
          </div>
        </div>
      </div>
      <!-- ------------------------------end transfert------------------------ -->

      <div style="display: flex; width: 70%; margin: auto">
        <h6
          style="
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
          "
        >
          Votre compte LalaChante a bien été crédité
        </h6>
      </div>

      <div
        style="
          display: flex;
          width: 70%;
          margin: auto;
          margin-top: 20px;
          margin-bottom: 10px;
        "
      >
        <button
          type="button"
          class="btn"
          style="background: rgb(216, 212, 212); margin: auto"
        >
          Télécharger la liste
        </button>
      </div>
    </div>
    </main>

@endsection