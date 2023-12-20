@extends('layouts.appwithtailwind')

@section('content')
    <div class="bg-gray-100 flex flex-col justify-center h-full items-center">
        <form action="" method="POST" class=" bg-white shadow-lg flex-grow w-full tel:w-full tel:h-screen telL:w-full sm:w-full md:w-3/5 lg:w-3/6 xl:w-2/6 2xl:w-2/6 4k:w-2/5">
            @csrf
            <button class="pt-3 pl-3 bg-transparent inline-flex items-end">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <div class="pt-2 text-center">
                <h1 class="text-5xl  p-6 font-display font-bold text-slate-800 tel:text-5xl">INSCRIPTION</h1>
            </div>
            <div class="p-1 mt-6 flex justify-center items-center">
                <p class="text-2xl  p-6 font-display  text-slate-800 tel:text-2xl">Je suis</p>
            </div>
            <div class="p-6">
                <div style="gap:40px"class="flex justify-center" style="margin-top: 20px;">
                    <a href="{{route('utilisateur.inscription')}}" style="box-shadow: 0px 12px 34px 0px rgba(13, 10, 44, 0.08), 0px 34px 26px 0px rgba(13, 10, 44, 0.05);" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">

                        <h5 style="max-width: 160px;max-height: 160px;" class="shadow-2xl flex justify-center items-center mb-2  text-2xl font-bold tracking-tight text-gray-900 tel:text-xl">Une personne</h5>
                    </a>
                    <a href="{{route('utilisateur.causeinscription')}}" style="box-shadow: 0px 12px 34px 0px rgba(13, 10, 44, 0.08), 0px 34px 26px 0px rgba(13, 10, 44, 0.05);" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow ">

                        <h5 style="max-width: 160px;max-height: 160px;" class="shadow-2xl flex justify-center items-center mb-2 text-2xl font-bold tracking-tight text-gray-900 tel:text-xl">Une cause <br></h5>
                        <span style="font-size: 10px;" class="text-gray-900">j'ai déjà un compte LalaChante</span>
                    </a>
                </div>
                <div class="flex justify-center gap-3" style="margin-top: 50px;">
                    <a href="#" style="box-shadow: 0px 12px 34px 0px rgba(13, 10, 44, 0.08), 0px 34px 26px 0px rgba(13, 10, 44, 0.05);" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow  ">

                        <h5 style="max-width: 160px;max-height: 160px;" class="shadow-2xl flex justify-center items-center mb-2 text-2xl font-bold tracking-tight text-gray-900 tel:text-xl">Organisme</h5>
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection