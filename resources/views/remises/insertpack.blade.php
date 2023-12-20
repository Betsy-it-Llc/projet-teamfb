@extends('layouts.navadmin')
@section('content')
<title>Modification Remise</title>
<div class="container">
    <form action="{{ route('remises.addpack') }}" method="post">
        @csrf
        <input type="hidden" id="id_remise" name="id_remise" value="{{ $rem->id_remise }}">
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
                    <center> <h1 style="margin-bottom:40px"> Ajout d'un pack à la Remise</h1>
                    <img src="https://t4.ftcdn.net/jpg/02/07/87/79/360_F_207877921_BtG6ZKAVvtLyc5GWpBNEIlIxsffTtWkv.jpg" style ="margin-left:65px;margin-bottom:10px; height:280px;width:280px;float:left;border-radius:10px;border:5px #888888 solid" alt="Maxwell Admin">
                <h5><input type="file" id="avatar" name="avatar" value="{{old('avatar')}}" accept="image/png, image/jpeg" style="width:350px;margin-top:40px"></h5>
                </div> 
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:420px;margin-left:300px">
                <div class="card-body"style="margin-right:0px">
                <div class="form-contact" style="margin-top:20px;">
            
                    <div class="form-contact" style="margin-top:20px">

                        <select name="id_pack" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                            <option value="">Choisissez un Pack </option>
                            @foreach ($nom_pack as $pack)
                            <option value="{{ $id_pack[$loop->index] }}" {{ old('id_pack') == $id_pack[$loop->index] ? "selected" : "" }}>{{ $pack }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                        <h6  style="color:black;margin-left:10px">Choisissez une version existante de la remise : </h6>
                        <select name="id_hist_rem" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                            <option value="">Aucune version</option>
                            @foreach ($hist_rem as $rem)
                            @isset($rem->taux)
                                <option value="{{ $rem->id_historique_remise }}" {{ old('id_hist_rem') == $rem->id_historique_remise ? "selected" : "" }}>{{ $rem->id_historique_remise }} {{''. $rem->taux .'%' }}</option>
                
                            @endisset
                            @isset($rem->montant)
                                <option value="{{ $rem->id_historique_remise }}" {{ old('id_hist_rem') == $rem->id_historique_remise ? "selected" : "" }}>{{ $rem->id_historique_remise }} {{''. $rem->montant .'€' }}</option>
                            @endisset
                            @endforeach
                        </select>                    
                    </div>
                    <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                        <h6 class="my_heading">Ou créer une nouvelle version de la remise : </h6>

                            <input type="text" name="taux" class="form-control"  placeholder="Taux" style="width:340px;float:left;margin-bottom:20px;margin-right:10px" value="{{old('taux')}}">
                            <a href=""><b style="font-size:2em;color:green">%</b></a>  
                    </div>
                    <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                            <input type="text" name="montant" class="form-control"  placeholder="Montant" value="{{old('montant')??$rem->montant}}" style="width:340px;float:left;margin-bottom:20px;margin-right:10px">
                            <a href=""><b style="font-size:2em;color:green">€</b></a>  
                    </div> 
                    
                    <div class="form-contact" style="margin-top:20px;">
                    <button class="btn btn-success" type="submit" style="margin-left:80px;margin-right:30px;background-color:#4968e5;border-color:#4968e5"> Modifier</button>
                    <a class="btn btn-danger" href="{{ route('remises.show',['id_remise'=>$rem->id_remise]) }}"> Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
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
#M92{
background-color: #747474;
}
</style>
@endsection
