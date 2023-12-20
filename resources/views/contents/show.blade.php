@extends('layouts.navadmin')
@section('content')
<div class="container"  style="width:100%;margin:0">
    <div id="content" class="content p-0" >
        <div class="profile-header">
        <center>
            <b style="margin-bottom :20px;font-size:2.5rem;">Info Content_Experience</b>
        </center> 
        <table>
                                    <tr ><td style="font-size:1.3em;text-align:center">
                                    <br>
                                    <br>
                                    <br>
                                        <b>Type Content :       </b> {{ $con->type }}  <br>
                                        <b>Id Content :         </b> {{ $con->id_content_experience }} <br>
                                        <b>Date Content :       </b> {{ Carbon\Carbon::parse($con->date_heure )->format('Y m d H:i')}} <br>
                                        <b>ID Expérience:       </b> {{ $con->id_experience }} <br>
                                        <b>Numéro Expérience:   </b> {{ $con->numero_experience }} <br>
                                        <b>Nom Expérience :     </b> {{ $con->nom_experience }}<br>
                                        <b>Lien Expérience :    </b> <a href="{{ route('experience.show', ['id_experience'=>$con->id_experience,'num_facture'=>$fact->num_facture]) }}"><b style="color:red">GO</b></a>
                                    </td></tr>
                            </table> 
            
        </div>
        <br>
        
        
        <div class="profile-container">
            <div class="row row-space-20" style="margin-top:30px">
            
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about" >
                       
                        <table style=" margin-top:-10px;margin-left:-30px;border-radius:20px;background-image:url(https://pbs.twimg.com/media/Dut5Ui4XQAAcLi0.jpg);background-repeat:no-repeat;background-size: contain;width:170%;height:405px">
                            
                        </table>
                       

                        </div>
                    </div>
                </div> 
                <div class="col-md-4 hidden-xs hidden-sm">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about" >
                            <table>
                            <table style="margin-bottom:38px;margin-left:14rem;width:165%;margin-top:-15px">
                                <thead>
                                     <th colspan="6"><b style="font-size:2.5em;color:#333333">Contacts Liés</th>
                                </thead>
                                 <tbody style="font-size:1.1em;">
                                        <tr>
                                                <td style="margin-right:20px"><b>ID</b></td>
                                                <td style="margin-right:20px"><b>Nom</b></td>
                                                <td style="margin-right:20px"><b>Prenom</b></td>
                                                <td style="margin-right:20px"><b>Email</b></td>
                                                <td style="margin-right:20px"><b>Tel</b></td>
                                        </tr>
                                        @foreach ($contacts_liees as $cont)
                                            <tr>
                                                <td>{{ $cont->id_contact }}</td>
                                                <td>{{ $cont->nom }}</td>
                                                <td>{{ $cont->prenom }}</td>
                                                <td>{{ $cont->email }}</td>
                                                <td>{{ $cont->tel }}</td>
                                                <td><a href="/contacts.show/{{$cont->id_contact}}" style="color:red;padding:0 0 0 2rem"><b>GO</b></a></td>
                                        </tr>
                                        @endforeach
                                        
                                </tbody>       

                            </table>
                            </table>
                            <table  style="margin-left:14rem;width:190%;margin-top:-15px" >
                                <thead>
                                        <th colspan="2"><b style="font-size:2.5em;color:#333333">Description</th>
                                </thead>
                                <tbody>
                                         <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                                <td style="text-align: justify;padding:0.5rem">{{ $con->description_ }}</td>
                                         </tr>
                                 </tbody>
                       
                            </table>
                       

                        </div>
                    </div>
                </div> 
            </div>
            <div class="row row-space-20" style="margin-top:30px;width:118%">
            
            <div class="col-md-4 hidden-xs hidden-sm">
                <div class="tab-content p-0">
                    <div class="tab-pane active show" id="profile-about" >
                    <table style="width:80% ;margin-left:-30px">
                        <thead>
                        <th colspan="2"><b style="font-size:2.5em;color:#333333">Storytelling</th>
                        </thead>
                        <tbody>
                            @foreach ($storytelling as $story)
                            <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                <td style="text-align: justify;padding:0.5rem"><b> {{ Carbon\Carbon::parse($story->date_heure )->format('Y m d H:i')}} </b><br>{{ $story->description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                       
                        <thead>
                            <th colspan="2"><b style="font-size:2.5em;color:#333333">Bons Cadeau</th>
                            </thead>
                            <tbody>
                                @foreach ($bon_cadeau as $bon)
                                <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                    <td style="text-align: justify;padding:0.5rem">
                                        <b> {{ Carbon\Carbon::parse($bon->date_heure)->format('Y m d H:i')}} {{ $bon->titre }}</b>
                                        <br><b>Pour {{ $bon->nom_destinataire }}</b>
                                        <br>{{ $bon->message }}
                                        <!-- <div class="square-container" > style="background-image:url({{ $bon->url }});" -->
                                                        <!-- il n'y a pas d'erreur ça marche !! -->
                                        <!-- <img src ="{{ $bon->url }}" style ="width:100%;object-fit : cover"> -->
                                        <iframe src="https://drive.google.com/file/d/1sUx6YYW8g_yWzLykfaYWi40w7YO5UUaE/preview" width="100%" height="100%" allow="autoplay"></iframe>
                                        <!-- </div> -->
                                    </td>
                                </tr>
                                @endforeach
                           
                                        
                            </tbody>
                        </table>

                        <table style="width:80% ;margin-left:-30px">
                        <thead>
                        <th colspan="2"><b style="font-size:2.5em;color:#333333">SMS</th>
                        </thead>
                        <tbody>
                       
                        <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                        <td style="text-align: justify;padding:0.5rem"><b> SMS de Harena  </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry .</td>
                                    
                        </tbody>
                       
                        </table>
                        <table style="width:80% ;margin-left:-30px">
                        <thead>
                        <th colspan="2"><b style="font-size:2.5em;color:#333333">Email</th>
                        </thead>
                        <tbody>
                        <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                        <td style="text-align: justify;padding:0.5rem"><b> Email de Mohammed</b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and .</td>
                                    </tr>
                        
                        </tbody>
                       
                        </table>
                   

                    </div>
                </div>
            </div> 
            <div class="col-md-4 hidden-xs hidden-sm" >
                <div class="tab-content p-0">
                    <div class="tab-pane active show" id="profile-about" >
                    <table style="width:80% ;margin-left:-80px">
                        <thead>
                        <th colspan="2"><b style="font-size:2.5em;color:#333333">Son</th> 
                            {{-- @dd($content_son) --}}
                        </thead>
                        <tbody>
                           
                        <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                            @if(!is_null($content_son))         
                            <td style="text-align: justify;padding:0.5rem"><b>ID : {{$content_son->id_son}}</b></td>
                                    </tr>
                                    <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                        <td style="text-align: justify;padding:0.5rem"><b>DESC : {{$content_son->description}}</b></td>
                                    </tr>
                                    <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                        <td style="text-align: justify;padding:0.5rem">
                                            {{-- <b> url : {{$content_son->url}} </b> --}}
                                            <audio controls>
                                                <source src="{{$content_son->url}}" type="audio/mp3">
                                                {{-- <source src="{{$content_son->url}}" type="audio/webm">
                                                <source src="{{$content_son->url}}" type="audio/ogg">
                                                <source src="{{$content_son->url}}" type="audio/wav"> --}}
                                                Votre navigateur ne prend pas en charge l'élément audio.
                                              </audio>
                                        </td>
                             @else 
                             <td>Le content ne contient pas de son pour le moment</td>
                             @endif
                                    </tr>
                        </tbody>
                       
                        </table>
                        <table style="width:80% ;margin-left:-80px">
                            <thead>
                                <th colspan="2"><b style="font-size:2.5em;color:#333333">Livrable</th>
                            </thead>
                            <tbody>
                                <!-- <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                    <td style="text-align: justify;padding:0.5rem"><b> Disque Vinyle  </b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and .</td>
                                </tr> -->
                                @foreach ($livrable as $livra)
                                <tr style="float:left ;border-radius:10px;margin-bottom:10px">
                                    <td style="text-align: justify;padding:0.5rem">
                                        <b> {{ Carbon\Carbon::parse($livra->date_envoie)->format('Y m d H:i')}}</b>
                                        <br><b>{{ $livra->nom }}</b>
                                        <!-- <br>{{ $livra->url }} -->
                                        <div  >
                                            <img style="margin-top:10px; width:100%; height:100%;border-radius: 10px; " src="{{ asset($livra->url)}}" alt="image d'illustration">
                                                        <!-- il n'y a pas d'erreur ça marche !! -->
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <table style="width:80% ;margin-left:-80px">
                        <thead>
                        <th colspan="2"><b style="font-size:2.5em;color:#333333">Intéraction</th>
                        </thead>
                        <tbody>
                       
                        <tr>
                            <td>
                        <div style="padding:0.5rem;text-align: justify;;background-color:#888888;width:300px;height:515px;float:left;border-radius:1px;overflow:auto;">
                        <ul style="margin-left:-30px">
                            @foreach ($interactions as $int)
                                <li><b style="font-size:1.2em">{{ Carbon\Carbon::parse($int->date_heure)->format('Y m d H:i')}} {{ $int->type_interaction }}</b><br> {{ $int->texte }}</li>
                            @endforeach

                        </ul>
                        </div>
                            </td>
                        </tr>
                       
                        </tbody>
                       
                        </table>

                    </div>
                </div>
            </div> 
            <div class="col-md-4 hidden-xs hidden-sm">
                <div class="tab-content p-0">
                    <div class="tab-pane active show" id="profile-about" >
                    <table style="margin-left:-120px;" >
                        <thead>
                        <th colspan="2"><b style="font-size:2.5em;color:#333333">Photos</th>
                        </thead>
                        {{-- @dd($content_photo) --}}
                        <tbody>
                            @if(!is_null($content_photo))
                        <tr >
                            
                            <td> ID : {{$content_photo->id_photo}}</td>
                        </tr>
                        <tr>
                            <td>DESC : {{$content_photo->description}}</td>
                        </tr>
                        <tr>
                            <td  class="image-container">
                                <img src="{{$content_photo->url}}" alt="{{$content_photo->url}}" >
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td>Le content ne contient pas de photo pour le moment</td>
                        </tr>
                        @endif
                        </tbody>
                        {{-- @dd($content_video) --}}
                        </table>
                        <table style="margin-left:-120px;" >
                        <thead>
                        <th colspan="2"><b style="font-size:2.5em;color:#333333">Vidéos</th>
                        </thead>
                        <tbody> 
                            {{-- @dd($content_video) --}}
                            @if(!is_null($content_video))
                        <tr >
                            <td> ID : {{$content_video->id_video}}</td>
                        </tr>
                        <tr>
                            <td> DESC : {{$content_video->description}}</td>
                        </tr>
                        <tr>
                        <td>
                            <iframe width="100%" src="{{$content_video->url}}" frameborder="0" allow="autoplay" allowfullscreen></iframe>
                            <!-- <video src="{{$content_video->url}}" controls>
                                Votre navigateur ne prend pas en charge la balise vidéo.
                              </video> -->
                                <!-- {{-- url : {{$content_video->url}} --}} -->
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td>Le content ne contient pas de video pour le moment</td>
                        </tr>
                            @endif
                       
                        </tbody>
                       
                        </table>
                   

                    </div>
                </div>
            </div> 
           
        </div>
        </div>
                    
    </div>
    </div>


<STYLE>
    body {
        background: #eaeaea;
    }
    .image-container {
  width: 100%; 
  height: auto; }
.image-container img {
  max-width: 100%;
  height: auto;
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
#M96{
background-color: #747474;
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
   text-align: left;
   font-size: 12px;
}
#dash{
    
    font-size:0.9em;
   
    text-align:center;
    
   
   
    
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
   position: left;

   left: -50%;
   text-align: left;
   font-size: 12px;
}
/* ---------------------------- */
.square-container {
    position: relative;
    margin-top: 10px;
    width: 100%;
    padding-top: 100%; /* La hauteur est égale à la largeur */
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
    border-radius: 10px;
}
</style>

@endsection