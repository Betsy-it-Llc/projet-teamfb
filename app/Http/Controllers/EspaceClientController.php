<?php

namespace App\Http\Controllers;


use App\Models\Projets;
use App\Models\Cagnotte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\experienceApp\Media;
use App\Models\experienceApp\Contact;

class EspaceClientController extends Controller
{
    public function temporaire()
    {   
        // Récupérez le contact en fonction de l'email de l'utilisateur authentifié
        $contact = Contact::where('email', auth()->user()->email)->first();

        // if ($contact) {
        return view('utilisateurcontribution.espaceclient.temporaire');
        // }

        // Gérez le cas où le contact n'est pas trouvé.
        // Vous pouvez rediriger l'utilisateur vers la page de connexion ou gérer l'erreur selon vos besoins.
        // return redirect('/login');
    }

    public function accueil(Request $request)
    {
        // Récupérez le contact en fonction de l'email de l'utilisateur authentifié
        $contact = Contact::where('email', auth()->user()->email)->first();

        $filenameOnDrive=$this->getMediaName('photo_profil',0);
        $photo_profil=null;
        if($filenameOnDrive){
            $photo_profil=$contact->getFirstMedia('photo_profil/'.$filenameOnDrive);
            //dd($photo_profil->getUrl());
            if($request->has('delete_file')){
                $media=$contact->getFirstMedia('photo_profil/'.$filenameOnDrive);
                // suppression du media
                $media->delete();
                // suppression success
                        
                return redirect()->back();
            }
        }
        $file = $request->file('file');
        if($file){ 
            $this->sendContentToDrive($request,'photo_profil',$this->validationForImages($request));
            return redirect()->back();
        }
        
        if ($contact) {
            
            return view('utilisateurcontribution.espaceclient.accueil', ['contact' => $contact,"photo_profil"=>$photo_profil]);
        }

        return redirect('/login');
    }


    public function public()
    {

        return view('utilisateurcontribution.espaceclient.pagepublic');
    }

    public function sendContentToDrive($request,$destination,$validationFunction){
        // JM upload image
        //gestion des erreurs
        $contact = Contact::where('email', auth()->user()->email)->first();
        $id_contact = $contact->id_contact;
        
        
        // on trouve l'id expérience 
        $contact=Contact::findorfail($id_contact);
        // on récupère le fichier venant de l'input file de la vue
        $file = $request->file('file');
        
        // si le fichier existe on execute le code
        if($file && $validationFunction ){
            // on recupère l'extension
            $extension = $file->getClientOriginalExtension();
            // on recupère le nom du fichier via l'input
            $originalFileName = $request->input('file');

            if($request->input('file')==""){
                // nom originale sans l'extenstion
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            }
            
            // on enlève les espaces, les accents
            $newFileName = preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName.'.'.$extension);
            $processedFileName=preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName);

            if($this->getMediaName('photo_profil',0)){
                $contact->getFirstMedia('photo_profil/'.$this->getMediaName('photo_profil',0))->delete();
            }
            // on ajoute le fichier a l'instance du modèle
            $contact->addMedia($file)
                ->usingFilename($newFileName)
                ->toMediaCollection($destination.'/'.$processedFileName,'google');
            $contact->save();
            
            //upload success
            $success='Le fichier a été ajouté avec succès';
            
            // Stockez la variable $success_image dans la session flash
            session()->flash('success', $success);
            return redirect()->back();
        }
    }

    public function validationForImages($request){
        $validate=$request->validate([
            'file' => 'required|image|mimes:jpeg,png,gif,jpg,bmp,tiff,webp,svg,ico,tga,pcx,pbm,pgm,ppm', // Acceptez uniquement les formats JPEG, PNG et GIF.
        ]);
        return $validate;
    }

    public function getMediaName($Collection,$index){

        if(Media::where('collection_name', 'LIKE', '%'.$Collection.'%')->get()){
            $fichiers=Media::where('collection_name', 'LIKE', '%'.$Collection.'%')->get();
            if(isset($fichiers[$index])){
                $nomDeFichier=explode(".",$fichiers[$index]->file_name)[0];
            }else{
                $nomDeFichier=null;
            }
            return $nomDeFichier;
        }
    }
}
