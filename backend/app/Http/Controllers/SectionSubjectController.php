<?php

namespace App\Http\Controllers;

use App\Models\SectionSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class SectionSubjectController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id' => 'required|exists:sections,id',
            'subjects' => 'required|array',
            'subjects.*.id' => 'required|exists:subjects,id',
            'subjects.*.coefficient' => 'required|numeric|min:0',
            'subjects.*.hours' => 'required|numeric|min:0',
        ], [
            'section_id.required' => 'L\'identifiant de la section est requis.',
            'section_id.exists' => 'La section spécifiée n\'existe pas.',
            'subjects.required' => 'La liste des matières est requise.',
            'subjects.array' => 'La liste des matières doit être un tableau.',
            'subjects.*.id.required' => 'L\'identifiant de la matière est requis.',
            'subjects.*.id.exists' => 'La matière spécifiée n\'existe pas.',
            'subjects.*.coefficient.required' => 'Le coefficient est requis pour toutes les matières.',
            'subjects.*.coefficient.numeric' => 'Le coefficient doit être un nombre.',
            'subjects.*.coefficient.min' => 'Le coefficient ne peut pas être négatif.',
            'subjects.*.hours.required' => 'Le nombre d\'heures est requis pour toutes les matières.',
            'subjects.*.hours.numeric' => 'Le nombre d\'heures doit être un nombre.',
            'subjects.*.hours.min' => 'Le nombre d\'heures ne peut pas être négatif.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $createdSubjects = [];
        $updatedSubjects = [];

        foreach ($request->subjects as $subject) {
            try {
                $existingRecord = SectionSubject::where('subject_id', $subject['id'])
                    ->where('section_id', $request->section_id)
                    ->firstOrFail();

                $existingRecord->update([
                    'coefficient' => $subject['coefficient'],
                    'hours_per_week' => $subject['hours'],
                ]);
                $updatedSubjects[] = $subject['id'];
            } catch (ModelNotFoundException $e) {
                SectionSubject::create([
                    'coefficient' => $subject['coefficient'],
                    'hours_per_week' => $subject['hours'],
                    'section_id' => $request->section_id,
                    'subject_id' => $subject['id'],
                ]);
                $createdSubjects[] = $subject['id'];
            } catch (Exception $e) {
                return response()->json(['message' => 'Erreur : ' . $e->getMessage()], 500);
            }
        }

        $message = 'Matières traitées avec succès';
        if (!empty($updatedSubjects)) {
            $message .= ', certaines matières ont été mises à jour : ' . implode(', ', $updatedSubjects);
        }
        if (!empty($createdSubjects)) {
            $message .= ', certaines matières ont été créées : ' . implode(', ', $createdSubjects);
        }

        return response()->json(['message' => $message, 'created' => $createdSubjects, 'updated' => $updatedSubjects]);
    }

    public function index($section_id)
    {
        try {
            $sectionSubjects = SectionSubject::where('section_id', $section_id)
                ->with('subject')
                ->get();
            return response()->json(['sectionSubjects' => $sectionSubjects]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erreur : ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $subjectSection = SectionSubject::findOrFail($id);
            $subjectSection->delete();
            return response()->json(['message' => 'Matière supprimée avec succès'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Matière introuvable avec l\'identifiant ' . $id], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erreur : ' . $e->getMessage()], 500);
        }
    }
}