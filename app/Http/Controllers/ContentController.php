<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\experienceApp\Content;
use App\Models\Sortable;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $content = new Content;
        $content->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $liste = DB::connection('mysql2')->select('SELECT contents_experience.id_content_experience, (select  GROUP_CONCAT(contact.nom," ",contact.prenom,"\t") from contact JOIN contact_experience ON   contact.id_contact=contact_experience.id_contact  where
        contact_experience.id_experience=contents_experience.id_experience) as contact,  contents_experience.type, contents_experience.description_, experience.url_experience_folder,experience.id_experience
        from contents_experience JOIN experience 
        ON contents_experience.id_experience=experience.id_experience');

        $sub_query = DB::connection('mysql2')->table('contact')
            ->join('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact')
            ->join('contents_experience', 'contact_experience.id_experience', '=', 'contents_experience.id_experience')
            ->selectRaw('GROUP_CONCAT(contact.nom," ",contact.prenom,"\t") as contact');

        $liste = DB::connection('mysql2')
            ->table('contents_experience')
            ->join('experience', 'experience.id_experience', '=', 'contents_experience.id_experience')
            ->join('contact_experience', 'experience.id_experience', '=', 'contact_experience.id_experience')
            ->join('contact', 'contact_experience.id_contact', '=', 'contact.id_contact')
            ->select('contents_experience.id_content_experience', 'contents_experience.description_', 'contents_experience.type', 'experience.id_experience', 'experience.url_experience_folder', 'contact.nom', 'contact.prenom')
            ->groupBy('contents_experience.id_content_experience')
            ->orderBy('contents_experience.id_content_experience', 'desc')
            ->paginate($perPage);

        // -------------------21.06.23 ------------------------------------------ 
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchmail = $request->get('multisearchmail');
        $multisearchstat = $request->get('multisearchstat');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchmail) || isset($multisearchstat)) {
            $liste = DB::connection('mysql2')
                ->table('contents_experience')
                ->join('experience', 'experience.id_experience', '=', 'contents_experience.id_experience')
                ->join('contact_experience', 'experience.id_experience', '=', 'contact_experience.id_experience')
                ->join('contact', 'contact_experience.id_contact', '=', 'contact.id_contact')
                ->select('contents_experience.id_content_experience', 'contents_experience.description_', 'contents_experience.type', 'experience.id_experience', 'experience.url_experience_folder', 'contact.nom', 'contact.prenom')
                ->groupBy('contents_experience.id_content_experience')
                ->where('contents_experience.type', '=', $multisearchstat)
                ->orderBy('contents_experience.id_content_experience', 'desc')
                ->paginate($perPage);
        }

        $liste_type = DB::connection('mysql2')->table('contents_experience')
            ->select('type')
            ->distinct()
            ->get();
        // -------------------21.06.23 ------------------------------------------ 

        $totalContent = $liste->total();

        return view('contents.index', compact('liste', 'perPage', 'totalContent', 'liste_type'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('experience.create');
    }

    //Permet de recuperer les url des content experiences
    public function getWebViewLink(Request $request)
    {
        $clientDrive = new \Google_Client();
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');
        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json'));

        $drive = new \Google_Service_Drive($clientDrive);

        // Remplacez 'fileId' par l'ID réel du fichier que vous souhaitez récupérer.
        $fileId = $request->id;

        $file = $drive->files->get($fileId, ['fields' => 'webViewLink']);

        $webViewLink = $file->getWebViewLink();

        return $webViewLink;
    }

    //Permet d'update l'url d'un content experience
    public function setURLToContent($url,$table,$id){
        DB::table($table)->where("id_content",$id)->update(['url' => $url]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->id_experience)) {
            DB::connection('mysql2')->table('experience')->insert(
                ['id_experience' => $request->id_experience,]
            );
        } else {
            echo "Service not stored";
        }

        return redirect()->route('experience.index')
            ->with('success', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_content_experience)
    {
        $modelcnt = new Content;
        $modelcnt->setConnection('mysql2');

        $id_cnt = DB::connection('mysql2')->select('SELECT id_content_experience FROM contents_experience');

        $url1 = (int) $id_content_experience;
        $url = $url1;

        foreach ($id_cnt as $key => $value) {
            if ($url1 === $value->id_content_experience) {
                $url = $url1;
            }
        }

        $con = DB::connection('mysql2')->selectOne('SELECT contents_experience.id_content_experience,contents_experience.date_heure,contents_experience.description_,contents_experience.type,experience.id_experience,experience.nom_experience,experience.numero_experience
        FROM contents_experience JOIN experience
        ON experience.id_experience=contents_experience.id_experience
        WHERE contents_experience.id_content_experience=?', [$url]);

        $fact = DB::connection('mysql2')->table('factures')
            ->join('pack_experience', 'pack_experience.num_facture', '=', 'factures.num_facture')
            ->where('pack_experience.id_experience', '=', $con->id_experience)
            ->first();


        $contacts_liees = DB::connection('mysql2')->select('SELECT contact.id_contact,contact.nom,contact.prenom,contact.email,contact.tel
        FROM contact JOIN contact_experience JOIN experience JOIN contents_experience
        ON contact.id_contact=contact_experience.id_contact
        AND contact_experience.id_experience=experience.id_experience
        AND experience.id_experience=contents_experience.id_experience
        WHERE contents_experience.id_content_experience=?', [$url]);

        $interactions = DB::connection('mysql2')->select('SELECT interaction.id_interaction,interaction.date_heure,interaction.texte,interaction.type_interaction,interaction.id_contact
        FROM interaction JOIN experience JOIN contents_experience
        ON interaction.id_experience=experience.id_experience
        AND experience.id_experience=contents_experience.id_experience
        WHERE contents_experience.id_content_experience=?', [$url]);



        $storytelling = DB::connection('mysql2')->select('SELECT storytelling.description, contents_experience.date_heure 
        FROM storytelling JOIN contents_experience
        ON storytelling.id_content_experience=contents_experience.id_content_experience
        WHERE contents_experience.id_experience=? AND contents_experience.type="storytelling"', [$con->id_experience]);

        // -------------yasser-----------     
        $bon_cadeau = DB::connection('mysql2')->select('SELECT bon_cadeau.url,bon_cadeau.nom_destinataire,bon_cadeau.titre,bon_cadeau.message,contents_experience.date_heure 
        FROM bon_cadeau JOIN contents_experience
        ON bon_cadeau.id_content_experience=contents_experience.id_content_experience
        WHERE contents_experience.id_content_experience=? AND contents_experience.type="bon cadeau"', [$url]);

        $livrable = DB::connection('mysql2')->select('SELECT livrables.nom,livrables.type,livrables.date_envoie,livrables.url,contents_experience.date_heure 
        FROM  contents_experience
        JOIN livrables
            ON contents_experience.id_content_experience = livrables.id_content_experience 
        WHERE contents_experience.id_content_experience= ?
        AND contents_experience.type="livrable"', [$url]);

        // -------------yasser-----------


        $media = DB::connection('mysql2')->select('SELECT medias_lalachante.description,medias_lalachante.type,medias_lalachante.url,contents_experience.date_heure 
        FROM medias_lalachante JOIN contents_experience
        ON medias_lalachante.id_content_experience=contents_experience.id_content_experience
        WHERE contents_experience.id_experience=? AND contents_experience.type="media"', [$con->id_experience]);

        $content_son = DB::connection('mysql2')->table('contents_experience')
            ->join('son', 'contents_experience.id_content_experience', '=', 'son.id_content_experience')
            ->where('contents_experience.id_content_experience', $url)
            ->first();

        $content_video = DB::connection('mysql2')->table('contents_experience')
            ->join('video', 'contents_experience.id_content_experience', '=', 'video.id_content_experience')
            ->where('contents_experience.id_content_experience', $url)
            ->first();

        $content_photo = DB::connection('mysql2')->table('contents_experience')
            ->join('photo', 'contents_experience.id_content_experience', '=', 'photo.id_content_experience')
            ->where('contents_experience.id_content_experience', $url)
            ->first();

        return view('contents.show', compact('con', 'contacts_liees', 'interactions', 'storytelling', 'bon_cadeau', 'livrable', 'media', 'fact', 'content_son', 'content_video', 'content_photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(experience $experience, Request $request)
    {

        $id2 = (int) $request->id_experience;

        $idexperiences = DB::connection('mysql2')->select('SELECT id_experience FROM experience');
        foreach ($idexperiences as $idexperience => $rang) {
            if ($id2 === $rang->id_experience) {
                $ids = DB::connection('mysql2')->select('SELECT id_experience FROM experience WHERE id_experience=' . $id2);
            }
        }
        return view('experience.edit', compact('ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $experience)
    {
        $request->validate([
            'id_experience',
            'nom_experience' => 'required',
            'statut_experience',
            'histoire_experience',
            'url_experience_folder'
        ]);

        $experience->update($request->all());
        return redirect()->route('Experience.index')
            ->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        return \view('experience.validate');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('contents');
        DB::connection('mysql2')->table('contents_experience')->whereIn('id_content_experience', $ids)->delete();
        return redirect()->route('contents.index')->with('success', 'Selection supprimée avec succes');
    }
}
