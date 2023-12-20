@extends('layouts.navadmin')
@section('content')
<div class="container"  style="width:100%;margin:0">
    <div id="content" class="content p-0" >
        <div class="profile-header" style="margin-bottom :50px;">
        <center>
            <b style="margin-bottom :20px;font-size:2.5rem;">Info Bon Cadeau</b>
        </center>   
            
        </div>
        <br>
        <div class="profil-container" style="margin-bottom:50px">
        <table>
                <tr>
                    <td>
                    <div class="profile-header-content">
                            <div class="profile-header-img" style="background:none;padding:0">
                                     <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4xj0iSqUrByq6k1TGf6Z8AoRg1tGXUujma2RKRTpBkWzEGXRdn1RvvSgKOJGPvDIQgJc&usqp=CAU" alt="Admin" class="rounded-circle p-1 bg-primary" width="100px">
                            </div >
                    </div>      
                    </td>
                    <td>
                    <div class="profile-header-name">
                           <table style="margin-left:-30px">
                            <th colspan="2">
                            <b style="font-size:2.3em;"> {{ $con->nom }} {{ $con->prenom }}</b>
                            </th>
                            <tr>
                                <td style="text-align:right;width:30%"><b>id contact : </b></td>
                                <td style="text-align:center">{{ $con->id_contact }}</td>
                                
                            </tr>
                          
                            <tr>
                                
                                
                                <td style="text-align:right;width:30%"><b >Email : </b></td>
                                <td style="text-align:center">{{ $con->email }}</td>
                            </tr>
                            <tr>
                                
                                
                                <td style="text-align:right;width:40%"><b >Tel: </b></td>
                                <td style="text-align:center">{{ $con->tel }}</td>
                            </tr>
                           </table>
                           
                    </td>

                </tr>

            </table>

           
                   
        </div> 
        <div>
            
        </div>
        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                        <table style="margin-bottom:-50px;width:120%;margin-top:3px">
                            <tr style="font-size:1.5em">
                                <td><b style="margin-right:10px">Id : </b></td><td style="margin-right:10px">{{ $cadeau->id_bonCadeau }}</td>
                                <td><b style="margin-right:10px">Date et Heure:</b></td><td style="margin-right:10px">{{ Carbon\Carbon::parse($cadeau->date_heure )->format('Y m d H:i')}}</td>
                            </tr>
                        </table>    
                        <table style=" margin-top:50px;border-radius:10px;background-image:url(https://images.rouxel.com/400/35301.jpg);background-repeat:no-repeat;background-size: contain;width:120%;height:400px">
                            
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                        
                        <table style="width: 150%;margin-left:50px">
                                   <thead>
                                        <tr>
                                        <th colspan="2" style="padding:0 0 1rem 0"><b style="font-size:2.5em;color:#333333">Titre</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    
                                    <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                        <td style="text-align: justify;padding:0.5rem">{{ $cadeau->titre }}</td>
                                    </tr>
                                    </tbody>

                                </table>
                        <table style="width: 150%;margin-left:50px">
                                   <thead>
                                        <tr>
                                        <th colspan="2" style="padding:0 0 1rem 0"><b style="font-size:2.5em;color:#333333">Message</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    
                                    <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                        <td style="text-align: justify;padding:0.5rem">{{ $cadeau->message }}</td>
                                    </tr>
                                    </tbody>

                                </table>       
                                <table style="width: 150%;margin-left:50px">
                                   <thead>
                                        <tr>
                                        <th colspan="2" style="padding:0 0 1rem 0"><b style="font-size:2.5em;color:#333333">Description</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    
                                    <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                        <td style="text-align: justify;padding:0.5rem">{{ $cadeau->description_ }}</td>
                                    </tr>
                                    </tbody>

                                </table>
                               
                        </div>
                        
                    </div>
                   
                </div>
                <div class="col-md-4 ">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about" style="margin-right:-100px">
                        <table style="width:70%;margin-left:200px">
                                   <thead>
                                        <tr>
                                        <th colspan="2" style="padding:0"><b style="font-size:2.5em;color:#333333">Info Expérience</th>
                                        <th style=""><a href="{{ route('experience.show',['id_experience'=>$experience->id_experience,'num_facture'=>$experience->num_facture]) }}"><b style="color:red;font-size:2em">GO</b></a></th> 
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td ><b style="font-size:1.2em;">Numero Experience: </b></td><td>{{ $experience->numero_experience }}</td>
                                    </tr>
                                    <tr >
                                    <td ><b style="font-size:1.2em;">Nom Exp : </b></td><td>{{ $experience->nom_experience }}</td>
                                    </tr>
                                    <tr>

                                    <td ><b style="font-size:1.2em;">Statut Exp : </b></td><td>{{ $experience->statut_experience }}</td>
                                                                                                                    
                                    </tr>
                                   
                                    </tbody>

                                </table> 
                                <table  style="width:70%;margin-left:200px;">
                                <thead>
                                        <tr>
                                        <th colspan="2" ><b style="font-size:2.5em;color:#333333">Info Client</th>
                                        <th ><a href="/contacts.show/{{$con->id_contact}}"><b style="color:red;font-size:2em">GO</b></a></th> 
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
                                            {{ $con->num_cse }}
                                        </td>
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                            
                               
                        </div>
                    </div>
                   
                </div>
              
                    </div>
                    
                    </div>


