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
    <h2 style="margin-bottom:30px">Edit Campagne</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>{{ $campagne->nom }}</h6>
            						<p class="text-muted font-size-sm">Etat : {{ $campagne->etat }}</p>
									<button class="btn btn-primary"><a href="{{ $campagne->id_groupe }}">Follow</a> </button>
									<a href="{{ route('campagnes.show',$campagne->id_campagne) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Score : </h6>
									<span class="text-secondary">{{ $campagne->score }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Date de début :</h6>
									<span class="text-secondary">{{ $campagne->date_debut }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Date de fin :</h6>
									<span class="text-secondary">{{ $campagne->date_fin }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">ID segmentation :</h6>
									<span class="text-secondary">{{ $campagne->id_segmentation }}</span>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
               
				<div class="col-lg-8">
                <form action="{{ route('campagnes.update',$campagne->id_campagne) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Campagne</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_campagne" value="{{ $campagne->id_campagne }}" class="form-control" placeholder="Enter l'ID">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nom" value="{{ $campagne->nom }}" class="form-control" placeholder="Enter le nom">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Score</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="score" value="{{ $campagne->score }}" class="form-control" placeholder="Enter le score">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date de début</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="date" name="datedebut" value="{{ $campagne->date_debut }}" class="form-control" placeholder="Enter la date de début">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date de fin</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="date" name="datefin" value="{{ $campagne->date_fin }}" class="form-control" placeholder="Enter la date de fin">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Contenu</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="contenue" value="{{ $campagne->contenu_post_mere }}" class="form-control" placeholder="Enter le contenu">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Objectifs</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="objectifs" value="{{ $campagne->objectifs }}" class="form-control" placeholder="Enter les objectifs">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Contexte</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="contexte" value="{{ $campagne->contexte }}" class="form-control" placeholder="Enter le contexte">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Etat</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="etat" value="{{ $campagne->etat }}" id="pet-select" class="form-control">
                                    <option value="">--Please choose an option--</option>
                                    <option value="Idée"  {{($campagne->etat === 'Idée') ? 'Selected' : ''}}>Idée</option>
                                    <option value="Planifiée"  {{($campagne->etat === 'Planifiée') ? 'Selected' : ''}}>Planifiée</option>
                                    <option value="En cours"  {{($campagne->etat === 'En cours') ? 'Selected' : ''}}>En cours</option>
                                    <option value="Terminée"  {{($campagne->etat === 'Terminée') ? 'Selected' : ''}}>Terminée</option>
                                    <option value="Archivée"  {{($campagne->etat === 'Archivée') ? 'Selected' : ''}}>Archivée</option>
                                </select>
                				</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date de programmation</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="date" name="dateprg" value="{{ $campagne->date_programmation }}" class="form-control" placeholder="Enter la date de programmation">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Bilan</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="bilan" value="{{ $campagne->bilan }}" class="form-control" placeholder="Enter le nom">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Recommendation</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="recommandation" value="{{ $campagne->recommandation }}" class="form-control" placeholder="Enter des recommendations">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nombre de j'aime</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="nbrlike" value="{{ $campagne->nb_likes }}" class="form-control" placeholder="Enter le nombre des j'aimes">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nombre de commentaires</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="nbrcmts" value="{{ $campagne->nb_comments }}" class="form-control" placeholder="Enter le nombre des commentaires">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nombres de partages</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nbrshare" value="{{ $campagne->nb_shares }}" class="form-control" placeholder="Enter le nombre de partages">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Porte</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="porte" value="{{ $campagne->portee }}" class="form-control" placeholder="Enter les portes">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID segmentation</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="id_segmentation" value="{{ $campagne->id_segmentation }}" class="form-control" placeholder="Enter l'ID de segmentation">
								</div>
							</div>

                          
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('campagnes.index') }}"> Back</a>
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
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M9{
background-color: #747474;
}
</style>
@endsection