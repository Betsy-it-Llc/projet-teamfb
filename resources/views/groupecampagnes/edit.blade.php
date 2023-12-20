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

    <form action="{{ route('groupecampagnes.update',$groupecampagne->id_campagne) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
         <h2>Edit Groupe campagne</h2>
         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID compagne:</strong>
                    <input type="text" name="id_campagne" value="{{ $groupecampagne->id_campagne }}" class="form-control" placeholder="Enter l'ID">
                </div>
            </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="nom" value="{{ $groupecampagne->nom }}" class="form-control" placeholder="Enter le nom">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Score:</strong>
                    <input type="text" name="score" value="{{ $groupecampagne->score }}" class="form-control" placeholder="Enter le score">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date de début:</strong>
                    <input type="date" name="datedebut" value="{{ $groupecampagne->date_debut }}" class="form-control" placeholder="Enter la date de début">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date de fin:</strong>
                    <input type="date" name="datefin" value="{{ $groupecampagne->date_fin }}" class="form-control" placeholder="Enter la date de fin">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contenu:</strong>
                    <input type="text" name="contenue" value="{{ $groupecampagne->contenu_post_mere }}" class="form-control" placeholder="Enter le contenu">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Objectifs:</strong>
                    <input type="text" name="objectifs" value="{{ $groupecampagne->objectifs }}" class="form-control" placeholder="Enter les objectifs">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contexte:</strong>
                    <input type="text" name="contexte" value="{{ $groupecampagne->contexte }}" class="form-control" placeholder="Enter le contexte">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date de programmation:</strong>
                    <input type="date" name="dateprg" value="{{ $groupecampagne->date_programmation }}" class="form-control" placeholder="Enter la date de programmation">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Bilan:</strong>
                    <input type="text" name="bilan" value="{{ $groupecampagne->bilan }}" class="form-control" placeholder="Enter le nom">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Recommendation:</strong>
                    <input type="text" name="recommandation" value="{{ $groupecampagne->recommandation }}" class="form-control" placeholder="Enter des recommendations">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre de j'aime :</strong>
                    <input type="number" name="nbrlike" value="{{ $groupecampagne->nb_likes }}" class="form-control" placeholder="Enter le nombre des j'aimes">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre de commentaires:</strong>
                    <input type="number" name="nbrcmts" value="{{ $groupecampagne->nb_comments }}" class="form-control" placeholder="Enter le nombre des commentaires">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombres de partages:</strong>
                    <input type="text" name="nbrsahre" value="{{ $groupecampagne->nb_shares }}" class="form-control" placeholder="Enter le nombre de partages">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Porte:</strong>
                    <input type="text" name="porte" value="{{ $groupecampagne->portee }}" class="form-control" placeholder="Enter les portes">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID segmentation:</strong>
                    <input type="number" name="id_segmentation" value="{{ $groupecampagne->id_segmentation }}" class="form-control" placeholder="Enter l'ID de segmentation">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('groupecampagnes.index') }}"> Back</a>
            </div>
    </form>
    <style>
#pageSubmenu{
visibility:visible;
display:block;
}
</style>
@endsection