<STYLE>
    body {
        background: #eaeaea;
    }
    

    .profile-info-list {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    .friend-list,
    .img-grid-list {
        margin: -1px;
        list-style-type: none;
    }

    .profile-info-list>li.title {
        font-size: 0.625rem;
        font-weight: 700;
        color: #8a8a8f;
        padding: 0 0 0.3125rem;
    }

    .profile-info-list>li+li.title {
        padding-top: 1.5625rem;
    }

    .profile-info-list>li {
        padding: 0.625rem 0;
    }

    .profile-info-list>li .field {
        font-weight: 700;
    }

    .profile-info-list>li .value {
        color: #666;
        
    }

    .profile-info-list>li.img-list a {
        display: inline-block;
    }

    .profile-info-list>li.img-list a img {
        max-width: 2.25rem;
        -webkit-border-radius: 2.5rem;
        -moz-border-radius: 2.5rem;
        border-radius: 2.5rem;
    }

    .coming-soon-cover img,
    .email-detail-attachment .email-attachment .document-file img,
    .email-sender-img img,
    .friend-list .friend-img img,
    .profile-header-img img {
        max-width: 100%;
    }

    .table.table-profile th {
        border: none;
        font-size:25px;
        color: black;
        padding-bottom: 1rem;
        padding-top: 0;
    }

    .table.table-profile td {
        
        border-color: #c8c7cc;
        font-size:12px;
        padding: 0 0 0 1rem;
       
       
    }


    .table.table-profile tbody+thead>tr>th {
        padding-top: 1.5625rem;
      
    }

    .table.table-profile .field {
        color: #666;
        font-weight: 600;
        width: 25%;
        text-align: right;
       
    }

    .table.table-profile .value {
        font-weight: 500;
    }

    .profile-header {
        position: relative;
        overflow: hidden;
    }

    .profile-header .profile-header-cover {
        background: url(https://www.digitalacademy.fr/wp-content/uploads/2021/10/loei-thailand-may-10-2017-hand-holding-samsung-s8-with-mobi-1230x310.jpg) center no-repeat;
        background-size: 100% auto;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    .profile-header .profile-header-cover:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0, rgba(0, 0, 0, 0.85) 100%);
    }

    .profile-header .profile-header-content,
    .profile-header .profile-header-tab,
    .profile-header-img,
    body .fc-icon {
        position: relative;
    }

    .profile-header .profile-header-tab {
        background: #fff;
        list-style-type: none;
        margin: -1.25rem 0 0;
        padding: 0 0 0 8.75rem;
        border-bottom: 1px solid #c8c7cc;
        white-space: nowrap;
    }

    .profile-header .profile-header-tab>li {
        display: inline-block;
        margin: 0;
    }

    .profile-header .profile-header-tab>li>a {
        display: block;
        color: #000;
        line-height: 1.25rem;
        padding: 0.625rem 1.25rem;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.75rem;
        border: none;
    }

    .profile-header .profile-header-tab>li.active>a,
    .profile-header .profile-header-tab>li>a.active {
        color: #007aff;
    }

    .profile-header .profile-header-content:after,
    .profile-header .profile-header-content:before {
        content: "";
        display: table;
        clear: both;
    }

    .profile-header .profile-header-content {
        color: #fff;
        padding: 1.25rem;
    }

    body .fc th a,
    body .fc-ltr .fc-basic-view .fc-day-top .fc-day-number,
    body .fc-widget-header a {
        color: #000;
    }

    .profile-header-img {
        float: left;
        width: 7.5rem;
        height: 7.5rem;
        overflow: hidden;
        z-index: 10;
        margin: 0 1.25rem -1.25rem 0;
        padding: 0.1875rem;
        -webkit-border-radius: 0.25rem;
        -moz-border-radius: 0.25rem;
        border-radius: 0.25rem;
        background: #fff;
    }

    .profile-header-info h4 {
        font-weight: 500;
        margin-bottom: 0.3125rem;
    }

    .profile-container {
        padding: 1.5625rem;
    }

    @media (max-width: 967px) {
        .profile-header-img {
            width: 5.625rem;
            height: 5.625rem;
            margin: 0;
        }

        .profile-header-info {
            margin-left: 6.5625rem;
            padding-bottom: 0.9375rem;
        }

        .profile-header .profile-header-tab {
            padding-left: 0;
        }
    }

    @media (max-width: 767px) {
        .profile-header .profile-header-cover {
            background-position: top;
        }

        .profile-header-img {
            width: 3.75rem;
            height: 3.75rem;
            margin: 0;
        }

        .profile-header-info {
            margin-left: 4.6875rem;
            padding-bottom: 0.9375rem;
        }

        .profile-header-info h4 {
            margin: 0 0 0.3125rem;
        }

        .profile-header .profile-header-tab {
            white-space: nowrap;
            overflow: scroll;
            padding: 0;
        }

        .profile-container {
            padding: 0.9375rem 0.9375rem 3.6875rem;
        }

        .friend-list>li {
            float: none;
            width: auto;
        }
    }

    .profile-info-list {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    .friend-list,
    .img-grid-list {
        margin: -1px;
        list-style-type: none;
    }

    .profile-info-list>li.title {
        font-size: 0.625rem;
        font-weight: 700;
        color: #8a8a8f;
        padding: 0 0 0.3125rem;
    }

    .profile-info-list>li+li.title {
        padding-top: 1rem;
    }

    .profile-info-list>li {
        padding: 0.6rem 0;
    }

    .profile-info-list>li .field {
        font-weight: 700;
    }

    .profile-info-list>li .value {
        color: #666;
    }

    .profile-info-list>li.img-list a {
        display: inline-block;
    }

    .profile-info-list>li.img-list a img {
        max-width: 2.25rem;
        -webkit-border-radius: 2.5rem;
        -moz-border-radius: 2.5rem;
        border-radius: 2.5rem;
    }

    .coming-soon-cover img,
    .email-detail-attachment .email-attachment .document-file img,
    .email-sender-img img,
    .friend-list .friend-img img,
    .profile-header-img img {
        max-width: 100%;
    }

    

    .table.table-profile td {
        border: none;
        
    }

    .table.table-profile tbody+thead>tr>th {
        padding-top: 1rem;
        
    }

    .table.table-profile .field {
        color: #666;
        font-weight: 600;
        width: 30%;
        text-align: left;
    }

    .table.table-profile .value {
        font-weight: 250;
       
    }

    .friend-list {
        padding: 0;
    }

    .friend-list>li {
        float: left;
        width: 40%;
    }

    .friend-list>li>a {
        display: block;
        text-decoration: none;
        color: #000;
        padding: 0.625rem;
        margin: 1px;
        background: #fff;
    }

    .friend-list>li>a:after,
    .friend-list>li>a:before {
        content: "";
        display: table;
        clear: both;
    }

    .friend-list .friend-img {
        float: left;
        width: 3rem;
        height: 3rem;
        overflow: hidden;
        background: #efeff4;
    }

    .friend-list .friend-info {
        margin-left: 3.625rem;
    }

    .friend-list .friend-info h4 {
        margin: 0.3125rem 0;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .friend-list .friend-info p {
        color: #666;
        margin: 0;
    }
    #pageSubmenu10{
    visibility:visible;
    display:block;
    }
    #pageSubmenu15{
            visibility:visible;
            display:block;
            }
            #pageSubmenu18{
            visibility:visible;
            display:block;
        }
    #M57{
    background-color: #747474;
    }
    #dash{
        
        font-size:0.9em;
        text-align:center;
        
    }
    
