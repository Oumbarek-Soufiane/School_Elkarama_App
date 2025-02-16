<?php

namespace App\Http\Controllers;

use App\Models\Tp;
use App\Models\Groupe;
use App\Models\Module;
use App\Models\Absence;
use App\Models\Filiere;
use App\Models\Etudiant;
use App\Models\GroupeDetail;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function etudiants()
    {
        return view("./Professeur/listEtudiants");
    }

    public function formAbsenceView()
    {
        $professeur_id = auth()->user()->professeur->id;
        $role = auth()->user()->role;
        $groupe = 0;
        $module = 0;
        $date = now()->format('d-m-Y');
        // dd($date);
        $absences = [];
        $etudiantsQuiOntPasDAbsenceDeCeDate = [];
        $groupes_id_Tab = GroupeDetail::all()->where('professeur_id', $professeur_id)->pluck('groupe_id');
        $groupes = Groupe::find($groupes_id_Tab);
        $modules = Module::all()->where('professeur_id', $professeur_id);

        return view('Absence', compact('groupe', 'module', 'date', 'groupes', 'modules', 'role', 'absences', 'etudiantsQuiOntPasDAbsenceDeCeDate'));
    }

    public function formStoreAbsenceView(Request $request)
    {
        $professeur_id = auth()->user()->professeur->id;
        $role = auth()->user()->role;
        // dd($request);
        $groupe = 0;
        $module = 0;
        $date = now()->format('d-m-Y');
        $absences = [];
        $etudiantsQuiOntPasDAbsenceDeCeDate = [];
        $groupes_id_Tab = GroupeDetail::all()->where('professeur_id', $professeur_id)->pluck('groupe_id');
        $groupes = Groupe::find($groupes_id_Tab);
        $modules = Module::all()->where('professeur_id', $professeur_id);

        return redirect()->route('professeur.absenceView', [
            'module' => $request->module_id,
            'groupe' => $request->groupe_id,
            'date' => $request->date,
        ])->with(compact('groupes', 'modules', 'role', 'absences', 'etudiantsQuiOntPasDAbsenceDeCeDate'));
    }


    public function absenceView(Request $request)
    {
        $date = $request["date"] ?? date("Y-m-d"); // If URL cames without date, so we give date variable today's date as a default walue
        $groupe = $request->groupe;
        $module = $request->module;
        $groupes = [];
        $modules = [];
        $role = auth()->user()->role;
        if ($role == 'professeur') {
            $professeur_id = auth()->user()->professeur->id;
            $groupes_id_Tab = GroupeDetail::all()->where('professeur_id', $professeur_id)->pluck('groupe_id');
            $groupes = Groupe::find($groupes_id_Tab);
            $modules = Module::all()->where('professeur_id', $professeur_id);
        }

        /*
            SELECT DISTINCT * FROM (
                (
                select
                    `a`.*,
                    `etudiants`.`id` as `idEtudiant`,
                    `etudiants`.`groupe_id`,
                    `u`.`nom`,
                    `u`.`prenom`
                from `etudiants`
                    left join `users` as `u` on `u`.`id` = `etudiants`.`user_id`
                    left join `absences` as `a` on `etudiants`.`id` = `a`.`etudiant_id`
                    left join `modules` as `m` on `m`.`id` = `a`.`module_id`
                where
                    `etudiants`.`groupe_id` = 2
                    and (
                        `a`.`module_id` = 2
                        or `a`.`module_id` is null
                    )
                    and (
                        date(a.created_at) = 2023 -12 -21
                        or `a`.`created_at` is null
                    )
                )
                union (
                    select
                        `a`.*,
                        `etudiants`.`id` as `idEtudiant`,
                        `etudiants`.`groupe_id`,
                        `u`.`nom`,
                        `u`.`prenom`
                    from `etudiants`
                        left join `users` as `u` on `u`.`id` = `etudiants`.`user_id`
                        left join `absences` as `a` on `etudiants`.`id` = `a`.`etudiant_id`
                        left join `modules` as `m` on `m`.`id` = `a`.`module_id`
                    where
                        `etudiants`.`groupe_id` = 2
                        and `etudiants`.`id` not in ()
                )
                order by `idEtudiant` asc
            )
        */
        $absences = Etudiant::select("a.*", "etudiants.id as idEtudiant", "etudiants.groupe_id", "u.nom", "u.prenom")
            ->leftJoin("users as u", "u.id", "etudiants.user_id")
            ->leftJoin("absences as a", "etudiants.id", "a.etudiant_id")
            ->leftJoin("modules as m", "m.id", "a.module_id")
            ->where("etudiants.groupe_id", $groupe)
            ->where(function ($query) use ($module) {
                $query->where("a.module_id", $module)
                    ->orWhereNull("a.module_id");
            })
            ->where(function ($query) use ($date) {
                $query->whereRaw("date(a.created_at)=?", $date)
                    ->orWhereNull("a.created_at");
            }); // This Query select all students in a specific groupe with specific module as well as date in URI

        $etudiantsQuiOntPasDAbsenceDeCeDate = Etudiant::select("a.*", "etudiants.id as idEtudiant", "etudiants.groupe_id", "u.nom", "u.prenom")
            ->leftJoin("users as u", "u.id", "etudiants.user_id")
            ->leftJoin("absences as a", "etudiants.id", "a.etudiant_id")
            ->leftJoin("modules as m", "m.id", "a.module_id")
            ->where("etudiants.groupe_id", $groupe)
            ->whereNotIn("etudiants.id", $absences->pluck("idEtudiant")->toArray());

        $absences = $absences->union($etudiantsQuiOntPasDAbsenceDeCeDate)->orderBy("idEtudiant")->get()->unique("idEtudiant");

        return view('Absence', compact("absences", "date", "module", "groupe", "groupes", "modules", "role"));
    }
    public function createAbsence(Request $request)
    {
        $absences = $request["dates"];
        $module = (int)$request["module"];
        $date = $request["date"] ?? date("Y-m-d");
        $absencesData = [];

        foreach ($absences as $absence) {
            if (!$absence) { // remove non checked value from Absences
                continue;
            }
            $absencesData[] = json_decode($absence, true);
        }

        foreach ($absencesData as $absenceData) {
            $isFound = Absence::where("etudiant_id", $absenceData["etudiant_id"])
                ->whereRaw("date(created_at)=?", $date)
                ->where("module_id", $module)
                ->get();

            if ($isFound->count() == 1) {
                $foundRecord = $isFound->first();
                $foundRecord->fill($absenceData);
                $foundRecord->save();
            } else {
                Absence::create([...$absenceData, "created_at" => "$date " . date('h:i:s'), "updated_at" => null]);
            }
        }

        return back()->with("message", "absence submited");
    }

    //TP
    public function createTp()
    {
        $professeur_id = auth()->user()->professeur->id;;
        $filieres = Filiere::all();
        $groupes_id_Tab = GroupeDetail::all()->where('professeur_id', $professeur_id)->pluck('groupe_id');
        $groupes = Groupe::find($groupes_id_Tab);
        $etudiants = Etudiant::all()->where('groupe_id', $groupes);
        $modules = Module::all()->where('professeur_id', $professeur_id);

        return view('Professeur.tp', compact('filieres', 'groupes', 'etudiants', 'modules'));
    }

    public function storeTp(Request $request)
    {
        $professeur_id = auth()->user()->professeur->id;;

        foreach ($request->groupe_id as $groupe_id) {
            $groupe = Groupe::find($groupe_id);

            $file = $request->file('description');
            $fileName = time() . "." . $file->extension();
            $file->storeAs('img/TP/' . $groupe->filiere->designation . '/' . $groupe->designation, $fileName);

            Tp::create([
                'professeur_id' => $professeur_id,
                'module_id' => $request->module_id,
                'groupe_id' => $groupe_id,
                'sujet' => $request->sujet,
                'description' => '/TP/' . $groupe->filiere->designation . '/' . $groupe->designation . '/' . $fileName,
                'dateFin' => $request->dateFin,
            ]);
        }
        return to_route("tp.list", $groupe_id);
    }


    public function listTP(Request $request, $groupe_id)
    {
        $tps = Tp::where('groupe_id', $groupe_id)->orderByDesc('created_at')->get();
        $groupe = Groupe::find($groupe_id);
        $dateNow = now();

        return view('Professeur.listTp', compact('tps', 'groupe', 'dateNow'));
    }

    public function formListTp()
    {
        $professeur_id = auth()->user()->professeur->id;;
        $filieres = Filiere::all();
        $groupes_id_Tab = GroupeDetail::all()->where('professeur_id', $professeur_id)->pluck('groupe_id');
        $groupes = Groupe::find($groupes_id_Tab);

        return view('Professeur.formListTp', compact('filieres', 'groupes'));
    }

    public function formStoreListTp(Request $request)
    {
        return to_route("tp.list", $request->groupe_id);
    }

    //Notes
    public function notes(Request $request)
    {
        $professeur_id = auth()->user()->professeur->id;;
        $groupes_id_Tab = GroupeDetail::all()->where('professeur_id', $professeur_id)->pluck('groupe_id');
        $modules = Module::all()->where('professeur_id', $professeur_id);
        $groupes = Groupe::find($groupes_id_Tab);
        // $etudiants = Etudiant::all()->where('groupe_id', $groupes);


        return view('Professeur.note', compact('groupes', 'modules'));
    }

    public function formNote(Request $request)
    {
        return redirect()->route('professeur.createNote', ['groupe_id' => $request->groupe_id, 'module_id' => $request->module_id]);
    }


    public function createNote(Request $request, $groupe_id, $module_id)
    {
        $notes = collect();
        $etudiants = Etudiant::all()->where('groupe_id', $groupe_id);
        $professeur_id = auth()->user()->professeur->id;;
        $groupe = Groupe::all()->find($groupe_id);
        $groupes = GroupeDetail::all()->where('professeur_id', $professeur_id)->pluck('groupe_id');
        $module = Module::all()->where('id', $module_id)->first();
        $modules = Module::all()->where('professeur_id', $professeur_id);
        $checkNotesExists = Note::all()->where('module_id', $module_id)->where('etudiant_id', $groupe->etudiants->first()->id);
        if (!$checkNotesExists->isEmpty()) {
            $notes = Note::all()->where('module_id', $module_id);
            return view('Professeur.addNote', compact('etudiants', 'groupe_id', 'module_id', 'groupe', 'module', 'modules', 'notes'));
        }
        return view('Professeur.addNote', compact('etudiants', 'groupe_id', 'module_id', 'groupe', 'modules', 'module', 'notes'));
    }

    public function storeNote(Request $request, $groupe_id, $module_id)
    {
        $exams = $request->input('exams');
        $etudiants = Etudiant::all()->where('groupe_id', $groupe_id);
        $etudiantIds = $etudiants->pluck('id');
        $notes = Note::whereIn('etudiant_id', $etudiantIds)->where('module_id', $module_id)->get();
        if ($notes->isEmpty()) {
            foreach ($exams as $etudiant_id => $examData) {
                // $etudiant_id is the ID of the student
                // $examData['controle_1'], $examData['controle_2'],$examData['exam'] are the exam scores for each student
                Note::create([
                    'etudiant_id' => $etudiant_id,
                    'module_id' => $module_id,
                    'controle_1' => isset($examData['controle_1']) ? $examData['controle_1'] : null,
                    'controle_2' => isset($examData['controle_2']) ? $examData['controle_2'] : null,
                    'exam' => isset($examData['exam']) ? $examData['exam'] : null,
                ]);
            }
            return redirect()->back();
        } else {
            foreach ($exams as $etudiant_id => $examData) {
                $noteEtudiant = Note::all()->where('etudiant_id', $etudiant_id)->where('module_id', $module_id)->first();
                // dd($exams);
                if ($noteEtudiant != null) {
                    $noteEtudiant->update([
                        'controle_1' => isset($examData['controle_1']) ? $examData['controle_1'] : null,
                        'controle_2' => isset($examData['controle_2']) ? $examData['controle_2'] : null,
                        'exam' => isset($examData['exam']) ? $examData['exam'] : null,
                    ]);
                }
            }
            return redirect()->back();
        }
    }
}
