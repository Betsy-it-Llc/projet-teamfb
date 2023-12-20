<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\experienceApp\Media;
use Illuminate\Support\Str;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class SyncMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-media';
    private $syncRootDirectory;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize media from drive storage ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->syncRootDirectory = env('SYNC_ROOT_DIRECTORY', '1FmwS7Xgb3nml3Pbz-dsk40rQOB-_ILms');
        $clientDrive = new \Google_Client();
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');

        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json')); //$_SESSION['access_token']
        // Définir la limite de temps d'exécution à 0 (pas de limite de temps)
        set_time_limit(0);
        $service = new \Google_Service_Drive($clientDrive);
        $files = $service->files->listFiles([
            'q' => "'$this->syncRootDirectory' in parents",
        ]);
        $this->info("Drive root reading successful!");

        $driveFiles = collect($files); // Use Google Drive SDK to list files

        $driveFiles->each(function ($driveItem) use ($service) {

            $modelName = $driveItem->name;

            $fullModelName = "App\\Models\\experienceApp\\" . $modelName;

            if ($driveItem->getMimeType() === 'application/vnd.google-apps.folder' && class_exists($fullModelName)) {
                $this->info("The model exists!");
                // Loop into the instance name!
                $this->synchronizeModelFolders($service, $driveItem->getId(), $fullModelName);
            } else {
                $this->info("The model does not exist!");
            }
        });
    }

    public function synchronizeModelFolders($service, $folderId, $modelName)
    {
        $this->info("Debut sychronisation des instances!");
        $modelFolders = $service->files->listFiles(['q' => "'$folderId' in parents"]);
        foreach ($modelFolders->getFiles() as $modelFolder) {
            if ($modelFolder->getMimeType() === 'application/vnd.google-apps.folder' && is_numeric($modelFolder->getName())) {
                $this->synchronizeInstanceFolders($service, $modelFolder->getId(), $modelName, $modelFolder->getName());
            } else {
                $this->info("The folder doesn't respect the id format!");
            }
        }
    }

    public function synchronizeInstanceFolders($service, $folderId, $modelName, $modelId)
    {
        $this->info("Debut sychronisation des collections du premier dossier!");
        
        $items = $service->files->listFiles(['q' => "'$folderId' in parents"]);
        
        foreach ($items->getFiles() as $driveItem) {
            if ($driveItem->getMimeType() === 'application/vnd.google-apps.folder') {
                // It's a folder (could be an instance or collection folder)
                $drivePathFromRoot =  $driveItem->getName();
                $this->synchronizeCollectionFolders($service, $driveItem->getId(), $drivePathFromRoot, $modelName, $modelId);
            } else {
                // It's a file
                $drivePathFromRoot = ''; // If you wish to keep a different path structure, adjust here.
                $this->syncSingleFile($driveItem, $drivePathFromRoot, $modelName, $modelId, $service);
            }
        }
    }
    
    public function synchronizeCollectionFolders($service, $folderId, $collectionName, $modelName, $modelId)
    {
        $this->info("Debut sychronisation des collections!");
        $items = $service->files->listFiles(['q' => "'$folderId' in parents"]);

        foreach ($items->getFiles() as $driveItem) {
            if ($driveItem->getMimeType() === 'application/vnd.google-apps.folder') {
                // It's a folder (could be an instance or collection folder)
                $drivePathFromRoot = $collectionName . '/' . $driveItem->getName();
                $this->synchronizeCollectionFolders($service, $driveItem->getId(), $drivePathFromRoot, $modelName, $modelId);
            } else {
                // It's a file
                $drivePathFromRoot = $collectionName; // If you wish to keep a different path structure, adjust here.
                $this->syncSingleFile($driveItem, $drivePathFromRoot, $modelName, $modelId, $service);
            }
        }
    }

    public function syncSingleFile($driveFile, $drivePathFromRoot, $modelName, $modelId, $service)
    {
        $mediaItemExists = Media::where('file_name', $driveFile->name)->exists();

        if (!$mediaItemExists) {
            $mediaItem = new Media();
            $custom_propeties = '[]';
            if (Str::startsWith($drivePathFromRoot,'prod/video_youtube/')){
                // $custom_propeties = '2';
                // $path = 'Experience/'.$modelId.'/'.$drivePathFromRoot.'/'.$driveFile->name;
                // $path = str_replace('\\', '/', $path);
                // dd($path);
                // $data = Gdrive::get($path);
                // dd($data);
                $file = $service->files->get($driveFile->id, ['alt' => 'media']);
                $fileContent = $file->getBody()->getContents();
                $fileContent = str_replace('/', '\\/', $fileContent);
                $fileContent = str_replace('http', 'https', $fileContent);
                $custom_propeties = "{\"folder\":\"video_youtube\",\"youtube_link\":\"".$fileContent."\"}";
                // dd($custom_propeties);
            }
            
            // Basic details
            $mediaItem->name = $driveFile->name;
            $mediaItem->file_name = $driveFile->name;
            $mediaItem->mime_type = $driveFile->mimeType; // Assuming the Google Drive SDK returns a mime type
            $mediaItem->size = $driveFile->size??0; // Similarly, assuming size is available
            $mediaItem->disk = 'google'; // If 'google' is the disk name for your Google Drive setup
            $mediaItem->conversions_disk = 'google'; // If 'google' is the disk name for your Google Drive setup
            $mediaItem->manipulations = '[]';
            $mediaItem->custom_properties = $custom_propeties;
            $mediaItem->generated_conversions = '[]';
            $mediaItem->responsive_images = '[]';
            $mediaItem->model_type = $modelName;
            $mediaItem->model_id = $modelId;
            // Collection: You might want to determine this based on folder or other criteria from Google Drive
            $mediaItem->collection_name = $drivePathFromRoot;
            $mediaItem->uuid = (string) Str::uuid();

            // You may need to specify additional fields like order_column, depending on your setup

            // Save the new media item
            $mediaItem->save();
        }
    }
}