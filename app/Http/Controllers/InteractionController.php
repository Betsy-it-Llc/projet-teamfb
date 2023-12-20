<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\experienceApp\Content;
use App\Models\Sortable;
use App\Models\experienceApp\Interaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $interaction = new Interaction;
        $interaction->setConnection('mysql2');
        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $id_con = DB::connection('mysql2')->select('SELECT id_contact,nom,prenom FROM contact');
        $id_exp = DB::connection('mysql2')->select('SELECT id_experience,nom_experience FROM experience');


        $contacts = DB::connection('mysql2')->table('contact')->get();

        // -------------------------------------yasser--------------------------------------------------
        $data = DB::connection('mysql2')->table('interaction')
            ->select('interaction.*', 'interaction_tag.id_tag_interaction')
            ->leftJoin('interaction_tag', 'interaction.id_interaction', '=', 'interaction_tag.id_interaction')
            ->groupBy('interaction.id_interaction')
            ->orderBy('interaction.id_interaction', 'DESC')
            ->paginate($perPage);




        $liste_tags = DB::connection('mysql2')->table('tag_interaction')
            ->distinct()
            ->get();
        $taille_resultat = $liste_tags->count();
        // ----------tags_interaction--------------
        // -----------------22.06.23--------------------------------------------------

        $tags_selected = $request->get('tags_test');
        if (isset($tags_selected)) {

            $tags = [];
            for ($i = 0; $i < $taille_resultat; $i++) {
                $var_temp = $request->get('tags_' . $i);

                if (isset($var_temp)) {
                    $tags[] = $var_temp;
                }
            }

            $query = DB::connection('mysql2')->table('interaction')
                ->select('interaction.*', 'interaction_tag.id_tag_interaction')
                ->leftJoin('interaction_tag', 'interaction.id_interaction', '=', 'interaction_tag.id_interaction')
                ->groupBy('interaction.id_interaction')
                ->orderBy('interaction.id_interaction', 'DESC');

            if (isset($tags[0])) {
                $query->whereIn('interaction_tag.id_tag_interaction', $tags);
            }

            $data = $query->paginate($perPage);
        }

        // -----------------22.06.23--------------------------------------------------
        $totalInt =  $data->total();
        // -------------------------------------yasser--------------------------------------------------


        return view('interactions.index', compact('data', 'perPage', 'id_con', 'id_exp', 'contacts', 'totalInt', 'liste_tags'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('interactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'id_contact' => 'required|exists:mysql2.contact,id_contact',
            'id_experience' => 'nullable|exists:mysql2.experience,id_experience',
            'texte' => 'required',
            // ---------
            'le_tag_1' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_2' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_3' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_4' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_5' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            // nouveau
            'nouveau_tag_1' => 'nullable|',
            'nouveau_tag_2' => 'nullable|',
            'nouveau_tag_3' => 'nullable|',
            'nouveau_tag_4' => 'nullable|',
            'nouveau_tag_5' => 'nullable|',
        ]);
        // --------------------yasser----------------
        // -les tags- il y a 5 au maximum.
        $le_tag_1 = $request->le_tag_1;
        $le_tag_2 = $request->le_tag_2;
        $le_tag_3 = $request->le_tag_3;
        $le_tag_4 = $request->le_tag_4;
        $le_tag_5 = $request->le_tag_5;
        // ------
        $tags = [];
        if (isset($le_tag_1) && !in_array($le_tag_1, $tags)) {
            $tags[] = $le_tag_1;
        }
        if (isset($le_tag_2) && !in_array($le_tag_2, $tags)) {
            $tags[] = $le_tag_2;
        }
        if (isset($le_tag_3) && !in_array($le_tag_3, $tags)) {
            $tags[] = $le_tag_3;
        }
        if (isset($le_tag_4) && !in_array($le_tag_4, $tags)) {
            $tags[] = $le_tag_4;
        }
        if (isset($le_tag_5) && !in_array($le_tag_5, $tags)) {
            $tags[] = $le_tag_5;
        }

        // -----nouveau tag---
        $nouveau_tag_1 = $request->nouveau_tag_1;
        $nouveau_tag_2 = $request->nouveau_tag_2;
        $nouveau_tag_3 = $request->nouveau_tag_3;
        $nouveau_tag_4 = $request->nouveau_tag_4;
        $nouveau_tag_5 = $request->nouveau_tag_5;
        // --------
        $nouveau_tags = [];
        if (isset($nouveau_tag_1)) {
            $nouveau_tags['le_tag_1'] = $nouveau_tag_1;
        }
        if (isset($nouveau_tag_2)) {
            $nouveau_tags['le_tag_2'] = $nouveau_tag_2;
        }
        if (isset($nouveau_tag_3)) {
            $nouveau_tags['le_tag_3'] = $nouveau_tag_3;
        }
        if (isset($nouveau_tag_4)) {
            $nouveau_tags['le_tag_4'] = $nouveau_tag_4;
        }
        if (isset($nouveau_tag_5)) {
            $nouveau_tags['le_tag_5'] = $nouveau_tag_5;
        }
        // dd($request);
        // --------------------yasser----------------
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        $interaction = Interaction::create([
            'id_contact' => $request->id_contact,
            'id_experience' => $request->id_experience,
            'type_interaction' => $request->type_interaction,
            'texte' => $request->texte,
            'date_heure' => $current_date->format('Y-m-d H:i:s')
        ]);

        // -----------associer avec le tag selected--------
        foreach ($tags as $tag) {
            DB::connection('mysql2')->table('interaction_tag')
                ->insert([
                    'id_interaction' =>    $interaction->id_interaction,
                    'id_tag_interaction' =>    $tag,
                ]);
        }
        // ---------- ajouter nouveau tag et associer -----
        foreach ($nouveau_tags as $tag) {
            // Insérer le nouveau tag dans la table tag_interaction
            $tagId = DB::connection('mysql2')->table('tag_interaction')->insertGetId([
                'tag' => $tag
            ]);

            // Faire l'association dans la table interaction_tag
            DB::connection('mysql2')->table('interaction_tag')->insert([
                'id_interaction' => $interaction->id_interaction,
                'id_tag_interaction' => $tagId,
            ]);
        }
        $notif_text = 'Creation d\'une interaction de type ' . $interaction->type_interaction . ' le ' . $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'interaction'
            ]);

        return redirect()->route('interactions.index')
            ->with('success', 'Interaction a bien été ajoutée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_content_experience)
    {

        //dd($request);
        $modelcnt = new Content;
        $modelcnt->setConnection('mysql2');

        $id_cnt = DB::connection('mysql2')->select('SELECT id_content_experience FROM contents_experience');


        return view('contents.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($interactionz)
    {
        $modelinter = new Interaction();
        $modelinter->setConnection('mysql2');

        $id_interaction = DB::connection('mysql2')->select('SELECT id_interaction FROM interaction');
        $url1 = (int) $interactionz;

        foreach ($id_interaction as $key => $value) {
            if ($url1 === $value->id_interaction) {
                $url = $url1;
            }
        }

        $data = DB::connection('mysql2')->select('SELECT interaction.id_interaction,interaction.id_experience,interaction.date_heure,interaction.texte,contact.nom as nomc,contact.prenom,contact.id_contact
        from interaction JOIN contact
        ON interaction.id_contact=contact.id_contact
        Where interaction.id_interaction=?', [$url]);

        $data_exp = DB::connection('mysql2')->table('experience')
            ->join('interaction', 'interaction.id_experience', '=', 'experience.id_experience')
            ->where('interaction.id_interaction', '=', $url)
            ->first();

        $id_con = DB::connection('mysql2')->select('SELECT id_contact,nom,prenom FROM contact');

        $id_exp = DB::connection('mysql2')->select('SELECT id_experience,nom_experience FROM experience');
        // -------------------------------------yasser--------------------------------------------------
        // ----------tags_interaction--------------
        $les_tags_lier_avec_inter = DB::connection('mysql2')->table('tag_interaction')
            ->join('interaction_tag', 'tag_interaction.id_tag_interaction', '=', 'interaction_tag.id_tag_interaction')
            ->orderByDesc('tag_interaction.id_tag_interaction')
            ->get();
        // ----------tags_interaction--------------
        // -------------------------------------yasser--------------------------------------------------

        return view('interactions.edit', compact('data', 'id_con', 'id_exp', 'data_exp', 'les_tags_lier_avec_inter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_interaction' => 'required|exists:mysql2.interaction,id_interaction',
            'id_contact' => 'required|exists:mysql2.contact,id_contact',
            'id_experience' => 'nullable|exists:mysql2.experience,id_experience',
            'texte' => 'max:255',
            // ---------
            'le_tag_1' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_2' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_3' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_4' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_5' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            // nouveau
            'nouveau_tag_1' => 'nullable|',
            'nouveau_tag_2' => 'nullable|',
            'nouveau_tag_3' => 'nullable|',
            'nouveau_tag_4' => 'nullable|',
            'nouveau_tag_5' => 'nullable|',
        ]);
        // --------------------yasser----------------
        // -les tags- il y a 5 au maximum.
        $le_tag_1 = $request->le_tag_1;
        $le_tag_2 = $request->le_tag_2;
        $le_tag_3 = $request->le_tag_3;
        $le_tag_4 = $request->le_tag_4;
        $le_tag_5 = $request->le_tag_5;
        // ------
        $tags = [];
        if (isset($le_tag_1) && !in_array($le_tag_1, $tags)) {
            $tags[] = $le_tag_1;
        }
        if (isset($le_tag_2) && !in_array($le_tag_2, $tags)) {
            $tags[] = $le_tag_2;
        }
        if (isset($le_tag_3) && !in_array($le_tag_3, $tags)) {
            $tags[] = $le_tag_3;
        }
        if (isset($le_tag_4) && !in_array($le_tag_4, $tags)) {
            $tags[] = $le_tag_4;
        }
        if (isset($le_tag_5) && !in_array($le_tag_5, $tags)) {
            $tags[] = $le_tag_5;
        }

        // -----nouveau tag---
        $nouveau_tag_1 = $request->nouveau_tag_1;
        $nouveau_tag_2 = $request->nouveau_tag_2;
        $nouveau_tag_3 = $request->nouveau_tag_3;
        $nouveau_tag_4 = $request->nouveau_tag_4;
        $nouveau_tag_5 = $request->nouveau_tag_5;
        // --------
        $nouveau_tags = [];
        if (isset($nouveau_tag_1)) {
            $nouveau_tags['le_tag_1'] = $nouveau_tag_1;
        }
        if (isset($nouveau_tag_2)) {
            $nouveau_tags['le_tag_2'] = $nouveau_tag_2;
        }
        if (isset($nouveau_tag_3)) {
            $nouveau_tags['le_tag_3'] = $nouveau_tag_3;
        }
        if (isset($nouveau_tag_4)) {
            $nouveau_tags['le_tag_4'] = $nouveau_tag_4;
        }
        if (isset($nouveau_tag_5)) {
            $nouveau_tags['le_tag_5'] = $nouveau_tag_5;
        }
        // --------------------yasser----------------
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $interaction = Interaction::find($request->id_interaction);
        // -----------associer avec le tag selected--------
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('interaction_tag')
            ->where('id_interaction', $request->id_interaction)
            ->delete();
        // --------------suppression des tags ----------
        foreach ($tags as $tag) {
            DB::connection('mysql2')->table('interaction_tag')
                ->insertGetId([
                    'id_interaction' =>    $request->id_interaction,
                    'id_tag_interaction' =>    $tag,
                ]);
        }
        // ---------- ajouter nouveau tag et associer -----
        foreach ($nouveau_tags as $tag) {
            // Insérer le nouveau tag dans la table tag_interaction
            $tagId = DB::connection('mysql2')->table('tag_interaction')->insertGetId([
                'tag' => $tag
            ]);

            // Faire l'association dans la table interaction_tag
            DB::connection('mysql2')->table('interaction_tag')->insert([
                'id_interaction' => $request->id_interaction,
                'id_tag_interaction' => $tagId,
            ]);
        }
        // ---------------

        $interaction->update([
            'id_contact' => $request->id_contact,
            'id_experience' => $request->id_experience,
            // 'type_interaction'=>$request->type_interaction,
            'texte' => $request->texte,
            'date_heure' => $current_date->format('Y-m-d H:i:s')
        ]);


        $notif_text = 'Mise à jour de l\'interaction ID ' . $request->id_interaction . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'interaction'
            ]);
        return redirect()->route('interactions.index')
            ->with('success', 'La mise a jour a bien été effectuée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($interactionz)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Suppression de l\'interaction ID ' . $interactionz . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('interaction_tag')
            ->where('id_interaction', $interactionz)
            ->delete();
        // --------------suppression des tags ----------
        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'interaction'
            ]);

        Interaction::destroy($interactionz);

        return redirect()->route('interactions.index')
            ->with('success', '');
    }


    // ------------------------------yasser----------------------------------
    public function update_show_interaction($p_id_interaction)
    {
        $modelinter = new Interaction();
        $modelinter->setConnection('mysql2');

        $id_interaction = DB::connection('mysql2')->select('SELECT id_interaction FROM interaction');
        $url1 = (int) $p_id_interaction;

        foreach ($id_interaction as $key => $value) {
            if ($url1 === $value->id_interaction) {
                $url = $url1;
            }
        }

        $data = DB::connection('mysql2')->select('SELECT interaction.id_interaction,interaction.id_experience,interaction.date_heure,interaction.type_interaction,interaction.texte,contact.nom as nomc,contact.prenom,contact.id_contact
        from interaction JOIN contact
        ON interaction.id_contact=contact.id_contact
        Where interaction.id_interaction=?', [$url]);
        $data_exp = DB::connection('mysql2')->table('experience')
            ->join('interaction', 'interaction.id_experience', '=', 'experience.id_experience')
            ->where('interaction.id_interaction', '=', $url)
            ->first();
        // dd($data[0]->texte);

        $id_con = DB::connection('mysql2')->select('SELECT id_contact,nom,prenom FROM contact');

        $id_exp = DB::connection('mysql2')->select('SELECT id_experience,nom_experience FROM experience');


        // ----------tags_interaction--------------
        $les_tags_lier_avec_inter = DB::connection('mysql2')->table('tag_interaction')
            ->join('interaction_tag', 'tag_interaction.id_tag_interaction', '=', 'interaction_tag.id_tag_interaction')
            ->where('interaction_tag.id_interaction', '=', $url)
            ->get();
        if (count($les_tags_lier_avec_inter) > 0) {
            // dd($les_tags_lier_avec_inter);
            $response = [
                'data' => $data,
                'data_exp' => $data_exp,
                'id_con' => $id_con,
                'id_exp' => $id_exp,
                'tags_lier' => $les_tags_lier_avec_inter,
            ];
        } else {
            $response = [
                'data' => $data,
                'data_exp' => $data_exp,
                'id_con' => $id_con,
                'id_exp' => $id_exp,
            ];
        }
        // ----------tags_interaction--------------



        // Retourner le tableau associatif en tant que réponse JSON
        return response()->json($response);
    }

    public function updated_interaction(Request $request)
    {
        $request->validate([
            'id_interaction' => 'required|exists:mysql2.interaction,id_interaction',
            'id_contact' => 'required|exists:mysql2.contact,id_contact',
            'id_experience' => 'nullable|exists:mysql2.experience,id_experience',
            // 'type_interaction' => 'required',
            'texte',
            // ---------
            'le_tag_1' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_2' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_3' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_4' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_5' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            // nouveau
            'nouveau_tag_1' => 'nullable|',
            'nouveau_tag_2' => 'nullable|',
            'nouveau_tag_3' => 'nullable|',
            'nouveau_tag_4' => 'nullable|',
            'nouveau_tag_5' => 'nullable|',
        ]);
        // --------------------yasser----------------
        // -les tags- il y a 5 au maximum.
        $le_tag_1 = $request->le_tag_1;
        $le_tag_2 = $request->le_tag_2;
        $le_tag_3 = $request->le_tag_3;
        $le_tag_4 = $request->le_tag_4;
        $le_tag_5 = $request->le_tag_5;
        // ------
        $tags = [];
        if (isset($le_tag_1) && !in_array($le_tag_1, $tags)) {
            $tags[] = $le_tag_1;
        }
        if (isset($le_tag_2) && !in_array($le_tag_2, $tags)) {
            $tags[] = $le_tag_2;
        }
        if (isset($le_tag_3) && !in_array($le_tag_3, $tags)) {
            $tags[] = $le_tag_3;
        }
        if (isset($le_tag_4) && !in_array($le_tag_4, $tags)) {
            $tags[] = $le_tag_4;
        }
        if (isset($le_tag_5) && !in_array($le_tag_5, $tags)) {
            $tags[] = $le_tag_5;
        }

        // -----nouveau tag---
        $nouveau_tag_1 = $request->nouveau_tag_1;
        $nouveau_tag_2 = $request->nouveau_tag_2;
        $nouveau_tag_3 = $request->nouveau_tag_3;
        $nouveau_tag_4 = $request->nouveau_tag_4;
        $nouveau_tag_5 = $request->nouveau_tag_5;
        // --------
        $nouveau_tags = [];
        if (isset($nouveau_tag_1)) {
            $nouveau_tags['le_tag_1'] = $nouveau_tag_1;
        }
        if (isset($nouveau_tag_2)) {
            $nouveau_tags['le_tag_2'] = $nouveau_tag_2;
        }
        if (isset($nouveau_tag_3)) {
            $nouveau_tags['le_tag_3'] = $nouveau_tag_3;
        }
        if (isset($nouveau_tag_4)) {
            $nouveau_tags['le_tag_4'] = $nouveau_tag_4;
        }
        if (isset($nouveau_tag_5)) {
            $nouveau_tags['le_tag_5'] = $nouveau_tag_5;
        }
        // --------------------yasser----------------

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $interaction = Interaction::find($request->id_interaction);
        // dd($interaction);
        // -----------associer avec le tag selected--------
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('interaction_tag')
            ->where('id_interaction', $request->id_interaction)
            ->delete();
        // --------------suppression des tags ----------
        foreach ($tags as $tag) {
            DB::connection('mysql2')->table('interaction_tag')
                ->insertGetId([
                    'id_interaction' =>    $request->id_interaction,
                    'id_tag_interaction' =>    $tag,
                ]);
        }
        // ---------- ajouter nouveau tag et associer -----
        foreach ($nouveau_tags as $tag) {
            // Insérer le nouveau tag dans la table tag_interaction
            $tagId = DB::connection('mysql2')->table('tag_interaction')->insertGetId([
                'tag' => $tag
            ]);

            // Faire l'association dans la table interaction_tag
            DB::connection('mysql2')->table('interaction_tag')->insert([
                'id_interaction' => $request->id_interaction,
                'id_tag_interaction' => $tagId,
            ]);
        }

        // ---------------
        $interaction->update([
            'id_contact' => $request->id_contact,
            'id_experience' => $request->id_experience,
            'texte' => $request->texte,
            'date_heure' => $current_date->format('Y-m-d H:i:s')
        ]);



        $notif_text = 'Mise à jour de l\'interaction ID ' . $request->id_interaction . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'interaction'
            ]);
    }

    public function liste_tags($expression)
    {
        $tags_interaction = DB::connection('mysql2')->table('tag_interaction')
            ->orderByDesc('tag_interaction.id_tag_interaction')
            ->when($expression, function ($query, $expression) {
                return $query->where('tag', 'like', '%' . $expression . '%');
            })
            ->limit(5)
            ->get();
        return response()->json($tags_interaction);
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('interactions');
        DB::connection('mysql2')->table('interaction')->whereIn('id_interaction', $ids)->delete();
        return redirect()->route('interactions.index')->with('success', 'Selection supprimée avec succes');
    }
}
