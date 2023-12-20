@extends('layouts.navadmin')
@section('content')
<head>
<title>{{$dbs[0]->nom_produit}}</title>

<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/83/83969.png" />
</head>
<div class="container">
    <form action="{{ route('produitservice.update',['produitservice'=>$produitservice]) }}" method="post">
        @csrf
        @method('put')
        @if($errors->any())
        <div class="notification is-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" style="margin-left:50px">
            <div class="card h-100" style="width:450px;margin-left:50px">
                <div class="card-body" style="height:400px;">
                    <center> <h1 style="margin-bottom:40px"> Modification Produit Service</h1>
                    <img src="https://t4.ftcdn.net/jpg/02/07/87/79/360_F_207877921_BtG6ZKAVvtLyc5GWpBNEIlIxsffTtWkv.jpg" style ="margin-left:65px;margin-bottom:10px; height:280px;width:280px;float:left;border-radius:10px;border:5px #888888 solid" alt="Maxwell Admin">
                <h5><input type="file" id="avatar" name="avatar" value="{{old('avatar')}}" accept="image/png, image/jpeg" style="width:350px"></h5>
                </div> 
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:420px;margin-left:300px">
                <div class="card-body"style="margin-right:0px">
                    <div class="form-contact" style="margin-top:20px;">
                    <div style="float:left;"><a href=""><div style="margin-bottom:20px;border:4px solid black;background-color:#888888;width:50px;height:26px;float:left;border-radius:25px;">
                    
                    <div  style="border:10px solid black;width:22px;height:12px;float:right ;border-radius:5px;"></div></a></div>
                    </div><b style="float:left;font-size:1.7em">{{$dbs[0]->statut}}</b>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="nom_produit" class="form-control"   placeholder="Nom" value="{{old('nom_produit')??$dbs[0]->nom_produit}}">
                    </div>
                    {{-- @dd($allPrices) --}}
                    
                    <div>
                        <select name="allpricesId" id="allPricesId">
                            @foreach($allPrices as $prices)
                            <option value="{{$prices->id_liste_prix}}">Id : {{$prices->id_liste_prix}} - Prix :{{$prices->prix}} - Statut : {{$prices->statut}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                        <input type="text" name="prix" class="form-control" placeholder="Prix" value="{{old('prix')}}" style="width:340px;float:left;margin-bottom:20px;margin-right:10px" id="prixInput">
                        <a href=""><b style="font-size:2em;color:green">€</b></a>
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                        <select name="statutPrix" id="pet-select" style="background-color:white;margin-bottom:20px;width:380px;height:35px;float:left;border-radius:4px;border-color:black">
                           @if($statutPrix->statut == 'Par Défaut')
                            <option value="Par Défaut" selected>Par Défaut</option>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                            @elseif(strtolower($statutPrix->statut)=='actif')
                            <option value="Par Défaut">Par Défaut</option>
                            <option value="Actif" selected>Actif</option>
                            <option value="Inactif">Inactif</option>
                            @elseif(strtolower($statutPrix->statut)=='inactif')
                            <option value="Par Défaut">Par Défaut</option>
                            <option value="Actif">Actif</option>
                            <option value="Inactif" selected>Inactif</option>
                            @else
                            <option value="Par Défaut">Par Défaut</option>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="abstract" class="form-control"   placeholder="Abstract" value="{{old('abstract')??$dbs[0]->abstract}}">
                    </div>
              
                    <div class="form-contact" style="margin-top:20px">
                        <h6 style="color:black;margin-left:10px">Categorie Produit</h6>
                    </div>
                    <div class="form-contact" style="margin-bottom:20px">
                    <select name="categorie" id="pet-select" style="background-color:white;margin-bottom:20px;width:380px;height:35px;float:left;border-radius:4px;border-color:black">
                        @if (strtolower($dbs[0]->categorie)=="produit")
                            <option value="">Aucune Categorie</option>
                            <option value="produit" selected>Produit</option>
                            <option value="experience">Experience</option>
                        @elseif (strtolower($dbs[0]->categorie)=="experience")
                            <option value="">Aucune Categorie</option>
                            <option value="produit">Produit</option>
                            <option value="experience" selected>Experience</option>
                        @else
                            <option value="" selected>Aucune Categorie</option>
                            <option value="produit">Produit</option>
                            <option value="experience" >Experience</option>
                        @endif
                        
                    </select>
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                        <h6 style="color:black; word-wrap:normal;">Statut<span style="color:red;">*</span></h6>
                    </div>
                    <div class="form-contact" style="margin-bottom:20px">
                        <select name="statut" id="pet-select" style="background-color:white;margin-bottom:20px;width:340px;height:35px;float:left;border-radius:4px;border-color:black">
                            <option value="actif" selected>Actif</option>
                            <option value="inactif">Inactif</option>
                            <option value="archivé" >Archivé</option>
                        </select>
                    </div>
                    <div class="form-contact" style="margin-top:20px" >
                    <h6 style="color:black;margin-left:10px">Description</h6>
                    </div>
                    <div class="form-contact" style="">
                        <!-- <input type="text" name="description" class="form-control" style="" placeholder="Description" value="{{old('description') ?? $dbs[0]->description}}"> -->
                        <textarea name="description" class="form-control" placeholder="Description" style="height:120px" cols="30" rows="5">{{old('description') ?? $dbs[0]->description}} </textarea>
                    </div>
                    <div class="form-contact" style="margin-top:20px;">
                    <button class="btn btn-success" type="submit" style="margin-left:80px;margin-right:30px;background-color:#4968e5;border-color:#4968e5">Modifier</button>
                    <a class="btn btn-danger" href="{{ route('produitservice.index') }}">Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var allPricesSelect = document.getElementById('allPricesId');
        var prixInput = document.getElementById('prixInput');

        allPricesSelect.addEventListener('change', function() {
            var selectedOption = allPricesSelect.options[allPricesSelect.selectedIndex];
            var idListePrix = selectedOption.value;
            var prixText = selectedOption.textContent.match(/Prix :(.*) -/)[1].trim();

            prixInput.value = prixText;
            prixInput.dataset.idListePrix = idListePrix;
        });
    });
</script>
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
    background: #DEDEDE;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}
.form-control{
   background-color:;
   border-radius:4px;
   border-color:black;
}

</style>
<style>
#pageSubmenu10{
    visibility:visible;
    display:block;
}
#pageSubmenu16{
    visibility:visible;
    display:block;
}
#pageSubmenu18{
    visibility:visible;
    display:block;
} 
#M53{
background-color: #747474;
}
</style>
@endsection
