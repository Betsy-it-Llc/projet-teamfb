<?php

namespace App\Livewire;

use App\Models\ExperienceStatutNotification;
use App\Models\Projets;
use Livewire\Component;
use App\Models\Cagnotte;
use App\Models\Contribution;
use Livewire\Attributes\Title;
use App\Models\ContentExperience;
use App\Models\experienceApp\Media;
use App\Models\experienceApp\Experience;
use App\Models\experienceApp\Storytelling;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

#[Title('L\'expérience')]
class Contribuer extends Component
{   public $idExperience;
    public function render()
    {   
        // implemnté sur la page contribution
        $indexPochette=0;
        $indexEnregistrementPhoto=0;
        $indexVideo_Youtube=0;
        $indexTeaserClip=0;
        $indexTeaserInterview=0;
        $indexEnregistrementInterview=0;
        
        // pour le futur si on venait à rajouter du contenu sur la page
        $indexInterview=0;
        $indexPhoto=0;
        $indexHeader=0;
        $indexMasterVideoClip=0;
        $indexMix=0;
        $indexEnregistrementStudio=0;
        $indexEnregistrementVideo=0;
        $indexTeaserMusic=0;
        $indexContentExperience=0;
        $indexCustomerSuccess=0;
        $indexPromoExp=0;
        $indexPromoLala=0;
        $indexStory=0;
        $indexBonCadeau=0;


        function getMediaName($Collection,$index){
            // définir les id des médias
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
        $contentsExperience = ContentExperience::where('id_experience', $this->idExperience)->first();
        try {
        // Storytelling
        $storytelling = Storytelling::where('id_content_experience', $contentsExperience->id_content_experience)->first();
        } catch (\Exception $th) {
            $storytelling =null;
        }
        $idExperience=$this->idExperience;
        
        // trouver le montant actuel de la cagnotte 
        $experience=Experience::find($this->idExperience);
        $experience_statut = ExperienceStatutNotification::where('id_experience',$idExperience)->orderBy('id_notification','DESC')->first();
        if($experience==null/**  || !in_array($experience_statut->id_statut_experience,['6','7'])*/){
            abort(404);
        }

        try {
            $cagnotte= Cagnotte::where('id_projet', $experience->id_projet)->first();
        } catch (\Exception $th) {
            $cagnotte=null;
        }
        
        try {
            // trouver les contributeurs et leurs informations
            $contributeurs=Contribution::join('contact', 'contributions.id_contact', '=', 'contact.id_contact')
            //->groupBy('contact.id_contact') demande de Mady enlever le nombre de personne contribué unique, chaque contribution doit s'afficher
            ->where('id_cagnotte',$cagnotte->id_cagnotte)->get();
            $contributeurApercu=Contribution::join('contact', 'contributions.id_contact', '=', 'contact.id_contact')
            ->where('id_cagnotte',$cagnotte->id_cagnotte)->take(14)->get();
        } catch (\Exception $th) {
            $contributeurs=null;
            $contributeurApercu=null;
        }

        try {
            // recuperer le content_experience
            $contentsExperience=ContentExperience::where('id_experience',$this->idExperience)->first(); 
            $id_content_experience=$contentsExperience->id_content_experience;
        } catch (\Exception $th) {
            $contentsExperience=null;
        }
        
        try {
            // recupérer le/ la photo de l'experience
            $photoExperience1=$experience->getFirstMedia('prod/pochette/'.getMediaName('prod/pochette',$indexPochette));
            //dd($experience->getFirstMedia('prod/pochette/'.$nomPochette)->getUrl());
        } catch (\Exception $th) {
            $photoExperience1=null;
        }
        
        try {
            $photoExperience2=$experience->getFirstMedia('enregistrement/photo/'.getMediaName('enregistrement/photo/',$indexEnregistrementPhoto));
        } catch (\Throwable $th) {
            $photoExperience2=null;
        }
        
        try {
            // récupérer la vidéo principale 
            $videoPrincipale=$experience->getFirstMedia('prod/video_youtube/'.getMediaName('prod/video_youtube',$indexVideo_Youtube));
        } catch (\Throwable $th) {
            $videoPrincipale=null;
        }
        
        $url =null;
        
        if (!empty($videoPrincipale)) {
            $url =$experience->getFirstMedia('prod/video_youtube/'.getMediaName('prod/video_youtube',$indexVideo_Youtube))->getCustomProperty('youtube_link');
        }
        
        $videoId =null;
        
        if (!empty($url)) {
            // récuperer la dernière partie de l'url
            // Analysez l'URL pour obtenir les paramètres de requête
            $queryString = parse_url($url, PHP_URL_QUERY);

            // Analysez les paramètres de requête pour obtenir la valeur du paramètre "v"
            parse_str($queryString, $queryParams);

            // Obtenez la valeur du paramètre "v", qui est l'identifiant de la vidéo
            $videoId = isset($queryParams['v']) ? $queryParams['v'] : '';
        }
        

        // récupérer les "Autres expériences", et l'id pour une redirection vers la page de l'experience
        $autresExperiencesEtInfos= Experience::inRandomOrder()
        ->take(5) // Limite à 5 résultats
        ->get();
        
        try {
            // récupérer le montant de l'objectif de la cagnotte
            $projet=Projets::find($experience->id_projet);
        } catch (\Exception $th) {
            $projet=null;
        }
        

        if (!empty($projet)) {
            $objectifCagnotte=$projet->objectif_financier;
        }else{
            $objectifCagnotte=null;
        }
        
        if ($objectifCagnotte>0) {
            $pourcentageAvancementCagnotte=number_format(($cagnotte->montant_actuel/$objectifCagnotte)*100);
        }else {
            $pourcentageAvancementCagnotte=0;
        }
        
        try {
            // trouver la video teaser clip
            $videoDuShort=$experience->getFirstMedia('market/916_teaser_experience_clip/'.getMediaName('market/916_teaser_experience_clip',$indexTeaserClip))->getUrl();
            
            $explodeUrl = explode("=",$videoDuShort);
            $explodeResult=explode("&",$explodeUrl[1]);
            $fileId=$explodeResult[0];
        } catch (\Throwable $th) {
            $fileId=null;
        }
        
        try {
            $videoDuShort=$experience->getFirstMedia('market/916_teaser_ interview/'.getMediaName('market/916_teaser_ interview',$indexTeaserInterview))->getUrl();
            
            $explodeUrl = explode("=",$videoDuShort);
            $explodeResult=explode("&",$explodeUrl[1]);
            $fileId_2=$explodeResult[0];
        } catch (\Throwable $th) {
            $fileId_2=null;
        }
       
        

        if($experience->getFirstMedia('enregistrement/interview/'.getMediaName('enregistrement/interview',$indexEnregistrementInterview))){

        try {
            // récupérer la vidéo secondaire (interview) 
            $videoInterview=$experience->getFirstMedia('enregistrement/interview/'.getMediaName('enregistrement/interview',$indexEnregistrementInterview));
        } catch (\Exception $th) {
            $videoInterview=null;
        }
        

        $url = $videoInterview->getUrl();

        $explodeUrl = explode("=",$url);
        $explodeResult=explode("&",$explodeUrl[1]);
        $videoIdInterview=$explodeResult[0];
        }else{
            $videoIdInterview=null;
        }
        
        return view('livewire.contribuer', compact('idExperience','experience','storytelling','cagnotte','contributeurs','contributeurApercu','videoId','autresExperiencesEtInfos','videoPrincipale','photoExperience1','photoExperience2','objectifCagnotte','pourcentageAvancementCagnotte','fileId','fileId_2','videoIdInterview'));
    }
}