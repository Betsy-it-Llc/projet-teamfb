<div class="bg-zinc-600 opacity-70 py-4 absolute  w-full">  
  <nav class="lg:px-16 px-6 flex flex-wrap items-center lg:py-0 py-2">
    <div class=" flex-auto flex justify-between items-center">
      
    </div>
    <label for="menu-toggle" class="cursor-pointer lg:hidden block">
      <svg
        class="fill-current text-white"
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 20 20"
      >
        <title>menu</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
      </svg>
    </label>
    <input class="hidden" type="checkbox" id="menu-toggle" />
      <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
        <nav>
          <ul class="text-xl text-center items-center gap-x-12 pt-4 md:gap-x-4 lg:text-lg lg:flex  lg:pt-0">
            <li class="py-2 lg:py-0">
              <button class=" py-2 lg:py-0 flex flex-row gap-2 p-3 items-center justify-center border border-white rounded-full w-[155px] h-[56.98px]">
                  <img src="{{asset('storage/disque.png')}}" class="w-7 h-7 relative">
                  <div><span class="text-white text-base font-bold font-['Quicksand'] uppercase">CHANSON</span></div>
              
              </button>
            </li>
            <li class="py-2 lg:py-0 ">
              <button class="flex flex-row gap-2 p-4 items-center justify-center w-[133px] h-[55.98px] border border-white rounded-full">
                  <img src="{{asset('storage/pop.png')}}" class="w-7 h-7 relative">
                  <div><span class="text-white text-base font-bold font-['Quicksand'] uppercase">POP</span></div>
              </button>
            </li>
            <li class="py-2 lg:py-0 ">
              <button class="flex flex-row gap-2 p-4 items-center justify-center w-[135px] h-[56.98px] border border-white rounded-full">
                  <img src="{{asset('storage/micro.png')}}" class="w-7 h-7 relative">
                  <div><span class="text-white text-base font-bold font-['Quicksand'] uppercase">URBAN</span></div>
              </button>
            </li>
            <li class="py-2 lg:py-0 ">
              <button class="flex flex-row gap-2 p-4 items-center justify-center w-[135px] h-[56.98px] border border-white rounded-full">
                  <img src="{{asset('storage/kids.png')}}" class="w-7 h-7 relative">
                  <div><span class="text-white text-base font-bold font-['Quicksand'] uppercase">KIDS</span></div>
              </button>
            </li>
            <li class="py-2 lg:py-0 ">
              <div class="w-[169px] h-[42px] ml-10 mt-4 flex flex-row gap-3">
                  <p class="bg-transparent text-white text-xl font-bold uppercase">Rechercher</p>
                  <div class=" mt-0.5">
                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="white" stroke-linecap="round" stroke-width="2"><path stroke-dasharray="16" stroke-dashoffset="16" d="M10.5 13.5L3 21"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="16;0"/></path><path stroke-dasharray="40" stroke-dashoffset="40" d="M10.7574 13.2426C8.41421 10.8995 8.41421 7.10051 10.7574 4.75736C13.1005 2.41421 16.8995 2.41421 19.2426 4.75736C21.5858 7.10051 21.5858 10.8995 19.2426 13.2426C16.8995 15.5858 13.1005 15.5858 10.7574 13.2426Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="40;0"/></path></g></svg>
                  </div>
                  
              </div>
            </li>
            <li class="py-2 lg:py-0 ">
              
            </li>
        </ul>
      </nav>
    </div>
  </nav>

</div> 