
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
    <h2 style="margin-bottom:30px">Edit Segment</h2>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://flyclipart.com/thumb2/organizational-structure-organization-icon-with-png-and-vector-107927.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h6> {{ $segement->nom_segment }}</h6>
            						<p class="text-muted font-size-sm">ID segement : {{ $segement->id_segment }}</p>
									<a href="{{ route('segements.edit',$segement->id_segment) }}"><button class="btn btn-outline-primary">More info</button></a>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0">Type : </h6>
									<span class="text-secondary">{{ $segement->type }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Thème :</h6>
									<span class="text-secondary">{{ $segement->theme }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Id Segmentation :</h6>
									<span class="text-secondary">{{ $segement->nom_segmentation }}</span>
								</li>


							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-8">
                <form action="{{ route('segements.update',$segement->id_segment) }}" method="POST">
                @csrf
                @method('PUT')
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">ID Segment</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="id_segment" value="{{ $segement->id_segment }}" class="form-control" placeholder="ID">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nom_segment" value="{{ $segement->nom_segment }}" class="form-control" >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Thème</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="theme" id="pet-select" class="form-control" value="{{ $segement->theme }}">
                                    <option value="">--Please choose an option--</option>
                                    <option value="Thème 1" {{($segement->theme === 'Thème 1') ? 'Selected' : ''}}>Thème 1</option>
                                    <option value="Thème 2" {{($segement->theme === 'Thème 2') ? 'Selected' : ''}}>Thème 2</option>
                                    <option value="Thème 3" {{($segement->theme === 'Thème 3') ? 'Selected' : ''}}>Thème 3</option>
                                    <option value="Thème 4" {{($segement->theme === 'Thème 4') ? 'Selected' : ''}}>Thème 4</option>
                                    <option value="Thème 5" {{($segement->theme === 'Thème 5') ? 'Selected' : ''}}>Thème 5</option>
                                </select>
                            </div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Type</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <select name="type" id="pet-select" class="form-control" value="{{ $segement->type }}">
                                    <option value="">--Please choose an option--</option>
                                    <option value="Type 1" {{($segement->type === 'Type 1') ? 'Selected' : ''}}>Type 1</option>
                                    <option value="Type 2" {{($segement->type === 'Type 2') ? 'Selected' : ''}}>Type 2</option>
                                    <option value="Type 3" {{($segement->type === 'Type 3') ? 'Selected' : ''}}>Type 3</option>
                                    <option value="Type 4" {{($segement->type === 'Type 4') ? 'Selected' : ''}}>Type 4</option>
                                    <option value="Type 5" {{($segement->type === 'Type 5') ? 'Selected' : ''}}>Type 5</option>
                                </select>
                            </div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Caractéristique</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="caracteristique" value="{{ $segement->caracteristique }}" class="form-control" placeholder="Enter le num de la caractérstique">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Description</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<textarea name="description" class="form-control" placeholder="Enter la description" style=" white-space: pre-line; border:1px #cfd1d8  solid;" cols="30" rows="5">{{ $segement->description }}</textarea>

                                <!-- <input type="text" name="description" value="{{ $segement->description }}" class="form-control" placeholder="Enter la description"> -->
								</div>
							</div>
                             <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">groupe</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                <input type="text" name="nb_groupe" value="{{ $segement->nb_groupe }}" class="form-control" placeholder="Enter la description">
								</div>
							</div>
                            <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0"style="  color:red; font-style: italic;font-weight: bold;">Id Segmentation</h6>
								</div>
								<div class="col-sm-9 text-secondary">

<select name="nom_segmentation" class="form-control">
                                                <?php
												use Illuminate\Support\Facades\DB;
 $ambs = DB::connection('mysql')->select('select id_segmentation ,nom_segmentation  from segementations  ');

foreach ($ambs as $amb => $am) {
 ?>
                                                <option name="nom_segmentation" value=" {{ $am->nom_segmentation }} ">
                                                    {{ $am->id_segmentation }} - {{ $am->nom_segmentation }}</option>
                                                <?php
  } ?>
                                            </select>								</div>
							</div>


							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-success" value="Save Changes">
                                    <a class="btn btn-primary" href="{{ route('segements') }}"> Back</a>
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
#pageSubmenu5{
visibility:visible;
display:block;
}
#pageSubmenu20{
    visibility:visible;
    display:block;
}
#M31{
background-color: #747474;
}
</style>
@endsection
