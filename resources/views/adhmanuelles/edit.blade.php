@extends('layouts.navadmin')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
    <h2 style="margin-bottom:30px">Edit Adhésion manuelle</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>{{ $adhmanuelle->nom }}</h6>
									<p class="text-secondary mb-1">Type : {{ $adhmanuelle->type }}</p>
									<p class="text-muted font-size-sm">Nombre de membres : {{ $adhmanuelle->nb_membres }}</p>
									<button class="btn btn-primary"><a href="{{ $adhmanuelle->id_groupe }}">Follow</a> </button>
									<a href="{{ route('adhmanuelles.show',$adhmanuelle->id) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Actif/supprimé</h6>
									<span class="text-secondary">{{ $adhmanuelle->actif_supprime }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Fréquence post/mois</h6>
									<span class="text-secondary">{{ $adhmanuelle->frequence_post_mois }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Date relevé</h6>
									<span class="text-secondary">{{ $adhmanuelle->date_releve }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Satut relevé</h6>
									<span class="text-secondary">{{ $adhmanuelle->statut_releve }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Tag recherche</h6>
									<span class="text-secondary">{{ $adhmanuelle->tag_recherche }}</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
               
				<div class="col-lg-8">
                <form action="{{ route('adhmanuelles.update',$adhmanuelle->id) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Groupe</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_groupe" value="{{ $adhmanuelle->id_groupe }}" class="form-control" placeholder="Enter id de groupe">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nom" value="{{ $adhmanuelle->nom }}" class="form-control" placeholder="Enter le nom">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Personalisation</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="personnalisaion" value="{{ $adhmanuelle->personnalisation }}" class="form-control" placeholder="personnalisaion">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nombres de membres</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="nb_membres" value="{{ $adhmanuelle->nb_membres }}" class="form-control" placeholder="Entrer une valeur">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Thème</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="theme" value="{{ $adhmanuelle->theme }}" class="form-control" placeholder="Thème">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Type</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="type" id="pet-select"  value="{{ $adhmanuelle->type }}" class="form-control">
                                    <option value="">--Veuillez choisir un type--</option>
                                    <option value="Privé">Privé</option>
                                    <option value="Public">Public</option>
                                </select> 
                				</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Réglementation</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="reglementation" value="{{ $adhmanuelle->reglementation }}" class="form-control" placeholder="Reglementation">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">URL à propos</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="url_a_propos" value="{{ $adhmanuelle->url_a_propos }}" class="form-control" placeholder="URL">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Fréquence post par mois</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="frequence_post_mois" value="{{ $adhmanuelle->frequence_post_mois }}" class="form-control" placeholder="Fréquence de Post mois">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Format groupe</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="format_groupe" value="{{ $adhmanuelle->format_groupe }}" class="form-control" placeholder="Choisir une format">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Lieu</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="lieu" value="{{ $adhmanuelle->lieu }}" class="form-control" placeholder="Choisir un lieu">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Actif/Supprimé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="actif_supprime" value="{{ $adhmanuelle->actif_supprime }}" id="pet-select" class="form-control">
                                    <option value="Actif">Actif</option>
                                    <option value="Supprimé">Supprimé</option>
                                </select>  								
                            </div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Statut relevé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="statut_releve" value="{{ $adhmanuelle->statut_releve }}" id="pet-select" class="form-control">
                                    <option value="Scrappé">Scrappé</option>
                                    <option value="Jarvee">Jarvee</option>
                                </select>								
                            </div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date relevé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="date" name="date_releve"  value="{{ $adhmanuelle->date_releve }}" class="form-control" placeholder="Choisir une date">
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Statut d'intégration</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="statut_integration" value="{{ $adhmanuelle->statut_integration }}" id="pet-select" class="form-control">
                                    <option selected>--Please choose an option--</option>
                                    <option value="nouveau groupe" {{($adhmanuelle->statut_integration === 'nouveau groupe') ? 'Selected' : ''}}>nouveau groupe</option>
                                    <option value="Nouveau membre" {{($adhmanuelle->statut_integration === 'Nouveau membre') ? 'Selected' : ''}}>Nouveau membre</option>
                                    <option value="Adhésion demandée" {{($adhmanuelle->statut_integration === 'Adhésion demandée') ? 'Selected' : ''}}>Adhésion demandée</option>
                                    <option value="Hors cible" {{($adhmanuelle->statut_integration === 'Hors cible') ? 'Selected' : ''}}>Hors cible</option>
                                </select>							
                                </div>
                            </div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Tag recherche</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="tag_recherche" value="{{ $adhmanuelle->tag_recherche }}" class="form-control" placeholder="Saisir un tag">
								</div>
							</div>
                        
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('adhmanuelles.index') }}"> Back</a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			
            </div>
		</div>
	</div>
    </form>

    <style>
        body{
    background: #f7f7ff;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}

#homeSubmenu{

   visibility:visible;
   display:block;
}
#pageSubmenu21{
            visibility:visible;
            display:block;
        }
#M4{
background-color: #747474;
}

    </style>
@endsection