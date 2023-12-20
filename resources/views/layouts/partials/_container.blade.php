<div class="bg-gray-100 flex flex-col justify-center items-center min-h-screen"> 
    <div style="width: 100%; max-width: 740px;" class="bg-white shadow-lg flex-grow w-full tel:w-full tel:h-full telL:w-full sm:w-full md:w-3/5 lg:w-3/6 xl:w-2/6 2xl:w-2/6 4k:w-2/5">
        <button onclick="history.go(-1);" class="pt-3 pl-3 bg-transparent inline-flex items-end md:relative md:left-5 md:top-2 tel:relative tel:left-5 tel:top-2">
            <img class="w-5" src="{{ asset('img/arrow.png') }}" alt="Page Precedente">
        </button> 
        @yield('content')
    </div>
</div>
