
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
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="https://flyclipart.com/thumb2/organizational-structure-organization-icon-with-png-and-vector-107927.png"
                                        alt="Maxwell Admin">
                                </div>
                                <h5 class="user-name">Nouveau segment</h5>
                                <h6 class="user-email">Date de création : <?php echo $date = date('d-m-y h:i:s'); ?></h6>
                            </div>
                            <div class="about">
                                <h5>Info</h5>
                                <p>En appuyant sur 'Ajouter', le groupe va ....</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="{{ route('segements.store') }}" method="POST">
                            @csrf

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h5 class="mb-2 text-primary">Information du segment</h5>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="id_segment"style="  color:red; font-style: italic;font-weight: bold;">ID
                                            Segment*(Auto-incrémenté)</label>
                                        <input type="text" name="id_segment" class="form-control"
                                            placeholder="ID segment">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="nom_segment">Nom</label>
                                        <input type="text" name="nom_segment" class="form-control"
                                            placeholder="Nom segment">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="theme">Thème</label>
                                        <select name="theme" id="theme" class="form-control">
                                            <option>Choisir un thème</option>
                                            <option value="Thème 1">Thème 1</option>
                                            <option value="Thème 2">Thème 2</option>
                                            <option value="Thème 3">Thème 3</option>
                                            <option value="Thème 4">Thème 4</option>
                                            <option value="Thème 5">Thème 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option>Choisir un type</option>
                                            <option value="Type 1">Type 1</option>
                                            <option value="Type 2">Type 2</option>
                                            <option value="Type 3">Type 3</option>
                                            <option value="Type 4">Type 4</option>
                                            <option value="Type 5">Type 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="caracteristique">Caractéristique</label>
                                        <input type="text" name="caracteristique" class="form-control"
                                            placeholder="Caractéristique">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <!-- <input type="text" name="description" class="form-control"
                                            placeholder="Description"> -->
                                            <textarea name="description" class="form-control" placeholder="Description" style=" white-space: pre-line; border:1px #cfd1d8  solid;"  rows="5"></textarea>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    {{-- <div class="form-group">
                            <label for="id_segmentation"style="  color:red; font-style: italic;font-weight: bold;">ID segmentation*(obligatoire)</label>
                            <input type="text" name="id_segmentation" class="form-control" placeholder="ID segmentation">
                        </div> --}}
                                    <div class="form-group">
                                        <label
                                            for="nom_segmentation"style="  color:red; font-style: italic;font-weight: bold;">ID
                                            segmentation*(obligatoire)</label>
                                        <div>
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
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="nb_groupe">Nombre de membres</label>
                                        <input type="text" name="nb_groupe" class="form-control"
                                            placeholder="Nombre de membres">
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a class="btn btn-secondary" href="{{ route('segementations') }}"> Back</a>
                                        </div>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <style>
        body {
            margin: 0;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
            width: 100%;
        }

        .account-settings .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }

        .account-settings .user-profile .user-avatar {
            margin: 0 0 1rem 0;
        }

        .account-settings .user-profile .user-avatar img {
            width: 90px;
            height: 90px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }

        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }

        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }

        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }

        .account-settings .about p {
            font-size: 0.825rem;
        }

        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
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
