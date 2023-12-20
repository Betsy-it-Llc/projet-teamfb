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
        <h2 style="margin-bottom:30px">Edit Segmentation</h2>
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://flyclipart.com/thumb2/organizational-structure-organization-icon-with-png-and-vector-107927.png"
                                    alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h6> {{ $segementation->nom }}</h6>
                                    <p class="text-muted font-size-sm">ID segementation :
                                        {{ $segementation->id_segmentation }}</p>
                                    <a href="{{ route('segementations.show', $segementation->id_segmentation) }}"><button
                                            class="btn btn-outline-primary">More info</button></a>
                                </div>
                            </div>
                            <hr class="my-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Nom : </h6>
                                    <span class="text-secondary">{{ $segementation->nom_segmentation }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Critères :</h6>
                                    <span class="text-secondary">{{ $segementation->criteres }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <form action="{{ route('segementations.update', $segementation->id_segmentation) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">ID Segmentation</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="id_segmentation"
                                            value="{{ $segementation->id_segmentation }}" class="form-control"
                                            placeholder="Nom">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nom</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="nom_segmentation"
                                            value="{{ $segementation->nom_segmentation }}" class="form-control"
                                            placeholder="Nom">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">criteres</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="criteres" value="{{ $segementation->criteres }}"
                                            class="form-control" placeholder="Enter la description">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Groupe</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="nb_groupe" value="{{ $segementation->nb_groupe }}"
                                            class="form-control" placeholder="Enter la description">
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Description</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <!-- <input type="text" name="description" value="{{ $segementation->description }}"
                                            class="form-control" placeholder="Enter la description"> -->
                                            <textarea name="description" class="form-control" placeholder="Enter la description" style=" white-space: pre-line; border:1px #cfd1d8  solid;"  rows="5">{{ $segementation->description }}</textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-success" value="Save Changes">
                                        <a class="btn btn-primary" href="{{ route('segementations') }}"> Back</a>
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
        body {
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
#M30{
background-color: #747474;
}
</style>
@endsection
