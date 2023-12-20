<nav class="font-sans"> 
    <div class="bg-gray-300 p-4">
        <div class="flex items-center justify-start">
            <!-- Burger Icon -->
            <button id="burger" class="text-black focus:outline-none lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <div>
                <a href="{{ route('accueil') }}" style="text-decoration: none; color: inherit;">
                <header class="xl:ml-5">
                    <h1 class="text-3xl md:text-5xl lg:text-2xl xl:text-3xl font-bold">
                        Contribution
                    </h1>
                    <h2 class="text-lg font-bold ml-2">
                        By LalaChante
                    </h2>
                </header>
                </a>
            </div>
            
            
            
            <!-- Navbar Links (Hidden by Default) -->
            <div id="navbar" class="hidden lg:flex lg:space-x-5 lg:ml-5 xl:space-x-10 xl:ml-10">
                <a href="#" class="text-black text-xl xl:text-xl lg:text-base">Découvrir</a>
                <a href="#" class="text-black text-xl xl:text-xl lg:text-base">Conseils</a>
                <a href="#" class="text-black text-xl xl:text-xl lg:text-base">Nos garanties</a>
                <a href="#" class="text-black text-xl xl:text-xl lg:text-base">LalaChante</a>
                <a href="#" class="text-black text-xl xl:text-xl lg:text-base">Tarifs</a>
            </div>

            <div class="flex items-center lg:space-x-5 lg:ml-5 xl:ml-10 xl:space-x-10 lg:absolute lg:top-8 lg:right-32 xl:absolute xl:top-8 xl:right-32">
                @guest
                <button class="bg-gray-400 hidden lg:flex lg:w-32 lg:h-8 xl:w-32 xl:h-10 w-28 h-10 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline lg:mt-2 lg:ml-5 xl:mt-3 xl:ml-4 w-4 h-4 lg:w-4 lg:h-4 xl:w-4 xl:h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>                                          
                    <span class="text-black text-base text-center lg:mt-1 xl:mt-2 xl:ml-3">
                        S'inscrire
                    </span>
                </button>
                @endguest
                
                @guest
                <button class="bg-gray-400 hidden lg:flex lg:w-32 lg:h-8 xl:w-32 xl:h-10 w-28 h-10 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline lg:mt-2 lg:ml-5 xl:mt-3 xl:ml-4 w-4 h-4 lg:w-4 lg:h-4 xl:w-4 xl:h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>                       
                    <span class="text-black text-base text-center lg:mt-1 xl:mt-2 xl:ml-3">
                        Connexion
                    </span>
                </button>
                @endguest

            </div>
            <div class="flex flex-col items-center lg:ml-5 xl:ml-40 absolute top-4 right-2">
                @php
                // pas la meilleure pratique mais la seul solution pour afficher l'image indépendemment de la page
                use App\Http\Controllers\EspaceClientController;
                use App\Models\experienceApp\Contact;
                $contact = Contact::where('email', auth()->user()->email)->first();
                $controller=new EspaceClientController();
                $filenameOnDrive=$controller->getMediaName('photo_profil',0);
                $photo_profil=null;
                if($filenameOnDrive){
                    $photo_profil=$contact->getFirstMedia('photo_profil/'.$filenameOnDrive);
                }
            @endphp
                 @isset ($contact)
                 <button style="width:100%" class="bg-transparent 2xl:h-16 2xl:w-20 rounded-md">
                     @isset($photo_profil)
                         <div style="width:40px;height:40px;border-radius:100%" >
                             <img style="border-radius:50%;margin-left:15px" class="w-12 relative lg:left-16 lg:ml-2 lg:bottom-4 xl:bottom-4 2xl:bottom-2 xl:mr-5 2xl:mr-5" src="{{$photo_profil->getUrl("photo_barre_menu")}}" alt="{{$photo_profil->name}}">
                         </div>
                     @else
                     <img style="margin-left:80px" class="w-12 relative lg:ml-3 lg:bottom-4 xl:bottom-4 2xl:bottom-2 xl:mr-5 2xl:mr-5" src="{{ asset('img/user.png') }}" alt="pas d'image">
                     @endisset
                     <p class="text-base text-center text-black relative  2xl:bottom-4">{{$contact->prenom}}</p>
                 </button>
             @endisset
                
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay (Initially Hidden) -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden lg:hidden z-50"></div>

    <!-- Mobile Menu (Initially Hidden) -->
    <div id="mobileMenu" class="fixed inset-y-0 left-0 transform -translate-x-full bg-gray-200 p-4 w-64 space-y-8
        overflow-y-auto ease-in-out transition-transform duration-300 lg:hidden z-50">
        <!-- Close Button -->
        <button id="closeMenu" class="text-black absolute top-4 right-4 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Mobile Menu Links -->
        <a href="#" class="text-black block">Découvrir</a>
        <a href="#" class="text-black block">Conseils</a>
        <a href="#" class="text-black block">Nos Garanties</a>
        <a href="#" class="text-black block">Lalachante</a>
        <a href="#" class="text-black block">Tarifs</a>
    </div>

    <script>
        // Toggle mobile menu visibility
        const burger = document.getElementById('burger');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const closeMenu = document.getElementById('closeMenu');

        burger.addEventListener('click', function () {
            mobileMenu.classList.toggle('-translate-x-full');
            mobileMenuOverlay.classList.toggle('hidden');
        });

        // Close mobile menu on overlay click
        mobileMenuOverlay.addEventListener('click', function () {
            mobileMenu.classList.toggle('-translate-x-full');
            mobileMenuOverlay.classList.toggle('hidden');
        });

        // Close mobile menu on close button click
        closeMenu.addEventListener('click', function () {
            mobileMenu.classList.toggle('-translate-x-full');
            mobileMenuOverlay.classList.toggle('hidden');
        });
    </script>
</nav>