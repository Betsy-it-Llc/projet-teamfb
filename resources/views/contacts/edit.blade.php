@extends('layouts.navadmin')
@section('content')
<head>
<title>{{$con[0]->nom }} {{$con[0]->prenom}}</title>

<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/83/83969.png" />
</head>

<div class="container">
    <form action="{{ route('contacts.update',['contact'=>$con[0]->id_contact]) }}" method="POST">
        @csrf
        @method('PUT')
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
                    <center> <h1 style="margin-bottom:60px"> Modification de Contact</h1>
                    <img src="https://www.devopssec.fr/media/cache/avatar/images/default/empty_profile.jpg" style ="margin-left:25px;margin-bottom:30px; height:360px;width:360px;float:left;border-radius:200px;border:5px black solid" alt="Maxwell Admin">
                <h5><input type="file" id="avatar" name="avatar" value="{{old('avatar')}}" accept="image/png, image/jpeg" style="width:350px"></h5>
                </div> 
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:420px;margin-left:300px">
                <div class="card-body"style="margin-top:60px;margin-right:0px">
                    <div class="form-contact">
                            <input type="text" name="Nom" class="form-control"  placeholder="Entrer le nom" value="{{old('Nom') ?? $con[0]->nom}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="Prénom" class="form-control"  placeholder="Entrer le prénom" value="{{old('Prénom') ?? $con[0]->prenom}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="mail" class="form-control"  placeholder="Email" value="{{old('mail') ?? $con[0]->email}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="tel" class="form-control"  placeholder="Téléphone" value="{{old('tel') ?? $con[0]->tel}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="adress" class="form-control"  placeholder="Adresse" value="{{old('adress') ?? $con[0]->adresse}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="cp" class="form-control"  placeholder="Code postale" value="{{old('cp') ?? $con[0]->code_postal}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="ville" class="form-control"  placeholder="Ville" value="{{old('ville') ?? $con[0]->ville}}">
                    </div>
                    <div class="form-contact" style="margin-top:20px;">
                            <input type="text" name="url" class="form-control"  placeholder="URL dossier" value="{{old('url') ?? $con[0]->url_contact_folder}}">
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
                        @if (isset($org->type))
                            <input type="text" name="type" class="form-control"  placeholder="Type Contact" value="{{old('type') ?? $org->type}}">
                        @else
                            <input type="text" name="type" class="form-control" value="{{old('type')}}"  placeholder="Type Contact">
                        @endif
                    </div>
                    <div class="form-contact" style="margin-top:80px;">
                        <button class="btn btn-success" type="submit" style="margin-left:80px;margin-right:30px;background-color:#4968e5;border-color:#4968e5"> Modifier </button>
                        <a class="btn btn-danger" href="{{ route('contacts.index') }}"> Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@php
@endphp
<livewire:address-contact-form  :model="$modelContact"/>
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
        #pageSubmenu17{
        visibility:visible;
        display:block;
        }
        #pageSubmenu18{
        visibility:visible;
        display:block;
        }
        #M52{
        background-color: #747474;
        }
</style>
@endsection
