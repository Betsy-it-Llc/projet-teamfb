<?php

namespace App\Http\Controllers;

use App\Models\experienceApp\BonCadeau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BonCadeauController extends Controller
{
    //
    public function index(Request $request)
    {
        $pack = new BonCadeau();
        $pack->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $data = DB::connection('mysql2')
        ->select('SELECT bon_cadeau.id_bonCadeau, experience.id_experience,contact.nom,contact.prenom, bon_cadeau.nom_destinataire,bon_cadeau.titre
            FROM bon_cadeau JOIN contents_experience JOIN experience JOIN contact_experience JOIN contact
            ON bon_cadeau.id_content_experience=contents_experience.id_content_experience
            AND contents_experience.id_experience=experience.id_experience
            AND experience.id_experience=contact_experience.id_experience
            AND contact_experience.id_contact=contact.id_contact
            WHERE (contact_experience.profil="Client" OR contact_experience.profil="Client_User")
            GROUP BY bon_cadeau.id_bonCadeau');

        $data = DB::connection('mysql2')->table('bon_cadeau')
        ->join('contents_experience','bon_cadeau.id_content_experience','=','contents_experience.id_content_experience')
        ->join('experience','experience.id_experience','=','contents_experience.id_experience')
        ->join('contact_experience','contact_experience.id_experience','=','experience.id_experience')
        ->join('contact','contact_experience.id_contact','=','contact.id_contact')
        ->where('contact_experience.profil','Client')
        ->orWhere('contact_experience.profil','Client_User')
        ->orWhere('contact_experience.profil','Client-User')
        ->groupBy('bon_cadeau.id_bonCadeau')
        // ------------yasser-------------
        ->orderByDesc('bon_cadeau.id_bonCadeau')
        // ------------yasser-------------
        ->paginate($perPage);

        $totalBons = DB::connection('mysql2')->table('bon_cadeau')
        ->join('contents_experience','bon_cadeau.id_content_experience','=','contents_experience.id_content_experience')
        ->join('experience','experience.id_experience','=','contents_experience.id_experience')
        ->join('contact_experience','contact_experience.id_experience','=','experience.id_experience')
        ->join('contact','contact_experience.id_contact','=','contact.id_contact')
        ->where('contact_experience.profil','Client')
        ->orWhere('contact_experience.profil','Client_User')
        // ------------yasser-------------
        ->orderByDesc('bon_cadeau.id_bonCadeau')
        // ------------yasser-------------
        ->groupBy('bon_cadeau.id_bonCadeau')
        ->get();
        $totalBons = count($totalBons);

        // $reservations = Reservationclient::sortable()->paginate(15)->withQueryString();
        return view('bonscadeau.index', compact('data', 'perPage','totalBons'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(Request $request)
    {

        $modelcadeau = new BonCadeau();
        $modelcadeau->setConnection('mysql2');

        $id_cad = DB::connection('mysql2')->select('SELECT id_bonCadeau FROM bon_cadeau');

        //dd($id_cad);
        //
        // http: //127 .0.0. 1:800 0/res ervat ioncl ient. show? 1  (45 en local)
        // https ://te amfb. lalac hante .fr/r eserv ation clien t.sho w? 1  (52 en ligne)
        $url1 = (int) $request->id_bonCadeau;
        $url = $url1;

        foreach ($id_cad as $key => $value) {
            if ($url1 === $value->id_bonCadeau) {
                $url = $url1;
            } 
        }

        $con= DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact_entreprise.type,organisation.num_cse,contact_experience.profil,contact_experience.personna,experience.numero_experience
        FROM contact join bon_cadeau JOIN contents_experience JOIN experience 
        LEFT JOIN contact_entreprise ON contact.id_contact = IFNULL(contact_entreprise.id_contact, "none")
        LEFT JOIN organisation ON IFNULL(contact_entreprise.id_organisation, "none") = IFNULL(organisation.id_organisation, "none")
        LEFT JOIN contact_experience ON contact_experience.id_contact = contact.id_contact
        AND bon_cadeau.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        AND experience.id_experience=contact_experience.id_experience
        WHERE (contact_experience.profil="Client" OR contact_experience.profil="Client_User") AND bon_cadeau.id_bonCadeau=?
        GROUP BY bon_cadeau.id_bonCadeau
        ',[$url]);

        //dd($con);

        $cadeau = DB::connection('mysql2')->selectOne('SELECT contents_experience.date_heure,contents_experience.description_,bon_cadeau.id_bonCadeau,bon_cadeau.nom_destinataire,bon_cadeau.titre,bon_cadeau.message
        FROM bon_cadeau JOIN contents_experience
        ON bon_cadeau.id_content_experience=contents_experience.id_content_experience
        WHERE bon_cadeau.id_bonCadeau=?',[$url]);

        //dd($cadeau);

        $experience = DB::connection('mysql2')->selectOne('SELECT experience.id_experience,experience.nom_experience,experience_statut.statut_experience,factures.num_facture,experience.numero_experience
        FROM bon_cadeau JOIN contents_experience JOIN experience JOIN pack_experience JOIN experience_statut JOIN factures
        JOIN (
            SELECT id_experience, MAX(id_statut_experience) AS id_statut_experience
            FROM experience_statut_notification
            GROUP BY id_experience) AS exp_stat_notif ON pack_experience.id_experience = exp_stat_notif.id_experience
            AND bon_cadeau.id_content_experience=contents_experience.id_content_experience
            AND contents_experience.id_experience=experience.id_experience
            AND experience.id_experience=pack_experience.id_experience
            AND exp_stat_notif.id_statut_experience=experience_statut.id_statut_experience
            AND pack_experience.num_facture=factures.num_facture
            WHERE bon_cadeau.id_bonCadeau=?',[$url]);
        //dd($experience);

        return view('bonscadeau.show',['id_bonCadeau'=>$url,'con'=>$con,'cadeau'=>$cadeau,'experience'=>$experience]);
    }

    public function edit()
    {
        return view('bonscadeau.show');
    }

    public function create()
    {
        return view('bonscadeau.show');
    }

    public function deleteSelect(Request $request){
        $ids = $request->input('bonscadeau');
        DB::connection('mysql2')->table('bon_cadeau')->whereIn('id_bonCadeau', $ids)->delete();
        return redirect()->route('bonscadeau.index')->with('success','Selection supprimée avec succes');
        } 

}
