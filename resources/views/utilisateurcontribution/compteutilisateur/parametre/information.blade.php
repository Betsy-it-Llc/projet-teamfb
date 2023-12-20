
@extends('layouts.appwithtailwind')

@section('content')

<div class="space-y-25">
<div class="  mt-10 text-center ">
  <h1 class="text-4xl font-bold leading-7 text-b-900">MES INFORMATIONS</h1>
  <h2 class="mt-5 text-2xl font-bold leading-7 text-black-600">MON IDENTITE</h2>
</div>


<form class=" h-screen flex flex-col items-center justify-center " method="POST" action="{{ route('modification.enregistrer') }}">
  @csrf
  @method('PUT')

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-15">
        <div class="sm:col-span-4">
          <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
          <div class="mt-1">
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
              <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
              <input type="text" name="prenom" id="prenom" autocomplete="prenom" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Prénom" value="{{ $contact->prenom }}">
            </div>
            <label for="nom" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Nom</label>
            <div class="mt-1">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
                <input type="text" name="nom" id="nom" autocomplete="nom" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Nom" value="{{ $contact->nom }}">
              </div>
          </div>
   
        <div class="col-span-full">
          <label for="date_naissance" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Date de Naissance</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="date" name="date_naissance" id="date_naissance" autocomplete="date_naissance" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="19/07/1191" value="{{ $contact->date_naissance }}">
          </div>
        </div>

        <div class="col-span-full">
          <label for="adresse" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Adresse</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="text" name="adresse" id="adresse" autocomplete="adresse" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="12 rue du pont" value="{{ $contact->adresse }}">
          </div>
        </div>

        <div class="col-span-full">
          <label for="code_postal" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Code Postal</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="text" name="code_postal" id="code_postal" autocomplete="code_postal" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="75000" value="{{ $contact->code_postal }}">
          </div>
        </div>

        <div class="col-span-full">
          <label for="ville" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Ville</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="text" name="ville" id="ville" autocomplete="ville" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Paris" value="{{ $contact->ville }}">
          </div>
        </div>

        <div class="col-span-full">
          <label for="nationalite" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Nationalité</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="text" name="nationalite" id="nationalite" autocomplete="nationalite" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Française" value="{{ $contact->nationalite }}">
          </div>
        </div>

        <div class="col-span-full">
          <label for="pays_residence" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Pays de résidence</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="text" name="pays_residence" id="pays_residence" autocomplete="pays_residence" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="France" value="{{ $contact->pays_residence }}">
          </div>
        </div>

        <div class="col-span-full">
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Email</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="text" name="email" id="email" autocomplete="email" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="monadresse@gmail.com" value="{{ $contact->email }}">
          </div>
        </div>

        <div class="col-span-full">
          <label for="tel" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Téléphone</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="text" name="tel" id="tel" autocomplete="tel" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="0386868686" value="{{ $contact->tel }}">
          </div>
        </div>

        <div class="col-span-full">
          <label for="pseudo" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Pseudo</label>
          <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm"></span>
            <input type="text" name="pseudo" id="pseudo" autocomplete="pseudo" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Mon pseudo" value="{{ $contact->pseudo }}">
          </div>
        </div>
      </div>
    </div>

    
    <div class=" pb-12">
      <h2 class="text-base font-semibold leading-7 text-gray-900 mt-2">Notifications</h2>
      <label class="relative inline-flex items-center mb-5 cursor-pointer">
        <input type="checkbox" value="" class="sr-only peer">
        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">J'accepte de recevoir des information par email</span>
      </label>
      <br>
      <label class="relative inline-flex items-center mb-5 cursor-pointer">
        <input type="checkbox" value="" class="sr-only peer">
        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">J'accepte de recevoir des information par email</span>
      </label>
    </div>

  <div class="mt-2  gap-x-6">
    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Annuler</button>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
  </div>
</form>

      
    @endsection
