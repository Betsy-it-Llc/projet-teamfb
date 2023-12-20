@extends('layouts.navadmin')
@section('content')

<title>Create Facture</title>
<center> <h1 style="margin-bottom:60px"> Création Facture</h1>
<div style="float: left;margin-left:40px;margin-bottom:10px" class="open-btn" >
    <button class="open-button" onclick="openClt()" style="border-radius:10px"><center><img style="margin-top:px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANwAAADlCAMAAAAP8WnWAAAAgVBMVEX///8AAAD7+/vz8/PLy8s7Ozv4+PjDw8Po6Oifn5/Y2Njv7+/i4uLAwMDg4ODy8vKurq5TU1OOjo5FRUVlZWXQ0NAcHBx8fHwzMzOampqHh4elpaU+Pj4QEBB2dna0tLQpKSlbW1siIiKSkpIvLy95eXlfX19sbGxMTEwZGRkNDQ0alzTIAAAG1ElEQVR4nO2di1riPBCGoeVQKWcBS6tSWFbR+7/AX9h1VSSHSb9MRv68F0D6PqU5TCaZVisSiUQikUgkEolEIpFIJBLxTpL08mw4Hmd5L0lCPwyGJB+ObsrHWfHQ/kJ9WJTrzTjrhX5AR5LxqFx023rqp7vNYBL6UYksq21t8PpgdZj3f4pgPn2y9vqgux6EfnAjw7Xpn6jhriP4Gxyub93NTuzuOqElLjOaNTT7Q7HOQpuck5evELUTW1Gvb/CMMztRbKQM9J0tWO1IXUnoXJaYT+07uyq02njrSe2kNw2plv72qHakDte1VJ7VjiyGQdSW9wxub/wK4FbyqL1RcM86Ow/mh8JRso56fK/tD4wvb8z0tX2Ga9Db8Ku9sU053HyPbSpe/P8186ZLtgb4nrAMXsK5vS3VvbqNQqq98eRxTOCYb+kpvIXJuEe3i3iaa96F9jrx6qXTfAyt9Y4Hu0Vopw/gdmLe2xGwnYzv7R9Qu3lomzMexji38OPbOSvYeNcPrXKBPchtEFrkIk8Qt2wV2uMyJULuENpCxaa5m7BB4DONB4QwMQU7HhrulQxDC2jZNpMLGFSwoVFMTNrM5BsNZiqd0M9upOscd0iEjnCfmbvKNQ8rFJmecXM7xz8mYNrVNTSR+m9CQfEj5NprFzfEOodDru2QlJMjduBY5B7pcpAgJYscfY4J6MfaXHL3VDlM6gyPHHXxA1p9M8ntaHKgnCcmOdqrQ00queRqitwW1CiXHGXTFRbvYpMjdJiwjQE2uXbf1i2HNcknN7OVw62/+eSspym4FhnlLGeYwJQFRrm2XcABmLTMKWc1GiBDlZxyVkvyNWODSDmrLgUZh2WVswiEYRZyf2GVs5il/EK2xypn8b+EZsHyyhm3IzNoc7xyxv5yytocVs4Y5MNmQTHLmcZxbGvMcoYMB/CmFbNcW98aOFeIW04/GIBP+nHL6T86cGPcctqPDp0JxS230jWGTq3nltPus6Lzz9nldMdA0SeHTXITcHu6bdaEsFPcvTfTNaX4pHubn9nbP9VC3RYlwpAmNhjkWla/QegJbtVNUTpLxgP4hEzdVa78FUpnKVNOcxqGsgoXKqeegFEONQqVU29DUhZzQuXUR+Yp6cxC5ZSHI3uEAUWqnHI/JKVctSNUTrkuIG06CpVTjuLXIFernosUsxQqp0zHJ20TCJVTPhdpHS5VTnWFw/Ka5UhByygnSO6qv7mrliPlMUiV+18O4lc9/boGOeXEOaWcuhIqp1zyJJSbfIXKqZP3KNF0oXLqO5goV8MKlVMHiCibPELl1KE9yo64UDl1UJYycxYqpw6nU5bijFdOYjZCMsKBwH7HgqXhsROrHyGkt2q2sLApe23zGRv4zuqzpjH0/Vfse+I3msaQ+c1HRG34o28bEpWqgU0l5ZfTH4HcYRvjltMkM7Tgt87JSmwD38ojKyUR/NHJSiZtYa8NZ5bTf3Lo1DZhCdzYpERmOfWs2UdzvHLmwzzQ6SWvnLlsA3QwkHZQCXeOui3viFnLpcCaCmmHA6H9pbhjnT1gyS5OObvrGYA3Woo7So08tcopZ+UGuc3sL4xytoUacEMdo5ztnXsJbD3OJ2d/SSksCMYnZ1/uDDZLYZPTRZrPQa3q2OQod2OhXh2XXEFwg706kZeatXqYRpnkapIb6v4JJrkRUa4HqQvFI3cguoGmKUIv78TcaMMi95vuRst4VsAiZwroXQRQRY9Dzu1yeMBwYFodA5qgTLw+0zyasrvRA5ihO5dWF1T/SoXT/dsn8qBFEG2gD3EfSCw39IVGpfYE13Y50rB+Jy5Y5AFdvpAN6OQNJHVDt/DVRzUAaltCL99DQl3oXEToaAeqEE/JyGfDoQTDRSasZd/taDJ6fwV6oSeEPTDFWlpppZ3TGk6FrHnYynkpcBlRwx28eLOgKnvAIqvvSHl3D16KbsvoVWrw9/YOIh7WlALaT35mCE6BpjPzeIQoRR8ZIYKacymgnB+E4x4NsgR9aISAdZETdzrA9CkKXU/d5FeyIMVXH7kO7AVYnEOW3XYsa161mbfR7RIpa0CzUZVfF5ZsA/qMpSc5g6nwMaAmugsZMh1aQcl4ZPuMvufA2JOHpZs9ydRjceeDfSqeL8BVAP5RhFc7UnkY9Q4ME0lLRuAZ2cIhb8YjS9xp15e5lyhJI9IKMqzPGGeRJAbzhn73FeskksqydI5EzCp5f8dvDKfP5PVscdcPMYN0ojeu7DuYotzkjFfHYJj0q2f9tdevt+XGdB+MaLJlvyqft4f7Yl/vXla7fdG9nS0e55vOQHTnQaSXTvJ80vtx/8BIJBKJRCIRLP8BFAGbt3t3NfEAAAAASUVORK5CYII="><b style="color:black;font-size:1.5em">Ajouter Client</b></button>
