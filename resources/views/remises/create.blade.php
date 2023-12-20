@extends('layouts.navadmin')
@section('content')
<title>Create Remise</title>
<div class="container">
    <form action="{{ route('remises.store') }}" method="post">
        @csrf
        @if($errors->any())
        <div class="notification is-danger  y_alerte">
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
                    <center> <h1 style="margin-bottom:40px"> Création de Remise</h1>
                    <img src="https://t4.ftcdn.net/jpg/02/07/87/79/360_F_207877921_BtG6ZKAVvtLyc5GWpBNEIlIxsffTtWkv.jpg" style ="margin-left:65px;margin-bottom:10px; height:280px;width:280px;float:left;border-radius:10px;border:5px #888888 solid" alt="Maxwell Admin">
                <h5><input type="file" id="avatar" name="avatar" value="{{old('avata')}}" accept="image/png, image/jpeg" style="width:350px;margin-top:40px"></h5>
                </div> 
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:420px;margin-left:300px">
                <div class="card-body"style="margin-right:0px">
                    <div class="form-contact" style="margin-top:20px;">
                    <div style="float:right;"><a href=""><div style="margin-bottom:20px;border:4px solid black;background-color:#888888;width:50px;height:26px;float:left ;border-radius:25px;">
        
                    <div  style="border:10px solid black;width:22px;height:12px;float:right ;border-radius:5px;"></div></a></div>
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="nom_remise" class="form-control" value="{{old('nom_remise')}}"  placeholder="Nom*">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="type_remise" class="form-control" value="{{old('type_remise')}}"  placeholder="Type">
                    </div>
                    <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                            <input type="text" name="taux" class="form-control" value="{{old('taux')}}"  placeholder="Taux*" style="width:340px;float:left;margin-bottom:20px;margin-right:10px">
                            <a href=""><b style="font-size:2em;color:green">%</b></a>  
                    </div>
                    <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                            <input type="text" name="montant" class="form-control" value="{{old('montant')}}"  placeholder="Montant*" style="width:340px;float:left;margin-bottom:20px;margin-right:10px">
                            <a href=""><b style="font-size:2em;color:green">€</b></a>  
                    </div> 
                    <div class="form-contact" style="margin-top:20px">
                    <h6 style="color:black;margin-left:10px">Date Début<span style="color:red;">*</span></h6>
                    </div>       
                    <div class="form-contact" style="margin-top:0px">
                    <input type="date" id="start" name="date_debut" value="{{old('date_debut')}}" style="width:380px;height:35px;float:right;border-radius:4px;border-color:black;margin-bottom:20px">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                    <h6 style="color:black;margin-left:10px">Date Fin<span style="color:red;">*</span></h6>
                    </div>       
                    <div class="form-contact" style="margin-top:0px">
                        <input type="date" id="end" name="date_fin" value="{{old('date_fin')}}" style="width:380px;height:35px;float:right;border-radius:4px;border-color:black;margin-bottom:20px">
                    </div>
                    <div>* ce champ est obligatoire</div>
                    <div class="form-contact" style="margin-top:20px;">
                        <button class="btn btn-success" type="submit" style="margin-left:80px;margin-right:30px;background-color:#4968e5;border-color:#4968e5"> Enregistrer</button>
                        <a class="btn btn-danger" href="{{ route('remises.index') }}"> Annuler</a>
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
   background-color:none;
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
