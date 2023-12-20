@extends('layouts.navadmin')
@section('content')
<title>Create Facture</title>
<center> <h1 style="margin-bottom:60px"> Création Facture</h1>
<div style="float: left;margin-left:40px;margin-bottom:10px" class="open-btn" >
<button class="open-button" onclick="openClt()" style="border-radius:10px"><center><img style="margin-top:px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"><b style="color:black;font-size:1.5em">Ajouter Client</b></button>
</div>
<div style="float: center;margin-bottom:10px" class="open-btn" >
<button class="open-button" onclick="openFac()" style="border-radius:10px;margin-left:-250px"><center><img style="margin-top:px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"><b style="color:black;font-size:1.5em">Ajouter Article</b></button>
</div>
<div style="float: right;margin-top:-46px;" class="open-btn" >
<button class="open-button" onclick="openPay()" style="border-radius:10px;margin-left:-310px"><center><b style="color:black;font-size:1.5em">Echéance Paiement</b></button>
</div>
<div class="container">
    <form action={{ route('facture.store') }} method="post">
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
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" style="margin-left:0px">
            <div class="card h-100" style="width:390px;margin-left:0px">
                <div class="card-body" style="height:600px;margin-bottom:-40px">
                <h3 style="text-align:start">Info Client</h3>

                    
              
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" style="margin-left:0px">
            <div class="card h-100" style="width:390px;margin-left:140px">
                <div class="card-body" style="margin-bottom:-40px">
                <h3 style="text-align:start">Info Facture</h3>
                <h6 style="text-align:start">Description</h6>
                <textarea name="description" id="description" value="{{old('description')}}" cols="30" rows="10">

                </textarea>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
            <div class="card h-100" style="width:390px;margin-left:280px">
                <div class="card-body" style="margin-bottom:-40px">
                <h3 style="text-align:start">Info Paiement </h3>
                <br>
                <h4 style="text-align:Center;font-size:3.5em">Montant :<b style="color:green;"> 000 €</b></h4>
                <h6 style="text-align:start;margin-top:40px"> Appliquer une remise </h6>
                <div class="form-contact" style="margin-top:20px">
                    <select name="role" id="pet-select" style="background-color:white;margin-bottom:20px;width:340px;height:35px;float:left;border-radius:4px;border-color:black">
                        <option >Remise</option>
                        <option value="mix">1</option>
                        <option value="mont">2</option>
                        <option value="photo">3</option>
                        <option value="ingen">4</option>
                    </select>
                    <a class="btn btn-danger" href="" style="width:80px;font-size:1.2em;padding:0;margin-left:160px"> Retirer</a>
                    <a class="btn btn-success" href="" style="width:80px;font-size:1.2em;padding:0;"> Appliquer</a>  
                </div>  
                <h6 style="text-align:start;margin-top:40px"> Appliquer un code promo </h6>
                <div class="form-contact" style="margin-top:20px">
                    <select name="role" id="pet-select" style="background-color:white;margin-bottom:20px;width:340px;height:35px;float:left;border-radius:4px;border-color:black">
                        <option >Promo</option>
                        <option value="mix">1</option>
                        <option value="mont">2</option>
                        <option value="photo">3</option>
                        <option value="ingen">4</option>
                    </select>  
                    <a class="btn btn-danger" href="" style="width:80px;font-size:1.2em;padding:0;margin-left:160px"> Retirer</a>
                    <a class="btn btn-success" href="" style="width:80px;font-size:1.2em;padding:0"> Appliquer</a>
                    </div>  
                </div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-danger" href="" style="width:80px;font-size:1.2em;margin-left:160px;margin-top:50px"> Annuler</a>
    <a class="btn btn-info" href="" style="width:80px;font-size:1.2em;margin-top:50px"> Créer</a>
    </form>
</div>
<script>
      function openClt() {
        document.getElementById("cltForm").style.display = "block";
      }

      function closeClt() {
        document.getElementById("cltForm").style.display = "none";
      }
      function openFac() {
        document.getElementById("facForm").style.display = "block";
      }

      function closeFac() {
        document.getElementById("facForm").style.display = "none";
      }
      function openPay() {
        document.getElementById("payForm").style.display = "block";
      }

      function closePay() {
        document.getElementById("payForm").style.display = "none";
      }
      function openPack() {
        document.getElementById("packForm").style.display = "block";
      }

      function closePack() {
        document.getElementById("packForm").style.display = "none";
      }
      function openPro() {
        document.getElementById("proForm").style.display = "block";
      }

      function closePro() {
        document.getElementById("proForm").style.display = "none";
      }
      function openCrePack() {
        document.getElementById("crepckForm").style.display = "block";
      }

      function closeCrePack() {
        document.getElementById("crepckForm").style.display = "none";
      }
      function openCrePro() {
        document.getElementById("creproForm").style.display = "block";
      }

      function closeCrePro() {
        document.getElementById("creproForm").style.display = "none";
      }
      function openCreClt() {
        document.getElementById("crecltForm").style.display = "block";
      }

      function closeCreClt() {
        document.getElementById("crecltForm").style.display = "none";
      }
    </script>
