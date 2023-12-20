@extends('layouts.appwithtailwind')

@section('content')
    <div class="bg-gray-100 flex flex-col justify-center h-full items-center">
        <div class="bg-gray-300 w-full h-16">
        </div>
        <div class="bg-white shadow-lg flex-grow w-full tel:w-full tel:h-full telL:w-full sm:w-full md:w-3/5 lg:w-3/6 xl:w-2/6 2xl:w-2/6 4k:w-2/5">
            <div class="pt-10 text-center">
                <h1 class="text-5xl flex text-left p-6 font-display font-bold text-slate-800 tel:text-5xl">Retrouver mot de <br> passe</h1>
            </div>
            <div class="p-7 mt-6 flex justify-center items-center">
                <i class="fa-solid fa-envelope fa-4x" style="margin: 10px;"></i>
            </div>
            <div class="p-6">
                <h5 class="text-3xl font-sans font-bold text-black pt-28 tel:text-xl   tel:ml-24 telL:ml-20 md:-mt-10 relative sm:-top-10 telL:mr-10 telL:-top-2 xl:text-2xl  lg:right-20">Email envoyé</h5>
                <div class="flex justify-center" style="margin-top: 20px;">
                    <p>
                        Si un compte est associé à votre email, vous recevrez un email de récupération. Suivez les instructions de l'email pour récupérer votre mot de passe
                    </p>
                </div>
            </div>
            <div class="p-7 mt-6 flex justify-center items-center">
                <i class="fa-regular fa-circle-check fa-3x" style="margin-bottom: 10px;"></i>
            </div>
            <p class="text-center">Nous avons envoyé un email à<br> {{session('email')}}</p>
            <div class="my-5 flex justify-center" style="margin-top: 80px;">
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" style="padding: 10px 30px;">
                    Suivant</span>
                </button>
            </div>
        </div>
@endsection