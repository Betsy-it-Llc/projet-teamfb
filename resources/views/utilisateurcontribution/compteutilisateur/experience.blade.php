@extends('layouts.appwithtailwind')

@section('content')


<main>
    <header>
        <div class="flex justify-start ml-12 telL:ml-28">
            <p class="text-2xl md:text-2xl text-black">
                liste
            </p>
        </div>
        <h1 class="h1-maj header-maj">
            mes experiences
        </h1>
        <div class="flex justify-center">
            <p class="text-2xl text-black">
                All Expérience
            </p>
        </div>
        <div class="text-right">
            <span class="somme-cagnotte-disponible">
                {{ $montantTotalDisponible }}€
            </span>
            <span class="text-montant-disponible">
                Montant disponible
            </span>
            <span>
                <h4 class="text-montant-disponible font-bold"> {{$nombreTotalContributions}} </h4>
                <p class="text-montant-disponible">Contributions </p>
            </span>
        </div>
    </header>
    <div class="tel:ml-10 telL:ml-24">
        <svg class="tel:w-32 tel:h-32 md:w-32 md:h-32 tel:justify-start" viewBox="0 0 138 138" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="138" height="138" fill="url(#pattern0)"/>
            <defs>
            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_3447_17913" transform="scale(0.02)"/>
            </pattern>
            <image id="image0_3447_17913" width="50" height="50" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEAklEQVR4nO2YTYiVVRjHf6KYmQop6Xxk2oi6EiNXSdQmVJqJ2ajoTCsXQhCKlEpQuZjatW3UoBRxoaJEjlLjOAkuRBCcwKmFGomlpJRfM43NWF554H/geDr3vV/vfe815g8H5p7/ez6eeT7PA+P4f6EN6AeGgSH93coThk+AXJ7RxROkiRzwN/A+0KixVXO5FDTTloW2v9dlTYgQ28TZwXWv7Xva1LQQokmcfVOv2i5JkNvUp7YfQ782tP9SiO3ieqk/bf8HrZ76t+mAJgkxCjwEVlAe/shSEOR0+Rzywwr27S1C26mZlq+ZfoXHW54zvlLBnqsLaDtVZy8UNk8A7wI9wCXlAhs/A8eBzcDcyPrZwIUETWeWbF8qcAl/jAFfAc97QgyKuyDN9MpnMi1/1ijk5mQCB4B1wGLgGQ37e704ZyZ/AhsCIWZTI2xSpLKLHAJeLGJNC3A40NJgLYVYKyH+AbZ489OAHfoPj2iYfzQH69/TWhPENFMTmMPe0SV8IWYAP+TxDTOpXcCkQBhnZqGgmWCfZ04+PtP8RWAVMBOYBez3MvfHwZojmv+SjDFPJjEa8YlfdKnlkXWvibsczC/QXqNeJMsEroCzCBTCRaSnI9xTnomFOCTOgkdm+FaHWjgNcU2cZeQQjeIsP4ToFHeMDPGbDl0U4X4U92qCadk3IRbnMbuq4r4OnR7h/lJIXhLhlmmdfRNiujjL5JlhRIdavghxTpzVVyGGxZ2NcNMShKwarupQizYhXgZuive1skRzvwNLI+sWir+SxgX97oXVTieVC0L06NCOPPt8HnkpureGcTG8Ld72rgj5uhdm7x95UWej59Cx8OtqKbfewf02LoaD4i3Tl41C3QsTZgD4N1KOxy72bIIgxoUwE32g/WLP3FS7Fzk5+Tcq8FyJ8jUwQfWTmeEe4K64894+A5q7q29WAhO11vY0bi8VopjuhYXcqd681VA3xHV75ubMsU+ljMN8zbmS3+WTbm//xiwEiXUv2r0y3MZ1+Vosmjks0DfXI/74BTC52r2qfN2LTk8YM5EXijjPNHVUa2ztbuUP+30aeK5avapC3Yt25QcXAA6oDmuROU6VJjoUncb0rb1n3vSy/q9eLlmqCrqv1GZ2V4Xdi5l6T7hLJg2LUDuBOcEeDcAZz2celnsfv1dVbveiWS9G1+ca014/6bn7Tp7K2C/1j2bZzE7CFOWcMYXYUvFdEekg9Y4jCSW5NeXKwW2tN1ML0ZAQRVPDW0quLpxbAHi93rvyIT5NcO4PyC4dVKyJQs75RobpoGycKsI5zYFLQVeF6aAsDBVh0/bYKhWtKaSD1Jyz2at66x79tXLOtFEz56wGauKc1ULmzjkO6hCPAOVo9wUWZFpaAAAAAElFTkSuQmCC"/>
            </defs>
        </svg>
    </div>
    <div class="telL:ml-10 mt-20">
        <dl class="flex justify-center space-x-6">
            <div class="div-kpi">
                <dt class="text-kpi">Like</dt>
                <dd class="donne-kpi">10</dd>
            </div>
            <div class="div-kpi">
                <dt class="text-kpi">Follow</dt>
                <dd class="donne-kpi">35</dd>
            </div>
            <div class="div-kpi">
                <dt class="text-kpi">Share</dt>
                <dd class="donne-kpi">35</dd>
            </div>
            <div class="div-kpi">
                <dt class="text-kpi">Vues</dt>
                <dd class="donne-kpi">35</dd>
            </div>
        </dl>
    </div>
    <div class="flex justify-center space-x-7 mt-10">
        <div class="flex flex-col">
            <p class="text-4xl font-sans text-center font-bold text-black">{{$montantTotalContributions}}</p>
            <p class="text-sm font-sans text-gray-400">Total Cagnotte</p>
        </div>
        <div class="flex flex-col">
            <p class="text-4xl text-center font-sans font-bold text-black">{{$nombreTotalContributeurs}}</p>
            <p class="text-sm font-sans text-gray-400">Contributeurs</p>
        </div>
    </div>
    <div class="pt-5 ">

        @foreach ($experiences as $experience)     
        <?php $montantTotalContributions = 0; ?>
        
        <div class="pt-5 ">
         
          <a href="{{ route('utilisateur.detailexperience', ['id_experience' => $experience->id_experience]) }}">
            <div class="bg-gray-200 tel:w-full telL:w-full telL:h-24 telxl:w-full telxl:h-28 sm:w-3/4 sm:h-28 rounded-lg sm:relative sm:left-24 sm:top-6 2xl:w-3/4 2xl:h-36">
              <div class="bg-gray-100 float-right w-16 h-20 tel:w-16 tel:h-20 relative tel:top-5 tel:right-2 lg:top-8 2xl:top-8 2xl:right-2">
                <p class="text-base font-sans text-slate-800 text-center">Voir</p>
                <p class="text-xs font-sans text-slate-800 text-left relative left-3">70</p>
                <button id="heartButton" class="relative focus:outline-none float-right right-3 bottom-7">
                    <span class="heart text-3xl text-gray-400 transition duration-300 transform hover:scale-110 active:text-red-500 active:scale-100">&hearts;</span>
                </button>
                <p class="text-xs font-sans text-slate-800 text-left relative left-3 top-1">15 Cont</p>
                <p class="text-xs font-sans text-slate-800 text-left relative left-3 top-1">14 %</p>
                <script>
                    const heartButton = document.getElementById('heartButton');
                    const heart = heartButton.querySelector('.heart');
                    let isFilled = false;
    
                    heartButton.addEventListener('click', () => {
                        isFilled = !isFilled;
                        if (isFilled) {
                            heart.classList.add('heart-filled');
                        } else {
                            heart.classList.remove('heart-filled');
                        }
                    });
                </script>
            </div>
                <div class="bg-gray-50 tel:w-40 tel:h-14 telL:w-40 telL:h-16 telxl:w-40 telxl:h-24 sm:w-36 sm:h-24 relative telL:top-3 telL:left-3 telxl:top-6 telxl:left-3 sm:left-2 sm:top-2 2xl:w-52 2xl:top-4 2xl:h-28">
                </div>
                <div class="relative tel:left-36 tel:bottom-14 telL:bottom-16 telL:left-48 telxl:left-48 telxl:bottom-16 md:left-48 md:bottom-24 sm:bottom-24 sm:left-10 2xl:left-60">
           
                  @foreach ($experience->contents_experiences as $contentExperience)
                    @if ($contentExperience->type === 'storytelling')
                        @foreach ($contentExperience->storytelling->tag_storytellings as $tagStoryTelling)
                            @if ($tagStoryTelling->tag_story->tag === 'titre chanson')
                                <h2 class="text-2xl tel:text-xl font-sans font-extrabold text-slate-800 text-left relative 2xl:bottom-3">
                                    {{ $contentExperience->storytelling->description }}
                                </h2>
                            @endif
                        @endforeach
                    @endif
                @endforeach


                    @foreach($experience->projet->cagnottes as $cagnotte)
                    <?php $montantTotalContributions += $cagnotte->contributions->sum('montant'); ?>
                @endforeach

                <!-- Afficher le montant total des contributions -->
                <p class="text-xl tel:text-base font-sans text-slate-800 text-left relative 2xl:bottom-3">
                    {{ $montantTotalContributions }} Récoltés
                </p>

                    <p class="text-xs tel:text-xs font-sans text-slate-800 text-left relative 2xl:bottom-3">{{ $experience->projet->date_creation->format('d-m-Y') }}</p>
                    <p class="text-xl tel:text-base font-sans text-slate-800 text-left relative md:top-3 2xl:top-2">Type: {{ $experience->projet->types_projet->valeur }}</p>
                </div>
            </div>
            </a>
        </div>
        @endforeach
</main>


@endsection


