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
    <h2 style="margin-bottom:30px">Edit Post Partagé</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>{{ $postpartage->nom }}</h6>
            						<p class="text-muted font-size-sm">ID Post : {{ $postpartage->id_post }}</p>
                                    <p class="text-muted font-size-sm">Statut : {{ $postpartage->statut }}</p>
									<button class="btn btn-primary"><a href="{{ $postpartage->id_groupe }}">Follow</a> </button>
									<a href="{{ route('postpartages.show',$postpartage->id_post) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Nom : </h6>
									<span class="text-secondary">{{ $postpartage->nom }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Prénom :</h6>
									<span class="text-secondary">{{ $postpartage->prenom }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Statut :</h6>
									<span class="text-secondary">{{ $postpartage->statut }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">ID utilisateur :</h6>
									<span class="text-secondary">{{ $postpartage->id_utilisateur }}</span>
								</li>

							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-8">
                <form action="{{ route('postpartages.update',$postpartage->id_post) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Post</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_post" value="{{ $postpartage->id_post }}"  class="form-control" placeholder="Enter ID">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0"style="  color:red; font-style: italic;">ID groupe*(obligatoire)</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_groupe" value="{{ $postpartage->id_groupe }}"  class="form-control" placeholder="Enter ID ">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nom" value="{{ $postpartage->nom }}"  class="form-control" placeholder="Enter nom">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Prenom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="prenom" value="{{ $postpartage->prenom }}"  class="form-control" placeholder="Enter prenom">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Message personalisé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <textarea class="form-control" value="{{ $postpartage->message_personnalise }}"  style="height:150px" name="message_personnalise" placeholder="Enter Message"></textarea>
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Statut</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="statut" id="pet-select" value="{{ $postpartage->statut }}"  class="form-control">
                                    <option value="">--Please choose an option--</option>
                                    <option value="Accepté">Acceptée</option>
                                    <option value="Refusé">Refusée</option>
                                </select>
                            </div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID utilisateur</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_utilisateur" value="{{ $postpartage->id_utilisateur }}"  class="form-control" placeholder="Enter ID utilisateur">
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('postpartages.index') }}"> Back</a>
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
#pageSubmenu1{
visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M13{
background-color: #747474;
}
</style>
@endsection
