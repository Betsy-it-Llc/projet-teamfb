@extends('layouts.appwithtailwind')
@section('content')


      <div>
          <div>
              <main>
                <header class="header-maj">
                    <h1 class="h1-maj">
                        Mon compte
                    </h1>
                    <h2 class="text-lg md:text-3xl tel:text-xl font-bold ml-8">
                        Transfert
                    </h2>
                </header>

                  </div>
                  <div class="grid grid-cols-3 grid-rows-2 gap-1 mt-40">
                      <div class="flex justify-center col-start-2 mt-5">
                          <span class="text-base whitespace-nowrap tel:text-lg pb-4">
                              Transférer Cagnotte
                          </span>
                      </div>
                      <div class="row-start-2">
                          <div class="text-center">
                              <span class="text-lg tel:text-xl">
                                  Cagnote
                              </span>
                              <span class="block text-3xl font-bold">
                                {{$montantCumule}}€
                              </span>
                              <span class="block text-xs tel:text-sm">
                                  Montant disponible
                              </span>
                          </div>
                      </div>
                      <div class="row-start-2">
                          <div class="flex justify-center">
                      
                            <form action="{{ route('utilisateur.transfere', ['cagnottes' => implode(',', $cagnottesIds)]) }}" method="POST">
                              @csrf
                              <input type="hidden" name="cagnottes_ids[]" value="{{ implode(',', $cagnottesIds) }}">
                              <button class="bg-green-100 button tel:mr-6">
                                  <div class="flex justify-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                      </svg>                                  
                                  </div>
                                  <span class="text-sm flex justify-center">
                                      Transférer
                                  </span>
                              </button>
                          </div>
                          </form>
                          
                           
                      </div>
                      <div class="text-left row-start-2">
                          <div class="text-center">
                              <span class="text-lg tel:text-xl">
                                  Compte LalaChante
                              </span>
                              <span class="block text-3xl  font-bold">
                                {{$soldeContact}}€
                              </span>
                              <span class="block text-xs tel:text-sm">
                                  Montant disponible
                              </span>
                          </div>
                      </div>
                  </div>
                  <div class="flex justify-center">
                      <div class="mt-16">
                          <a class="text-sm text-black italic" href="#">Cliquez pour créditer votre compte LalaChante</a>
                      </div>
                  </div>
              </main>
          </div>
      </div>


@endsection


