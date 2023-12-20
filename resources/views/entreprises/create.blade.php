@extends('layouts.navadmin')
@section('content')
<title>Create Entreprise</title>
<div class="container">
    <form action="{{ route('entreprises.store') }}" method="post">
        @csrf
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
                <div class="card-body" style="height:600px;margin-bottom:-40px">
                    <center> <h1 style="margin-bottom:60px"> Création Contact Entreprise</h1>
                    <img src="https://us.123rf.com/450wm/alekseyvanin/alekseyvanin1704/alekseyvanin170401267/75474203-vecteur-d-ic%C3%B4ne-d-usine-illustration-de-logo-solide-de-l-industrie-pictogramme-isol%C3%A9-sur-blanc.jpg" style ="margin-left:25px;margin-bottom:30px; height:360px;width:360px;float:left;border-radius:200px;border:5px black solid" alt="Maxwell Admin">
                <h5><input type="file" id="avatar" name="avatar" value="{{old('avatar')}}" accept="image/png, image/jpeg" style="width:350px"></h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:420px;margin-left:300px">
                <div class="card-body"style="margin-top:60px;margin-right:0px">
                    <div class="form-contact">
                            <input type="text" name="Nom" class="form-control" value="{{old('Nom')}}"  placeholder="Nom*">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="mail" class="form-control" value="{{old('mail')}}"  placeholder="Email*">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="tel" class="form-control" value="{{old('tel')}}"  placeholder="Téléphone*">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="adress" class="form-control" value="{{old('adress')}}"  placeholder="Adresse">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="cp" class="form-control" value="{{old('cp')}}"  placeholder="Code postale">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="ville" class="form-control" value="{{old('ville')}}"  placeholder="Ville">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="num_cse" class="form-control" value="{{old('nom_cse')}}"  placeholder="Num CSE*">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                    <h6 style="color:black;margin-left:10px">Description</h6>
                    </div>
                    <div class="form-contact" style="">
                        <!-- <input type="text" name="description" class="form-control" style="height:120px"> -->
                        <textarea name="description" class="form-control" style="height:120px" cols="30" rows="5"></textarea>
                    </div>
                    <div>* ce champ est obligatoire</div>
                    <div class="form-contact" style="margin-top:30px;">
                    <button class="btn btn-success" type="submit" style="margin-left:80px;margin-right:30px;background-color:#4968e5;border-color:#4968e5"> Enregistrer</button>
                    <a class="btn btn-danger" href="{{ route('entreprises.index') }}"> Annuler</a>
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
    background:#DEDEDE; 
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
        #pageSubmenu17{
        visibility:visible;
        display:block;
        }
        #pageSubmenu18{
        visibility:visible;
        display:block;
        }
        #M91{
        background-color: #747474;
        }
</style>
@endsection