</STYLE>

<style>
    .timeline {
  border-left: 1px solid hsl(0, 0%, 90%);
  position: relative;
  list-style: none;
    }

.timeline .timeline-item {
  position: relative;
}

.timeline .timeline-item:after {
  position: absolute;
  display: block;
  top: 0;
}

.timeline .timeline-item:after {
  background-color: hsl(0, 0%, 90%);
  left: -38px;
  border-radius: 50%;
  height: 11px;
  width: 11px;
  content: "";
}
.history-tl-container ul.tl{
   
   padding:0.5rem;
   display:inline-block;

}
.history-tl-container ul.tl li{
   list-style: none;
 
   margin-left:120px;
   
   /*background: rgba(255,255,0,0.1);*/
   border-left:3px solid  black;
   padding:10px 0 50px 30px;
   position:relative;
}
.history-tl-container ul.tl li:last-child{ border-left:0;}
.history-tl-container ul.tl li::before{
   position: absolute;
   left: -11px;
   top: -5px;
   content: " ";
   border: 8px solid rgba(255, 255, 255, 0.74);
   border-radius: 1000%;
   background: blue;
   height: 20px;
   width: 20px;
   

}
.history-tl-container ul.tl li:hover::before{
   border-color:  #258CC7;
   
}
ul.tl li .item-title{
}
ul.tl li .item-detail{
   color:rgba(0,0,0,0.5);
   font-size:12px;
}
ul.tl li .timestamp{
   color: #8D8D8D;
   position: absolute;
 width:100px;
   left: -50%;
   text-align: right;
   font-size: 12px;
}

.history-tl-container ul.tl{
   
   padding:0.5rem;
   display:inline-block;

}
.history-tl-container ul.tl li{
   list-style: none;
 
   margin-left:120px;
   
   /*background: rgba(255,255,0,0.1);*/
   border-left:3px solid  black;
   padding:10px 0 50px 30px;
   position:relative;
}
.history-tl-container ul.tl li:last-child{ border-left:0;}
.history-tl-container ul.tl li::before{
   position: absolute;
   left: -11px;
   top: -5px;
   content: " ";
   border: 8px solid rgba(255, 255, 255, 0.74);
   border-radius: 1000%;
   background: blue;
   height: 20px;
   width: 20px;
   

}
.history-tl-container ul.tl li:hover::before{
   border-color:  #258CC7;
   
}
ul.tl li .item-title{
}
ul.tl li .item-detail{
   color:rgba(0,0,0,0.5);
   font-size:12px;
}
ul.tl li .timestamp{
   color: #8D8D8D;
   position: absolute;
 width:100px;
   left: -50%;
   text-align: right;
   font-size: 12px;
}
</style>

@endsection