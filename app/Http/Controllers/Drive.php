<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\VideoYoutube;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class Drive extends Controller
{
   // ce fichier est un brouiller tout comme sa vue (drive.blade.php) , il m'a servit à comprendre comment fonctionne media library , il peut encore être utile
   public function test(Request $request){
    $youtubeLink=$request->input('video_youtube');
    if($youtubeLink){
        $filePath = storage_path('app/file.txt');
        $bibi="bibi";

        // Ajoutez le texte au fichier existant
        file_put_contents($filePath, $youtubeLink,FILE_APPEND);

        //Storage::disk('google')->put($myfile->getClientOriginalName(), File::get($myfile->getRealPath()));
        //Gdrive::put($myfile->getClientOriginalName(), $myfile);
        $commentaire=Commentaire::findorfail(44);
        $commentaire->id_contact="307";
        $commentaire->id_experience="322";
        $commentaire->texte=$bibi;
        $commentaire->addMedia($filePath)
        ->withCustomProperties(['folder' => 'video_youtube','youtube_link'=> $youtubeLink])
        ->usingFileName($bibi.'.txt')
        ->toMediaCollection('video_youtube','google');
        $commentaire->save();

        // Effacez le contenu du fichier
        file_put_contents($filePath, '');
        return redirect()->to('drive');
    }
    $commentaire=Commentaire::findorfail(44);
    //dd($commentaire->getFirstMedia('video_youtube')->delete());
    $video_youtube=null;
    if($commentaire->getFirstMedia('video_youtube')){
        $video_youtube=$commentaire->getFirstMedia('video_youtube')->getCustomProperty('youtube_link');
    }



    $myfile = $request->file('myfile');
    if($myfile){
        
        $commentaire=Commentaire::findorfail(44);
        $commentaire->id_contact="307";
        $commentaire->id_experience="322";
        $commentaire->texte=$myfile->getClientOriginalName();
        $commentaire
            ->clearMediaCollection('image_produit')
            ->addMedia($myfile)
            ->withCustomProperties(['folder' => 'Cloud_Laravel_App/Ressources/Produits'])
            ->toMediaCollection('photo_simple','google');
        $commentaire
            ->save();
        return redirect()->to('drive');
    }
    $commentaire=Commentaire::findorfail(44);
    //dd($commentaire->getFirstMedia('photo_simple')->delete());
    //dd($commentaire->setCustomProperty('youtube_link', 'https://www.youtube.com/watch?v=PU81boOXPmo'));
    //dd($commentaire->getMedia());
    $photo=null;
    if($commentaire->getFirstMedia('photo_simple')){
        $photo=$commentaire->getFirstMedia('photo_simple')->getUrl();
    }
    

    $video = $request->file('video');
    if($video){

        //Storage::disk('google')->put($myfile->getClientOriginalName(), File::get($myfile->getRealPath()));
        //Gdrive::put($myfile->getClientOriginalName(), $myfile);
        $commentaire=Commentaire::findorfail(44);
        $commentaire->id_contact="307";
        $commentaire->id_experience="322";
        $commentaire->texte=$video->getClientOriginalName();
        $commentaire->addMedia($request->file('video'))
        ->withCustomProperties(['folder' => 'video_tag'])
        ->toMediaCollection('video','google');
        $commentaire->save();
        return redirect()->to('/drive');
    }
    //dd($commentaire->getFirstMedia('video')->delete());
    $video=null;
    if($commentaire->getFirstMedia('video')){
    $video=$commentaire->getFirstMedia('video')->getUrl();
    }
    

    $parts = parse_url($video_youtube);
if (isset($parts['query'])) {
    parse_str($parts['query'], $query);
    if (isset($query['v'])) {
        $video_youtube = $query['v'];
    }
}
    
    //dd('Liens des fichiers ajoutés à la table avec succès');
    return view('drive',compact('commentaire','video', 'photo','video_youtube'));
   }
}