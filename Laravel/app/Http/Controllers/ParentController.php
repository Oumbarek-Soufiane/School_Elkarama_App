<?php

namespace App\Http\Controllers;

use App\Models\Tp;
use App\Models\Note;
use App\Models\Devoir;
use App\Models\Tuteur;
use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\TuteurDetail;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $roles = DB::table("users")->selectRaw("role,count(*) as count")->where("role", "<>", "admin")
            ->groupBy("role")->get();
        $invites = DB::table("invites")->count();
        // Students
        $user_id = auth()->user()->id;
        $enfants = [];
        $countTps =0;
        $countReponses = 0;
        $countAbsences = 0;
        $countNotes = 0;

        $tuteur = Tuteur::all()->where('user_id', $user_id)->first();
        $etudiants = TuteurDetail::all()->where('tuteur_id', $tuteur->id)->pluck('etudiant_id');
        foreach ($etudiants as $element) {
            $etudiant = Etudiant::all()->where('id', $element)->first();
            $filiere = $etudiant->groupe->filiere->designation;
            $parents = TuteurDetail::all()->where('etudiant_id', $etudiant->id);
            $absences = Absence::join("etudiants as e", "e.id", "absences.etudiant_id")
            ->join("tuteur_details as td", "td.etudiant_id", "e.id")
            ->where("e.id", $etudiant->id)
            ->get();

            //Field
            $tps = Tp::where('groupe_id', $etudiant->groupe_id)->orderByDesc('created_at')->get();
            $countTps += $tps->count();
            $countReponses += Devoir::where('etudiant_id', $etudiant->id)->count();
            $countAbsences += $absences->count();
            $countNotes += Note::where('etudiant_id', $etudiant->id)->count();

            $enfants[$element] = [
                'etudiant' => $etudiant,
                'nom' => $etudiant->user->nom,
                'prenom' => $etudiant->user->prenom,
                'groupe' => $etudiant->groupe->designation,
                'filiere' => $filiere,
                'parents' => $parents,
            ];
        }
        // Absences
        $absences = Absence::join("etudiants as e", "e.id", "absences.etudiant_id")
            ->join("tuteur_details as td", "td.etudiant_id", "e.id")
            ->join("tuteurs as t", "td.tuteur_id", "t.id")
            ->where("t.id", auth()->user()->tuteur->id)
            ->get();


        return view("Tuteur.Dashboard", compact("roles", "invites", "absences", "enfants","countTps","countReponses", "countAbsences","countNotes"));
    }
    public function notes()
    {
        $user_id = auth()->user()->id;
        $modules = [];
        $notesArray = [];
        $enfant = [];
        $tuteur = Tuteur::all()->where('user_id', $user_id)->first();
        $etudiants = TuteurDetail::all()->where('tuteur_id', $tuteur->id)->pluck('etudiant_id');
        foreach ($etudiants as $element) {
            $etudiant = Etudiant::all()->where('id', $element)->first();
            foreach ($etudiant->groupe->groupe_details as $groupe_detail) {
                foreach ($groupe_detail->professeur->modules as $module) {
                    array_push($modules, $module);
                }
            }
            foreach ($modules as $module) {
                $note = Note::all()->where('module_id', $module->id)->where('etudiant_id', $etudiant->id)->first();
                if (!$note) {
                    $note = [
                        "etudiant_id" => $etudiant->id,
                        "module_id" => $module->id,
                        "controle_1" => null,
                        "controle_2" => null,
                        "exam" => null,
                    ];
                }
                $notesArray[$module->designation] = $note;
            }
            $enfant[$element] = [
                'nom' => $etudiant->user->nom,
                'prenom' => $etudiant->user->prenom,
                'notes' => $notesArray,
            ];
        }
        // Full Name, Module name,date
        $absences = Absence::join("etudiants as e", "e.id", "absences.etudiant_id")
            ->join("tuteur_details as td", "td.etudiant_id", "e.id")
            ->join("tuteurs as t", "td.tuteur_id", "t.id")
            ->where("t.id", auth()->user()->tuteur->id)
            ->get();
        return view('Etudiant.listNotes', compact('absences', 'enfant'));
    }

    public function absences()
    {
        $absences = Absence::join("etudiants as e", "e.id", "absences.etudiant_id")
            ->join("tuteur_details as td", "td.etudiant_id", "e.id")
            ->join("tuteurs as t", "td.tuteur_id", "t.id")
            ->where("t.id", auth()->user()->tuteur->id)
            ->get();
        return view("Tuteur.Absence", compact("absences"));
    }

    public function listTP($tuteur_id)
    {
        $modules = [];
        $notesArray = [];
        $enfants = [];
        $tuteur = Tuteur::find($tuteur_id);
        $etudiants = TuteurDetail::all()->where('tuteur_id', $tuteur->id)->pluck('etudiant_id');
        foreach ($etudiants as $etudiant_id) {
            $etudiant = Etudiant::all()->where('id', $etudiant_id)->first();
            $tps = Tp::where('groupe_id', $etudiant->groupe_id)->orderBy('created_at', 'desc')
                ->get();
            $tp_Done = Devoir::where("etudiant_id", $etudiant_id)->pluck('tp_id')->toArray();
            $enfants[$etudiant_id] = [
                'nom' => $etudiant->user->nom,
                'prenom' => $etudiant->user->prenom,
                'tp_Done' => $tp_Done,
                'listTp' => $tps,
            ];
        }
        return view('Tuteur.listTpEtudiants', compact('enfants'));
    }
}
