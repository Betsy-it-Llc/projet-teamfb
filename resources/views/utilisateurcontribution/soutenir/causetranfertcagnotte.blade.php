
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

        <p class="text-xl font-sans text-black text-center relative tel:text-base">Transférer une cagnotte</p>
        <h3 class="text-4xl font-sans font-bold text-slate-800 tel:pt-3 tel:text-2xl tel:pb-2 tel:ml-8 telL:text-2xl telL:ml-10 md:ml-10 xl:text-4xl">Cause</h3>
        <div class="tel:ml-5 telL:ml-10 md:ml-10">
            <div class="bg-gray-100 xl:w-96 xl:h-36 tel:w-72 tel:h-32 telL:w-5/6 sm:w-96 text-center rounded-md border border-gray-200">
                <div class="flex">
                    <div class="bg-gray-300 w-28 h-20 tel:w-20 tel:h-16 relative mt-3 ml-2"></div>
                    <div class="tel:mt-3 relative tel:left-5 xl:left-10">
                        <div class="grid grid-cols-1 grid-rows-3 gap-1">
                            <p class="text-base font-sans font-bold text-black text-left tel:pb-2 xl:pb-3">{{$cagnotte->titre}}</p>
                            <p class="text-sm tel:text-xs telL:text-xs sm:text-sm md:text-sm font-sans text-slate-800 text-left">Date: {{ $projet->date_creation->format('d-m-Y') }}</p>
                            <p class="text-sm tel:text-xs telL:text-xs sm:text-sm md:text-sm font-sans text-slate-800 text-left relative bottom-5">Type: {{ $projet->types_Projet->valeur }}</p>
                        </div>
                        <button id="heartButton" class="relative focus:outline-none tel:bottom-11 tel:left-22 lg:bottom-10 lg:left-10 float-right">
                            <span class="heart text-3xl text-gray-400 transition duration-300 transform hover:scale-110 active:text-red-500 active:scale-100">&hearts;</span>
                        </button>
                        
                    </div>
                </div>
                <button class="hover:bg-gray-400 bg-gray-300 rounded-md text-center h-5 pl-3 pr-2 relative tel:bottom-16 tel:left-2 lg:bottom-14 lg:left-5 float-left">
                    <p class="text-xs font-sans text-black tel:text-xs lg:text-xs xl:text-sm 2xl:text-sm">Voir la page</p>
                </button>
            </div>
        </div>
        
            <form x-bind:submit.prevent="isFormSubmitted || isCarouselButtonClicked1 || isCarouselButtonClicked2 ? null : $event.target.submit()" action="{{ route('transferMyCagnotte') }}" method="POST">
                @csrf
                   <input type="hidden" name="projet_cause" value="{{ $projet->id_projet }}">
   
                   <h4 class=" text-center relative float-left pt-3 ml-2 font-sans text-3xl font-bold text-black tel:text-lg tel:ml-2 telL:left-0 telL:right-1 stel:left-2 sm:-left-3 md:left-10 lg:-left-12 xl:left-12 xl:text-xl 1xl:text-xl 1xl:-left-14 2xl:text-xl">
                   Quelle Cagnotte souhaitez vous Transféré</h4>
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
                                   <div class="w-full h-48 p-4 swiper-slide" @click.prevent="toggleSelectedSlide({{ $index }})">
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


        <div class="text-center tel:pt-24 md:pt-24">
            <h5 class="text-3xl font-sans font-bold text-black tel:text-lg telL:text-lg md:text-lg lg:text-xl xl:text-2xl">Valider votre tranfère</h5>
            <div class="text-center pt-10">
                <button type="submit"  @click="isFormSubmitted = true" class="button-valider">Tranferer</button>
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