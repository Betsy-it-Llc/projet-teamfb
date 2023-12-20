<div>
    @if ($var1!==null && $var2!==null)
        <div class="w-auto flex-row md:mb-4">
            <article class="mx-auto w-72 bg-gray-200 rounded-xl lg:p-4 mb-4 telL:w-full telxl:w-full">
                <div class="sm:flex-row">
                    <div class="p-4 flex flex-col mb-10 sm:flex-row">
                        <div class="h-36 w-72 telxl:h-40 sm:w-80 bg-white rounded-lg mb-8 flex flex-col items-center justify-end sm:mb-0">
                            <img class="w-4 mx-auto mb-2" src="{{ asset('img/plus.png') }}" alt="plus">
                            <p class="text-xs font-sans text-slate-800 text-center sm:text-left mb-2">Utiliser</p>
                        </div>

                    <div class="flex-1 w-full sm:w-1/2 h-auto px-3">
                        <div class="flex items-center justify-between text-base font-sans text-black mb-5 ">
                            <h2 class="font-mono font-extrabold text-black mt-0 text-xl">{{$var1->titre}}</h2>
                            <p class="text-xl ml-2 mb-2 md:mb-0">{{$var1->montant_actuel}}€</p>
                        </div>

                            <p class="text-xl font-sans mb-2 m-1 text-black">{{ $var2[$var1->id_cagnotte] }}  Contributeurs</p>
                            <p class="text-base font-sans mb-2 m-1 sm:mb-4 text-black">Date: {{ date('d-m-Y', strtotime($var1->projet->date_creation)) }}</p>
                            <p class="text-base font-sans m-1 mb-10 sm:mb-0 text-black">Type: {{ $var1->projet->types_projet->valeur }}</p>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    @endif
    @if($var3 !== null)
    <div class="mx-5 auto">
        <div class="w-auto flex-row md:mb-4 mt-12">
            <article class="mx-auto w-72 bg-white rounded-xl lg:p-4 mb-4 telL:w-full telxl:w-full border-2 border-gray-300">
                <div class="sm:flex-row">
                    <div>
                        <div class="text-center text-xl font-bold text-black">Cause</div>
                    </div>
                    <div style="margin-left:3%; margin-right:3%" class="pt-4 flex flex-col sm:flex-row lg:h-48">
                        <div class="h-28 w-68 telxl:h-40 sm:w-80 bg-white rounded-lg mb-8 ">
                            @if ($var3->cagnottes[0]->getFirstMedia('header/' . $var3->cagnottes[0]->nom_image))
                                <img class="h-full w-full rounded-lg " src="{{ $var3->cagnottes[0]->getFirstMedia('header/' . $var3->cagnottes[0]->nom_image)->getUrl('miniature_cagnotte') }}" alt="{{ $var3->cagnottes[0]->getFirstMedia('header/' . $var3->cagnottes[0]->nom_image)->titre }}">
                                
                            @else
                                <svg class="h-full w-full object-cover bg-gray-200 rounded-lg"  viewBox="0 0 228 168" fill="none" xmlns="http://www.w3.org/2000/svg">
                                </svg>
                            @endif
                        </div>

                        <div class="flex-1 w-full sm:w-1/2 h-auto px-3">
                            <div class="flex items-center justify-between text-base font-sans text-black mb-5 ">
                                <p class="text-xl font-bold text-black">{{ $var3->nom_cagnotte }}</p>
                                <p class="text-base font-bold text-black">{{ $var3->montant_actuel_cagnotte }}€ récoltés</p>
                            </div>

                            <p class="text-sm font-sans text-black">Date : {{ $var3->date_creation->format('d-m-Y') }}</p>
                            <div class="text-sm font-sans text-black flex items-center gap-2">
                                <p class="text-sm font-sans text-black">Type : {{ $var3->types_Projet->valeur }}</p>
                                <div class="mb-4">
                                    <button id="heartButton" class="mr-4">
                                        <i class="fa-regular fa-heart heart text-3xl text-black transition duration-300 transform hover:scale-110 active:text-red-500 active:scale-100"></i>
                                    </button>
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
                            </div>
                        </div>
                    </div>
                    <div class="text-center 1xl:flex 1xl:justify-around 1lx:gap-2 md:gap-2 md:flex md:justify-around ">
                        <button class="hover:bg-gray-400 bg-gray-300  rounded-md mb-4">
                            <p class="text-xs font-sans text-black font-bold w-44 h-12 flex items-center justify-center">Voir la page</p>
                        </button>
                        <button class="hover:bg-gray-400 bg-gray-300  rounded-md mb-4">
                            <a href="{{ route('utilisateur.recapsoutenir', ['id_projet' => $var3->id_projet]) }}" class="text-xs font-sans text-black w-44 h-12 flex items-center justify-center font-bold">Soutenir</a>
                        </button>
                    </div>
                </div>
            </article>
        </div>
    </div>
@endif
</div>
