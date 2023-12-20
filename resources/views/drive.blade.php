<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" id="myfile" name="myfile">
    <button type="submit">Envoyer</button>
    <br><br><br>
    <input type="file" id="video" name="video">
    <label class="mx-2" for="youtubeLink"> Lien Video youtube</label>
    <input type="text" id="youtubeLink" name="video_youtube">
    

    <div style=" width:300px; height:300px; margin:20px auto">
        @isset($photo)
            <img style="width:300px; height:300px; margin:auto" src="{{$photo}}" alt="">  
        @else
            hello moto
        @endisset
        
    </div>
    <div style=" width:300px; height:300px; margin:20px auto">
        @isset($photo)
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$video_youtube}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> 
        @else
            hello moto
        @endisset
        
    </div>
    <video style=" width:300px; height:300px; margin:20px auto" width="320" height="240" controls>
        @isset($video)
        <source src="{{$video}}" type="video/mp4">
        @else
            pas de videos
        @endisset
      </video>
    
</form>