</div>
<div style="float: center;margin-bottom:10px" class="open-btn" >
    <button class="open-button" onclick="openFac()" style="border-radius:10px;margin-left:-250px"><center><img style="margin-top:px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"><b style="color:black;font-size:1.5em">Ajouter Article</b></button>
    <button class="open-button" onclick="openRemFac()" style="border-radius:10px;margin-left:0px"><center><b style="color:black;font-size:1.5em">Enlever Article</b></button>
</div>
<div style="float: right;margin-top:-46px;" class="open-btn" >
    <button class="open-button" onclick="openPay()" style="border-radius:10px;margin-left:-280px"><center><b style="color:black;font-size:1.5em">Paiement</b></button>
    <button class="open-button" onclick="openEch()" style="border-radius:10px;margin-left: 40px"><center><b style="color:black;font-size:1.5em">Echéances</b></button>
</div>

<div class="container">
    <form action={{ route('factures.store') }} method="POST">
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
            {{-- Ajout des messages personnalisés 'success' --}}
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            
                {{-- Ajout des messages personnalisés 'error' --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                    {{ session()->get('error') }}
                    </div>
            @endif
          
        <input type="hidden" id="id_contacts" name="id_contacts" value="{{ serialize($id_contacts) }}"> 
        <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{ serialize($id_autre_prest) }}"> 
        <input type="hidden" id="packs_experience" name="packs_experience" value="{{ serialize($packs_experience) }}"> 
        <input type="hidden" id="paiements" name="paiements" value="{{ serialize($paiements) }}"> 
        <input type="hidden" id="montant_remise" name="montant_remise" value="{{ $montant_remise }}">
        <input type="hidden" id="fact_rem" name="fact_rem" value="{{ $fact_rem }}">
        <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
        <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">
        

        <div class="row gutters ">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" style="margin-left:0px">
                <div class="card h-100 le_rectangle" style="width:390px;margin-left:0px">
                    <div class="card-body" style="margin-bottom:-40px">
                        <h3 style="text-align:start">Info Client</h3>
                        @if (!is_null($listecontacts))
                        <!--@dump($paiements)-->
                        <table class="table table-sm">
                            @foreach ($listecontacts as $con)
                            
                                <thead>
                                    <tr style="padding:0;">
                                        <th style="padding:0;"  colspan="2">Info Client  </th>
                                    </tr>
                                    <tr style="font-size:1rem; ">
                                        <td style="padding:0 0 0.5rem 0;">
                                            <b> Id : {{ $con->id_contact }}  </b>
                                            
                                            
                                        </td>
                                        <td style="text-align:left">
                                            <button formaction="{{ route('facture.removecontact', ['id_con'=>$con->id_contact]) }}"
                                            style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger">
                                                <i style="color : #cc3300" class="fas fa-trash"></i>
                                            </button>
                                            <!-- ----------------yasser----------------- -->
                                            <div onclick="open_modif_client('{{ $con->id_contact }}')"  style="background: none ; border : none;" class="btn btn-primary" data-csrf-token="{{ csrf_token() }}">
                                                <i style="color : green;" class="fas fa-edit fa-lg"></i>
                                                <!-- {{!! $listecontacts  !!}} -->
                                            </div>
                                            <!-- ----------------yasser----------------- -->
                                        </td>
                                    </tr>
                                
                                </thead>
                            
                                <tbody>
                                    <tr>
                                        <td class="field">Nom: </td>
                                        <td class="value">
                                        {{ $con->nom }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Prenom: </td>
                                        <td class="value">
                                        {{ $con->prenom }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Email:</td>
                                        <td class="value">
                                            {{ $con->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Tel: </td>
                                        <td class="value">
                                            {{ $con->tel }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Adresse: </td>
                                        <td class="value">
                                            {{ $con->adresse }} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Code Postale: </td>
                                        <td class="value">
                                        {{ $con->code_postal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Ville : </td>
                                        <td class="value">
                                        {{ $con->ville }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width:50%">Numero CSE : </td>
                                        <td class="value" >
                                            @foreach ($contactscse as $cse)
                                                @if ($cse->id_contact==$con->id_contact)
                                                {{$cse->num_cse}}
                                                @endif
                                            @endforeach
                                        
                                        </td>
                                    </tr>
                                
                                    
                                </tbody>
                            
                            @endforeach
                        </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" style="margin-left:0px">
                <div class="card h-100 le_rectangle" style="width:390px;margin-left:140px">
                    <div class="card-body" style="margin-bottom:-40px">
                            <h3 style="text-align:start">Info Facture</h3>
                            <h6 style="text-align:start">Description </h6>
                            <div class="form-contact" style="">
                                <!-- <input type="text" name="description" class="form-control" style="height:120px;background-color:white;border:2px black  solid"> -->
                                <textarea name="description_facture" class="form-control" cols="30" rows="5" placeholder="Description Facture" style="background-color:white;border:2px black  solid; margin-bottom:3px">{{ $desc_fact }}</textarea>
                                <button formaction="{{ route('facture.insertdescription') }}"
                                style="text-align:center;margin-top:20px" type="submit" class="btn btn-primary">
                                Enregistrer Description</button>
                            </div>
                        <table class="table table-sm">  
                            <thead>
                                <tr>
                                    <th colspan="2">Info Packs</th>
                                </tr>
                            </thead>
                            <tbody style="border:none">
                                @foreach($packs_experience as $pack)
                            
                                @php
                                    $countpack=0;
                                    $countprest=0;
                                    $nb_pack=$loop->index+1;
                                @endphp
                                @foreach ($listepacks as $p)
                                @if (($p->id_pack==$pack['id_pack'])&&($countpack==0))
                                <tr>
                                    <td class="field"><b>Informations du pack N° {{ $nb_pack }}</b> </td>
                                </tr>
                                
                                <tr >
                                    <td class="field" style="padding:1rem 0 0 1rem;">Pack: </td>
                                    <td class="value" style="padding:1rem 0 0 1rem;">
                                        {{$p->nom}} 
                                    </td>
                                </tr>
                                <tr>
                                    <tr >
                                        <td class="field" style="padding:1rem 0 0 1rem;">Montant: </td>
                                        <td class="value" style="padding:1rem 0 0 1rem;">
                                            {{$prix_packs->reverse()->firstWhere('id_pack',$p->id_pack)->prix ?? '- ' }}€
                                        </td>
                                    </tr>
                                    <tr>
                                    @php
                                        $countpack++;
                                    @endphp
                                @endif
                                @endforeach
                                
                                    <td class="field">Titre:</td>
                                    <td class="value">
                                        {{$pack['nb_titres']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Participant:</td>
                                    <td class="value">
                                        {{$pack['nb_participants']}}
                                    </td>
                                </tr>
                
                            
                                @isset($pack['id_prest'])
                                <tr>
                                    <td class="field"><b>Prestations du pack {{ $loop->index+1 }}</b></td>
                                </tr>
                                @foreach ($packsprestation as $p)
                                @if (($p->id_produit==$pack['id_prest'])&&($countprest==0))
                            
                                <tr>
                                    <td class="field">Nom Produit:</td>
                                    <td class="value">
                                        {{$p->nom_produit}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Montant:</td>
                                    <td class="value">
                                        {{$prix_packsprestation->reverse()->firstWhere('id_produit',$p->id_produit)->prix ?? '- ' }}€
                                    </td>
                                </tr>
                                @php
                                    $countprest++;
                                @endphp
                                @endif
                                @endforeach
                            
                            
                                @endisset
                                @endforeach
                                <tr>
                                    <td class="field"><b>Autres Prestations Non liées à un pack</b></td>
                                </tr>
                                @foreach ($id_autre_prest as $id_prest)
                                
                                <tr>
                                    <td class="field"><b>Prestations N° {{ $loop->index +1 }}</b></td>
                                </tr>

                                <tr>
                                    <td class="field">Nom Produit:</td>
                                    <td class="value">
                                        {{$autres_prestations->firstWhere('id_produit',$id_prest)->nom_produit ?? '- ' }}

                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Montant:</td>
                                    <td class="value">
                                        {{$prix_autres_prestation->reverse()->firstWhere('id_produit',$id_prest)->prix ?? '- ' }}€
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" >
                <div class="card h-100 le_rectangle" style="width:390px;margin-left:280px">
                    <div class="card-body" style="margin-bottom:-40px">
                        <h3 style="text-align:start">Info Paiement </h3><br>
                        <h4 style="text-align:Center;font-size:3.5em">Montant :<b style="color:green;"> {{ $montant_remise }} €</b></h4>
                        <h4>Nombres Echéances :<b style="color:green;"> {{$paiements['nb_paiements']}}</b></h4>
                        <a href="javascript:openRemise()"><h6 style="width:250px;text-align:center;margin-top:40px" class="btn btn-light">  Appliquer une remise </h6></a>
                        
                        <a href="javascript:openForm()"><h6 style="width:250px;text-align:center;margin-top:40px" class="btn btn-light"> Appliquer un code promo </h6></a>

                        <button formaction="{{ route('facture.cancelremise') }}"
                            style="text-align:center;margin-top:40px" type="submit" class="btn btn-danger">
                            Annuler la remise/code promo
                        </button>
                        
                        <div class="form-contact" style="margin-top:20px;margin-bottom:30px">                
                            <button class="btn btn-info" formaction="{{ route('facture.storebrouillon') }}" style="width:80px;font-size:1.2em;">Brouillon</button>

                            <button class="btn btn-primary" type="submit" style="width:80px;font-size:1.2em;"> Créer</button>
                            <button class="btn btn-info" formaction="{{ route('facture.storeandenvoyer') }}" style="width:80px;font-size:1.2em;">Envoyer</button>
                            <input type="text" hidden value="{{url()->previous()}}" name="previous_url">
                            <a class="btn btn-danger" href="{{ route('facture.create') }}" style="width:80px;font-size:1.2em;;"> Annuler</a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </form>
</div>


<script>
      function openClt() {
        var cltForm = document.getElementById("cltForm");
        cltForm.style.display = "block";
        cltForm.style.zIndex = "33";
      }
      function closeClt() {
        document.getElementById("cltForm").style.display = "none";
      }
      function openFac() {
        var facForm = document.getElementById("facForm");
        facForm.style.display = "block";
        facForm.style.zIndex = "9999";
      }
      function closeFac() {
        document.getElementById("facForm").style.display = "none";
      }
      function openRemFac() {
        var remfacForm = document.getElementById("remfacForm");
        remfacForm.style.display = "block";
        remfacForm.style.zIndex = "9999";
      }
      function closeRemFac() {
        document.getElementById("remfacForm").style.display = "none";
      }
      function openPay() {
        var payForm = document.getElementById("payForm");
        payForm.style.display = "block";
        payForm.style.zIndex = "9999";
      }

      function closePay() {
        document.getElementById("payForm").style.display = "none";
      }
      function openEch() {
        var echForm = document.getElementById("echForm");
        echForm.style.display = "block";
        echForm.style.zIndex = "9999";
      }

      function closeEch() {
        document.getElementById("echForm").style.display = "none";
      }
      
      function openPack() {
        var packForm = document.getElementById("packForm");
        packForm.style.display = "block";
        packForm.style.zIndex = "9999";
      }

      function closePack() {
        document.getElementById("packForm").style.display = "none";
      }
      function openRemPack() {
        var rempackForm = document.getElementById("rempackForm");
        rempackForm.style.display = "block";
        rempackForm.style.zIndex = "9999";
      }

      function closeRemPack() {
        document.getElementById("rempackForm").style.display = "none";
      }
      function openPro() {
        var proForm = document.getElementById("proForm");
        proForm.style.display = "block";
        proForm.style.zIndex = "9999";
      }

      function closePro() {
        document.getElementById("proForm").style.display = "none";
      }
    function openRemPro() {
        var remproForm = document.getElementById("remproForm");
        remproForm.style.display = "block";
        remproForm.style.zIndex = "9999";
      }

      function closeRemPro() {
        document.getElementById("remproForm").style.display = "none";
      }
      function openCrePack() {
        var crepckForm = document.getElementById("crepckForm");
        crepckForm.style.display = "block";
        crepckForm.style.zIndex = "9999";
      }

      function closeCrePack() {
        document.getElementById("crepckForm").style.display = "none";
      }
      function openCrePro() {
        var creproForm = document.getElementById("creproForm")
        creproForm.style.display = "block";
        creproForm.style.zIndex = "9999";
      }

      function closeCrePro() {
        document.getElementById("creproForm").style.display = "none";
      }
      function openCreClt() {
        var crecltForm = document.getElementById("crecltForm")
        crecltForm.style.display = "block";
        crecltForm.style.zIndex = "9999";
      }

      function closeCreClt() {
        document.getElementById("crecltForm").style.display = "none";
      }
      function openForm() {
        var promoForm = document.getElementById("promoForm")
        promoForm.style.display = "block";
        promoForm.style.zIndex = "9999";
      }

      function closeForm() {
        document.getElementById("promoForm").style.display = "none";
      }
      function openFormcre() {
        var promocreForm = document.getElementById("promocreForm")
        promocreForm.style.display = "block";
        promocreForm.style.zIndex = "9999";
      }

      function closeFormcre() {
        document.getElementById("promocreForm").style.display = "none";
      }
      function openRemise() {
        var remiseForm = document.getElementById("remiseForm")
        remiseForm.style.display = "block";
        remiseForm.style.zIndex = "9999";
      }

      function closeRemise() {
        document.getElementById("remiseForm").style.display = "none";
      }
      function openRemisecre() {
        var remisecreForm = document.getElementById("remisecreForm")
        remisecreForm.style.display = "block";
        remisecreForm.style.zIndex = "9999";
      }

      function closeRemisecre() {
        document.getElementById("remisecreForm").style.display = "none";
      }
</script>

<div class="formclt">
        <div class="form-clt" id="cltForm">
            <form action="{{ route('facture.insertexistingcontact') }}" method="post" class="form-container">
                @csrf
                <h4 style="text-align:start;margin-top:30px">Ajouter un client à la facture </h4>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                    <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                    <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                    <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                    <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                    <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}"> 
                    <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                    <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">
                    <input list="contacts" name="id_cnt" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;" placeholder="Choisissez un contact">
                    <datalist id="contacts">
                        @foreach ($id_con as $con)
                            <option value="{{ $con->id_contact }}">{{ $con->id_contact }} - {{ $con->nom }} {{ $con->prenom }}</option>    
                        @endforeach
                    </datalist>
                    <a href="javascript:openCreClt(),closeClt()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeClt()" style="width:100px">Annuler</button>
            </form>
        </div>
        <div class="form-pay" id="payForm">
            <form action="{{ route('facture.setuppaiements') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}">
                <input type="hidden" id="montant_remise" name="montant_remise" value="{{old('montant_remise') ?? $montant_remise }}">
                <input type="hidden" id="verif_nb_client" name="verif_nb_client" value="{{old('verif_nb_client') ?? count($id_contacts) }}">
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}"> 
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <h3 style="text-align:center;margin-top:10px;margin-bottom:20px">Les paiements </h3>
                <h4 style="text-align:Center;font-size:1.5em">Montant :<b style="color:green;"> {{ $montant_remise }} €</b></h4>
                <div class="form-contact" style="margin-bottom:20px;margin-top:40px">
                <h6 style="margin-left:80px;text-align:center;font-size:1.5em"><b style="float:left">Nb échéances : </b>
                <input name="nb_echeances" id="pet-select" value="{{$paiements['nb_echeances'] ?? old('nb_echeances') }}" style="margin-right:70px;float:right;margin-left:10px;background-color:#eee;margin-bottom:10px;width:50px;height:35px;float:left;border-radius:4px;">
                    </h6>
                </div>
                <div class="form-contact" style="margin-bottom:20px">
                <h6 style="text-align:center;font-size:1.5em;margin-left:115px;"><b style="float:left">Nb Clients : </b>
                <input name="nb_clients" id="pet-select" value="{{$paiements['nb_clients'] ?? old('nb_clients') ?? count($id_contacts) }}" style="margin-left:10px;margin-right:70px;background-color:#eee;margin-bottom:10px;width:50px;height:35px;float:left;border-radius:4px;">
                    
                </h6>
                
                </div> 
                        
                <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closePay()" style="width:100px">Annuler</button>
                </form>
        </div>
        <div class="form-pay" id="echForm">
            <form action="{{ route('facture.insertpaiements') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}">
                <input type="hidden" id="montant_remise" name="montant_remise" value="{{old('montant_remise') ?? $montant_remise }}">
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <h3 style="text-align:center;margin-top:10px;margin-bottom:20px">Les Echéances </h3>
                <h4 style="text-align:Center;font-size:1.5em">Montant :<b style="color:green;"> {{ $montant_remise }} €</b></h4>
                
                <div class="form-contact" style="margin-bottom:20px">
                <h6 style="margin-left:50px;margin-bottom:20px;margin-right:10px;text-align:center;font-size:1.5em"><b>Paiement : </b><b style="margin-left:10px;color:red;">
                @if(isset($paiements['nb_paiements'])) 
                {{$paiements['nb_paiements']}}
                @endif
                fois</b></h6> 
                </div> 
                <?php $date=date('Y-m-d', strtotime('+ 1 day'));?>
                        <table style="width:110%;margin-top:60px;margin-bottom:40px">
                    <thead>
                        <th colspan="5"style="padding:0 0 2rem 0"> <b style="font-size:1.2em;">Type d'échéances :</b>Mensulités</th>
                    </thead>
                    <tbody style="margin-bottom:30px">
                    @if(isset($paiements['nb_paiements']))
                    @for($i=0;$i<$paiements['nb_echeances'];$i++)
                    @for($j=0;$j<$paiements['nb_clients'];$j++)
                        @php
                            $forcounter = ($j)+($i*$paiements['nb_clients'])
                        @endphp
                        <tr>
                            <td></td>
                        <td>

                            <input type="date" value="{{$paiements['paiements'][$forcounter]['date_fin'] ?? old('date_fin')[$forcounter] ?? $date}}" id="end" name="date_fin[]" style="height:35px;border-radius:4px;border-color:black;">
                    
                            </td>
                            <td>
                            <div class="form-contact" style="margin-bottom:20px">
                                <select name="id_cnt[]" id="pet-select" style="width:65px;height:35px;float:left;border-radius:4px;">
                                @foreach ($listecontacts as $con)
                                    @if(isset($paiements['paiements']))
                                        @if ($con->id_contact==$paiements['paiements'][$forcounter]['id_contact'])
                                            <option value="{{ $con->id_contact }}"{{old('id_cnt[]') == $con->id_contact ? "selected" : ""}}> {{ $con->nom }}  {{ $con->prenom }}</option>
                                        @else
                                            <option value="{{ $con->id_contact }}"{{old('id_cnt[]') == $con->id_contact ? "selected" : ""}}> {{ $con->nom }}  {{ $con->prenom }}</option>
                                        @endif
                                    @elseif (is_null(old('id_cnt')))
                                        @if ($loop->index==$j)
                                        <option value="{{ $con->id_contact }}"{{old('id_cnt[]') == $con->id_contact ? "selected" : ""}}> {{ $con->nom }}  {{ $con->prenom }}</option>
                                        @else
                                            <option value="{{ $con->id_contact }}"{{old('id_cnt[]') == $con->id_contact ? "selected" : ""}}> {{ $con->nom }}  {{ $con->prenom }}</option>
                                        @endif
                                    @else
                                        @if ($con->id_contact==old('id_cnt')[$forcounter])
                                            <option value="{{ $con->id_contact }}"{{old('id_cnt[]') == $con->id_contact ? "selected" : ""}}> {{ $con->nom }}  {{ $con->prenom }}</option>
                                        @else
                                            <option value="{{ $con->id_contact }}"{{old('id_cnt[]') == $con->id_contact ? "selected" : ""}}> {{ $con->nom }}  {{ $con->prenom }}</option>
                                        @endif
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            </td><td>
                            <input type="text" class="form-control" name="prix[]" value="{{old('prix')[$forcounter] ?? $paiements['paiements'][$forcounter]['prix'] ?? $montant_remise/$paiements['nb_paiements'] }}" style="width:60px;height:35px;background-color:#888888;margin-top:20px">
                            </td>
                            <td>
                            </td>
                        </tr>
                        @endfor
                        <?php $date=date('Y-m-d', strtotime($date. ' + 1 months'));?>
                        @endfor 
                        @endif
                        
                    </tbody>                 
                </table>    
                    
                        
                <button type="submit" class="btn" style="width:100px">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeEch()" style="width:100px">Annuler</button>
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
        <div class="form-clt" id="remfacForm">
            <form action="/action_page.php" class="form-container">
                <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Vous voulez enlever : </h4>
                <button type="button" onclick="openRemPack(),closeRemFac()" class="btn" style="width:100px">Pack</button>
                <button type="button" onclick="openRemPro(),closeRemFac()" class="btn" style="width:100px">Produit</button>
                <button type="button" class="btn cancel" onclick="closeRemFac()" style="width:100px">Annuler</button>
                </form>
        </div>
        <div class="form-pck" id="packForm">
            <form action="{{ route('facture.insertpackexperience') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Ajouter pack à la facture : </h4>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                <select name="id_pack" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Choisissez un Pack </option>
                    @foreach ($nom_pack as $pack)
                    <option value="{{ $id_pack[$loop->index] }}" {{ old('id_pack') == $id_pack[$loop->index] ? "selected" : "" }}>{{ $pack }}</option>
                    @endforeach
                </select>
                <a href="javascript:openCrePack(),closePack()"><img  style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="nb_titres" value="1" class="form-control" value="{{ old('nb_titres') }}" placeholder="Nombre de chansons" style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="nb_adults" value="1" class="form-control" value="{{ old('nb_adults') }}"  placeholder="Nombre de participants adults" style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="nb_enfants" value="0" class="form-control" value="{{ old('nb_enfants') }}" placeholder="Nombre de participants enfants" style="background-color:white;border:2px black  solid">
                </div>
                <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Ajouter prestation : </h4>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                <select name="id_prest" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Aucune Prestation </option>
                    @foreach ($nom_prod as $prod)
                    @if (($prod!="Titre")&&($prod!="Participant"))
                    <option value="{{ $id_prod[$loop->index] }}" {{ old('id_prest') == $id_prod[$loop->index] ? "selected" : "" }}>{{ $prod }}</option>
                    @endif
                    @endforeach
                </select>
                    <a href="javascript:openCrePro(),closePack()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                <button type="submit" class="btn" style="width:100px">Appliquer</button>
                <button type="button" class="btn cancel" onclick="closePack()" style="width:100px">Annuler</button>
                </form>
        </div>

        <div class="form-pck" id="rempackForm">
            <form action="{{ route('facture.removepackexperience') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Enlever un pack : </h4>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                <select name="pack_index" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Aucun Pack </option>
                    @foreach ($packs_experience as $pack)
                    <option value="{{ $loop->index }}" {{ old('pack_index') == $loop->index ? "selected" : "" }}> {{ $loop->index+1 }} {{ $listepacks->firstWhere('id_pack',$pack['id_pack'])->nom }}</option>
                    @endforeach
                </select>
                <a href="javascript:openCrePack(),closePack()"><img  style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                
                <h4 style="display:inline-block; margin-top:30px;margin-bottom:30px">Ou enlever une prestation liée à un pack: </h4>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                <select name="pack_prest_index" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Aucune Prestation </option>
                    @foreach ($packs_experience as $pack)
                    @isset($pack['id_prest'])
                    <option value="{{ $loop->index }}" {{ old('pack_prest_index') == $loop->index ? "selected" : "" }}> {{ $listepacks->firstWhere('id_pack',$pack['id_pack'])->nom }} : {{ $packsprestation->firstWhere('id_produit',$pack['id_prest'])->nom_produit }}</option>
                    @endif
                    @endforeach
                </select>
                    <a href="javascript:openCrePro(),closePack()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                <button type="submit" class="btn" style="width:100px">Appliquer</button>
                <button type="button" class="btn cancel" onclick="closeRemPack()" style="width:100px">Annuler</button>
                </form>
        </div>

        <div class="form-clt" id="proForm">
            <form action="{{ route('facture.insertexistingautreprestation') }}" method="post" class="form-container">
                @csrf
                <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Ajouter prestation : </h4>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                    <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                    <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                    <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                    <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                    <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                    <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                    <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <select name="id_prest" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    <option value="">Choisissez une Prestation </option>
                    @foreach ($nom_prod as $prod)
                    @if (($prod!="Titre")&&($prod!="Participant"))
                    <option value="{{ $id_prod[$loop->index] }}" {{ old('id_prest') == $id_prod[$loop->index] ? "selected" : "" }} >{{ $prod }}</option>
                    @endif
                    @endforeach
                </select>
                    <a href="javascript:openCrePro(),closePro()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                <button type="submit" class="btn" style="width:100px">Appliquer</button>
                <button type="button" class="btn cancel" onclick="closePro()" style="width:100px">Annuler</button>
                </form>
        </div>
        <div class="form-clt" id="remproForm">
            <form action="{{ route('facture.removeautreprestation') }}" method="post" class="form-container">
                @csrf
                <h4 style="text-align:center;margin-top:30px;margin-bottom:30px">Enlever prestation : </h4>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px">
                    <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                    <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                    <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                    <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                    <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                    <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                    <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">


                <select name="prest_index" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                    @foreach ($autres_prestations as $prest)
                    <option value="{{ $loop->index }}" {{ old('prest_index') == $loop->index ? "selected" : "" }}>{{ $id_autre_prest[$loop->index] }} {{ $prest->nom_produit }}</option>
                    @endforeach
                    
                </select>
                    <a href="javascript:openCrePro(),closeremPro()"><img style="margin-top:8px;margin-right:5px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                <button type="submit" class="btn" style="width:100px">Appliquer</button>
                <button type="button" class="btn cancel" onclick="closeRemPro()" style="width:100px">Annuler</button>
                </form>
        </div>
        <div class="form-crepck" style="width:900px;background-color:#EDEFF0" id="crepckForm">
            <form action="{{ route('facture.createpack') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <table style="width:220%">
                <th colspan="2"><h1 style="text-align:center;margin-top:30px;margin-bottom:10px">Création Pack </h1> </th>
                <tr>
                <td>
                <img src="https://t4.ftcdn.net/jpg/02/07/87/79/360_F_207877921_BtG6ZKAVvtLyc5GWpBNEIlIxsffTtWkv.jpg" style ="margin-left:65px;margin-bottom:20px; height:280px;width:280px;float:left;border-radius:10px;border:5px #888888 solid" alt="Maxwell Admin">
                <h5><input type="file" id="avatar" name="avatar" value="old('avatar')" accept="image/png, image/jpeg" style="width:350px"></h5>
                </td>
                <td>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px;">
                <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}"  placeholder="Nom" style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                        <input type="text" name="prix" class="form-control" value="{{ old('prix') }}" placeholder="Prix" style="background-color:white;border:2px black  solid"> 
                </div>        
                <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="abstract" class="form-control" value="{{ old('abstract') }}" placeholder="Abstract" style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:20px">
                <h6 style="color:black;margin-left:10px">Description</h6>
                </div>
                <div class="form-contact" style="">
                        <input type="text" name="description" class="form-control" value="{{ old('description') }}" style="height:120px;background-color:white;border:2px black  solid">
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
        <div class="form-crepck" style="width:410px;background-color:#EDEFF0" id="promoForm">
            <form action="{{ route('facture.insertcode') }}" method="post" class="form-container">
                @csrf   
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_.contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <h2 style="width:100%">Choix Code Promo</h2>
                <div class="form-contact" style="margin-bottom:20px">
                <select name="id_code" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:285px;height:50px;float:left;border-radius:4px;">
                    <option value="" selected>Aucun Code</option>
                        @foreach ($codes_promo as $code)
                        <option value="{{ $code->id_code }}" {{ old('id_code') == $code->id_code ? "selected" : "" }}> {{ $code->id_code }} - {{ $code->code }}</option>
                        @endforeach
                </select>
                <a href="javascript:openFormcre(),closeForm()"><img style="margin-top:8px;margin-right:px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                <div class="form-contact" style="margin-left:0px;margin-top:20px;">
                <button type="submit" class="btn">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
                </div></div>
            </form>
        </div>

        <div class="form-crepck" style="width:600px;background-color:#EDEFF0" id="promocreForm">
            <form action="{{ route('facture.createcode') }}" method="post" class="form-container">
                @csrf   
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{ old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{ old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{ old('packs_experience') ?? serialize($packs_experience) }}"> 
                <input type="hidden" id="paiements" name="paiements" value="{{ old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{ old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <h2 style="">Création Code Promo</h2>
                <div class="form-contact" style="margin-bottom:20px">
                <select name="id_remise" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:385px;height:50px;float:left;border-radius:4px;">
                    <option value="" selected>Choisissez une remise</option>
                    @foreach ($nom_remise as $rem)
                    <option value="{{ $id_remise[$loop->index] }}" {{ old('id_remise') == $id_remise[$loop->index] ? "selected" : "" }}> {{ $id_remise[$loop->index] }} - {{ $rem }}</option>
                    @endforeach
                </select>

                </div>
                <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="Code" style="width:385px;margin-left:0px;border:2px #888888  solid">
                </div>
                <div class="form-contact" style="margin-top:20px">
                    <input type="text" name="nb_utilisation" class="form-control" value="{{ old('nb_utilisation') }}" placeholder="Nb d'utilisation" style="width:385px;margin-left:0px;border:2px #888888  solid">
                </div>
                <div class="form-contact" style="margin-top:20px">
                <button type="submit" class="btn">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeFormcre()">Annuler</button>
                </div>
            </form>
        </div>
        <div class="form-crepck" style="width:410px;background-color:#EDEFF0" id="remiseForm">
            <form action="{{ route('facture.insertremise') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <h2 style="width:100%">Choix Remise</h2>
                <div class="form-contact" style="margin-bottom:20px">
                <select name="id_remise" id="pet-select" style="margin-left:0px;background-color:#eee;margin-bottom:20px;width:285px;height:50px;float:left;border-radius:4px;">
                    <option value="" selected>Aucune remise</option>
                    @foreach ($nom_remise as $rem)
                    <option value="{{ $id_remise[$loop->index] }}" {{ old('id_remise') == $id_remise[$loop->index] ? "selected" : "" }}> {{ $id_remise[$loop->index] }} - {{ $rem }}</option>
                    @endforeach
                </select>
                <a href="javascript:openRemisecre(),closeRemise()"><img style="margin-top:8px;margin-right:px;height:30px;border-radius:4px"  src="data:image/png;base64,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"></a>
                </div>
                
                <button type="submit" class="btn">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeRemise()">Annuler</button>
                </div></div>
            </form>
        </div>
        <div class="form-crepck" style="width:410px;background-color:#EDEFF0" id="remisecreForm">
            <form action="{{ route('facture.createremise') }}" method="post" class="form-container">
                @csrf
                <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <center><h2 style="width:100%">Création Remise</h2>
                <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="nom_remise" class="form-control" value="{{ old('nom_remise') }}" placeholder="Nom"style="background-color:white">
                </div>
                <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="type_remise" class="form-control" value="{{ old('type_remise') }}" placeholder="Type"style="background-color:white">
                </div>
                <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                        <input type="text" name="taux" class="form-control" value="{{ old('taux') }}" placeholder="Taux" style="background-color:white">
                </div>
                <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                        <input type="text" name="montant" class="form-control" value="{{ old('montant') }}" placeholder="Montant"style="background-color:white">
                </div> 
                <div class="form-contact" style="margin-top:20px">
                <h6 style="color:black;margin-left:10px">Date Début</h6>
                </div>       
                <div class="form-contact" style="margin-top:0px">
                <input type="date" id="start" name="date_debut" value="{{ old('date_debut') }}" style="width:360px;height:35px;float:right;border-radius:4px;border-color:black;margin-bottom:20px">
                </div>
                <div class="form-contact" style="margin-top:20px">
                <h6 style="color:black;margin-left:10px">Date Fin</h6>
                </div>       
                <div class="form-contact" style="margin-top:0px">
                <input type="date" id="end" name="date_fin" value="{{ old('date_fin') }}" style="width:360px;height:35px;float:right;border-radius:4px;border-color:black;margin-bottom:20px">
                </div>
                <div class="form-contact" style="margin-left:0px;margin-top:20px;">
                <button type="submit" class="btn">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeRemisecre()">Annuler</button>
                </div></div>
            </form>
        </div>
        <div class="form-crepro" style="width:900px;background-color:#EDEFF0" id="creproForm">
            <form action="{{ route('facture.insertnewautreprestation') }}" method="post" class="form-container">
                @csrf
                <table style="width:220%">
                <th colspan="2"><h1 style="text-align:center;margin-top:30px;margin-bottom:10px">Création Prestation </h1> </th>
                <tr>
                <td>
                <img src="https://t4.ftcdn.net/jpg/02/07/87/79/360_F_207877921_BtG6ZKAVvtLyc5GWpBNEIlIxsffTtWkv.jpg" style ="margin-left:65px;margin-bottom:20px; height:280px;width:280px;float:left;border-radius:10px;border:5px #888888 solid" alt="Maxwell Admin">
                <h5><input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" style="width:350px"></h5>
                </td>
                <td>
                <div class="form-contact" style="margin-bottom:20px;margin-top:30px;">
                    <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="nom_produit" class="form-control" value="{{ old('nom_produit') }}" placeholder="Nom" style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:20px;margin-bottom:20px">
                        <input type="text" name="prix" class="form-control" value="{{ old('prix') }}" placeholder="Prix" style="background-color:white;border:2px black  solid"> 
                </div>        
                <div class="form-contact" style="margin-bottom:20px">
                    <select name="categorie" id="pet-select" value="{{ old('categorie') }}" style="background-color:white;margin-bottom:20px;width:340px;height:35px;float:left;border-radius:4px;border-color:black">
                        <option value="" {{ old('categorie') == "" ? "selected" : "" }}>Aucune Categorie</option>
                        <option value="produit"{{ old('categorie') == "produit" ? "selected" : "" }}>Produit</option>
                        <option value="experience" {{ old('categorie') == "experience" ? "selected" : "" }}>Experience</option>
                    </select>
                    <a href=""><img style="margin-left:7px;margin-top:1.5px;height:30px;border-radius:4px" src="data:image/png;base64,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"></a>  
                </div>
                <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="abstract" class="form-control" value="{{ old('abstract') }}" placeholder="Abstract" style="background-color:white;border:2px black  solid">
                </div>
                <div class="form-contact" style="margin-top:20px">
                <h6 style="color:black;margin-left:10px">Description</h6>
                </div>
                <div class="form-contact" style="">
                        <input type="text" name="description" class="form-control" value="{{ old('description') }}" style="height:120px;background-color:white;border:2px black  solid">
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
                        
                    <img src="https://www.devopssec.fr/media/cache/avatar/images/default/empty_profile.jpg" style ="margin-left:65px;margin-bottom:20px; height:280px;width:280px;float:left;border-radius:200px;border:5px #888888 solid" alt="Maxwell Admin">
                    <h5><input type="file" id="avatar" name="avatar" value="{{old('avatar')}}" accept="image/png, image/jpeg" style="width:350px"></h5>
                    </td>
                    <td style="width:305px">
                    <div class="form-contact" style="margin-bottom:0px;margin-top:0px;">
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="Nom" class="form-control" value="{{ old('Nom') }}" placeholder="Nom" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <input type="hidden" id="id_contacts" name="id_contacts" value="{{old('id_contacts') ?? serialize($id_contacts) }}"> 
                    <input type="hidden" id="id_autre_prest" name="id_autre_prest" value="{{old('id_autre_prest') ?? serialize($id_autre_prest) }}"> 
                    <input type="hidden" id="packs_experience" name="packs_experience" value="{{old('packs_experience') ?? serialize($packs_experience) }}"> 
                    <input type="hidden" id="paiements" name="paiements" value="{{old('paiements') ?? serialize($paiements) }}"> 
                    <input type="hidden" id="fact_rem" name="fact_rem" value="{{old('fact_rem') ?? $fact_rem }}">
                    <input type="hidden" id="desc_fact" name="desc_fact" value="{{ $desc_fact }}">
                    <input type="hidden" id="id_code_used" name="id_code_used" value="{{ $id_code_used }}">

                    <div class="form-contact" style="margin-top:0px;margin-bottom:0px">
                            <input type="text" name="Prénom" class="form-control" value="{{ old('Prénom') }}" placeholder="Prénom" style="height:35px;background-color:white;border:2px black  solid"> 
                    </div>        
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="mail" class="form-control" value="{{ old('mail') }}" placeholder="Email" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="tel" class="form-control" value="{{ old('tel') }}" placeholder="Tel" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="adress" class="form-control" value="{{ old('adress') }}" placeholder="Adresse" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="cp" class="form-control" value="{{ old('cp') }}" placeholder="Code postale" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="ville" class="form-control" value="{{ old('ville') }}" placeholder="Ville" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-top:0px">
                            <input type="text" name="url" class="form-control" value="{{ old('url') }}" placeholder="Url Dossier" style="height:35px;background-color:white;border:2px black  solid">
                    </div>
                    <div class="form-contact" style="margin-bottom:0px;margin-top:30px">
                        <label for="pet-select">Entreprise</label>
                    <select name="enteprise" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:385px;height:35px;float:left;border-radius:4px;">
                        <option value="" >Aucune</option>
                        @foreach ($nom_org as $nom)
                        <option value="{{ $id_org[$loop->index] }}" {{ old('entreprise') == $id_org[$loop->index] ? "selected" : "" }}>{{ $nom }}</option>
                        @endforeach
                    </select>
                    </div>  
                    <div class="form-contact" style="margin-top:20px">
                        <input type="text" name="type" class="form-control" value="{{ old('type') }}" placeholder="Type Contact">
                    </div>        
                    </div>
                    </td>
                </tr>
                </table>
                <div class="form-contact" style="margin-bottom:10px;margin-left:350px;width:120%">
                <button type="submit" class="btn" style="width:100px">Appliquer</button>
                <button type="button" class="btn cancel" onclick="closeCreClt()" style="width:100px">Annuler</button>
                </div>
            </form>
        </div>
    
    
</div>  
         
<!-- -----------------HTML-------------------- -->
<div id="modif_client">
    <form id="form_modif_client" method="post" action="{{ route('factures.modif_client_dans_facture') }}">
    @csrf
        <h3>Modification du client</h3>
        <input type="hidden" id="id_contact" name="id_contacts" >
        <div class="une_ligne">
            <label class="lelabel">Nom :</label>
            <input type="text" id="input_nom" name="nom" class="mon linput">
        </div>
        <div class="une_ligne">
            <label class="lelabel">Prénom :</label>
            <input type="text" id="input_prenom" name="prenom" class="premon linput">
        </div>
        <div class="une_ligne">
            <label class="lelabel">Email :</label>
            <input type="text" id="input_email" name="email" class="email linput">
        </div>
        <div class="une_ligne">
            <label class="lelabel">Tel :</label>
            <input type="text" id="input_tel" name="tel" class="tel linput">
        </div>
        <div class="une_ligne">
            <label class="lelabel">Adresse :</label>
            <input type="text" id="input_adresse" name="adresse" class="adresse linput">
        </div>
        <div class="une_ligne">
            <label class="lelabel">code postal :</label>
            <input type="text" id="input_code_postal" name="code_postal" class="code_postal linput">
        </div>
        <div class="une_ligne">
            <label class="lelabel">Ville :</label>
            <input type="text" id="input_ville" name="ville" class="ville linput">
        </div>
        <!-- <div class="une_ligne">
            <label class="lelabel">Numéro CSE :</label>
            <input type="text" id="input_numero_cse" name="numero_cse" class="numero_cse linput">
        </div> -->
        <div class="une_ligne">
            <label  class="lelabel" for="entrep_select">Entreprise :</label>
            <select class="linput"  name="enteprise" id="entrep_select" >
                <option value="0" >Aucune</option>
                <!-- @foreach ($nom_org as $nom)
                <option value="{{ $id_org[$loop->index] }}" {{ old('entreprise') == $id_org[$loop->index] ? "selected" : "" }}>{{ $nom }}</option>
                @endforeach -->
            </select>
        </div>  
        <div class="une_ligne">
            <label class="lelabel">Type :</label>
            <input type="text" id="input_type" name="type" class="type linput">
        </div>
        <div class="div_boutons">
            <button id="envoyer_cli" type="submit" class="btn btn-info my-button">Modifier</button>
            <div id="annuler_cli" class="btn btn-danger my-button">Annuler</div>
        </div>
    </form>
</div>

<script>
    function open_modif_client(id_client) {
        let ce_client = '';
        let liste_contact = {{ Js::from($listecontacts) }};
        // console.log(liste_contact);
        liste_contact.forEach(element => {
            if (element.id_contact == id_client) {
                // console.log(element);
                ce_client = element;
            }
        });
        
        // -----------all organisation 
        let entrep_selected ='';
        let all_organisation = {{ Js::from($all_orga) }};


        // -------------------- afficher la div form --------------------
        var div_form = document.getElementById('modif_client');
        div_form.style.display = "block";
        var le_formulaire = document.getElementById('form_modif_client');
        // -------------------- récupérer les inputs ---------------------
        var id_contact = document.getElementById('id_contact');
        var nom = document.getElementById('input_nom');
        var prenom = document.getElementById('input_prenom');
        var email = document.getElementById('input_email');
        var tel = document.getElementById('input_tel');
        var adresse = document.getElementById('input_adresse');
        var codePostal = document.getElementById('input_code_postal');
        var ville = document.getElementById('input_ville');
        var entrep_select = document.getElementById('entrep_select');
        var type = document.getElementById('input_type');
        // ------------------ affecter les valeurs par défaut ------------------------------
        id_contact.value = id_client;
        nom.value = ce_client.nom;
        prenom.value = ce_client.prenom;
        email.value = ce_client.email;
        tel.value = ce_client.tel;
        adresse.value = ce_client.adresse;
        codePostal.value = ce_client.code_postal;
        ville.value = ce_client.ville;
        // ------ le numero cse
        let id_Organisation ='';
        let contact_cse = {{ Js::from($contactscse) }};
        contact_cse.forEach(element => {
            if (element.id_contact == id_client) {
                console.log(element.type);
                id_Organisation = element.id_organisation;
                type.value = element.type
            }
        });
        // -----------select
        all_organisation.forEach(element => {
            var optionElement = document.createElement('option');
            optionElement.value = element.id_organisation;
            optionElement.text = element.nom;
            if (element.id_organisation == id_Organisation) {
                // console.log(element);
                // ------
                optionElement.selected = true;
            }
            entrep_select.appendChild(optionElement);
        });
        
        // --------------------- récupérer les boutons ----------------------------
        var envoyer = document.getElementById('envoyer_cli');
        var annuler = document.getElementById('annuler_cli');
        // --------------------- un événement sur annuler --------------
        annuler.onclick = function () {
            div_form.style.display = "none";
        };

        // ------------------envoyer le formulaire ---------------------------
        le_formulaire.addEventListener('submit', function(event) {
            // Empêcher le comportement par défaut du formulaire
            event.preventDefault();
            // Effectuer la requête AJAX vers le contrôleur pour le traitement
            const formData = new FormData(le_formulaire);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', le_formulaire.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // const response = JSON.parse(xhr.responseText);
                    // console.log(response);
                    // div_form.style.display = "none";
                    location.reload();
                } else {
                    // Traitement échoué
                    const response = JSON.parse(xhr.responseText);
                    console.log(response);
                }
            };
            xhr.send(formData);
        });
    }
</script>

<!-- -----------------script------------------ -->
<!-- -----------------style------------------ -->
<style>
    #modif_client{
        display:none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9998;
        width: 500px;
        background-color: #7d6b6b;
    }
    #form_modif_client{
        color: black;
        margin: 30px;
        text-align: center;
    }
    .une_ligne{
        display: flex;
        width: 100%;
        margin-top: 5px;
        justify-content: space-around;
    }
    .lelabel{
        width: 30%;
        text-align: left;
    }
    .linput{
        width: 70%;
    }
    .div_boutons{
        display: flex;
        justify-content: space-evenly;
        margin-top: 15px;
    }
</style>
<!-- -----------------style------------------ -->


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
    #pageSubmenu14{
                visibility:visible;
                display:block;
                }
        #pageSubmenu18{
            visibility:visible;
            display:block;
        }
    #M54{
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

<!-- --------------- structure de la page ---------------- -->
<style>
    .le_rectangle{
        z-index: 1;

    }
</style>
@endsection
