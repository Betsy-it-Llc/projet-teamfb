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
    <h2 style="margin-bottom:30px">Validation Facture</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6> </h6>
									<p class="text-secondary mb-1"> </p>
									<p class="text-muted font-size-sm"> </p>
									<button class="btn btn-primary"><a href="">Follow</a> </button>
									<a href="{{ route('paiements.show') }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">numero :</h6>
									<span class="text-secondary"></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">description :</h6>
									<span class="text-secondary"></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">exper :</h6>
									<span class="text-secondary"></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">chanson :</h6>
									<span class="text-secondary"></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
                <form action="{{ route('paiements.update') }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Numero </h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="id_experience" value="{{old('id_experience')}}" class="form-control">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">descri</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="nom" class="form-control" value="{{old('nom')}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">exper</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="prenom" class="form-control" value="{{old('prenom')}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">chanson</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="Tel" class="form-control" value="{{old('Tel')}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="email" class="form-control" value="{{old('email')}}">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Statut</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="statut_experience" class="form-control" value="{{old('statut_experience')}}">
                				</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Num Facture</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="num_facture" value="{{old('num_facture')}}" class="form-control">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">UrlFactStripe</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <input type="text" name="url_facture" value="{{old('url_facture')}}" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Validate Facture">
                                    <a class="btn btn-primary" href="{{ route('factures.index') }}"> Back</a>
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
        #pageSubmenu14{
                visibility:visible;
                display:block;
                }
        #pageSubmenu18{
            visibility:visible;
            display:block;
        }
#M54{
background-color: #747474;
}
</style>
@endsection
