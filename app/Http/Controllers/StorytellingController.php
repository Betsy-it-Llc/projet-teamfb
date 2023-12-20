<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Sortable;
use App\Models\experienceApp\Storytelling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorytellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $story = new Storytelling;
        $story->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $data = DB::connection('mysql2')->table('storytelling')
            ->select('storytelling.*', 'experience.nom_experience', 'tag_storytelling.id_tag_story', 'contents_experience.date_heure')
            ->join('contents_experience', 'storytelling.id_content_experience', '=', 'contents_experience.id_content_experience')
            ->join('experience', 'contents_experience.id_experience', '=', 'experience.id_experience')
            ->leftJoin('tag_storytelling', 'storytelling.id_storytelling', '=', 'tag_storytelling.id_storytelling')
            ->groupBy('storytelling.id_storytelling')
            ->orderByDesc('storytelling.id_storytelling')
            ->paginate($perPage);

        $id_con = DB::connection('mysql2')->select('SELECT id_contact,nom,prenom FROM contact');

        $id_exp = DB::connection('mysql2')->select('SELECT id_experience,nom_experience FROM experience');

        $contacts = DB::connection('mysql2')->table('contact')->get();



        // -------------------------------------yasser--------------------------------------------------
        $liste_tags = DB::connection('mysql2')->table('tag_story')
            ->distinct()
            ->get();
        $taille_resultat = $liste_tags->count();
        // ----------tags_storytelling--------------
        $les_tags_lier_avec_story = DB::connection('mysql2')->table('tag_story')
            ->join('tag_storytelling', 'tag_story.id_tag_story', '=', 'tag_storytelling.id_tag_story')
            ->orderByDesc('tag_story.id_tag_story')
            ->get();
        // ----------tags_storytelling--------------

        $tags_selected = $request->get('tags_test');
        if (isset($tags_selected)) {

            $tags = [];
            for ($i = 0; $i < $taille_resultat; $i++) {
                $var_temp = $request->get('tags_' . $i);

                if (isset($var_temp)) {
                    $tags[] = $var_temp;
                }
            }

            // ----------------
            $query = DB::connection('mysql2')->table('storytelling')
                ->select('storytelling.*', 'experience.nom_experience', 'tag_storytelling.id_tag_story', 'contents_experience.date_heure')
                ->join('contents_experience', 'storytelling.id_content_experience', '=', 'contents_experience.id_content_experience')
                ->join('experience', 'contents_experience.id_experience', '=', 'experience.id_experience')
                ->leftJoin('tag_storytelling', 'storytelling.id_storytelling', '=', 'tag_storytelling.id_storytelling')
                ->groupBy('storytelling.id_storytelling')
                ->orderByDesc('storytelling.id_storytelling');

            if (isset($tags[0])) {
                $query->whereIn('tag_storytelling.id_tag_story', $tags);
            }

            $data = $query->paginate($perPage);
        }

        $totalStory = $data->total();
        // -------------------------------------yasser--------------------------------------------------

        return view('storytellings.index', compact('data', 'perPage', 'totalStory', 'id_con', 'id_exp', 'contacts', 'les_tags_lier_avec_story', 'liste_tags'))
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
            'desc_story' => 'required',
            // --------
            'le_tag_1' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_2' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_3' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_4' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_5' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            // nouveau
            'nouveau_tag_1' => 'nullable|',
            'nouveau_tag_2' => 'nullable|',
            'nouveau_tag_3' => 'nullable|',
            'nouveau_tag_4' => 'nullable|',
            'nouveau_tag_5' => 'nullable|',
        ]);
        // ------------------yasser-------------------
        // -les tags- il y a 5 au maximum.
        $le_tag_1 = $request->le_tag_1;
        $le_tag_2 = $request->le_tag_2;
        $le_tag_3 = $request->le_tag_3;
        $le_tag_4 = $request->le_tag_4;
        $le_tag_5 = $request->le_tag_5;
        // --------
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
        // ----------
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
        // ------------------yasser-------------------
        $id_contact = $request->id_contact;
        $id_experience = $request->id_experience;
        $desc_content = $request->desc_content;
        $desc_story = $request->desc_story;


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Creation d\'un nouveau content experience de type storytelling associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'content experience/storytelling'
            ]);
        $content = DB::connection('mysql2')->table('contents_experience')
            ->insertGetId([
                'date_heure' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'description_' => $desc_content,
                'type' => 'storytelling',
                'id_experience' => $id_experience
            ]);
        $storytelling = DB::connection('mysql2')->table('storytelling')
            ->insertGetId([
                'id_content_experience' => $content,
                'description' => $desc_story,
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);
        // -----------associer avec le tag selected--------
        foreach ($tags as $key => $tag) {
            DB::connection('mysql2')->table('tag_storytelling')
                ->insertGetId([
                    'id_storytelling' => $storytelling,
                    'id_tag_story' => $tag,
                ]);
        }
        // ---------- ajouter nouveau tag et associer -----
        foreach ($nouveau_tags as $tag) {
            // Insérer le nouveau tag dans la table tag_interaction
            $tagId = DB::connection('mysql2')->table('tag_story')->insertGetId([
                'tag' => $tag
            ]);

            // Faire l'association dans la table interaction_tag
            DB::connection('mysql2')->table('tag_storytelling')
                ->insertGetId([
                    'id_storytelling' =>    $storytelling,
                    'id_tag_story' =>    $tagId,
                ]);
        }
        // ---------------

        return redirect()->route('storytellings.index', ['id_contact' => $id_contact])
            ->with('success', 'Storytelling créé avec succes !');
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


        return view('contents.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($story)
    {

        $story = DB::connection('mysql2')->table('storytelling')
            ->join('contents_experience', 'contents_experience.id_content_experience', '=', 'storytelling.id_content_experience')
            ->where('storytelling.id_storytelling', '=', $story)
            ->first();

        // -------------------------------------yasser--------------------------------------------------
        // ----------tags_storytelling--------------
        $les_tags_lier_avec_story = DB::connection('mysql2')->table('tag_story')
            ->join('tag_storytelling', 'tag_story.id_tag_story', '=', 'tag_storytelling.id_tag_story')
            ->orderByDesc('tag_story.id_tag_story')
            ->get();
        // ----------tags_storytelling--------------
        // -------------------------------------yasser--------------------------------------------------

        return view('storytellings.edit', compact('story', 'les_tags_lier_avec_story'));
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
            'id_storytelling' => 'required|exists:mysql2.storytelling,id_storytelling',
            // 'desc_content'=>'required|nullable|max:50',
            'desc_story' => 'required|nullable',
            // --------
            'le_tag_1' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_2' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_3' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_4' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_5' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            // nouveau
            'nouveau_tag_1' => 'nullable|',
            'nouveau_tag_2' => 'nullable|',
            'nouveau_tag_3' => 'nullable|',
            'nouveau_tag_4' => 'nullable|',
            'nouveau_tag_5' => 'nullable|',
        ]);
        // ------------------yasser-------------------
        // -les tags- il y a 5 au maximum.
        $le_tag_1 = $request->le_tag_1;
        $le_tag_2 = $request->le_tag_2;
        $le_tag_3 = $request->le_tag_3;
        $le_tag_4 = $request->le_tag_4;
        $le_tag_5 = $request->le_tag_5;
        // --------
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
        // ----------
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
        // ------------------yasser-------------------
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('tag_storytelling')
            ->where('id_storytelling', $request->id_storytelling)
            ->delete();
        // --------------suppression des tags ----------
        // -----------associer avec le tag selected--------
        foreach ($tags as $key => $tag) {
            DB::connection('mysql2')->table('tag_storytelling')
                ->insertGetId([
                    'id_storytelling' => $request->id_storytelling,
                    'id_tag_story' => $tag,
                ]);
        }
        // ---------- ajouter nouveau tag et associer -----
        foreach ($nouveau_tags as $tag) {
            // Insérer le nouveau tag dans la table tag_interaction
            $tagId = DB::connection('mysql2')->table('tag_story')->insertGetId([
                'tag' => $tag
            ]);

            // Faire l'association dans la table interaction_tag
            DB::connection('mysql2')->table('tag_storytelling')
                ->insertGetId([
                    'id_storytelling' =>    $request->id_storytelling,
                    'id_tag_story' =>    $tagId,
                ]);
        }
        // ---------------
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour du storytelling de ID ' . $request->id_storytelling . ' et du content experience associé le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'content experience/storytelling'
            ]);

        $story = DB::connection('mysql2')->table('storytelling')
            ->where('id_storytelling', '=', $request->id_storytelling)
            ->update([
                'description' => $request->desc_story,
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);
        $story = DB::connection('mysql2')->table('storytelling')
            ->where('id_storytelling', '=', $request->id_storytelling)
            ->first();

        $content = DB::connection('mysql2')->table('contents_experience')
            ->where('id_content_experience', '=', $story->id_content_experience)
            ->update([
                'description_' => $request->desc_content,
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);

        return redirect()->route('storytellings.index')
            ->with('success', 'La mise a jour a bien été effectuée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($story)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Suppression du storytelling de ID ' . $story . ' et du content experience associé le ' .  $current_date->format('Y-m-d H:i:s') . '';
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('tag_storytelling')
            ->where('id_storytelling', $story)
            ->delete();
        // --------------suppression des tags ----------
        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'content experience/storytelling'
            ]);

        $storytelling = DB::connection('mysql2')->table('storytelling')
            ->where('id_storytelling', '=', $story)
            ->first();

        $id_content = $storytelling->id_content_experience;


        $storytelling = DB::connection('mysql2')->table('storytelling')
            ->where('id_storytelling', '=', $story)
            ->delete();


        $content = DB::connection('mysql2')->table('contents_experience')
            ->where('id_content_experience', '=', $id_content)
            ->delete();

        return redirect()->route('storytellings.index')
            ->with('success', 'Storytelling suprimé avec succes');
    }

    // ------------------------------------------------
    public function edit_show_storytelling($p_story)
    {

        $story = DB::connection('mysql2')->table('storytelling')
            ->join('contents_experience', 'contents_experience.id_content_experience', '=', 'storytelling.id_content_experience')
            ->where('storytelling.id_storytelling', '=', $p_story)
            ->first();
        // ----------tags_storytelling--------------
        $les_tags_lier_avec_story = DB::connection('mysql2')->table('tag_story')
            ->join('tag_storytelling', 'tag_story.id_tag_story', '=', 'tag_storytelling.id_tag_story')
            ->where('tag_storytelling.id_storytelling', '=', $p_story)
            ->get();
        // ----------tags_storytelling--------------
        if (count($les_tags_lier_avec_story) > 0) {
            // dd($les_tags_lier_avec_inter);
            $response = [
                'data' => $story,
                'tags_lier' => $les_tags_lier_avec_story,
            ];
        } else {
            $response = [
                'data' => $story,
            ];
        }

        // Retourner le tableau associatif en tant que réponse JSON
        return response()->json($response);
    }

    // ___________________________________________________
    public function update_show_storytelling(Request $request)
    {
        $request->validate([
            'id_storytelling' => 'required|exists:mysql2.storytelling,id_storytelling',
            'desc_story' => 'required|nullable',
            // --------
            'le_tag_1' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_2' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_3' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_4' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_5' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            // nouveau
            'nouveau_tag_1' => 'nullable|',
            'nouveau_tag_2' => 'nullable|',
            'nouveau_tag_3' => 'nullable|',
            'nouveau_tag_4' => 'nullable|',
            'nouveau_tag_5' => 'nullable|',
        ]);
        // ------------------yasser-------------------
        // -les tags- il y a 5 au maximum.
        $le_tag_1 = $request->le_tag_1;
        $le_tag_2 = $request->le_tag_2;
        $le_tag_3 = $request->le_tag_3;
        $le_tag_4 = $request->le_tag_4;
        $le_tag_5 = $request->le_tag_5;
        // --------
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
        // ----------
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
        // ------------------yasser-------------------


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour du storytelling de ID ' . $request->id_storytelling . ' et du content experience associé le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'content experience/storytelling'
            ]);

        $story = DB::connection('mysql2')->table('storytelling')
            ->where('id_storytelling', '=', $request->id_storytelling)
            ->update([
                'description' => $request->desc_story,
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);
        $story = DB::connection('mysql2')->table('storytelling')
            ->where('id_storytelling', '=', $request->id_storytelling)
            ->first();

        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('tag_storytelling')
            ->where('id_storytelling', $request->id_storytelling)
            ->delete();
        // --------------suppression des tags ----------
        // -----------associer avec le tag selected--------
        foreach ($tags as $key => $tag) {
            DB::connection('mysql2')->table('tag_storytelling')
                ->insertGetId([
                    'id_storytelling' => $request->id_storytelling,
                    'id_tag_story' => $tag,
                ]);
        }
        // ---------- ajouter nouveau tag et associer -----
        foreach ($nouveau_tags as $tag) {
            // Insérer le nouveau tag dans la table tag_interaction
            $tagId = DB::connection('mysql2')->table('tag_story')->insertGetId([
                'tag' => $tag
            ]);

            // Faire l'association dans la table interaction_tag
            DB::connection('mysql2')->table('tag_storytelling')
                ->insertGetId([
                    'id_storytelling' =>    $request->id_storytelling,
                    'id_tag_story' =>    $tagId,
                ]);
        }
        // ---------------
        $content = DB::connection('mysql2')->table('contents_experience')
            ->where('id_content_experience', '=', $story->id_content_experience)
            ->update([
                'description_' => $request->desc_content,
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);
    }


    public function liste_tags($expression)
    {
        $tags_storytelling = DB::connection('mysql2')->table('tag_story')
            ->orderByDesc('tag_story.id_tag_story')
            ->when($expression, function ($query, $expression) {
                return $query->where('tag', 'like', '%' . $expression . '%');
            })
            ->limit(5)
            ->get();
        return response()->json($tags_storytelling);
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('storytellings');
        DB::connection('mysql2')->table('storytelling')->whereIn('id_storytelling', $ids)->delete();
        return redirect()->route('storytellings.index')->with('success', 'Selection supprimée avec succes');
    }
}
