<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Devoir;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Note;
use App\Models\Professeur;
use App\Models\Tp;
use App\Models\Tuteur;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $tps = Tp::whereIn('groupe_id', auth()->user()->professeur->groupes_details->pluck("groupe_id"));
        $countTps = $tps->count();
        $countDevoir = Devoir::whereIn('tp_id', $tps->get()->pluck("id"))->count();
        $countNotes = Note::whereIn('module_id', auth()->user()->professeur->modules->pluck("id"))->count();
        $absences = Absence::whereIn('module_id', auth()->user()->professeur->modules->pluck("id"))->where("created_at", date("Y-m-d"));
        $countAbsences = $absences->count();
        $absences = $absences->get();
        return view("Professeur.Dashboard", compact("countTps", "countDevoir", "countNotes", "countAbsences", "absences"));
    }
}
