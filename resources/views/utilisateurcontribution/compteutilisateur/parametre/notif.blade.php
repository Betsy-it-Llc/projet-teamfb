
@extends('layouts.appwithtailwind')

@section('content')
    

        <div class="pt-10 text-center">
            <h1 class="text-5xl flex text-left p-6 font-display font-bold text-slate-800 tel:text-4xl">Gestion de mes <br> notifications</h1>
        </div>
        <div class="p-7 mt-6">
            <form method="post" action="{{route('utilisateur.notif-update')}}">
                @csrf
                <input type="hidden" name="id_contact" value="{{$contact->id_contact}}">
                <input type="submit" class="btn btn-success" href="#" style="margin-bottom : 14px " value="Enregistrer">

            <div class="flex items-center mb-4">
                @if($contact->notification_contributed_enabled===1)
                <input  name="notification_contributed_enabled" type="checkbox" checked  class=" focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                @else
                <input  name="notification_contributed_enabled" type="checkbox"  class=" focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                @endif
                <label for="checkbox" class="ms-2 text-sm font-medium text-gray-900 ">Recevoir dans ma boîte mail une notification à chaque contribution</label>
            </div>
             <div class="flex items-center mb-4">
                @if($contact->notification_contribution_enabled===1)
                <input  type="checkbox" checked checked name="notification_contribution_enabled"  class=" focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                @else
                <input  type="checkbox" name="notification_contribution_enabled"  class=" focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                @endif
                <label for="checkbox" class="ms-2 text-sm font-medium text-gray-900">Recevoir dans ma boîte mail un récapitulatif des contributions de mes cagnottes chaque semaines</label>
            </div>
            <div class="flex items-center mb-4">
                <input   name="notification_others_enabled" type="checkbox"  class=" focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checkbox" class="ms-2 text-sm font-medium text-gray-900">Recevoir la newsletter contribution LalaChante</label>
            </div>
           </form>
        </div>

    
    @endsection
