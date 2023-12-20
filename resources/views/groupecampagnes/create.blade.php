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

    <form action="{{ route('groupecampagnes.store') }}" method="POST">
        @csrf

        <div class="row">
        <h2>Nouveau groupe</h2>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID compagne:</strong>
                     <select name="id_campagne"  class="form-control">
                        <?php
                        use Illuminate\Support\Facades\DB;
                        $req1 = DB::connection('mysql')->select('select id_campagne from campagnes ');
                        ?>
 <?php
foreach ($req1 as $re1 => $r1) {
 ?>
                                                    <option name="id_campagne" value=" {{ $r1->id_campagne }} "> {{ $r1->id_campagne }}</option>
<?php
  } ?>
                                                    </select>
                    {{--  <input type="text" name="id_campagne" class="form-control" placeholder="Enter l'ID">  --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_groupe:</strong>
                     <select name="id_groupe"  class="form-control">
                                                     <?php
                        $req1 = DB::connection('mysql')->select('select id_groupe from segment_groupe ');
                        ?>
 <?php
foreach ($req1 as $re1 => $r1) {
 ?>
                                                    <option name="id_groupe" value=" {{ $r1->id_groupe }} "> {{ $r1->id_groupe }}</option>
<?php


  } ?>
                                                    </select>
                    {{--  <input type="text" name="id_groupe" class="form-control" placeholder="Enter le nom">  --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>statut_publication:</strong>
                    <input type="text" name="statut_publication" class="form-control" placeholder="Enter le score">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>statut_recherche</strong>
                    <input type="text" name="statut_recherche" class="form-control" placeholder="Enter la date de début">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>traitement_publication:</strong>
                    <input type="text" name="traitement_publication" class="form-control" placeholder="Enter la date de fin">
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-primary" href="{{ route('groupecampagnes.index') }}"> Back</a>
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
