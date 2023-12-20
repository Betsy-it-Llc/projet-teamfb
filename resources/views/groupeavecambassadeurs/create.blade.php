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
   
    <form action="{{ route('groupeavecambassadeurs.store') }}" method="POST">
        @csrf
    
        <div class="row">
        <h2>New groupe</h2>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID groupe :</strong>
                    <input type="text" name="id_groupe" class="form-control" placeholder="Enter ID">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="nom" class="form-control" placeholder="Enter le nom">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Personalisation:</strong>
                    <input type="text" name="personnalisation" class="form-control" placeholder="Personalisation">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre de membres:</strong>
                    <input type="number" name="nb_membres" class="form-control" placeholder="Enter le nombre de memebres">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Thème</strong>
                    <input type="text" name="theme" class="form-control" placeholder="Entrer un thème">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type:</strong><br>
                    <select name="type" id="pet-select" class="form-control">
                        <option value="">--Please choose an option--</option>
                        <option value="Privé">Privé</option>
                        <option value="Public">Public</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Réglementation</strong>
                    <input type="text" name="reglementation" class="form-control" placeholder="Réglementation">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>URL à propos:</strong>
                    <input type="number" name="url_a_propos" class="form-control" placeholder="URL à propos">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fréquence de post par mois:</strong>
                    <input type="text" name="frequence_post_mois" class="form-control" placeholder="Fréquence de postes par mois">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Format groupe:</strong>
                    <input type="text" name="format_groupe" class="form-control" placeholder="Enter les tag de recherche">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lieu:</strong>
                    <input type="text" name="lieu" class="form-control" placeholder="Enter les tag de recherche">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Actif / supprimé:</strong>
                    <input type="text" name="actif_supprime" class="form-control" placeholder="Choisir ..">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Statut relevé:</strong>
                    <input type="text" name="statut_releve" class="form-control" placeholder="Choisir le statut">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date relevé:</strong>
                    <input type="date" name="date_releve" class="form-control" placeholder="Choisir une date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Statut d'intégration:</strong>
                    <select name="statut_integration" id="pet-select" class="form-control">
                        <option value="">--Please choose an option--</option>
                        <option value="Nouveau groupe">Nouveau groupe</option>
                        <option value="Nouveau membre">Nouveau membre</option>
                        <option value="Adhésion demandée">Adhésion demandée</option>
                        <option value="Hors cible">Hors cible</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tag de recherche:</strong>
                    <input type="text" name="tag_recherche" class="form-control" placeholder="Enter les tag de recherche">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Ambassadeur:</strong>
                    <input type="text" name="id_ambassadeur" class="form-control" placeholder="Enter ID">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ambassadeur:</strong>
                    <input type="text" name="nom_ambassadeur" class="form-control" placeholder="Enter nom">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-primary" href="{{ route('groupeavecambassadeurs') }}"> Back</a>
            </div>
        </div>
    
    </form>
    <style>
#pageSubmenu{
visibility:visible;
display:block;
}
</style>
@endsection