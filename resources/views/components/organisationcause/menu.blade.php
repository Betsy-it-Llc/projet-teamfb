<div class="w-full">
    
      <nav class="w-screen absolute bg-zinc-600 bg-opacity-40 h-fit overflow-hidden">
        <div class="py-4 lg:px-8 px-4 max-w-[1280px] h-16 m-auto text-white flex items-center justify-between">
            <div class="w-[51px] h-[30px] relative ml-10 mt-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24"><path fill="white" d="M4 18h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1m0-5h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1M3 7c0 .55.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1"/></svg>
            </div>
            <div class="flex lg:gap-8 gap-6 uppercase tracking-wider cursor-pointer text-lg items-center" id="navItems">
                <button class=" py-2 lg:py-0 flex flex-row gap-2 p-3 items-center justify-center border border-white rounded-full w-[155px] h-[56.98px]">
                    <img src="{{asset('storage/disque.png')}}" class="w-7 h-7 relative">
                    <div><span class="text-white text-base font-bold font-['Quicksand'] uppercase">CHANSON</span></div>
                
                </button>
                <button class="flex flex-row gap-2 p-4 items-center justify-center w-[133px] h-[55.98px] border border-white rounded-full">
                    <img src="{{asset('storage/pop.png')}}" class="w-7 h-7 relative">
                    <div><span class="text-white text-base font-bold font-['Quicksand'] uppercase">POP</span></div>
                </button>
                <button class="flex flex-row gap-2 p-4 items-center justify-center w-[135px] h-[56.98px] border border-white rounded-full">
                    <img src="{{asset('storage/micro.png')}}" class="w-7 h-7 relative">
                    <div><span class="text-white text-base font-bold font-['Quicksand'] uppercase">URBAN</span></div>
                </button>
                <button class="flex flex-row gap-2 p-4 items-center justify-center w-[135px] h-[56.98px] border border-white rounded-full">
                    <img src="{{asset('storage/kids.png')}}" class="w-7 h-7 relative">
                    <div><span class="text-white text-base font-bold font-['Quicksand'] uppercase">KIDS</span></div>
                </button>
                <div class="w-[169px] h-[42px] ml-10 mt-4 flex flex-row gap-3">
                    <p class="bg-transparent text-white text-xl font-bold uppercase">Rechercher</p>
                    <div class=" mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="white" stroke-linecap="round" stroke-width="2"><path stroke-dasharray="16" stroke-dashoffset="16" d="M10.5 13.5L3 21"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="16;0"/></path><path stroke-dasharray="40" stroke-dashoffset="40" d="M10.7574 13.2426C8.41421 10.8995 8.41421 7.10051 10.7574 4.75736C13.1005 2.41421 16.8995 2.41421 19.2426 4.75736C21.5858 7.10051 21.5858 10.8995 19.2426 13.2426C16.8995 15.5858 13.1005 15.5858 10.7574 13.2426Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="40;0"/></path></g></svg>
                    </div>
                    
                </div>
            </div>
            {{-- <div id="hamburger" class="fa fa-bars flex items-center text-xl" style="display:none;"></div> --}}
            <div id="mobileNav"
                class="fixed flex flex-col gap-8 pt-16 px-4 text-xl uppercase h-full inset-0 top-16 w-[70%] left-[-70%] ease-in-out duration-500 cursor-pointer">
                <button>Chanson</button>
                <button>Pop</button>
                <button>Urban</button>
                <button>Kids</button>
                
            </div>
        </div>
    </nav>

    <script>
        var navItems = document.getElementById("navItems");
        var mobileNav = document.getElementById("mobileNav");
        var hamburger = document.getElementById("hamburger");


        function adjustNavbar() {
            screenWidth = parseInt(window.innerWidth);

            if (screenWidth < 541) {
                navItems.style.display = "none";
                hamburger.style.display = "flex";
            }
            else {
                navItems.style.display = "flex";
                hamburger.style.display = "none";
            }
        }

        adjustNavbar();

        window.addEventListener("resize", adjustNavbar);

        hamburger.addEventListener("click", function () {
            mobileNav.classList.toggle("left-[-70%]");
            hamburger.classList.toggle("fa-bars");
            hamburger.classList.toggle("fa-close");
        })
    </script>

    </div>