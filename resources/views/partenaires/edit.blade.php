@extends('layouts.navadmin')
@section('content')
<head>
<title>{{$con->nom}}{{$con->prenom}}</title>

<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/83/83969.png" />
</head>
<div class="container">
    <form action="{{ route('partenaires.update') }}" method="post">
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
                <div class="card-body" style="height:600px;margin-bottom:-40px">
                    <center> <h1 style="margin-bottom:60px"> Modification partenaire</h1>
                    <img src="https://www.devopssec.fr/media/cache/avatar/images/default/empty_profile.jpg" style ="margin-left:25px;margin-bottom:30px; height:360px;width:360px;float:left;border-radius:200px;border:5px black solid" alt="Maxwell Admin">
                <h5><input type="file" id="avatar" name="avatar" value="{{old('avatar')}}" accept="image/png, image/jpeg" style="width:350px"></h5>
                </div> 
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:420px;margin-left:300px">
                <div class="card-body"style="margin-top:60px;margin-right:0px">
                    <div class="form-contact" style="margin-top:20px">
                        <h6 style="color:black;margin-left:10px">ID Contact</h6>
                    </div>
                    <div class="form-contact" style="margin-bottom:20px">
                    <select name="id_cnt" id="pet-select" style="background-color:white;margin-bottom:20px;width:380px;height:35px;float:left;border-radius:4px;border-color:black">
                        <option value="{{ $con->id_contact }}"{{old('id_cnt') == $con->id_contact ? "selected" : ""}}>{{$con->id_contact}}</option>
                    </select>
                    </div>
                    @php
                        /*
                             <div class="form-contact" style="margin-top:20px">
                    <select name="role" id="pet-select" style="background-color:white;margin-bottom:20px;width:340px;height:35px;float:left;border-radius:4px;border-color:black">
                        <option >Fonction</option>
                        <option value="mix">Mixeur</option>
                        <option value="mont">Monatge</option>
                        <option value="photo">Photographer</option>
                        <option value="ingen">Ingenieur </option>
                    </select>  
                    <a href=""><img style="margin-left:7px;margin-top:5px;height:30px;border-radius:4px" src="data:image/png;base64,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"></a>  
                    </div>  
                        */
                    @endphp
                    <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="fonction" class="form-control"  placeholder="Fonction" value="{{old('fonction') ?? $con->fonction}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="Nom" class="form-control"  placeholder="Nom" value="{{old('Nom') ?? $con->nom}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="Prénom" class="form-control"  placeholder="Prénom" value="{{old('Prénom') ?? $con->prenom}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="mail" class="form-control"  placeholder="Email" value="{{old('mail') ?? $con->email}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="tel" class="form-control"  placeholder="Téléphone" value="{{old('tel') ?? $con->tel}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="adress" class="form-control"  placeholder="Adresse" value="{{old('adress') ?? $con->adresse}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="cp" class="form-control"  placeholder="Code postale" value="{{old('cp') ?? $con->code_postal}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="ville" class="form-control"  placeholder="Ville" value="{{old('ville') ?? $con->ville}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                        <label for="pet-select">Entreprise</label>
                    <select name="entreprise" id="pet-select" style="margin-bottom:20px;width:380px;height:35px;float:left;border-radius:4px;border-color:black">
                        @if (isset($org->id_organisation))
                            <option value="" >Aucune</option>
                            @foreach ($nom_org as $nom)
                            @if ($id_org[$loop->index]==$org->id_organisation)
                                <option value="{{ $id_org[$loop->index] }}"{{old('entreprise') == $id_org[$loop->index] ? "selected" : ""}}>{{ $nom }}</option>
                            @else
                                <option value="{{ $id_org[$loop->index] }}"{{old('entreprise') == $id_org[$loop->index] ? "selected" : ""}}>{{ $nom }}</option>
                            @endif
                            @endforeach
                        @else
                            <option value="" selected>Aucune</option>
                            @foreach ($nom_org as $nom)
                                <option value="{{ $id_org[$loop->index] }}"{{old('entreprise') == $id_org[$loop->index] ? "selected" : ""}}>{{ $nom }}</option>
                            @endforeach
                        @endif
                        
                        
                    </select>                    
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="type" class="form-control"  placeholder="type" value="{{old('type') ?? $con->type}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px;">
                    <button class="btn btn-success" type="submit" style="margin-left:80px;margin-right:30px;background-color:#4968e5;border-color:#4968e5"> Modifier</button>
                    <a class="btn btn-danger" href="{{ route('partenaires.index') }}"> Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<livewire:address-contact-form :model="$modelContact"/>
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
        #pageSubmenu17{
        visibility:visible;
        display:block;
        }
        #pageSubmenu18{
        visibility:visible;
        display:block;
        }
        #M93{
        background-color: #747474;
        }
</style>
@endsection
