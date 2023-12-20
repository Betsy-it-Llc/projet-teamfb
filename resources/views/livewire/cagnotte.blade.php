



<div>
    {{-- In work, do what you enjoy. --}}
    <div class="d-flex">
        <div class="d-flex justify-content-center align-items-center mx-3">Je donne</div>
        <div class="d-flex flex-column">
        </div>
        <div class="d-flex mx-2">
            <div class="h2 d-flex align-items-center">
                <input wire:change="typeAmount(document.querySelector('#numberInput').value)" style="width: 60px" type="number" id="numberInput" min="0" class="form-control text-center" value="{{ $count }}" />
                <span class="h5 mx-2"><i class="fa-solid fa-euro-sign"></i></span>
            </div>
            <a class="d-flex align-items-center" style="text-decoration: none" id="contributeButton" onclick="redirectToOtherPage({{ $idExperience  }}, {{ $count  }})"><i class="fa-solid fa-heart fa-2x d-flex justify-content-center align-items-center mx-3" style="color: #d72d0f;"></i></a>
        </div>
    </div>
    <div class="row">
        @isset($cagnotte)
        <div class="my-2 text-center col">
            <span class="h3 d-block">{{$cagnotte->montant_actuel}} <span class="h4"><i class="fa-solid fa-euro-sign"></i></span></span>
            <span class="badge bg-info text-dark">Contribution</span>
        </div>
        @else
        <div class="my-2 text-center col ">
            <span class="h3 d-block">0<span class="h4"><i class="fa-solid fa-euro-sign"></i></span></span>
            <span class="badge bg-info text-dark">Contribution</span>
        @endisset
        @isset($contributeurs)
        <div class="my-2 text-center col">
            <span class="h3 d-block">{{$contributeurs->count()}}</i></span>
            <span class="badge bg-success text-dark">Contributeurs</span>
        </div>
        @else
        <div class="my-2 text-center col">
            <span class="badge bg-success text-dark">Contributeurs</span>
        </div>
        @endisset
    </div>
    <div>
        @if ($objectifCagnotte == 0 || $objectifCagnotte == null)
        <div class="text-center fw-bold my-2" style="font-size:11px">Simplement pour le plaisir</div>
        @else
        <div class="mt-1 fw-bold">Objectif :</div>
        <div class="text-center fw-bold">{{$objectifCagnotte}} €</div>
        <div class="progress text-center" style="height: 10px;">
            <div class="progress-bar" style="background-color:#FF7043; width:{{$pourcentageAvancementCagnotte}}%;font-size:10px" role="progressbar" aria-valuenow="{{$cagnotte->montant_actuel}}" aria-valuemin="0" aria-valuemax="{{$objectifCagnotte}}">{{$pourcentageAvancementCagnotte}}%</div>
        </div>
        @endif
    </div>
    <style>
        .fa-heart:hover {
            transform: scale(1.2);
            cursor: pointer;
            transition: 200ms;
        }

        input[type="number"] {
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            appearance: textfield;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
    <script>
        let inputNumber = document.querySelector('#numberInput');
        inputNumber.addEventListener("change", handleChange);

        function handleChange() {
            if (document.querySelector('#numberInput').value == '') {
                document.querySelector('#numberInput').value = "{{$count}}";
            }
        }

        function redirectToOtherPage(idExperience, count) {
            // Construire l'URL de redirection avec les paramètres
            const finalUrl = "{{ route('information', ['idExperience' => ':idExperience', 'montant' => ':count']) }}"
            .replace(':idExperience', idExperience)
            .replace(':count', count);


            // Rediriger vers la nouvelle page
            window.location.href = finalUrl;
        }
    </script>
</div>

