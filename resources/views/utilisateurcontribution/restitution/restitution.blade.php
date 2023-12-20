@extends('layouts.app')
@section('content')
    <main>
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
              <a style="text-decoration: none; color: black" href="{{route('creation.type')}}"
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
        <h1 style="font-weight: bolder">Restitutions</h1>
        <span
          style="
            display: flex;
            margin-top: -5px;
            font-size: 25px;
            margin-left: 10%;
          "
          >Contributions</span
        >
      </div>

      <!-- --------------------------------transfert--------------------------------- -->
      <div
        style="
          display: flex;
          gap: 1rem;
          width: 100%;
          margin: auto;
          margin-top: -100px;
        "
      >
        <div
          class="card"
          style="display: flex; width: 20%; height: 150px; margin-left: 70%"
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
            <h5 class="card-title" style="font-size: 50px">{{ $montantTotal }}€</h5>
            <h6 class="card-title">Montant disponible</h6>
          </div>
        </div>
      </div>
      <!-- ------------------------------end transfert------------------------ -->

      <div
        style="
          display: flex;
          width: 70%;
          margin: auto;
          flex-direction: column;
          gap: 1rem;
        "
      >
        <!-- ------------------------------blog card restitutions ------------------------------------ -->
        <div
          style="
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            width: 100%;
            height: 100px;
            background: rgb(226, 245, 244);
            border-radius: 8px;
          "
        >
          <h6
            style="
              display: flex;
              align-items: end;
              height: 50%;
              font-size: 20px;
              margin-left: 5%;
            "
          >
            <i class="fa fa-arrow-circle-right"></i>
            <span style="margin-left: 10px"> Récupérer des Expériences</span>
          </h6>
          <button
            class="btn"
            style="
              display: flex;
              margin-left: 60%;
              width: 30%;
              border-radius: 5px;
              height: 50%;
              align-items: center;
              justify-content: center;
              border: none;
              background: rgb(216, 219, 216);
              margin-bottom: 10px;
            "
          >
            Je crédite mon compte
          </button>
        </div>

        <!--  -->
        <div
          style="
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            width: 100%;
            height: 100px;
            background: rgb(226, 245, 244);
            border-radius: 8px;
          "
        >
          <h6
            style="
              display: flex;
              align-items: end;
              height: 50%;
              font-size: 20px;
              margin-left: 5%;
            "
          >
            <i class="fa fa-arrow-circle-right"></i>
            <span style="margin-left: 10px"> Soutenir une cause</span>
          </h6>
          <button onclick="window.location='{{ route('utilisateur.searchcause') }}';"
          style="
              display: flex;
              margin-left: 60%;
              width: 30%;
              border-radius: 5px;
              height: 50%;
              align-items: center;
              justify-content: center;
              border: none;
              background: rgb(216, 219, 216);
              margin-bottom: 10px;
          "
      >
          Découvrir des causes
      </button>
       
        
        </div>
        <!--  -->
        <div
          style="
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            width: 100%;
            height: 100px;
            background: rgb(226, 245, 244);
            border-radius: 8px;
          "
        >
          <h6
            style="
              display: flex;
              align-items: end;
              height: 50%;
              font-size: 20px;
              margin-left: 5%;
            "
          >
            <i class="fa fa-arrow-circle-right"></i>
            <span style="margin-left: 10px"> Soutenir un projet</span>
          </h6>
          <button onclick="window.location='{{ route('utilisateur.searchprojet') }}';"
            class="btn"
            style="
              display: flex;
              margin-left: 60%;
              width: 30%;
              border-radius: 5px;
              height: 50%;
              align-items: center;
              justify-content: center;
              border: none;
              background: rgb(216, 219, 216);
              margin-bottom: 10px;
            "
          >
            Découvrir des projets
          </button>
        </div>
        <!--  -->
        <div
          style="
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            width: 100%;
            height: 100px;
            background: rgb(226, 245, 244);
            border-radius: 8px;
          "
        >
          <h6
            style="
              display: flex;
              align-items: end;
              height: 50%;
              font-size: 20px;
              margin-left: 5%;
            "
          >
            <i class="fa fa-arrow-circle-right"></i>
            <span style="margin-left: 10px"> Soutenir des expérimenteurs</span>
          </h6>
          <button  onclick="window.location='{{ route('utilisateur.searchexperience') }}';"
            class="btn"
            style="
              display: flex;
              margin-left: 60%;
              width: 30%;
              border-radius: 5px;
              height: 50%;
              align-items: center;
              justify-content: center;
              border: none;
              background: rgb(216, 219, 216);
              margin-bottom: 10px;
            "
          >
            Découvrir des expériences
          </button>
        </div>
        <!--  -->
        <div
          style="
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            width: 100%;
            height: 100px;
            background: rgb(226, 245, 244);
            border-radius: 8px;
          "
        >
          <h6
            style="
              display: flex;
              align-items: end;
              height: 50%;
              font-size: 20px;
              margin-left: 5%;
            "
          >
            <i class="fa fa-arrow-circle-right"></i>
            <span style="margin-left: 10px"> Récupérer des fonds</span>
          </h6>
          <button  onclick="window.location='{{ route('utilisateur.recuperation') }}';"
            class="btn"
            style="
              display: flex;
              margin-left: 60%;
              width: 30%;
              border-radius: 5px;
              height: 50%;
              align-items: center;
              justify-content: center;
              border: none;
              background: rgb(216, 219, 216);
              margin-bottom: 10px;
            "
          >
            Découvrir des fonds
          </button>
        </div>
        <!--  -->
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
    </main>
@endsection














