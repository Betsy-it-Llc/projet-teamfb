@extends('layouts.appwithtailwind')

@section('content')
<div class="flex justify-center bg-gray-700 h-screen items-center">
    <div class="bg-white shadow-lg h-full w-full sm:w-full md:w-3/5 lg:w-3/6 xl:w-2/6 2xl:w-2/6 4k:w-2/5">
        <div class="w-full h-16 bg-gray-300"></div>
        <button class="pt-3 pl-3 bg-transparent inline-flex items-end md:relative md:left-5 md:top-2">
            <img class="w-5" src="{{ asset('img/arrow.png') }}" alt="arrow">
        </button>
        <button class="pt-8 pr-5 bg-transparent float-right">
            <img class="w-8" src="{{ asset('img/menu.png') }}" alt="menu">
        </button>

        <div class="pt-10 pl-10 text-left">
            <h2 class="text-xl font-display font-bold text-slate-800">Expérience</h2>
            <h1 class="text-5xl font-display font-bold text-slate-800 tel:text-4xl md:text-5xl lg:text-6xl">{{ $experience->nom_experience }}</h1>
        </div>

         <!--  options de modification -->
        <div class="flex">
            <input type="text" id="nouveauMontant" name="nouveauMontant" class="hidden border rounded shadow-inner py-2 px-3 w-1/4 focus:shadow-outline text-right" placeholder="Nouveau montant en €">
            <button id="validerMontant" class="hidden text-base font-display text-slate-800 text-left relative cursor-pointer tel:text-sm ml-2 bg-gray-300 text-black px-7 py-2 rounded hover:bg-gray-600">Valider</button>
        </div>
        
        <form action="{{ route('checkContact') }}" method="post">
            @csrf

            <!-- Affichage du montant  -->
            <p class="text-5xl font-display text-slate-800 text-left tel:ml-9 tel:text-4xl md:text-5xl lg:text-5xl pt-6">{{ $montant }}€</p>
            <p id="modifierMontant" class="text-base font-display text-slate-800 text-left relative tel:text-sm tel:ml-28 md:ml-32 lg:ml-32 tel:bottom-6 cursor-pointer">Modifier le montant</p>
           

            <!-- Options de masquage du montant et d'anonymat -->
            <div>
                <div class="float-right relative tel:right-3 sm:right-10 md:right-12 lg:right-14 xl:right-14">
                    <label for="toggleMontant" class="relative inline-flex items-center mb-5 cursor-pointer">
                        <input type="checkbox" id="toggleMontant" name="hidden" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                <p class="text-sm font-display text-slate-800 tel:ml-9">Masquer le montant</p>
            </div>
            
            <div>
                <div class="float-right relative tel:right-3 sm:right-10 md:right-12 lg:right-14 xl:right-14">
                    <label for="toggleAnonyme" class="relative inline-flex items-center mb-5 cursor-pointer">
                        <input type="checkbox" id="toggleAnonyme" name="anonyme" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                <p class="text-sm font-display text-slate-800 tel:pt-2 tel:ml-9">Rendre ma participation anonyme</p>
            </div>

            <!-- Champs d'informations -->
            <h3 class="text-3xl font-bold font-display text-slate-800 text-center sm:right-4">Mes informations</h3>
            <div class="mb-4 flex-1 md:flex-col justify-center items-center text-center pt-5">
                <label for="prenom" class="block text-gray-600 mb-2"></label>
                <input type="text" id="prenom" name="prenom" placeholder="Prénom" class="border rounded shadow-inner py-2 px-3 text-gray-700 w-3/4 focus:shadow-outline">
            </div>
            <div class="mb-4 text-center">
                <label for="nom" class="block text-gray-600 mb-2"></label>
                <input type="text" id="nom" name="nom" placeholder="Nom" class="border rounded shadow-inner py-2 px-3 text-black w-3/4 focus:shadow-outline">
            </div>
            <div class="mb-4 text-center">
                <label for="email" class="block text-gray-600 mb-2"></label>
                <input type="email" id="email" name="email" placeholder="Email" class="border rounded shadow-inner py-2 px-3 text-black w-3/4 focus:shadow-outline">
            </div>
            <div class="mb-4 text-left relative tel:ml-10 telL:ml-16 sm:ml-24 md:ml-16 lg:ml-16 xl:ml-16">
                <label for="date_naissance" class="block text-gray-600 mb-2"></label>
                <input type="text" id="date_naissance" name="date_naissance" placeholder="Date de naissance" class="border rounded shadow-inner py-2 px-3 w-1/3 tel:w-1/2 telL:w-2/4 sm:w-4/6 tel:text-sm text-black focus:shadow-outline">
            </div>
        
            <!-- Ajout de champs cachés pour idExperience et montant -->
            <input type="hidden" name="id_experience" value="{{ $idExperience }}">
            <input type="hidden" name="montant" value="{{ $montant }}">
        
            <div class="text-center">
                <button type="submit" class="bg-gray-300 text-black px-7 py-2 rounded hover:bg-gray-600">Valider</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modifierMontant = document.getElementById("modifierMontant");
        const nouveauMontant = document.getElementById("nouveauMontant");
        const validerMontant = document.getElementById("validerMontant");
    
        modifierMontant.addEventListener("click", function() {
            nouveauMontant.classList.remove("hidden");
            validerMontant.classList.remove("hidden");
        });
    
        validerMontant.addEventListener("click", function() {
            const saisieMontant = nouveauMontant.value;
            const idExperience = "{{ $idExperience }}"; // Remplacez par la valeur réelle
    
            if (!isNaN(saisieMontant) && parseFloat(saisieMontant) >= 0) {
                // Mettre à jour l'URL avec le nouveau montant
                window.location.href = `/information/${idExperience}/${saisieMontant}`;
            } else {
                alert("Veuillez entrer un montant valide.");
            }
        });
    
        let montant = 0; // 0 signifie inactif par défaut
        let anonyme = 0;   // 0 signifie anonyme par défaut
        console.log(montant);
        const toggleMontant = document.getElementById("toggleMontant");
        const toggleAnonyme = document.getElementById("toggleAnonyme");

        toggleMontant.addEventListener("change", function() {
            if (toggleMontant.checked) {
                montant = 1;
            } else {
                montant = 0;
            }
        });

        toggleAnonyme.addEventListener("change", function() {
            if (toggleAnonyme.checked) {
                anonyme = 1;
            } else {
                anonyme = 0;
            }
        });
    });
</script>

@endsection
