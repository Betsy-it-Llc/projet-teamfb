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
    <h2 style="margin-bottom:30px">Edit Question d'Adhésion</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6>{{ $questionad->nom }}</h6>
            						<p class="text-muted font-size-sm">ID Question : {{ $questionad->idq }}</p>
                                    <p class="text-muted font-size-sm">Nombre de membres : {{ $questionad->nbrmbr }}</p>
									<a href="{{ route('questionads.show',$questionad->id) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Nom : </h6>
									<span class="text-secondary">{{ $questionad->nom }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Question :</h6>
									<span class="text-secondary">{{ $questionad->question }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Réponse :</h6>
									<span class="text-secondary">{{ $questionad->reponse }}</span>
								</li>
							
								
							</ul>
						</div>
					</div>
				</div>
               
				<div class="col-lg-8">
                <form action="{{ route('questionads.update',$questionad->id) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Question</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="idq" value="{{ $questionad->idq }}" class="form-control" placeholder="Enter Link">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nom" value="{{ $questionad->nom }}" class="form-control" placeholder="Enter le nom">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Thème</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="theme"  value="{{ $questionad->theme }}" class="form-control" placeholder="Enter le theme">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nombre de membres</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="number" name="nbrmbr" value="{{ $questionad->nbrmbr }}" class="form-control" placeholder="Enter le nombre des membres">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Question</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="question" value="{{ $questionad->question }}" class="form-control" placeholder="Enter la question">
								</div>
							</div>
                
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Réponse</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="reponse" value="{{ $questionad->reponse }}" class="form-control" placeholder="Enter la réponse">
								</div>
							</div>
                           
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('questionads') }}"> Back</a>
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
#M5{
background-color: #747474;
}

    </style>
@endsection