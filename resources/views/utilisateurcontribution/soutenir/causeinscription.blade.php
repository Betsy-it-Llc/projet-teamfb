@extends('layouts.appwithtailwind')

@section('content')

    <form action="" method="POST" class=" bg-white shadow-lg flex-grow w-full tel:w-full tel:h-full telL:w-full sm:w-full md:w-3/5 lg:w-3/6 xl:w-2/6 2xl:w-2/6 4k:w-2/5">
        @csrf

        <div class="pt-2 text-center">
            <h1 class="text-5xl  p-6 font-display font-bold text-slate-800 tel:text-5xl">Inscription Cause</h1>
        </div>
        <div class="p-1 mt-6 flex justify-center items-center">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="100" height="100" fill="url(#pattern0)"/>
                <defs>
                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                <use xlink:href="#image0_2367_16681" transform="scale(0.01)"/>
                </pattern>
                <image id="image0_2367_16681" width="100" height="100" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAAHlklEQVR4nO1dZ6gcVRSeJHbFXrFiATtiIhbsvWJLjGJBVOwQu6Do2hBFn3HJZu/33XnhmSgYVn8YE6NGsRfUGGJJFKwoFiyxJEaNJiMn70bWdd++mTszb2Zn7gfnz+PtnjP3m9vO/c5dz3NwcHBwcHBwcHBwKAJIHgngVZILSH5M8ppGozEi67hKCa318SSXkgyaDcD9WcdWOlSr1bVJftNKhrElEydO3DLrGEsFkj0DkLHclFLHZh1jaUByDQBfdiIEwGFZx1kqkFzH9JIlbQj5otForJJ1jKWEUmoHkjNaesfYrOMqPUgeDmA+yZeDIBhW+gZJCyT3IvmiLG8B/ApgEsmt2v1vtVpdleRmjoyU4Pv+7iQXt5mwfyd5l8wjrvGHCEEQDCP5yiArqR8BXC89wxGTMgCM7URGi73rNoIpotForGLyUmEJkd4yM82YSg2S10UhY4W5XpICJk2atBHJn20IIblnGjGVGgAmWpLxmyQcs46/UPB9fyeSf1kS0pN1/IUDySdsyJDlr+/762cdf6GgtT7UsmcIIZdlHX+h0Gg0RpCc26HR55F8TPJUJP9oIWN+pVJZKetnKBSUUuc3NfAyIUAmd631ab7vb9L8v5KrIjnZ/J87iEoaU6ZMWZPkLJI1pdToer2+cZjPaa0PIMnEAyoj6vX6tgAuBDCF5Hkxhrm3JcnY19e3WvJRloAAkg2S3zcNT19JD0lgmPvIHdlaEMAWk0a1IaOnp2d1OaZtmdyXmR63oVd2tBDwQ8il6nzb1RHJmzt877dKqXO8sqk+5O0GMM0oBm32D8fY+JZVl5wchiB8plJqG6/o0FrvM5gEJ0RjPWPrHwAi+Fkk0tLC7lN6e3u3ljRFHDJILtVa7zHEua45AEZ5RUOUt7ODPWDrn+TjMXrl3yTH12q1tbwioFarbWrEBXHIWDyQYmQwkDwogZdh+VKb5Kle0bW0IRvjjhiCh7eSIKQplulde8IoqW2SC2M2wHe2B0gAzkqSjCaTk8lxlUpluNdNAHBrAg9/qY1vSYsA+DwlQla8LK9qrXfxuij5F2qz18E+JLmyjX/RXaVJRpOJaLtqm8rJvQKk2ZRSJ9r4rtfr6yWwzI5qHyuljvDyCFEEmlVJnAd80dY/yeoQk9FsDVHAeHkCyUtiPtRnIpa28e37/vYA/syQkOULEVlQeHmApBsAfGrxELO11ucqpTaP45/kIxFWSg9K7sps/tIgZ5YkUJNrXbsGOTsiEfOVUgcn4RvAviuOaAexX5pXRwCOTpGUxSbLPKaTaa238JKGrMuNsCBssPcmdWoXBMEwU3ce5iW4ovXzJJ8eymGtjY3xkobW+uSQDSJv8dVJ+g76CZEecq3spgdK7wN4p10Wl+R7hSMEwJshCbnBSxmVSmW4Kdy5nORUSf2L+b4/svV/5Xw+YzKSJ0TW4CEdP9kp5WBK0WokPzDnEgvNMFiV8++khQmSl4oh0s4vISSfDznBta3lk3wVgIdDTMq/CakAriK5W5yYjQLluRyQkSwhMnaHcTrQXSIiMADwvuWDfG0EcGe1iuM6QeYROWPJARGpEDI9BBnL2qWtZfgC8EISD4X+3jUXwD1y24+oTDq8QG/kgITkCZGJM+Taf04S+xZGI+h3MySNN9W3jNETu4MQGfdDNs6dAxAyJweNERSCEJM3CrXDlbRI6+dld5qDhggKQwhJP6xDSU+0+fwhOWiIoBCESBKwteZiENtvgJvdsm6IoBCEALgvikOt9VGt3yH7iBw0RND1hJh9w6IoDgFc3Po9cuyZgEQoKIjFIuS2qA4B9A3wXZNz0BhB1xJiLpG0EUovaHdbm8hDB7jdrWw2xstAzXFcu+8keWUOGiToOkJEktPhitVBTTaRHRSGt4fc8QcFNStCdozjVMQHnRKAUvsRt2SBJSPkOEsiljW9/X4Igd0tJs0elMiiEyJiBEtnS6MK4CStAuChEg1j0Qnp6+tb12JF9FcrIbKHkXrxMD4BjDI3MWTdYPkjxDTQoxaE/O/vAH4iuX8Yn0EQDFNKndFaQVswG2Od4RVdUxgnIpjrlA2WSV6qcKMUjZK8KWqWoPA7dREbhCDlZQCvhwxmRpQKKdWf2Pz33pKCWLzkIsntTH35kjZn3DfKEWrEgERdcmWUu9fZr1DpeCVsF1kyJ4Yy0QM4EMAJ9Xp9VxEPGNHabMvAZkXxH/T7Gpt2cU7XENIOWuszYwR2UowrYseFnd9KQ4hpmE8sg3ot7oX47L8XiymKp7uLEJIX2QRkJui9k4rD9/2RAF7KQUNnTohtGfLUNOJRSo22qVcpBCFG9Ba5esl8ZjsvJTS6Y35JnhCTGMzt3bm1Wm1Tkr3tfjKvsEOW1NdFDGTBhAkTNvCGEEqpnUWwXQpCogqYRcXuZQQAp8RYEXYNIadHCGJe1j+qUu3/uaMLADyV8dl+aoQ8GzKA/xRe5gG1Wm0tiUlUloMVaSZtqRR9ygOF2ZBJnZ9cKpZ4AA7/F0F0IORDAHeLgtH9PN0QQorx25CxWBKPQxmHw39rBaetOKuQO0/cD/7mADJJyQTprvN2cHBwcHBwcHBwcHBwcHBwcPDSwz/BP2NzHpr0vQAAAABJRU5ErkJggg=="/>
                </defs>
                </svg>
                
        </div>
        <div class="p-6">
            <div class="flex justify-center" style="margin-top: 20px;">
                <p>
                    Si vous avez déjà un compte lalachante connectez<br> vous à votre compte, pour créer une cause
                </p>
            </div>
        </div>
        <div class="flex justify-center items-center">
            <input name="nom_organisme" style="width: 350px" type="text"  class=" mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg   focus:ring-blue-500 focus:border-blue-500 block p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('nom_organisme') }}" placeholder="Nom de l'organisme" >
        </div>
        <div class="flex justify-center items-center">
            <input name="first_name" style="width: 350px" type="text"  aria-label="disabled input" class=" mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block p-2.5   dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500  " value="{{ old('first_name') }}" placeholder="Prénom" >
        </div>
        <div class="flex justify-center items-center">
            <input name="last_name" style="width: 350px;" type="text"  aria-label="disabled input" class=" mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('last_name') }}" placeholder="Nom" >
        </div>
        <div class="flex justify-center items-center">
            <input name="date_naissance" style="width: 250px; margin-right:100px" type="date" aria-label="disabled input" class=" mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 " value="{{ old('date_naissance') }}" placeholder="Date de naissance" >
        </div>
        <div class="flex justify-center items-center">
            <input  name="email" style="width: 250px; margin-right:100px" type="text"  aria-label="disabled input" class=" mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 " value="{{ old('email') }}" placeholder="Email" >
        </div>
        <div class="flex justify-center items-center">
            <select name="role" style="width: 250px; margin-right:100px" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 "  data-te-select-init>
                <option selected  style="width: 250px; margin-right:100px" value="0"  >Choisissez votre rôle</option>
                <option  style="width: 250px; margin-right:100px"value="Cause">Cause</option>
                <option  style="width: 250px; margin-right:100px" value="Expérimentateur">Experimentateur</option>
            </select>
        </div>
        <div class="flex justify-center items-center">
            <div class="flex">
            <span style="border-top-left-radius:0.5rem;border-bottom-left-radius:0.5rem" class="mb-6 inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 rounded-s-md dark:text-gray-400 dark:border-gray-600">
                +33
            </span>
            <input name="telephone" style="width: 302px; border-top-right-radius:0.5rem;border-bottom-right-radius:0.5rem;" min="0" type="text" id="website-admin" class="  mb-6 bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Téléphone portable" value="{{ old('telephone') }}">
            </div>
        </div>
        <div class="flex justify-center items-center">
            <input name="password" style="width: 350px" type="text" id="disabled-input" aria-label="disabled input" class=" mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 " value="" placeholder="Mot de passe" >
        </div>
        <div class="flex justify-center items-center">
            <input  name="password_confirmation" style="width: 350px" type="text" id="disabled-input" aria-label="disabled input" class=" mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 " value="" placeholder="Confirmer mot de passe" >
        </div>
        <div class="flex justify-center items-center">
            <p style="margin-right:50px" class="text center font-bold">J'accepte les CGU de LalaChante<br>stripe, et la politique de<br> confidentialité</p>
            
            <label class="relative inline-flex items-center cursor-pointer">
                <input name="cgu" type="checkbox" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            </label>
        </div>
        <div class="flex justify-center" style="margin-top: 60px;margin-bottom: 60px;">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" style="padding: 10px 30px;">
                Suivant</span>
            </button>
        </div>
        <div  class="text-center flex justify-center items-center">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    <ul>
                        @foreach (session()->get('success') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
                {{-- Ajout des messages personnalisés 'error' --}}
            @if($errors->any())
            <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </form>
@endsection