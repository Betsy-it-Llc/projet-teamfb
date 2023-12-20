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
    <h2 style="margin-bottom:30px">Edit Ambassadeur</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>{{ $ambassadeur->prenom }} {{ $ambassadeur->nom }}</h6>
            						<p class="text-muted font-size-sm">ID ambassadeur : {{ $ambassadeur->id_ambassadeur }}</p>
									<a href="{{ route('ambassadeurs.show',$ambassadeur->id_ambassadeur) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Login : </h6>
									<span class="text-secondary">{{ $ambassadeur->login }}</span>
								</li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Mot de passe :</h6>
									<span class="text-secondary">{{ $ambassadeur->mdp }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Anthentification facebook :</h6>
									<span class="text-secondary">{{ $ambassadeur->authentification_facebook }}</span>
								</li>



							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-8">
                <form action="{{ route('ambassadeurs.update',$ambassadeur->id_ambassadeur) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_ambassadeur" value="{{ $ambassadeur->id_ambassadeur }}" class="form-control" placeholder="Enter le nom">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Login</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="login" value="{{ $ambassadeur->login }}" class="form-control" placeholder="Enter le login">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mot de passe</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="mdp" value="{{ $ambassadeur->mdp }}" class="form-control" placeholder="Enter le mot de passe">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Anthentification facebook</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="authentification_facebook" id="pet-select" class="form-control" value="{{ $ambassadeur->authentification_facebook }}">
                                    <option value="">--Please choose an option--</option>
                                    <option value="Oui">Oui</option>
                                    <option value="Non">Non</option>
                                </select>
                            </div>
							</div>



							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('ambassadeurs') }}"> Back</a>
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
#pageSubmenu6{
visibility:visible;
display:block;
}
#pageSubmenu20{
    visibility:visible;
    display:block;
}
#M34{
background-color: #747474;
}
</style>
@endsection
