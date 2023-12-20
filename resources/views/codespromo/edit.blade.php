@extends('layouts.navadmin')
@section('content')
<title>Modification Code Promo</title>
<div class="container">
        <form action="{{ route('codespromo.update') }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" id="codepromo" name="codepromo" value="{{old("codepromo") ?? $codepromo }}">
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
        
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:420px;margin-left:350px">
                <div class="card-body"style="margin-right:0px;">
                <center> <h1 style="margin-bottom:40px"> Modification de Code Promo</h1>  
                <div class="form-contact" style="margin-bottom:20px;">
                <b style="font-size:1.2em;color:green"></b><br>
                <b style="font-size:1.2em;color:brown"></b><br>
                </div>
                <div style="float:left;margin-left:10px;margin-bottom:30px">
                    <a href=""><div style="margin-bottom:20px;border:4px solid black;background-color:#888888;width:50px;height:26px;float:left;border-radius:25px;">
                    <div  style="border:10px solid black;width:22px;height:12px;float:right ;border-radius:5px;"></div></a></div>
                    </div><b style="float:left;font-size:1.7em">{{ $remise->statut}}</b>
                  <div class="form-contact" style="margin-bottom:20px;">
                    <select name="id_remise" id="pet-select" style="background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                        @foreach ($remises as $rem)
                            @if ($code->id_remise==$rem->id_remise)
                            <option value="{{ $rem->id_remise }}"{{old('id_remise') == $rem->id_remise ? "selected" : ""}} > {{ $rem->id_remise }} - {{ $rem->nom_remise }}</option>
                            @else
                            <option value="{{ $rem->id_remise }}"{{old('id_remise') == $rem->id_remise ? "selected" : ""}}> {{ $rem->id_remise }} - {{ $rem->nom_remise }}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                    <div class="form-contact" style="margin-top:20px;">
                        <input type="text" name="code" class="form-control"  placeholder="Code" value="{{ old('code') ?? $code->code }}"style="width:385px;border:2px #888888  solid">
                    </div>
                    <div class="form-contact" style="margin-top:20px;">
                        <input type="text" name="nb_utilisation" class="form-control"  placeholder="Nb d'utilisation" value="{{ old('nb_utilisation') ?? $code->nb_utilisation }}" style="width:385px;border:2px #888888  solid;margin-bottom:50px">
                    </div>
                    <button type="submit" class="btn btn-info" >Modifier</button>
                    <a class="btn btn-danger" href="{{ route('codespromo.index') }}" style="margin-left:30px"> Annuler</a>
                
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
#M99{
background-color: #747474;
}
</style>
@endsection
