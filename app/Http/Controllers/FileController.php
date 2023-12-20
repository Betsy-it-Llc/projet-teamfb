<?php

namespace App\Http\Controllers;

use App\Models\ContactExperience;
use App\Models\experienceApp\Experience;
use App\Models\Contact;
use App\Models\experienceApp\BonCadeau;
use App\Models\Facture;
use App\Models\experienceApp\Organisation;
use App\Models\Cause;
use App\Models\Paiement;
use App\Models\Projets;
use App\Models\experienceApp\Intervenant;
use App\Models\experienceApp\ProduitService;
use App\Models\experienceApp\Pack;
use App\Models\experienceApp\Remise;
use App\Models\experienceApp\Codepromo;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Google_Client;
use Google_Service_Drive;

class FileController extends Controller
{
    public function createDocs(Request $request){
        set_time_limit(500);
        $models = [
            'Experience',
            'Contact',
            'BonCadeau',
            'Facture',
            'Organisation',
            'Projet',
            'Intervenant',
            // 'Studio',
            'ProduitsService',
            'Pack',
            'Remise',
            'CodesPromo'
        ];
    
        foreach ($models as $modelName) {
            // Instanciez le modèle correspondant
            $model = '\\App\\Models\\' . $modelName;
            // Récupérez tous les enregistrements de ce modèle depuis la base de données
            $records = $model::all();
            $primaryKey = (new $model)->getKeyName();

            if($modelName == "Experience"){
                $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/experience.txt';
                $contenu = "id_experience,Nom_Experience,Nom_Client,Prenom_Client\r\n";

                // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                file_put_contents($nom_fichier, $contenu);
            }
            if($modelName == "Contact"){
                $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/contact.txt';
                $contenu = "id_contact,Nom_Client,Prenom_Client\r\n";

                // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                file_put_contents($nom_fichier, $contenu);
            }

            if($modelName == "Facture"){
                $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/facture.txt';
                $contenu = "num_facture,Nom_Client,Prenom_Client,Prix_Facture\r\n";

                // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                file_put_contents($nom_fichier, $contenu);
            }

            if($modelName == "ProduitsService"){
                $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/produits_service.txt';
                $contenu = "id_produit,nom_produit\r\n";

                // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                file_put_contents($nom_fichier, $contenu);
            }

            if($modelName == "Pack"){
                $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/pack.txt';
                $contenu = "id_pack,nom_pack\r\n";

                // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                file_put_contents($nom_fichier, $contenu);
            }

            if($modelName == "Remise"){
                $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/remise.txt';
                $contenu = "id_remise,nom_remise\r\n";

                // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                file_put_contents($nom_fichier, $contenu);
            }

            if($modelName == "CodesPromo"){
                $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/codes_promo.txt';
                $contenu = "id_code,code\r\n";

                // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                file_put_contents($nom_fichier, $contenu);
            }
    
            foreach ($records as $record) {
                // Créez un répertoire "id_{id}" pour chaque enregistrement
                $directoryPath = "C:/Users/Harena/Documents/LLC/DOCS2/{$modelName}/{$record->$primaryKey}";
                File::makeDirectory($directoryPath);
    
                // Copiez le modèle de base "id_{id}" autant de fois qu'il y a d'enregistrements
                $baseDirectory = "C:/Users/Harena/Documents/LLC/DOCS2/{$modelName}/id";
                File::copyDirectory($baseDirectory, $directoryPath);

                if($modelName == "Experience"){

                    error_log($record->$primaryKey);
                    $ce=ContactExperience::where('id_experience',$record->$primaryKey)->first();
                    if(isset($ce->id_contact)){
                        $contact=Contact::find($ce->id_contact);

                        $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/experience.csv';
                        $contenu = $record->$primaryKey.",".$record->nom_experience.",".$record->nom_experience.",".$contact->nom.",".$contact->prenom."\r\n";
        
                        // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                        file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                    }else{
                        $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/experience.csv';
                        $contenu = $record->$primaryKey.",".$record->nom_experience.",NULL,NULL\r\n";
        
                        // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                        file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                    }
                    
                }
                if($modelName == "Contact"){
                    $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/contact.csv';
                    $contenu = $record->$primaryKey.",".$record->nom.",".$record->prenom."\r\n";
    
                    // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                    file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                }
    
                if($modelName == "Facture"){

                    $ce=Paiement::where('num_facture',$record->$primaryKey)->first();
                    if(isset($ce->id_contact)){
                        $contact=Contact::find($ce->id_contact);

                        $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/facture.csv';
                        $contenu = $record->$primaryKey.",".$contact->nom.",".$contact->prenom.",".$record->prix_facture."\r\n";
        
                        // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                        file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                    }else{
                        $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/facture.csv';
                        $contenu = $record->$primaryKey.",NULL,NULL,".$record->prix_facture."\r\n";
        
                        // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                        file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                    }
                }
    
                if($modelName == "ProduitsService"){
                    $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/produits_service.csv';
                    $contenu = $record->$primaryKey.",".$record->nom_produit."\r\n";
    
                    // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                    file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                }
    
                if($modelName == "Pack"){
                    $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/pack.csv';
                    $contenu = $record->$primaryKey.",".$record->nom."\r\n";
    
                    // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                    file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                }
    
                if($modelName == "Remise"){
                    $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/remise.csv';
                    $contenu = $record->$primaryKey.",".$record->nom_remise."\r\n";
    
                    // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                    file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                }

                if($modelName == "CodesPromo"){
                    $nom_fichier = 'C:/Users/Harena/Documents/LLC/DOCS2/codes_promo.csv';
                    $contenu = $record->$primaryKey.",".$record->code."\r\n";
    
                    // Écrire le contenu dans le fichier (créera le fichier s'il n'existe pas)
                    file_put_contents($nom_fichier, $contenu,FILE_APPEND);
                }
    
                // Renommez le répertoire copié avec l'ID de l'enregistrement
                // File::move($directoryPath, public_path("$model/{$record->id}"));
            }
        }
    }

    public function getFilesUrls(){
        set_time_limit(500);
        //Creation du dossier Client
        $clientDrive = new \Google_Client();
        //$clientDrive->setApplicationName('Laravel');
        //$authConfig = file_get_contents(__DIR__ . '/../../Google/google_credentials.json');
        //$clientDrive->setAuthConfig(json_decode($authConfig, true));
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');

        // Redirect the user to the consent page to authorize your application
        //if (!isset($_SESSION['access_token'])||$_SESSION['access_token']==null) {
            //$redirect_uri = 'http://localhost:8000/contacts.create';
            //$clientDrive->setRedirectUri($redirect_uri);
            //$auth_url = $clientDrive->createAuthUrl();
            //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            //exit();
        //} else {
        // Exchange authorization code for an access token
        //$token = $clientDrive->fetchAccessTokenWithAuthCode($_GET['code']);
        //dd($_SESSION['access_token']);
        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json')); //$_SESSION['access_token']

        // Use the access token to make API requests
        $drive = new \Google_Service_Drive($clientDrive);
        //}
        // $modelFiles = $drive->files->list('1nzG7_MR5xv--0je2iWZE3CYpATpfXm6U');
        $optParams = array(
            'q' => "'1nzG7_MR5xv--0je2iWZE3CYpATpfXm6U' in parents and mimeType = 'application/vnd.google-apps.folder'",
          );
        $modelFiles = $drive->files->listFiles($optParams);
        // dd($modelFiles);
        foreach($modelFiles as $modelFile){
            $optParams = array(
                'q' => "'".$modelFile->id."' in parents and mimeType = 'application/vnd.google-apps.folder'",
            );
            $files = $drive->files->listFiles($optParams);
            $model = '\\App\\Models\\' . $modelFile->name;
            $primaryKey = (new $model)->getKeyName();
            foreach($files as $file){
                $url = 'https://drive.google.com/drive/u/1/folders/'.$file->id;
                // dd($url);

                if($modelFile->name){

                }
                
                    $model :: where($primaryKey,'=',intval($file->name))
                    ->update(['drive_url'=> $url]);
                    // dd($record->drive_url);
                    // dd($files, $modelFile);
                
            }
            // $files = $drive->files->list('1nzG7_MR5xv--0je2iWZE3CYpATpfXm6U');
        }
        dd('OK PROCESS');
    }

    public function listFolders($directoryId = '1W7KQaR_9pOKsgHvuAByoHmq5xhV4Ytpq')
    {
        http_response_code(200);
        set_time_limit(10000);
        // Initialiser le client Google API
        $client = new Google_Client();
        $client->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $client->addScope(Google_Service_Drive::DRIVE);
        $client->setAccessType('offline');
        $client->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json')); //$_SESSION['access_token']

        // Créer le service Google Drive
        $driveService = new Google_Service_Drive($client);

        $nextPageToken = null;

        do {
            // Récupérer la liste des fichiers et dossiers dans le répertoire
            $files = $driveService->files->listFiles([
                'q' => "'$directoryId' in parents and mimeType='application/vnd.google-apps.folder'",
                'orderBy' => 'name',
                'pageToken' => $nextPageToken,
            ]);
    
            // Parcourir la liste des dossiers et afficher les noms et les URL
            foreach ($files->getFiles() as $file) {
                $folderName = $file->getName();
                $folderUrl = "https://drive.google.com/drive/folders/{$file->getId()}";
    
                // Faites quelque chose avec le nom et l'URL du dossier (par exemple, stockez-les dans une base de données)
                $folderInfo = $folderName.",".$folderUrl."\n";
                // dd(public_path().'/urls.txt');
                file_put_contents(public_path().'/urls.txt', $folderInfo, FILE_APPEND);
    
                // Récursivement appeler la fonction pour explorer les sous-dossiers
                $this->listFolders($file->getId());
            }
            // Mettre à jour nextPageToken pour la prochaine page, s'il y en a une
            $nextPageToken = $files->getNextPageToken();
        } while ($nextPageToken);
    }
}
