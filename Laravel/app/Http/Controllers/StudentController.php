<?php

namespace App\Http\Controllers;

use App\Models\Tp;
use App\Models\Note;
use App\Models\Devoir;
use App\Models\Groupe;
use App\Models\Tuteur;
use App\Models\Absence;
use App\Models\Filiere;
use App\Models\Etudiant;
use App\Models\GroupeDetail;
use App\Models\TuteurDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{

    public function index()
    {
        $roles = DB::table("users")->selectRaw("role,count(*) as count")->where("role", "<>", "admin")
            ->groupBy("role")->get();
        $invites = DB::table("invites")->count();
        //TPs
        $groupe_id = auth()->user()->etudiant->groupe_id;
        $tps = Tp::where('groupe_id', $groupe_id)->orderByDesc('created_at')->get();
        $groupe = Groupe::find($groupe_id);
        $dateNow = now();
        // Absences
        $absences = Absence::join("etudiants as e", "e.id", "absences.etudiant_id")
        ->join("tuteur_details as td", "td.etudiant_id", "e.id")
        ->where("e.id", auth()->user()->etudiant->id)
        ->get();
        //Field
        $countTps =$tps->count();
        $countReponses =Devoir::where('etudiant_id',auth()->user()->etudiant->id)->count();
        $countAbsences =$absences->count();
        $countNotes =Note::where('etudiant_id',auth()->user()->etudiant->id)->count();
        return view("Etudiant.Dashboard", compact("roles", "invites","absences","tps", "groupe","dateNow","countTps","countReponses", "countAbsences","countNotes"));
    }

    public function notes()
    {
        $user_id = auth()->user()->id;
        $etudiant = Etudiant::all()->where('user_id', $user_id)->first();
        $modules = [];
        $notesArray = [];
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
        $enfant[$module->designation] = [
            'nom' => '',
            'prenom' => '',
            'notes' => $notesArray,
        ];
        return view('Etudiant.listNotes', compact('modules', 'notesArray', 'enfant'));
    }

    public function emploiDuTemps()
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->role;
        $filiere = [];
        $filieres = [];
        $emploieDuTemps = "";
        if ($role == "professeur") {
            $professeur_id = auth()->user()->professeur->id;
            $emploieDuTemps = "";
            $groupe_detail = GroupeDetail::all()->where('professeur_id', $professeur_id)->first();
            $filiere = Filiere::find($groupe_detail->groupe->filiere->id);
            $emploieDuTemps = $filiere;
            // dd($filiere);
        } elseif ($role == "etudiant") {
            $etudiant_id = auth()->user()->etudiant->id;
            $emploieDuTemps = "";
            $etudiant = Etudiant::find($etudiant_id);
            $filiere = Filiere::find($etudiant->groupe->filiere->id);
            $emploieDuTemps = $filiere;
        } elseif ($role == "admin") {
            $filieres = Filiere::all();
            //-----------------------------------------------
        } elseif ($role == "tuteur") {
            $emploieDuTemps = [];
            $tuteur = Tuteur::all()->where('user_id', $user_id)->first();
            $etudiants = TuteurDetail::all()->where('tuteur_id', $tuteur->id)->pluck('etudiant_id');
            foreach ($etudiants as $element) {
                $etudiant = Etudiant::find($element);
                $filiere = Filiere::find($etudiant->groupe->filiere->id);
                // $emploieDuTemps[$etudiant->id] = $filiere;
                $emploieDuTemps[$element] = [
                    'nom' => $etudiant->user->nom,
                    'prenom' => $etudiant->user->prenom,
                    'emploieDuTemps' => $filiere,
                ];
            }
            // dd($emploieDuTemps);

        }
        //-----------------------------------------------
        return view('Etudiant.emploiDuTemps', compact('filieres', 'filiere', 'emploieDuTemps', 'role'));
    }

    public function formEmploiDuTemps(Request $request)
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->role;
        if ($role == "admin") {
            $filiere = [];
            $filieres = Filiere::all();
            $emploieDuTemps = "";
            if ($request->filiere_id) {
                $filiere = Filiere::find($request->filiere_id);
                $emploieDuTemps = $filiere;
            }
        } elseif ($role == "professeur") {
            $filiere = [];
            $emploieDuTemps = "";
            if ($request->filiere_id) {
                $groupe_detail = GroupeDetail::all()->where('professeur_id', $user_id)->first();
                $filiere = Filiere::find($groupe_detail->groupe->filiere->id);
                $emploieDuTemps = $filiere;
            }
        } elseif ($role == "etudiant") {
            $user_id = auth()->user()->id;
            $filiere = [];
            $filieres = Filiere::all();
            $emploieDuTemps = "";
        }
        return view('Etudiant.emploiDuTemps', compact('filieres', 'filiere', 'emploieDuTemps', 'role'));
    }

    public function absences()
    {
        $absences = Absence::join("etudiants as e", "e.id", "absences.etudiant_id")
            ->join("tuteur_details as td", "td.etudiant_id", "e.id")
            ->where("e.id", auth()->user()->etudiant->id)
            ->get();
        return view("Etudiant.Absence", compact("absences"));
    }

    public function submitHomework(Request $request)
    {
        $etudiant_id = auth()->user()->etudiant->id;
        // dd($request);
        if ($etudiant_id) {
            $etudiant = Etudiant::find($etudiant_id);
            // dd($etudiant->groupe->filiere->designation);
            if ($request->hasFile('devoir')) {
                $file = $request->file('devoir');
                $fileName = time() . "." . $file->extension();
                $request->devoir->move(public_path('/img/Homeworks_Answers/' . $etudiant->groupe->filiere->designation . '/' . $etudiant->groupe->designation), $fileName);
                $devoir = Devoir::create([
                    'tp_id' => $request->tp_id,
                    'etudiant_id' => $etudiant_id,
                    'reponses' => '/Homeworks_Answers/' . $etudiant->groupe->filiere->designation . '/' . $etudiant->groupe->designation . '/' . $fileName,
                ]);
                return redirect()->route('etudiant.devoir.show');
            }
        }
    }

    public function etudiantDevoir(Request $request)
    {
        $etudiant_id = auth()->user()->etudiant->id;
        $results = [];

        if ($etudiant_id) {
            // $etudiant = Etudiant::find($etudiant_id);
            $devoirs = Devoir::where("etudiant_id", $etudiant_id)->orderBy('created_at', 'desc')->get();
            $results[] = $devoirs;
            return view('Etudiant.etudiantDevoir', compact('results'));
        } else {
            return abort(403, 'Access Denied');
        }
    }

    public function etudiantDevoirDelete(Request $request, $devoir_id)
    {
        $devoir = Devoir::find($devoir_id);
        if ($devoir){
            if (File::exists(public_path('img' . $devoir->reponses))) {
                File::delete(public_path('img' . $devoir->reponses));
            }
            Devoir::destroy($devoir_id);

            return Redirect()->back();
        }else{
            return abort(404, 'Not Found');
        }
    }


}
