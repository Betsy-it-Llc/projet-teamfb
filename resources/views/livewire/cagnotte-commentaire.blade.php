<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="" >
                <div class="form-outline mb-4">
                    <input wire:model="nouveauCommentaire" type="text" id="addANote" class="form-control my-2" placeholder="Ecrivez..." />
                    <label class="form-label my-2 mx-3" for="addANote"> + Ajouter un commentaire</label>
                    <i class="fa-solid fa-arrow-up-wide-short"></i>
                    <button wire:click="addComment" type="button" class="btn btn-primary btn-sm my-2 rounded rounded-5 mx-5">Envoyer</button>
                </div>
                @if (isset($erreur))
                    <div class="alert alert-danger">{{ $erreur }}</div>
                @endif
                <div wire:poll.lazy>
                @foreach($commentaires as $commentaire)
                    <div class="card mb-4">
                        <div class="card-body tipeur-bg rounded rounded-2 shadow-sm">
                            @php
                                // Formatez la date avec Carbon
                                $carbonDate = \Carbon\Carbon::parse($commentaire->date_creation)->locale('fr');
                                $dateFormatee =$carbonDate->isoFormat('Do MMMM YYYY [à] HH : mm  : ss ');
                            @endphp
                            <p style="font-size:0.8rem"><i class="fa-regular fa-clock"></i> {{ $dateFormatee }}</p>
                            <p>{{ $commentaire->texte }}</p>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp" alt="avatar" width="25"
                                        height="25" />
                                    <p class="small mb-0 ms-2">{{$commentaire->prenom}} {{$commentaire->nom}}</p>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div class="d-flex flex-row align-items-center mx-2 p-2 border border-1 rounded">
                                        <i class="fa-regular fa-thumbs-up d-flex justify-content-center align-items-center mx-2" ></i>
                                        <p class="small text-muted mb-0 mx-">{{ $commentaire->likes }}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mx-2 p-2 border border-1 rounded">
                                        <i class="fa-regular fa-thumbs-down d-flex justify-content-center align-items-center mx-2"></i>
                                        <p class="small text-muted mb-0">{{ $commentaire->dislikes }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            </div>
        </div>
</div>
