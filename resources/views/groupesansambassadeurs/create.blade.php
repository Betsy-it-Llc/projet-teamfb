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
                        <h5 class="user-name">Groupe facebook</h5>
                        <h6 class="user-email">Date de création : <?php echo $date = date('d-m-y h:i:s');?></h6>
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
            <form action="{{ route('groupesansambassadeurs.store') }}" method="POST">
            @csrf

                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 class="mb-2 text-primary">Information du groupe sans ambassadeur</h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="fullName">ID Groupe</label>
                            <input type="text" name="id_groupe" class="form-control" placeholder="Enter ID">
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
                            <label for="personalisation">Personalisation</label>
                            <input type="text" name="personalisation" class="form-control" placeholder="Personalisation">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="url_a_propos">URL</label>
                            <input type="text" name="url_a_propos" class="form-control" placeholder="URL à propos">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="url_a_propos">Nombre de membres</label>
                            <input type="number" name="nb_membres" class="form-control" placeholder="Enter le nombre de memebres">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="url_a_propos">Thème</label>
                            <input type="text" name="theme" class="form-control" placeholder="Entrer un thème">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="url_a_propos">Type</label>
                            <select name="type" id="pet-select" class="form-control">
                                <option value="">--Please choose an option--</option>
                                <option value="Privé">Privé</option>
                                <option value="Public">Public</option>
                            </select>				
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="url_a_propos">Réglementation </label>
                            <input type="text" name="reglementation" class="form-control" placeholder="Réglementation">
                        </div>
                    </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 class="mt-3 mb-2 text-primary">Plus</h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="frequence_post_mois">Fréquence de post par mois</label>
                            <input type="text" name="frequence_post_mois" class="form-control" placeholder="Fréquence de postes par mois">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="format_groupe">Format groupe</label>
                            <input type="text" name="format_groupe" class="form-control" placeholder="Enter les tag de recherche">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="lieu">Lieu</label>
                            <input type="text" name="lieu" class="form-control" placeholder="Enter les tag de recherche">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="actif_supprime">Actif / supprimé</label>
                            <select name="actif_supprime" id="pet-select" class="form-control">
                                <option value="">--Please choose an option--</option>
                                <option value="Actif">Actif</option>
                                <option value="Supprimé">Supprimé</option>

                            </select>				
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="statut_releve">Statut relevé</label>
                            <input type="text" name="statut_releve" class="form-control" placeholder="Choisir le statut">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="date_releve">Date relevé</label>
                            <input type="date" name="date_releve" class="form-control" placeholder="Choisir une date">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="statut_integration">Statut d'intégration</label>
                            <select name="statut_integration" id="pet-select" class="form-control">
                                <option value="">--Please choose an option--</option>
                                <option value="Nouveau groupe">Nouveau groupe</option>
                                <option value="Nouveau membre">Nouveau membre</option>
                                <option value="Adhésion demandée">Adhésion demandée</option>
                                <option value="Hors cible">Hors cible</option>
                            </select>				
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="tag_recherche">Tag recherché</label>
                            <input type="text" name="tag_recherche" class="form-control" placeholder="Enter les tag de recherche">
                        </div>
                    </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a class="btn btn-secondary" href="{{ route('groupesansambassadeurs') }}"> Back</a>
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
    width : 100%;
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
#pageSubmenu{
visibility:visible;
display:block;
}
</style>
@endsection