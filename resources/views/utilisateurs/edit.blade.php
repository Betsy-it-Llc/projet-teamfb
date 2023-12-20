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
    <h2 style="margin-bottom:30px">Edit Utilisateur</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>{{ $utilisateur->prenom }} {{ $utilisateur->Nom }}</h6>
            						<p class="text-muted font-size-sm">ID Utilisateur : {{ $utilisateur->id_utilisateur }}</p>
									<a href="{{ route('utilisateurs.show',$utilisateur->id_utilisateur) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Nom : </h6>
									<span class="text-secondary">{{ $utilisateur->Nom }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">PréNom :</h6>
									<span class="text-secondary">{{ $utilisateur->prenom }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Sexe :</h6>
									<span class="text-secondary">{{ $utilisateur->genre }}</span>
								{{--  </li>
<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">profil :</h6>
									<span class="text-secondary">{{ $utilisateur->profil }}</span>
								</li>  --}}

							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-8">
                <form action="{{ route('utilisateurs.update',$utilisateur->id_utilisateur) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Utilisateur</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="id_utilisateur" value="{{ $utilisateur->id_utilisateur }}" class="form-control" placeholder="Enter ID">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="Nom" value="{{ $utilisateur->Nom }}" class="form-control" placeholder="Enter le Nom">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">PréNom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="prenom" value="{{ $utilisateur->prenom }}" class="form-control" placeholder="Entrer le prenom">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Genre</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="genre" id="pet-select" value="{{ $utilisateur->genre }}" class="form-control">
                                    <option value="">--Please choose an option--</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>

							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">URL utilisateur</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="url_utilisateur" value="{{ $utilisateur->url_utilisateur }}" class="form-control" placeholder="Entrer un URL">
								</div>
							</div>

<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">profil</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="profil" value="{{ $utilisateur->profil }}" class="form-control" placeholder="profil">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('utilisateurs.index') }}"> Back</a>
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
#pageSubmenu2{
visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M18{
background-color: #747474;
}
</style>
@endsection
