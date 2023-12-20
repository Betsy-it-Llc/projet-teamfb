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
    <h2 style="margin-bottom:30px">Edit Groupe sans ambassadeur</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>{{ $groupesansambassadeur->nom }}</h6>
									<p class="text-secondary mb-1">Groupe {{ $groupesansambassadeur->type }}</p>
									<p class="text-muted font-size-sm">Nombre de membres : {{ $groupesansambassadeur->nb_membres }}</p>
									<button class="btn btn-primary"><a href="{{ $groupesansambassadeur->id_groupe }}">Follow</a> </button>
									<a href="{{ route('groupesansambassadeurs.show',$groupesansambassadeur->id) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Actif/supprimé</h6>
									<span class="text-secondary">{{ $groupesansambassadeur->actif_supprime }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Fréquence post/mois</h6>
									<span class="text-secondary">{{ $groupesansambassadeur->frequence_post_mois }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Date relevé</h6>
									<span class="text-secondary">{{ $groupesansambassadeur->date_releve }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Satut relevé</h6>
									<span class="text-secondary">{{ $groupesansambassadeur->statut_releve }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Tag recherche</h6>
									<span class="text-secondary">{{ $groupesansambassadeur->tag_recherche }}</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
               
				<div class="col-lg-8">
                <form action="{{ route('groupesansambassadeurs.update',$groupesansambassadeur->id_groupe) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Groupe</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_groupe" value="{{ $groupesansambassadeur->id_groupe }}" class="form-control" placeholder="Enter ID">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nom" class="form-control" value="{{ $groupesansambassadeur->nom }}" placeholder="Enter le nom">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Personalisation</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="personnalisation" class="form-control" value="{{ $groupesansambassadeur->personnalisation }}" placeholder="Personalisation">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nombres de membres</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="nb_membres" class="form-control" value="{{ $groupesansambassadeur->nb_membres }}" placeholder="Enter le nombre de memebres">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Thème</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="theme" class="form-control" value="{{ $groupesansambassadeur->theme }}" placeholder="Entrer un thème">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Type</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="type" value="{{ $groupesansambassadeur->type }}" id="pet-select" class="form-control">
                                    <option value="">--Please choose an option--</option>
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
                                <input type="text" name="reglementation" value="{{ $groupesansambassadeur->reglementation }}" class="form-control" placeholder="Réglementation">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">URL à propos</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="url_a_propos" value="{{ $groupesansambassadeur->url_a_propos }}" class="form-control" placeholder="URL à propos">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Fréquence post par mois</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="frequence_post_mois" value="{{ $groupesansambassadeur->frequence_post_mois }}" class="form-control" placeholder="Fréquence de postes par mois">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Format groupe</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="format_groupe" value="{{ $groupesansambassadeur->format_groupe }}" class="form-control" placeholder="Enter les tag de recherche">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Lieu</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="lieu" class="form-control" value="{{ $groupesansambassadeur->lieu }}" placeholder="Enter les tag de recherche">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Actif/Supprimé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="actif_supprime" class="form-control" value="{{ $groupesansambassadeur->actif_supprime }}" placeholder="Choisir ..">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Statut relevé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="statut_releve" value="{{ $groupesansambassadeur->statut_releve }}" class="form-control" placeholder="Choisir le statut">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date relevé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="date" name="date_releve" value="{{ $groupesansambassadeur->date_releve }}" class="form-control" placeholder="Choisir une date">
								</div>
							</div>

                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Statut red'intégrationlevé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="statut_integration" value="{{ $groupesansambassadeur->statut_integration }}" id="pet-select" class="form-control">
                                    <option selected>--Please choose an option--</option>
                                    <option value="nouveau groupe" {{($groupesansambassadeur->statut_integration === 'nouveau groupe') ? 'Selected' : ''}}>nouveau groupe</option>
                                    <option value="Nouveau membre" {{($groupesansambassadeur->statut_integration === 'Nouveau membre') ? 'Selected' : ''}}>Nouveau membre</option>
                                    <option value="Adhésion demandée" {{($groupesansambassadeur->statut_integration === 'Adhésion demandée') ? 'Selected' : ''}}>Adhésion demandée</option>
                                    <option value="Hors cible" {{($groupesansambassadeur->statut_integration === 'Hors cible') ? 'Selected' : ''}}>Hors cible</option>
                                </select>							
                                </div>
                            </div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Tag recherche</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="tag_recherche" value="{{ $groupesansambassadeur->tag_recherche }}" class="form-control" placeholder="Enter les tag de recherche">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Ambassadeur</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_ambassadeur" value="{{ $groupesansambassadeur->id_ambassadeur }}" class="form-control" placeholder="Enter ID">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom Ambassadeur</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nom_ambassadeur" value="{{ $groupesansambassadeur->nom_ambassadeur }}" class="form-control" placeholder="Enter nom">
								</div>
							</div>
                            

							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('groupesansambassadeurs') }}"> Back</a>
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

    </style>
	<style>
#pageSubmenu{
visibility:visible;
display:block;
}
</style>
@endsection