<div class="formclt">
            <div class="form-clt" id="cltForm">
                <form action="{{ route('facture.insertexistingcontact') }}" method="post" class="form-container">
                    @csrf
                    <h4 style="text-align:start;margin-top:30px">Ajouter un client à la facture </h4>
                    <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                        <input type="hidden" id="id_contacts" name="id_contacts" value="{{ serialize($id_contacts) }}"> 
                    <select name="id_cnt" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                        <option value="">Choisissez un Contact </option>
                        @foreach ($id_con as $con)
                            <option value="{{ $con->id_contact }}"{{old('id_cnt' == $con->id_contact ? " selected" : "")}}>{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>    
                        @endforeach
                    </select>
                     <a href="javascript:openCreClt(),closeClt()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                    </div>
                    <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                    <button type="button" class="btn cancel" onclick="closeClt()" style="width:100px">Annuler</button>
                    </form>
            </div>
            <div class="form-pay" id="payForm">
                <form action="/action_page.php" class="form-container">
                    <h3 style="text-align:center;margin-top:10px;margin-bottom:20px">Echéance de paiement </h3>
                    <h4 style="text-align:Center;font-size:1.5em">Montant :<b style="color:green;"> 000 €</b></h4>
                    <div class="form-contact" style="margin-bottom:20px;margin-top:40px">
                    <h6 style="margin-left:80px;text-align:center;font-size:1.5em"><b style="float:left">Nb échéances : </b>
                    <select name="id_cnt" id="pet-select" style="margin-right:70px;float:right;margin-left:10px;background-color:#eee;margin-bottom:10px;width:50px;height:35px;float:left;border-radius:4px;">
                        <option></option>
                        <option value="cnt1">1</option>
                        <option value="cnt2">2</option>
                        <option value="cnt3">3</option>
                        <option value="cnt4">4</option>
                        <option value="cnt5">Autre</option>
                    </select></h6>
                    </div>
                    <div class="form-contact" style="margin-bottom:20px">
                    <h6 style="text-align:center;font-size:1.5em;margin-left:115px;"><b style="float:left">Nb Clients : </b>
                    <select name="id_cnt" id="pet-select" style="margin-left:10px;margin-right:70px;background-color:#eee;margin-bottom:10px;width:50px;height:35px;float:left;border-radius:4px;">
                        <option></option>
                        <option value="cnt1">1</option>
                        <option value="cnt2">2</option>
                        <option value="cnt3">3</option>
                        <option value="cnt4">4</option>
                        <option value="cnt5">Autre</option>
                    </select>
                    </h6>
                    <h6 style="margin-left:50px;margin-bottom:20px;margin-right:10px;text-align:center;font-size:1.5em"><b>Paiement : </b><b style="margin-left:10px;color:red;">2 fois</b></h6> 
                    </div> 
                    <table style="width:110%;margin-top:60px;margin-bottom:40px">
                        <thead>
                            <th colspan="5"style="padding:0 0 2rem 0"> <b style="font-size:1.2em;">Type d'échéances :</b>Mensulités</th>
                        </thead>
                        <tbody style="margin-bottom:30px">
                            <tr>
                            <td>
                                    J
                                </td><td>
                                    12345
                                </td><td>
                                <div class="form-contact" style="margin-bottom:20px">
                                     <select name="id_cnt" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                            <option value="cnt1">Client 1</option>
                                            <option value="cnt2">Client 2</option>
                                    </select>
                                </div>
                                </td><td>
                                <input type="text" class="form-control"  value="100" style="width:40px;height:10px;margin-top:20px">
                                </td><td>
                                <div class="form-contact" style="margin-bottom:20px">
                                     <select name="id_cnt" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                            <option value="cnt1">Créee</option>
                                            <option value="cnt2">Payé</option>
                                            <option value="cnt3">Partiellement</option>
                                            <option value="cnt4">Annulé</option>
                                            <option value="cnt5">Autre</option>
                                    </select>
                                </div>
                                </td>
                            </tr>
                            <tr>
                            <td>
                                    J
                                </td><td>
                                    12345
                                </td><td>
                                <div class="form-contact" style="margin-bottom:20px">
                                     <select name="id_cnt" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                            <option value="cnt1">Client 1</option>
                                            <option value="cnt2">Client 2</option>
                                    </select>
                                </div>
                                </td><td>
                                <input type="text" class="form-control"  value="100" style="width:40px;height:10px;margin-top:20px">
                                </td><td>
                                <div class="form-contact" style="margin-bottom:20px">
                                     <select name="id_cnt" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                            <option value="cnt1">Créee</option>
                                            <option value="cnt2">Payé</option>
                                            <option value="cnt3">Partiellement</option>
                                            <option value="cnt4">Annulé</option>
                                            <option value="cnt5">Autre</option>
                                    </select>
                                </div>
                                </td>
                            </tr>
                            <tr>
                            <td>
                                    J+mois
                                </td><td>
                                    12345
                                </td><td>
                                <div class="form-contact" style="margin-bottom:20px">
                                     <select name="id_cnt" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                            <option value="cnt1">Client 1</option>
                                            <option value="cnt2">Client 2</option>
                                    </select>
                                </div>
                                </td><td>
                                <input type="text" class="form-control"  value="100" style="width:40px;height:10px;margin-top:20px">
                                </td><td>
                                <div class="form-contact" style="margin-bottom:20px">
                                     <select name="id_cnt" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                            <option value="cnt1">Créee</option>
                                            <option value="cnt2">Payé</option>
                                            <option value="cnt3">Partiellement</option>
                                            <option value="cnt4">Annulé</option>
                                            <option value="cnt5">Autre</option>
                                    </select>
                                </div>
                                </td>
                            </tr>
                            <tr>
                            <td>
                                    J+mois
                                </td><td>
                                    12345
                                </td><td>
                                <div class="form-contact" style="margin-bottom:20px">
                                     <select name="id_cnt" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                            <option value="cnt1">Client 1</option>
                                            <option value="cnt2">Client 2</option>
                                    </select>
                                </div>
                                </td><td>
                                <input type="text" class="form-control"  value="100" style="width:40px;height:10px;margin-top:20px">
                                </td><td>
                                <div class="form-contact" style="margin-bottom:20px">
                                     <select name="id_cnt" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                            <option value="cnt1">Créee</option>
                                            <option value="cnt2">Payé</option>
                                            <option value="cnt3">Partiellement</option>
                                            <option value="cnt4">Annulé</option>
                                            <option value="cnt5">Autre</option>
                                    </select>
                                </div>
                                </td>
                            </tr>
                            
                            
                        </tbody>                 
                    </table>         
                    <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                    <button type="button" class="btn cancel" onclick="closePay()" style="width:100px">Annuler</button>
                    </form>
            </div>
            <div class="form-clt" id="facForm">
                <form action="/action_page.php" class="form-container">
                    <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Vous voulez ajouter : </h4>
                    <button type="button" onclick="openPack(),closeFac()" class="btn" style="width:100px">Pack</button>
                    <button type="button" onclick="openPro(),closeFac()" class="btn" style="width:100px">Produit</button>
                    <button type="button" class="btn cancel" onclick="closeFac()" style="width:100px">Annuler</button>
                    </form>
            </div>
            <div class="form-pck" id="packForm">
                <form action="/action_page.php" class="form-container">
                    <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Ajouter pack à la facture : </h4>
                    <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                    <select name="id_cnt" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                        <option>Pack</option>
                        <option value="cnt1">1</option>
                        <option value="cnt2">2</option>
                        <option value="cnt3">3</option>
                        <option value="cnt4">4</option>
                        <option value="cnt5">5</option>
                    </select>
                    <a href="javascript:openCrePack(),closePack()"><img  style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="ville" class="form-control"  placeholder="Nombre de personne" style="background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="ville" class="form-control"  placeholder="Nombre de chanson" style="background-color:white;border:2px black  solid">
                    </div>
                    <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Ajouter prestation : </h4>
                    <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                    <select name="id_cnt" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                        <option>Prestation</option>
                        <option value="cnt1">1</option>
                        <option value="cnt2">2</option>
                        <option value="cnt3">3</option>
                        <option value="cnt4">4</option>
                        <option value="cnt5">5</option>
                    </select>
                     <a href="javascript:openCrePro(),closePack()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                    </div>
                    <button type="submit" class="btn" style="width:100px">Appliquer</button>
                    <button type="button" class="btn cancel" onclick="closePack()" style="width:100px">Annuler</button>
                    </form>
            </div>
            <div class="form-clt" id="proForm">
                <form action="/action_page.php" class="form-container">
                    <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Ajouter prestation : </h4>
                    <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                    <select name="id_cnt" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                        <option>Prestation</option>
                        <option value="cnt1">1</option>
                        <option value="cnt2">2</option>
                        <option value="cnt3">3</option>
                        <option value="cnt4">4</option>
                        <option value="cnt5">5</option>
                    </select>
                     <a href="javascript:openCrePro(),closePro()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                    </div>
                    <button type="submit" class="btn" style="width:100px">Appliquer</button>
                    <button type="button" class="btn cancel" onclick="closePro()" style="width:100px">Annuler</button>
                    </form>
            </div>
            <div class="form-crepck" style="width:900px;background-color:#EDEFF0" id="crepckForm">
                <form action="/action_page.php" class="form-container">
                    <table style="width:220%">
                    <th colspan="2"><h1 style="text-align:center;margin-top:30px;margin-bottom:10px">Création Pack </h1> </th>
                    <tr>
                    <td>
                    <img src="https://t4.ftcdn.net/jpg/02/07/87/79/360_F_207877921_BtG6ZKAVvtLyc5GWpBNEIlIxsffTtWkv.jpg" style ="margin-left:65px;margin-bottom:20px; height:280px;width:280px;float:left;border-radius:10px;border:5px #888888 solid" alt="Maxwell Admin">
                    <h5><input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" style="width:350px"></h5>
                    </td>
                    <td>
                    <div class="form-contact" style="margin-bottom:20px;margin-top:30px;">
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="Nom" class="form-control"  placeholder="Nom" style="background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                            <input type="text" name="Prénom" class="form-control"  placeholder="Prix" style="background-color:white;border:2px black  solid"> 
                    </div>        
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="mail" class="form-control"  placeholder="Abstract" style="background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                    <h6 style="color:black;margin-left:10px">Description</h6>
                    </div>
                    <div class="form-contact" style="">
                            <input type="text" name="url" class="form-control" style="height:120px;background-color:white;border:2px black  solid">
                    </div>            
                    </div>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <button type="submit" class="btn" style="width:100px">Appliquer</button>
                        <button type="button" class="btn cancel" onclick="closeCrePack()" style="width:100px">Annuler</button>
                        </td>
                    </tr>
                    </table>
                    </form>
            </div>
            <div class="form-crepro" style="width:900px;background-color:#EDEFF0" id="creproForm">
                <form action="/action_page.php" class="form-container">
                    <table style="width:220%">
                    <th colspan="2"><h1 style="text-align:center;margin-top:30px;margin-bottom:10px">Création Prestation </h1> </th>
                    <tr>
                    <td>
                    <img src="https://t4.ftcdn.net/jpg/02/07/87/79/360_F_207877921_BtG6ZKAVvtLyc5GWpBNEIlIxsffTtWkv.jpg" style ="margin-left:65px;margin-bottom:20px; height:280px;width:280px;float:left;border-radius:10px;border:5px #888888 solid" alt="Maxwell Admin">
                    <h5><input type="file" id="avatar" name="avatar" value="{{old('avatar')}}" accept="image/png, image/jpeg" style="width:350px"></h5>
                    </td>
                    <td>
                    <div class="form-contact" style="margin-bottom:20px;margin-top:30px;">
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="Nom" class="form-control" value="{{old('nom')}}"  placeholder="Nom" style="background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                            <input type="text" name="Prénom" class="form-control" value="{{old('Prénom')}}"  placeholder="Prix" style="background-color:white;border:2px black  solid"> 
                    </div>        
                    <div class="form-contact" style="margin-top:20px">
                            <input type="text" name="mail" class="form-control" value="{{old('mail')}}"  placeholder="Abstract" style="background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:20px">
                    <h6 style="color:black;margin-left:10px">Description</h6>
                    </div>
                    <div class="form-contact" style="">
                            <input type="text" name="url" class="form-control" value="{{old('url')}}" style="height:120px;background-color:white;border:2px black  solid">
                    </div>            
                    </div>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <button type="submit" class="btn" style="width:100px">Appliquer</button>
                        <button type="button" class="btn cancel" onclick="closeCrePro()" style="width:100px">Annuler</button>
                        </td>
                    </tr>
                    </table>
                    </form>
            </div>
            <div class="form-creclt" style="width:900px;background-color:#EDEFF0" id="crecltForm">
                <form action="{{ route('facture.insertnewcontact') }}" method="post" class="form-container">
                    @csrf
                    <table style="width:220%">
                    <th colspan="2"><h1 style="text-align:center;margin-top:5px;margin-bottom:5px">Création Contact</h1> </th>
                    <tr>
                    <td>
                        @php
                            dump($id_contacts);
                        @endphp
                    <img src="https://www.devopssec.fr/media/cache/avatar/images/default/empty_profile.jpg" style ="margin-left:65px;margin-bottom:20px; height:280px;width:280px;float:left;border-radius:200px;border:5px #888888 solid" alt="Maxwell Admin">
                    <h5><input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" style="width:350px"></h5>
                    </td>
                    <td style="width:305px">
                    <div class="form-contact" style="margin-bottom:0px;margin-top:0px;">
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="Nom" class="form-control" value="{{old('Nom')}}"  placeholder="Nom" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') serialize($id_contacts) }}"> 
                    <div class="form-contact" style="margin-top:0px;margin-bottom:0px">
                            <input type="text" name="Prénom" class="form-control" value="{{old('Prénom')}}"  placeholder="Prénom" style="height:35px;background-color:white;border:2px black  solid"> 
                    </div>        
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="mail" class="form-control" value="{{old('mail')}}"  placeholder="Email" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="tel" class="form-control" value="{{old('tel')}}"  placeholder="Tel" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="adress" class="form-control" value="{{old('adress')}}"  placeholder="Adresse" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="cp" class="form-control" value="{{old('cp')}}"  placeholder="Code postale" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="ville" class="form-control" value="{{old('ville')}}"  placeholder="Ville" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="url" class="form-control" value="{{old('url')}}"  placeholder="Url Dossier" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-bottom:0px;margin-top:30px">
                        <label for="pet-select">Entreprise</label>
                    <select name="id_cnt" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:385px;height:35px;float:left;border-radius:4px;">
                        <option value="" selected>Aucune</option>
                        @foreach ($nom_org as $nom)
                        <option value="{{ $id_org[$loop->index] }}"{{old('id_cnt') == $id_org[$loop->index] ? "selected" : ""}}>{{ $nom }}</option>
                        @endforeach
                    </select>
                    </div>  
                    <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="type" class="form-control" value="{{old('type')}}"  placeholder="Type Contact">
                    </div>        
                    </div>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <button type="submit" class="btn" style="width:100px">Appliquer</button>
                        <button type="button" class="btn cancel" onclick="closeCreClt()" style="width:100px">Annuler</button>
                        </td>
                    </tr>
                    </table>
                    </form>
            </div>
    
    
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
#M52{
background-color: #747474;
}

      /* Stylez et fixez le bouton sur la page */
     
      /* Positionnez la forme Popup */
      .formclt {
        position: center;
        text-align: center;
        z-index: 1;
        width: 80%;
      }
      /* Masquez la forme Popup */
      .form-clt {
        display: none;
        position: fixed;
        left:55%;
        top: 30%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
       
      }
      .form-pay {
        display: none;
        position: fixed;
        left:55%;
        top: 1%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
       
      }
      
      /* Masquez la forme Popup */
      .form-pck {
        display: none;
        position: fixed;
        left:55%;
        top: 15%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
       
      }
      .form-crepck{
        display: none;
        position: fixed;
        left:55%;
        top: 15%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
      }
      .form-crepro{
        display: none;
        position: fixed;
        left:55%;
        top: 15%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
      }
      .form-creclt{
        display: none;
        position: fixed;
        left:55%;
        top: 1%;
        transform: translate(-45%, 5%);
        border:3px black solid;
        border-radius:10px; 
      }
      /* Styles pour le conteneur de la forme */
      .form-container {
        width: 400px;
        padding: 20px;
        background-color: #EDEFF0;
        border-radius:10px ;
      }
      /* Largeur complète pour les champs de saisie */
      .form-container input[type="text"],
      .form-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 22px 0;
        border: none;
        background: #eee;
      }
      /* Quand les entrées sont concentrées, faites quelque chose */
      .form-container input[type="text"]:focus,
      .form-container input[type="password"]:focus {
        background-color: #ddd;
      }
      /* Stylez le bouton de connexion */
      .form-container .btn {
        background-color: #4968e5;
        color: #fff;
        padding:;
        border: none;
        cursor: pointer;
        width: 30%;
        margin-bottom: 0px;
        opacity: 0.8;
      }
      /* Stylez le bouton pour annuler */
      .form-container .cancel {
        background-color: #cc0000;
      }
     
</style>
@endsection
