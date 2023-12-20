<div class="flex flex-col items-center justify-center h-full bg-gray-100">
    {{-- Stop trying to control. --}}
    <div class="w-full h-16 bg-gray-300">
    </div>
    <div
        class="flex-grow w-full bg-white shadow-lg tel:w-full tel:h-full telL:w-full sm:w-5/6 md:w-3/4 lg:w-4/6 xl:w-3/6 2xl:w-2/6 4k:w-2/5">
        <button class="float-right pt-6 pr-5 bg-transparent">
            <img class="w-8" src="../menu.png" alt="">
        </button>
        <button class="inline-flex items-end pt-5 bg-transparent pl-7">
            <img class="w-6" src="../arrow.png" alt="">
        </button>
        <div class="grid grid-cols-1 grid-rows-2 gap-0.5 pl-5 relative tel:left-9 tel:bottom-10">
            <h1 class="font-sans text-6xl font-bold text-slate-800 tel:text-2xl telL:text-2xl md:text-4xl">VALIDATION
            </h1>
            <h2 class="font-sans text-6xl font-bold text-slate-800 tel:text-2xl telL:text-2xl md:text-4xl">SOUTENIR</h2>
        </div>
        <p class="relative font-sans text-xl text-center text-black tel:text-base">Lier une Cagnotte Expérience</p>
        <h3
            class="font-sans text-4xl font-bold text-slate-800 tel:pt-3 tel:text-2xl tel:pb-2 tel:ml-8 telL:text-2xl telL:ml-10 md:ml-10">
            Cause</h3>
        <div class="tel:ml-5 telL:ml-10 md:ml-10">
            <div class="text-center bg-gray-100 border border-gray-200 rounded-md xl:w-96 xl:h-36 tel:w-72 tel:h-32">
                <div class="flex">
                    <div class="relative h-20 mt-3 ml-2 bg-gray-300 w-28 tel:w-20 tel:h-16"></div>
                    <div class="relative tel:mt-3 tel:left-5 xl:left-10">
                        <div class="grid grid-cols-1 grid-rows-3 gap-1">
                            <p class="font-sans text-base font-bold text-left text-black tel:pb-2 xl:pb-3">Ela</p>
                            <p class="font-sans text-sm text-left text-slate-800">Date: 21/02/2023</p>
                            <p class="relative font-sans text-sm text-left text-slate-800 bottom-5">Type: Cause</p>
                        </div>
                        <button id="heartButton"
                            class="relative float-right focus:outline-none tel:bottom-11 tel:left-8 lg:bottom-10 lg:left-16">
                            <span
                                class="text-3xl text-gray-400 transition duration-300 transform heart hover:scale-110 active:text-red-500 active:scale-100">&hearts;</span>
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
                <button
                    class="relative float-left h-5 pl-3 pr-2 text-center bg-gray-300 rounded-md hover:bg-gray-400 tel:bottom-16 tel:left-2 lg:bottom-14 lg:left-12">
                    <p class="font-sans text-xs text-black tel:text-xs lg:text-xs xl:text-sm 2xl:text-sm">Voir la page
                    </p>
                </button>
            </div>
        </div>
        <h4
            class="relative float-left pt-3 ml-2 font-sans text-3xl font-bold text-black tel:text-lg tel:ml-2 telL:left-3">
            Quelle Cagnotte souhaitez vous lier</h4>
        <div
            class="grid float-left grid-cols-1 grid-rows-1 tel:grid-cols-2 tel:grid-rows-1 tel:gap-3 telL:grid-cols-2 telL:grid-rows-1 telL:gap-5 md:grid-cols-4 md:grid-rows-1 md:gap-28 md:ml-5 lg:grid-cols-4 telL:ml-10 telL:right-5 tel:ml-5">
            <div
                class="relative flex flex-col items-center justify-center bg-gray-100 rounded-md tel:w-32 sm:w-40 sm:h-24 md:w-40 lg:w-40 md:h-28 sm:left-2 top-9">
                <p class="relative font-sans text-base text-center text-slate-800 tel:text-sm ">Nom Cagnotte</p>
                <p class="relative font-sans text-base text-center text-slate-800 tel:text-sm bottom-1">101€</p>
                <p class="relative font-sans text-xs italic text-center text-slate-800 bottom-1">35 contributeurs</p>
                <img class="relative float-right w-3 mx-auto tel:top-7 tel:left-1 md:left-1 sm:top-7 md:top-7"
                    src="../+.png" alt="">
                <p class="relative font-sans text-xs text-center text-slate-800 top-3 right-8">12/12/23</p>
                <p class="relative font-sans text-xs text-center text-slate-800 bottom-1 left-8">Choisir</p>
            </div>
            <div
                class="relative flex flex-col items-center justify-center bg-gray-100 rounded-md tel:w-32 sm:w-40 sm:h-24 md:w-40 lg:w-40 md:h-28 sm:left-2 top-9">
                <p class="relative font-sans text-base text-center text-slate-800 tel:text-sm ">Nom Cagnotte</p>
                <p class="relative font-sans text-base text-center text-slate-800 tel:text-sm bottom-1">101€</p>
                <p class="relative font-sans text-xs italic text-center text-slate-800 bottom-1">35 contributeurs</p>
                <img class="relative float-right w-3 mx-auto tel:top-7 tel:left-1 md:left-1 sm:top-7 md:top-7"
                    src="../+.png" alt="">
                <p class="relative font-sans text-xs text-center text-slate-800 top-3 right-8">12/12/23</p>
                <p class="relative font-sans text-xs text-center text-slate-800 bottom-1 left-8">Choisir</p>
            </div>
            <div
                class="relative flex-col items-center justify-center bg-gray-100 rounded-md tel:w-32 sm:w-40 sm:h-24 md:w-40 lg:w-40 md:h-28 sm:left-2 top-9 md:flex tel:hidden">
                <p class="relative font-sans text-base text-center text-slate-800 tel:text-sm ">Nom Cagnotte</p>
                <p class="relative font-sans text-base text-center text-slate-800 tel:text-sm bottom-1">101€</p>
                <p class="relative font-sans text-xs italic text-center text-slate-800 bottom-1">35 contributeurs</p>
                <img class="relative float-right w-3 mx-auto tel:top-7 tel:left-1 md:left-1 sm:top-7 md:top-7"
                    src="../+.png" alt="">
                <p class="relative font-sans text-xs text-center text-slate-800 top-3 right-8">12/12/23</p>
                <p class="relative font-sans text-xs text-center text-slate-800 bottom-1 left-8">Choisir</p>
            </div>
        </div>
        <!-- Fin de répétition -->
        <h5
            class="relative float-left font-sans text-3xl font-bold text-center text-black pt-28 tel:text-xl tel:ml-24 telL:ml-32 md:-mt-10 sm:-top-10 telL:mr-10 telL:-top-2 md:left-24 md:pt-40 lg:right-28">
            Choisir la durée</h5>
        <div
            class="grid float-left grid-cols-2 grid-rows-1 gap-0 ml-8 tel:grid-cols-1 tel:grid-rows-2 tel:gap-1 sm:grid-cols-2 sm:grid-rows-1 md:ml-40 telL:pt-10">
            <div
                class="relative flex items-center justify-center text-center md:flex-col tel:ml-2 telL:ml-16 tel:pt-5 sm:-top-24 sm:left-10 md:pb-5 lg:right-28 lg:-top-16 lg:-left-32">
                <label for="start_date" class="block mb-2 text-gray-600"></label>
                <input type="text" id="start_date" name="start_date" placeholder="Date de début"
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
                class="relative font-sans text-xs text-center text-slate-800 sm:bottom-8 sm:right-40 md:right-52 md:-top-5 lg:right-96 lg:top-2">
                Entrez une date de début</p>
            <div
                class="relative flex items-center justify-end text-center md:flex-col tel:ml-2 sm:bottom-14 sm:left-16 telL:ml-16 md:left-0 md:bottom-24 lg:left-40 lg:-top-44">
                <label class="block mb-2 text-gray-600"></label>
                <input type="text" id="end_date" name="end_date" placeholder="Date de fin"
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
                class="relative font-sans text-xs text-center text-slate-800 sm:right-44 sm:bottom-1 md:right-52 md:-top-10 lg:-top-32 lg:right-24">
                Vous pouvez laisser vide</p>
            <h5
                class="relative float-left font-sans text-3xl font-bold text-center text-black tel:text-xl tel:bottom-7 bottom-5 tel:pt-16 telL:pt-20 telL:left-2 sm:left-14 sm:bottom-20 md:pt-5 md:left-10 lg:-top-36">
                Valider votre lien</h5>
            <div
                class="relative float-left pt-20 text-center tel:bottom-16 telL:bottom-16 telL:left-2 sm:-top-6 sm:-left-36 md:-top-24 md:-left-44 lg:-left-60 lg:-top-32">
                <button type="submit"
                    class="px-10 py-2 text-black bg-gray-300 rounded hover:bg-gray-600">Lier</button>
            </div>
        </div>
    </div>
</div>
