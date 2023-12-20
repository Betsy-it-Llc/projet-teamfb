@extends('layouts.appwithtailwind')
<link rel="stylesheet" href="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.css">
<style>
    .hidden {
    /* Hide the checkbox visually but keep it accessible */
    opacity: 0;
    position: absolute;
}

.checked-slide {
    /* Tailwind classes for checked slide */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  transform: scale(1.05);
}
</style>
@section('content')

            <header class="header-maj">
                <h1 class="h1-maj">
                    Soutenir
                </h1>
                <h2 class="font-sans text-2xl font-bold text-slate-800 tel:text-2xl telL:text-2xl md:text-2xl">Validation</h2>
            </header>

            <p class="relative font-sans text-xl text-center text-black tel:text-base">Lier une Cagnotte Expérience</p>
            
            <h3
                class="font-sans text-4xl font-bold text-slate-800 tel:pt-3 tel:text-2xl tel:pb-2 tel:ml-8 telL:text-2xl telL:ml-10 md:ml-10">
                Cause</h3>
            <div class="tel:ml-1 telL:ml-10 md:ml-10">
                <div class="text-center bg-gray-100 border border-gray-200 rounded-md tel:w-80 tel:h-32 telL:w-80 telxl:h-32 telxl:w-96 sm:h-32 sm:w-96 md:h-32 md:w-96 lg:h-32 lg:w-96 xl:w-96 xl:h-36">
                    <div class="flex">
                        <div class="relative h-20 mt-3 ml-2 bg-gray-300 w-28 tel:w-20 tel:h-16"></div>
                        <div class="relative tel:mt-3 tel:left-5 xl:left-10">
                            <div class="grid grid-cols-1 grid-rows-3 gap-1">
                                <p class="font-sans text-base font-bold text-left text-black tel:pb-2 xl:pb-3">
                                    {{ $cagnotte->titre }}</p>
                                <p class="font-sans text-sm text-left text-slate-800">Date:
                                    {{ $projet->date_creation->format('d-m-Y') }}</p>
                                <p class="relative font-sans text-sm text-left text-slate-800 bottom-5">Type:
                                    {{ $projet->types_Projet->valeur }}</p>
                            </div>
                            <button id="heartButton"
                            class="relative float-right focus:outline-none tel:bottom-10 tel:right-3 telL:bottom-10 telL:left-2 lg:bottom-10 lg:left-10">
                                <span
                                    class="text-3xl text-gray-400 transition duration-300 transform heart hover:scale-110 active:text-red-500 active:scale-100">&hearts;</span>
                            </button>
                           
                        </div>
                    </div>
                    <button
                        class="relative float-left h-5 pl-3 pr-2 text-center bg-gray-300 rounded-md hover:bg-gray-400 tel:bottom-16 tel:left-2 lg:bottom-14 lg:left-5">
                        <p class="font-sans text-xs text-black tel:text-xs lg:text-xs xl:text-sm 2xl:text-sm">Voir la page
                        </p>
                    </button>
                </div>
            </div>
            <form x-bind:submit.prevent="isFormSubmitted || isCarouselButtonClicked1 || isCarouselButtonClicked2 ? null : $event.target.submit()" action="{{ route('linkMyCagnotte') }}" method="POST">
             @csrf
                <input type="hidden" name="projet_cause" value="{{ $projet->id_projet }}">

            <h4
                class="relative float-left pt-3 ml-2 font-sans text-3xl font-bold text-black tel:text-lg tel:ml-2 telL:left-0 telL:right-1 stel:left-2 sm:-left-3 lg:left-10 xl:text-2xl">
                Quelle Cagnotte souhaitez vous lier</h4>
                <div x-data="{ swiper: null, selectedSlides: [], isFormSubmitted: false, toggleSelectedSlide(index) { 

                   
                    if (this.selectedSlides.includes(index)) {
                        
                        this.selectedSlides = this.selectedSlides.filter(item => item !== index);
                    } else {
                        
                        this.selectedSlides.push(index);
                    }
                } }" x-init="swiper = new Swiper($refs.container, {
                    loop: false,
                    slidesPerView: 1,
                    spaceBetween: 0,
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                            spaceBetween: 0,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 0,
                        }
                    },
                })" class="relative flex flex-row w-10/12 mx-auto">
                    <div class="absolute inset-y-0 left-0 z-10 flex items-center">
                        <button @click.prevent="if (!isFormSubmitted) { isCarouselButtonClicked1 = true; swiper.slidePrev(); setTimeout(() => isCarouselButtonClicked1 = false, 50); }"
                            class="flex items-center justify-center w-10 h-10 -ml-2 bg-white rounded-full shadow lg:-ml-4 focus:outline-none">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 chevron-left">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                
                    <div class="swiper-container" x-ref="container">
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($projetsCagnottesContact as $index => $projetCagnotteContact)
                                <div class="w-full h-48 p-4 swiper-slide " @click.prevent="toggleSelectedSlide({{ $index }})">  
                                    <label :for="'slide-' + {{ $index }}" class="slide-label">
                                        <div x-bind:class="{'checked-slide': selectedSlides.includes({{ $index }})}" class="div-caroussel " style="cursor: pointer;">
                                            <p class="text-caroussel text-base tel:text-sm">{{ $projetCagnotteContact->titre }}</p>
                                            <p class="text-caroussel text-base tel:text-sm bottom-1">{{ $projetCagnotteContact->montant_actuel }}€</p>
                                            <p class="text-caroussel text-xs italic bottom-1">{{ $nombreContributeursUniques[$projetCagnotteContact->id_cagnotte] }} contributeurs</p>
                                            <input type="checkbox" name="selected_cagnotte" hidden value="{{ $projetCagnotteContact->id_cagnotte }}" x-bind:class="{'hidden': !selectedSlides.includes({{ $index }}) }" :id="'slide-' + {{ $index }}"  :checked="selectedSlides.includes({{ $index }})" />
                                            <img  x-bind:class="{'hidden': selectedSlides.includes({{ $index }}) }" class="relative float-right w-3 mx-auto tel:top-7 tel:left-1 md:left-1 sm:top-7 md:top-7" src="{{ asset('img/+.png') }}" alt="">
                                            <p class="text-caroussel text-xs top-3 right-8">{{ $projetCagnotteContact->projet->date_creation->format('d-m-Y') }}</p>
                                            <p class="text-caroussel text-xs bottom-1 left-8">Choisir</p>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                
                    <div class="absolute inset-y-0 right-0 z-10 flex items-center">
                        <button @click.prevent="if (!isFormSubmitted) { isCarouselButtonClicked2 = true; swiper.slideNext(); setTimeout(() => isCarouselButtonClicked2 = false, 50); }"
                            class="flex items-center justify-center w-10 h-10 -mr-2 bg-white rounded-full shadow lg:-mr-4 focus:outline-none">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 chevron-right">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            <div
                class="grid float-left grid-cols-1 grid-rows-1 tel:grid-cols-2 tel:grid-rows-1 tel:gap-3 telL:grid-cols-2 telL:grid-rows-1 telL:gap-5 md:grid-cols-4 md:grid-rows-1 md:gap-28 md:ml-5 lg:grid-cols-4 telL:ml-10 telL:right-5 tel:ml-5">


            </div>
            <!-- Fin de répétition -->
            <h5
                class="relative float-left font-sans text-3xl font-bold text-center text-black pt-28 tel:text-xl tel:ml-24 telL:ml-32 md:-mt-10 sm:-top-10 telL:mr-10 telL:-top-2 xl:text-2xl md:left-24 md:pt-40 lg:right-20">
                Choisir la durée</h5>
            <div
                class="grid float-left grid-cols-2 grid-rows-1 gap-0 ml-8 tel:grid-cols-1 tel:grid-rows-2 tel:gap-1 sm:grid-cols-2 sm:grid-rows-1 md:ml-40 telL:pt-10">
                <div
                    class="relative flex items-center justify-center text-center md:flex-col tel:ml-2 telL:ml-16 tel:pt-5 sm:-top-24 sm:left-10 md:pb-5 md:-left-2 lg:right-28 lg:-top-16 lg:-left-32 xl:bottom-20">
                    <label for="start_date" class="block mb-2 text-gray-600"></label>
                    <input type="date" id="start_date" name="start_date" placeholder="Date de début"
                        class="px-12 py-2 text-gray-700 border rounded shadow-inner w-52 focus:shadow-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="relative w-8 h-8 text-gray-600 tel:right-48 telL:right-48 md:right-20 md:bottom-8 "
                        viewBox="0 0 24 24">
                        <rect width="18" height="18" x="3" y="2" rx="2" ry="2"></rect>
                        <path d="M16 2v4M8 2v4M3 10h18"></path>
                    </svg>
                </div>
                <p
                    class="relative font-sans text-xs text-center text-slate-800 sm:bottom-8 sm:right-48 md:right-52 md:-top-5 lg:right-96 lg:top-2 xl:bottom-1 xl:-left-80">
                    Entrez une date de début</p>
                <div
                    class="relative flex items-center justify-end text-center md:flex-col tel:ml-2 sm:bottom-14 sm:-right-14 telL:ml-16 md:left-0 md:bottom-24 lg:left-40 lg:-top-44 lg:pt-1 xl:-top-44 xl:pt-2">
                    <label class="block mb-2 text-gray-600"></label>
                    <input type="date" id="end_date" name="end_date" placeholder="Date de fin"
                        class="px-12 py-2 text-gray-700 border rounded shadow-inner w-52 focus:shadow-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="relative w-8 h-8 text-gray-600 tel:right-48 telL:right-48 md:right-20 md:bottom-10 lg:bottom-9"
                        viewBox="0 0 24 24">
                        <rect width="18" height="18" x="3" y="2" rx="2" ry="2"></rect>
                        <path d="M16 2v4M8 2v4M3 10h18"></path>
                    </svg>
                </div>
                <p
                    class="relative font-sans text-xs text-center text-slate-800 sm:right-44 sm:bottom-1 md:right-52 md:-top-10 lg:-top-32 lg:right-24 lg:pt-1 xl:-top-28 xl:-left-16">
                    Vous pouvez laisser vide</p>
                <h5
                    class="relative float-left font-sans text-3xl font-bold text-center text-black tel:text-xl tel:bottom-7 bottom-5 tel:pt-16 telL:pt-20 telL:left-2 sm:left-14 sm:bottom-20 md:pt-5 md:left-10 lg:-top-36 xl:text-2xl">
                    Valider votre lien</h5>
                <div
                    class="relative float-left pt-20 text-center tel:bottom-16 telL:bottom-16 telL:left-2 sm:-top-6 sm:-left-36 md:-top-24 md:-left-44 lg:-left-60 lg:-top-32">
                    <button type="submit" @click="isFormSubmitted = true" class="button-valider">Lier</button>
                </div>
            </div>
            </form>


@endsection
@section('scripts')

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('carousel', () => ({
            selectedSlides: [],
            isCarouselButtonClicked1: false,
            isCarouselButtonClicked2: false,
            isFormSubmitted: false,
            // ... autres propriétés et méthodes
        }));
    });
</script>
    <script src="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
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
 
@endsection