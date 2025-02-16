<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $authenticatedProf = Auth::user();
        if ($authenticatedProf) {
            $authenticatedProfId = $authenticatedProf->professeur->id;
        }
        $groups = DB::table('groupe_details')
            ->join('groupes', 'groupes.id', '=', 'groupe_details.groupe_id')
            ->where('groupe_details.professeur_id', '=', $authenticatedProfId)
            ->select('groupes.id as idGroupe', 'groupes.designation as groupeDesignation')
            ->get();
        return view('groups', compact('groups'));
    }
}
