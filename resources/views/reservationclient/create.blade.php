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
                            </div>
                            <h5 class="user-name">Réservation</h5>
                            <h6 class="user-email">Date de création : <?php //echo $date = date('d-m-y h:i:s');
                                                                        ?></h6>
                        </div>
                        <div class="about">
                            <h5>Info</h5>
                            <p>En appuyant sur 'Ajouter', la reservation va ....</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <form action="{{ route('reservationclient.store') }}" method="POST">
                        @csrf

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h5 class="mb-2 text-primary">Information de la reservation</h5>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nom" style="  color:red; font-style: italic;font-weight: bold;">Nom*(obligatoire)</label>
                                    <input type="text" name="nom" class="form-control" value="{{old('nom')}}" placeholder="Enter le nom">
                                </div>
                            </div>
                            <?php

                            use Illuminate\Support\Facades\DB;

                            $produits = DB::connection('mysql2')->select('SELECT Id_produit, nom_produit FROM produits_services');

                            ?>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="experience">Experience</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">Choississez une experience</option>
                                        <?php
                                        for ($i = 0; $i < count($produits); $i++) {
                                            if ($i < count($produits)) {
                                        ?>
                                                <option value="{{$produits[$i]->Id_produit}}" >{{$produits[$i]->nom_produit}}</option>
                                        <?php
                                            } else {
                                                echo `<option value=""></option>`;
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="prenom">Prenom</label>
                                    <input type="text" name="prenom" value="{{old('prenom')}}" class="form-control" placeholder="Prenom">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nb_chanson">Nombre de titre</label>
                                    <input type="text" name="nb_chanson" value="{{old('nb_chanson')}}" class="form-control" placeholder="Enter nombre de titre">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="tel">Tel</label>
                                    <input type="text" name="tel" value="{{old('tel')}}" class="form-control" placeholder="Tel">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nb_experimentateur">Nombre de participant</label>
                                    <input type="text" name="nb_experimentateur" value="{{old('nb_experimentateur')}}" class="form-control" placeholder="Enter nombre de participant">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="bon_cadeau">Bon cadeau</label>
                                    <input type="checkbox" id="oui" name="bon_cadeau" value="oui" class="form-control" placeholder="oui">
                                    <label for="oui">oui</label>
                                    <input type="checkbox" id="non" name="bon_cadeau" value="non" class="form-control" placeholder="non">
                                    <label for="non">non</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="adresse" value="{{old('adresse')}}" class="form-control" placeholder="Enter adresse">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Message</label>
                                    <input type="text" name="description" value="{{old('description')}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ville">Ville</label>
                                    <input type="text" name="ville" value="{{old('ville')}}" class="form-control" placeholder="Enter ville">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="code_postale">Code_Postale</label>
                                    <input type="text" name="code_postale" value="{{old('code_postale')}}" class="form-control" placeholder="Enter code_postale">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <a class="btn btn-secondary" href="{{ route('reservationclient.index') }}">Annuler</a>
                                    <button type="submit" class="btn btn-success">Ajouter</button>
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
#M49{
background-color: #747474;
}
</style>
@endsection