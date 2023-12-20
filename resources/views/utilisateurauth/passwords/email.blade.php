@extends('layouts.appwithtailwind')

@section('content')
    <div class="bg-gray-100 flex flex-col justify-center h-screen items-center">
        <div class="bg-gray-300 w-full h-16">
        </div>
        <div class="bg-white shadow-lg flex-grow w-full tel:w-full tel:h-full telL:w-full sm:w-full md:w-3/5 lg:w-3/6 xl:w-2/6 2xl:w-2/6 4k:w-2/5">
            <div class="pt-10 text-center">
                <h1 class="text-5xl flex text-left p-6 font-display font-bold text-slate-800 tel:text-5xl">Retrouver mot de <br> passe</h1>
            </div>

            @if (session('status'))
                <div class="flex justify-center">
                    <div style="width:70%" class="flex items-center p-4 mb-4 text-sm text-whi-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                          <strong class="text-center">{{ session('status') }}</strong>
                        </div>
                      </div>
                </div>
            @endif

            <div class="p-7 mt-6 flex justify-center items-center">Saisissez votre numéro de téléphone ou votre adresse e-mail de récupération</div>
            <div>
            <form  method="POST" action="{{ route('utilisateur.sendresetpassword') }}">
                @csrf
                <div  class="mb-6 flex items-center justify-center gap-4">
                    <i class="fa-solid fa-envelope fa-3x" style="margin: 10px;"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  class="@error('email') is-invalid @enderror block w-20px mx-5 p-4 text-gray-900 border-2 border-black-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500  dark:border-gray-600  dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" style="height:40px;width:60%;border: solid;" placeholder="xxxxxxxxxx@gmail.com">
                </div>
                <div class="flex justify-center" style="margin-top: 50px; margin-bottom:50px;">
                    <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" style="padding: 10px 30px;">
                        {{ __('Suivant') }}</span>

                    </button>
                </div>
            </form>
            @error('email')
            <div class="flex justify-center">
                <div style="width:70%" class="flex items-center p-4 mb-4 text-sm text-whi-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-white" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                      <strong class="text-center">{{ $message }}</strong>
                    </div>
                  </div>
            </div>
            @enderror
        </div>
@endsection
