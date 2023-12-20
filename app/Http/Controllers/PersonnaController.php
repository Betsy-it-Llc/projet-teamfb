<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PersonnaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function liste_tags($expression)
{
    $personas = DB::connection('mysql2')->table('persona')
        ->orderByDesc('persona.id_persona')
        ->when($expression, function ($query, $expression) {
            return $query->where('tag', 'like', '%' . $expression . '%');
        })
        ->limit(5)
        ->get();

    return response()->json($personas);
}

}
