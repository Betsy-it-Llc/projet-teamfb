@extends('layouts.appwithtailwind')

@section('content')


            <div class="pt-2 text-center">
                <h1 class="text-5xl  p-6 font-display font-bold text-slate-800 tel:text-5xl">Inscription Cause</h1>
            </div>
            <div class="p-7 mt-6 flex justify-center items-center">
                <i class="fa-solid fa-envelope fa-4x" style="margin: 10px;"></i>
            </div>
            <div class="p-6 flex justify-center flex-col items-center">
                <h5 class="text-3xl font-sans font-bold text-black pt-28 tel:text-xl  tel:ml- telL:ml-20 md:-mt-10 relative sm:-top-10 telL:mr-10 telL:-top-2 xl:text-2xl  lg:right-20">Inscription réussie !</h5>
                <div class="flex justify-center " style="margin-top: 20px;width:70%">
                    <p>
                       Bienvenue ! Votre inscription est confirmée. 👍<br>
                       Un email de validation a été envoyé à votre adresse.Merci de le consulter pour activer votre compte.<br><br>
                       À tout de suite sur Contribution by LalaChante
                    </p>
                </div>
            </div>
            <div class="p-7 mt-6 flex justify-center items-center">
                <i class="fa-regular fa-circle-check fa-3x" style="margin-bottom: 10px;"></i>
            </div>
            <div class="flex justify-center" style="margin-top: 60px;margin-bottom: 60px;">
                <a href="{{route('utilisateur.connection')}}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" style="padding: 10px 30px;">
                    Suivant</span>
                </a>
            </div>
    

@endsection