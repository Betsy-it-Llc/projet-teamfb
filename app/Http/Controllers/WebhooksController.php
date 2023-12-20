<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContentExperience;
use App\Models\experienceApp\BonCadeau;
use App\Models\experienceApp\Experience;
use Illuminate\Http\Request;

class WebhooksController extends Controller
{
    public function handleBonCadeau(Request $request) {
        sleep(10);
        $file1 = $request->file('file');
        $file2 = $request->file('file');
        $fileName = $request->fileName;
        $fileSize = $file1->getSize();
        $fileType = $file1->getMimeType();
        $extension = $file1->getClientOriginalExtension();

        $experience = Experience::where('numero_experience',$request->numero_experience)->first();
        $content = ContentExperience::where('type','bon cadeau')
                    ->where('id_experience',$experience->id_experience)->orderByDesc('id_content_experience')->first();
        $bon_cadeau = BonCadeau::where('id_content_experience', $content->id_content_experience)->first();
        $bon_cadeau->save();

        $newFileName = preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $fileName.'.jpg');
        $processedFileName=preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $fileName);
        // on ajoute le fichier a l'instance du modèle
        // $bon_cadeau->addMedia($file1)
        // ->usingFilename($newFileName)
        // ->toMediaCollection('bon_cadeau/'.$processedFileName,'google');
        // $bon_cadeau->save();
        $experience->addMedia($file2)
        // ->withCustomProperties(['folder' => 'Cloud_Laravel_App/Ressources/Produits/image_produit-'.$produitservice->nom_produit]) exemple envoyer des custom properties
        ->usingFilename($newFileName)
        ->toMediaCollection('bon_cadeau/'.$processedFileName,'google');
        $experience->save();
        
        //upload success
        $success='Le fichier a été ajouté avec succès';


        return response(200);
    }
}