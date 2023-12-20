
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
                                <img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Maxwell Admin">
                            </div>
                            <h5 class="user-name">Campagne facebook</h5>
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
                    <form action="{{ route('campagnes.store') }}" method="POST">
                        @csrf

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h5 class="mb-2 text-primary">Information de la campagne</h5>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="id_campagne" style="  color:red; font-style: italic;font-weight: bold;">ID
                                        Campagne*(Auto-incrémenté)</label>
                                    <input type="text" name="id_campagne" class="form-control" placeholder="Enter ID">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" class="form-control" placeholder="Enter le nom">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="url_a_propos">Date de début</label>
                                    {{-- <input type="hidden" name="date_debut" >  --}}
                                    <input type="date" id="theDate" name="date_debut" class="form-control" value="date d'aujourd'hui en PHP" placeholder="Date de début">

                                    {{-- <input type="date" id="theDate"name="date_debut" class="form-control" placeholder="Date de début"> --}}
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="date_fin">Date de fin</label>
                                    <input type="number" name="date_fin" class="form-control" placeholder="Date de fin">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="contexte">Contexte</label>
                                    <input type="text" name="contexte" class="form-control" placeholder="Contexte">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="url_a_propos">Etat</label>
                                    <select name="etat" id="pet-select" class="form-control">
                                        <option value="">--Please choose an option--</option>
                                        <option value="Idée">Idée</option>
                                        <option value="Terminée">Terminée</option>
                                        <option value="Planifiée">Planifiée</option>
                                        <option value="Archivée">Archivée</option>
                                        <option value="En cours">En cours</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="objectifs">Objectifs</label>
                                    <input type="text" name="objectifs" class="form-control" placeholder="Objectifs">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="date_programmation">Date programmation</label>
                                    <input type="text" name="date_programmation" class="form-control" placeholder="Date programmation">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="recommandation">Recommandation</label>
                                    <input type="text" name="recommandation" class="form-control" placeholder="Recommandation">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="contenu_post_mere">Contenu post mere </label>
                                    <input type="text" name="contenu_post_mere" class="form-control" placeholder="Contenu post mere">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            {{-- <div class="form-group">
                            <label for="id_segmentation"style="  color:red; font-style: italic;font-weight: bold;">ID segmentation*(obligatoire)</label>
                            <input type="text" name="id_segmentation" class="form-control" placeholder="ID segmentation">
                        </div> --}}
                            <div class="form-group">
                                <label for="id_segmentation">ID
                                    segmentation</label>
                                <div>
                                    <select name="id_segmentation" class="form-control">
                                        <?php
                                        use Illuminate\Support\Facades\DB;
                                        $ambs = DB::connection('mysql')->select('select id_segmentation ,nom_segmentation  from segementations  ');

                                        foreach ($ambs as $amb => $am) {
                                        ?>
                                            <option name="id_segmentation" value=" {{ $am->id_segmentation }} ">
                                                {{ $am->id_segmentation }} - {{ $am->nom_segmentation }}
                                            </option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a class="btn btn-secondary" href="{{ route('campagnes.index') }}"> Back</a>
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
{{-- <script type="text/javascript">
function SetDate()
{
var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;


document.getElementById('theDate').value = today;
$("#startDate").val($.datepicker.formatDate("dd/mm/yy", new Date()));
$("#endDate").val($.datepicker.formatDate("dd/mm/yy", new Date()));
}
</script> --}}
<style>
#pageSubmenu{
visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M9{
background-color: #747474;
}
</style>
@endsection