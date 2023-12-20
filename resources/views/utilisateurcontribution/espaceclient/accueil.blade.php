@extends('layouts.appwithtailwind')

@section('content')


    
    <form style="width:110px!important;margin-bottom:60px!important; margin-left:2.25rem;margin-top:1.75rem" class="flex flex-col" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @if($photo_profil)
            <div style="width:110px;height:110px;object-fit:fill;position:relative" >
                <img style="object-fit:fill;height:110px;" src="{{$photo_profil->getUrl("photo_menu")}}" alt="{{$photo_profil->name}}">
                <button type="submit" class="font-bold text-red-500" name="delete_file" style="position:absolute;top:-20px;left:-5px;">
                    x
                </button>
            </div>
        @else
            <div>
                <svg width="110" height="110" viewBox="0 0 159 159" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <rect width="159" height="159" fill="url(#pattern0)"/>
                    <defs>
                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_2367_16707" transform="scale(0.02)"/>
                    </pattern>
                    <image id="image0_2367_16707" width="50" height="50" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACNElEQVR4nO2ZPWgUQRTHn4ooYmNExFaLNJJCG0EQEVELSzVNbAS7tMFC8PADBCGFiI0WNipyRYpj5v+f5Q4WgorKIRgNikQwrUQh2BhPbmTlRDmSuB/j7VP2B6+e9+O9N7szI1JRUVEKxpidJE+TvELyJoDrAM5ba/d779eIdgAcIfmEpF8lHjrnhkQrJK8C6P5B4kcAmCd5C8CIaMI5N55GYBmhrwDOiAaMMVtILuYR6cl0oijarWEuxvJK/CZzW4PIvQAibzSIPC0qQvIbgA1li7wNIOLjON5cqgjJuRAijUZjU6kiAB4HEFmUsiE5FUDkuQaRiwF2rRsavurHA4ic0FCRPUVFoijaW7ZHMuwuwIxAg8irAK31UoPI/QAVuathRg6nPYesUI2utfaQaMA5d6xANY6KJki+yyExJ9oAMJmjrSZFGwB2kVzKINEhOSwaAXD5n67GT5I7q5Tflff1en2daAbpToyzoh2Sz1K01WvRDsnZFCLzopl2u72e5IcUIp/jON4oWgFQy7BrXRNtOOeGANzJ+s+V3IkB2FZ2/tJqtbYDuJCmnVaRWQBwieSOgQsYYw70bhi/5BVYJpZIPiB58K++odRqtbXJ2Zrki4DJrxQzJE8lawaVALBvQAK+XyhZO4iEtfZs7wdv0BK+N0OdJIeiEqNFTn8BZbokT+Z+wAHwsWwJ/opPzWZza2YRAOcUJO/7YiKPyCMFifu+FpvOLJKUUqHIQmaRiooK+W/4DrbqolyMh5gqAAAAAElFTkSuQmCC"/>
                    </defs>
                </svg>
            </div>  
        @endif
        <label class="text-center" for="choisirImage">
            <div style="margin-top:3px" class="flex justify-center">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.9 8.1H13.5V9.9H9.9V13.5H8.1V9.9H4.5V8.1H8.1V4.5H9.9V8.1ZM9 18C6.61305 18 4.32387 17.0518 2.63604 15.364C0.948211 13.6761 0 11.3869 0 9C0 6.61305 0.948211 4.32387 2.63604 2.63604C4.32387 0.948211 6.61305 0 9 0C11.3869 0 13.6761 0.948211 15.364 2.63604C17.0518 4.32387 18 6.61305 18 9C18 11.3869 17.0518 13.6761 15.364 15.364C13.6761 17.0518 11.3869 18 9 18ZM9 16.2C10.9096 16.2 12.7409 15.4414 14.0912 14.0912C15.4414 12.7409 16.2 10.9096 16.2 9C16.2 7.09044 15.4414 5.25909 14.0912 3.90883C12.7409 2.55857 10.9096 1.8 9 1.8C7.09044 1.8 5.25909 2.55857 3.90883 3.90883C2.55857 5.25909 1.8 7.09044 1.8 9C1.8 10.9096 2.55857 12.7409 3.90883 14.0912C5.25909 15.4414 7.09044 16.2 9 16.2Z" fill="#909090"/>
            </svg>
            </div>
        </label>
        <input type="file" id="choisirImage" name="file" id="file" style="display:none">
        <button class="font-bold" id="boutonSoumettre">
            {{$contact->prenom}}
        </button>
    </form>
    <div class="flex justify-center">
        <div class="text-left">
            <h1 class="text-2xl font-bold mb-4"><a href="{{ route('utilisateur.compte') }}" class="text-black no-underline">Mon Compte</a></h1>
           
            <a href="{{ route('utilisateur.compte.experience') }}" class="block text-2xl font-bold mb-4">Mes Expériences</a>
            <a href="{{ route('utilisateur.cagnotte') }}" class="block text-2xl font-bold mb-4">Mes Cagnottes</a>
            {{-- Condition pour afficher le lien uniquement si le contact n'est pas un expérimentateur --}}
            
            @if(auth()->check() && auth()->user()->role == 'Expérimentateur')
                <a href="{{ route('utilisateur.mesprojets') }}" class="block text-2xl font-bold mb-4">Mes Projets</a>
            @endif
        
            <a href="{{ route('utilisateur.soutenirprojet') }}" class="block text-2xl font-bold mb-4">Soutenir</a>
    </div>
    </div>
    <div style='margin-top:4rem;' class="flex justify-center">
        <a style="margin-left:-100px;margin-bottom:0.75rem;" href="{{ route('utilisateur.parametre') }}" class="text-2xl font-bold mb-3 flex items-center"><span><svg width="50" height="50" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M27.7501 66L26.5501 56.4C25.9001 56.15 25.2871 55.85 24.7111 55.5C24.1351 55.15 23.5731 54.775 23.0251 54.375L14.1001 58.125L5.8501 43.875L13.5751 38.025C13.5251 37.675 13.5001 37.337 13.5001 37.011V34.989C13.5001 34.663 13.5251 34.325 13.5751 33.975L5.8501 28.125L14.1001 13.875L23.0251 17.625C23.5751 17.225 24.1501 16.85 24.7501 16.5C25.3501 16.15 25.9501 15.85 26.5501 15.6L27.7501 6H44.2501L45.4501 15.6C46.1001 15.85 46.7131 16.15 47.2891 16.5C47.8651 16.85 48.4271 17.225 48.9751 17.625L57.9001 13.875L66.1501 28.125L58.4251 33.975C58.4751 34.325 58.5001 34.663 58.5001 34.989V37.011C58.5001 37.337 58.4501 37.675 58.3501 38.025L66.0751 43.875L57.8251 58.125L48.9751 54.375C48.4251 54.775 47.8501 55.15 47.2501 55.5C46.6501 55.85 46.0501 56.15 45.4501 56.4L44.2501 66H27.7501ZM36.1501 46.5C39.0501 46.5 41.5251 45.475 43.5751 43.425C45.6251 41.375 46.6501 38.9 46.6501 36C46.6501 33.1 45.6251 30.625 43.5751 28.575C41.5251 26.525 39.0501 25.5 36.1501 25.5C33.2001 25.5 30.7121 26.525 28.6861 28.575C26.6601 30.625 25.6481 33.1 25.6501 36C25.6501 38.9 26.6621 41.375 28.6861 43.425C30.7101 45.475 33.1981 46.5 36.1501 46.5Z" fill="#202020"/>
            </svg></span>
            Paramètres</a>
    </div>
    <div class="flex justify-center">
        <form style="margin-top:140px" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center text-center" method="POST" action="{{ route('utilisateur.logout') }}">
            @csrf
            <button type="submit" class="text-black-500 hover:underline text-2xl">
                Se déconnecter
            </button>
        </form>
    </div>
    
    <script>
        // Sélectionnez l'élément input de type file et le bouton de soumission
        var inputImage = document.getElementById('choisirImage');
        var boutonSoumettre = document.getElementById('boutonSoumettre');
        var btnText=boutonSoumettre.textContent;

        // Ajoutez un écouteur d'événements pour le changement
        inputImage.addEventListener('change', function() {
        // Vérifiez si un fichier a été choisi
        if (inputImage.files.length > 0) {
            // Changez le texte du bouton
            boutonSoumettre.innerHTML = 'Valider image <i class="fa-solid fa-check"></i> ';
            
        } else {
            // Revert to the original text if no file is chosen
            boutonSoumettre.textContent = btnText;
        }
        });
    </script>
@endsection