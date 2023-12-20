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
    <h2 style="margin-bottom:30px">Edit Post Groupe</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>{{ $postgroupe->nom }}</h6>
            						<p class="text-muted font-size-sm">ID Post : {{ $postgroupe->id_post }}</p>
									<button class="btn btn-primary"><a href="{{ $postgroupe->id_groupe }}">Follow</a> </button>
									<a href="{{ route('postgroupes.show',$postgroupe->id_post) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Titre : </h6>
									<span class="text-secondary">{{ $postgroupe->titre }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Type de Média :</h6>
									<span class="text-secondary">{{ $postgroupe->type_media }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Porte :</h6>
									<span class="text-secondary">{{ $postgroupe->portee }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Interaction :</h6>
									<span class="text-secondary">{{ $postgroupe->interaction }}</span>
								</li>

							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-8">
                <form action="{{ route('postgroupes.update',$postgroupe->id_post) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Post</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_post" value="{{ $postgroupe->id_post }}" class="form-control" placeholder="Id">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0"style="  color:red; font-style: italic;  ">ID campagne*(obligatoire)</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="idc" value="{{ $postgroupe->idc }}" class="form-control" placeholder="Id">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Lien</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="lien" value="{{ $postgroupe->lien }}" class="form-control" placeholder="Enter Lien">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Statut scrappé</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select value="{{ $postgroupe->stascra }}" name="stascra" id="pet-select" class="form-control">
                                    <option value="">--Please choose an option--</option>
                                    <option value="Scrappé">Scrappé</option>
                                    <option value="Non Scrappé">Non Scrappé</option>
                                </select>
                            </div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Titre</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input value="{{ $postgroupe->titre }}" type="text" name="titre" class="form-control" placeholder="Enter Titre">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Type de Média</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" value="{{ $postgroupe->typemedia }}" name="typemedia" class="form-control" placeholder="Enter Type de média">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Légénde</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" value="{{ $postgroupe->legende }}" name="legende" class="form-control" placeholder="Enter légende">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Hashtag</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" value="{{ $postgroupe->hashtag }}" name="hashtag" class="form-control" placeholder="Enter Hashtag">
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('postgroupes.index') }}"> Back</a>
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
#M14{
background-color: #747474;
}
</style>
@endsection
