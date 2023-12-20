@extends('layouts.navadmin')

@section('content')
<div class="row" style="margin-top: 1rem;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <?php
            use Illuminate\Support\Facades\DB;
            use Illuminate\Http\Request;
            use Illuminate\Support\Arr;


            ?>
            <h4>Groupe de la campagne {{ $nom_campagne[0]->nom }}</h4>
            <span>Nombres de groupes : {{ $nbre2 }}</span>
            <br>
        </div>
        <div class="form-row" style="margin : 10px">
            <div class="col">
                <select name="cpgrps" class="form-control">
                    <option selected>Choisir un statut</option>
                    @foreach ($cpgrps as $cpgrp)
                    <option value="{{ $cpgrp->statut_publication }}">{{ $cpgrp->statut_publication }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn btn-outline-primary" style="background: #17a2b8 ; border : #FFF"><i style="color : #fff " class="fas fa-search"></i></button>
        </div>
        <form method="POST" action="{{ route('recup',['ids'=>$ids]) }}">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="control-label">Nom segment</label>
                <div>
                    <select name="id_segment" class="form-control">
                        <?php
                        $req1 = DB::connection('mysql')->select("SELECT id_segment, nom_segment FROM `segements` ");
                        foreach ($req1 as $re1 => $r1) { ?>
                            <option name="id_segment" value="{{ $r1->id_segment }}"> {{ $r1->id_segment }}
                                {{ $r1->nom_segment }}
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="AjoutSegment">Ajouter</button>
                <a class="btn btn-primary" href="{{ route('groupecampagnes.index',['id_campagne'=>$ids]) }}"> Back</a>
            </div>
        </form>
    </div>
    <div class="pull-right" style="margin : 10px">
        <a class="btn btn-info" href="{{ route('campagnes.index') }}"> Retour</a>
    </div>
    <br>
</div>
</div>
<br><br>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="table conteneur">
    <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
    <table class="table table-bordered data-table">
        <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col">N</th>
                <th scope="col">ID camp</th>
                <th scope="col">Nom groupe</th>
                <th scope="col">Statut publication</th>
                <th scope="col">URL</th>
                <th scope="col">segments</th>
                <th width="150px"></th>
            </tr>
        </thead>
        <?php
        // Initialisez votre tableau associatif
        $groupes_segments = array();
        $groupes_infos = array();

        // Parcourez votre tableau $groupecampagnes
        foreach ($groupecampagnes as $groupe) {
            // Vérifiez si le groupe existe déjà dans votre tableau associatif
            if (array_key_exists($groupe->nom, $groupes_segments)) {
                // Si le groupe existe déjà, ajoutez l'id_segment au groupe existant
                $groupes_segments[$groupe->nom] .= ', ' . $groupe->id_segment;
            } else {
                // Si le groupe n'existe pas, ajoutez le groupe et son id_segment au tableau associatif
                $groupes_segments[$groupe->nom] = $groupe->id_segment;

                // Ajoutez les informations supplémentaires que vous souhaitez afficher pour ce groupe dans le tableau associatif $groupes_infos
                $groupes_infos[$groupe->nom] = array(
                    'statut_publication' => $groupe->statut_publication,
                    'id_groupe' => $groupe->id_groupe,
                    'id_campagne' => $groupe->id_campagne,
                    'id' => $groupe->id
                );
            }
        }
        ?>

        @foreach ($groupes_segments as $nom_groupe => $id_segment)
        <?php $infos = $groupes_infos[$nom_groupe]; ?>
        <tr>
            <td scope="row" name="ligne">{{ $loop->index + 1 }}</td>
            <td>{{ $infos['id_campagne'] }}</td>
            <td>{{ $nom_groupe }}</td>

            <?php
            $tab = ["No seg 2", "NULL", "En attente", "Blacklist", "Blacklist Doute", "non trouvé", "posté", "non posté", "select"];

            if ($infos['statut_publication'] === "NULL") {
                $select = Arr::except($tab, [1]);
            } elseif ($infos['statut_publication'] === "No seg 2") {
                $select = Arr::except($tab, [0]);
            } elseif ($infos['statut_publication'] === "En attente") {
                $select = Arr::except($tab, [2]);
            } elseif ($infos['statut_publication'] === "Blacklist") {
                $select = Arr::except($tab, [3]);
            } elseif ($infos['statut_publication'] === "Blacklist Doute") {
                $select = Arr::except($tab, [4]);
            } elseif ($infos['statut_publication'] === "non trouvé") {
                $select = Arr::except($tab, [5]);
            } elseif ($infos['statut_publication'] === "posté") {
                $select = Arr::except($tab, [6]);
            } elseif ($infos['statut_publication'] === "non posté") {
                $select = Arr::except($tab, [7]);
            } elseif ($infos['statut_publication'] === "select") {
                $select = Arr::except($tab, [8]);
            } else {
                // Si aucune des conditions précédentes n'est remplie,
                // définir $select avec le tableau complet
                $select = $tab;
            }
            ?>
            <td>
                <form id="ajaxform" action=" {{ route('ajaxupdate',['ids'=>$ids]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_campagne" value="<?php echo $infos['id_campagne']; ?>">
                    <input type="hidden" name="id_groupe" value="<?php echo $infos['id_groupe']; ?>">
                    <select name="statut_publication">
                        <option value="<?php echo $infos['statut_publication']; ?>"><?php echo $infos['statut_publication']; ?></option>
                        <?php foreach ($select as $st) : ?>
                            <option value="<?php echo $st; ?>"><?php echo $st; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-success save-data" type="submit">Enregistrer</button>
                </form> 
            </td>
            <td id="url"><a href="{{ $infos['id_groupe'] }}">{{ $infos['id_groupe'] }}</a></td>
            <td>{{ $id_segment }}</td>
            <td style="width : 600px; margin:auto">
                <form action="{{ route('groupecampagnes.destroy', $infos['id_campagne']) }}" method="POST" style="float:left">
                    <a style="float: left; background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('groupecampagnes.show', $infos['id_campagne']) }}"><i style="color : black" class="fas fa-eye"></i></a>
                    <a style="float: left; background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('groupecampagnes.edit', $infos['id_campagne']) }}"><i style="color : black" class="fas fa-edit"></i></a>
                    @csrf
                    @method('DELETE')
                    <!--<a style="float: left; background-color : #fafafa ; border : #fafafa" class="btn btn-danger" href="{{ route('groupe.delete', $id_campagne) }}"><i style="color : black" class="fas fa-trash"></i></a>-->
                    <a style="float: left; background-color : #fafafa ; border : #fafafa" class="btn btn-danger" href="{{ route('groupe.delete', ['id'=> $infos['id'], 'id_campagne'=> $infos['id_campagne']]) }}"><i style="color : black" class="fas fa-trash"></i></a>
                    <a style="float: left; background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('groupecampagnes.show', $infos['id_campagne']) }}"><i style="color : black" class="fas fa-info"></i></a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<script>
    import axios from 'axios';
    window.axios = axios;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".save-data").click(function(event) {
        event.preventDefault();

        let id_campagne = $("input[name=id_campagne]").val();
        let name = $("input[name=name]").val();
        let statut_publication = $("input[name=statut_publication]").val();
        let id_groupe = $("input[name=id_groupe]").val();
        let id_segment = $("input[name=id_segment]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/ajaxupdate",
            type: "POST",
            data: {
                id_campagne: id_campagne,
                name: name,
                statut_publication: statut_publication,
                id_groupe: id_groupe,
                id_segment: id_segment,
                _token: _token
            },
            success: function(response) {
                console.log(response);
                if (response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
        });
    });
</script>
{{-- {!! $groupecampagnes->links() !!} --}}
<style>
#pageSubmenu{
visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
</style>
@endsection
