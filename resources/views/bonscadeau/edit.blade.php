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
    <h2 style="margin-bottom:30px">Edit Contact</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>Nom : {{ $data->nom }}</h6>
									<p class="text-secondary mb-1">Prenom : {{ $data->prenom }}</p>
									<p class="text-muted font-size-sm">Tel : {{ $data->tel }}</p>
									<button class="btn btn-primary"><a href="{{ $data->id_contact }}">Follow</a> </button>
									<a href="{{ route('contacts.show',$data->id_contact) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Email</h6>
									<span class="text-secondary">{{ $data->email }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Adresse</h6>
									<span class="text-secondary">{{ $data->adresse }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Code postale</h6>
									<span class="text-secondary">{{ $data->code_postale }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Ville</h6>
									<span class="text-secondary">{{ $data->ville }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">ID Cse</h6>
									<span class="text-secondary">{{ $data->id_CSE }}</span>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-8">
                <form action="{{ route('contacts.update',$data->id_contact) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Contact</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="id_groupe" value="{{old('id_groupe') ?? $data->id_contact }}" class="form-control">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="nom" class="form-control" value="{{old('nom') ?? $data->nom }}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Prenom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom') ?? $data->prenom }}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Tel</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="Tel" class="form-control" value="{{old('Tel') ?? $data->tel }}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="email" class="form-control" value="{{old('email') ?? $data->email }}">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Adresse</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="adresse" class="form-control" value="{{old('adresse') ?? $data->adresse }}">
                				</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Code postale</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="code_postale" value="{{old('code_postale') ?? $data->code_postale }}" class="form-control">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Ville</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="ville" value="{{old('ville') ?? $data->ville }}" class="form-control">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Cse</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="id_CSE" value="{{old('id_CSE') ?? $data->id_CSE }}" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Back</a>
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
#pageSubmenu10{
visibility:visible;
display:block;
}
#pageSubmenu15{
            visibility:visible;
            display:block;
            }
#pageSubmenu18{
            visibility:visible;
            display:block;
        }
#M57{
background-color: #747474;
}
</style>
@endsection
