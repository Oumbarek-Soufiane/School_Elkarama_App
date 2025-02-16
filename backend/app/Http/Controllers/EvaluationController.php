<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\SchoolYear;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EvaluationController extends Controller
{
    public function index()
    {
        try {
            $evaluations = Evaluation::with('group', 'teacher', 'subject', 'schoolYear')->get();
            if ($evaluations->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune évaluation trouvée',
                    'evaluations' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les évaluations récupérée avec succès',
                'evaluations' => $evaluations
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des évaluations : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $evaluation = Evaluation::with('group', 'teacher', 'subject', 'schoolYear')->findOrFail($id);
            return response()->json([
                'message' => 'Evaluation récupéré avec succès',
                'evaluation' => $evaluation
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Evaluation non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération d\'evaluation : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info($request->all());
           
            $validator = Validator::make($request->all(), [
                'teacher_id' => 'required|exists:teachers,id',
                'group_id' => 'required|exists:groups,id',
                'subject_id' => 'required|exists:subjects,id',
                'evaluation_number' => 'required|integer|in:1,2,3,4',
                'type' => 'nullable|string',
                'date' => 'required|date',
                'start_time' => 'nullable|date_format:H:i',
                'end_time' => 'nullable|date_format:H:i|after:start_time',
                'description' => 'nullable|string',
                'status' => 'nullable|string',
                'semester' => 'nullable|integer', 
            ], [
                'teacher_id.required' => 'Le champ enseignant est requis.',
                'teacher_id.exists' => 'L\'enseignant sélectionné est invalide.',
                'group_id.required' => 'Le champ groupe est requis.',
                'group_id.exists' => 'Le groupe sélectionné est invalide.',
                'subject_id.required' => 'Le champ sujet est requis.',
                'subject_id.exists' => 'Le sujet sélectionné est invalide.',
                'evaluation_number.required' => 'Le numéro d\'évaluation est requis.',
                'evaluation_number.integer' => 'Le numéro d\'évaluation doit être un entier.',
                'evaluation_number.in' => 'Le numéro d\'évaluation doit être 1, 2, 3 ou 4.',
                'type.string' => 'Le type doit être une chaîne de caractères.',
                'date.required' => 'La date est requise.',
                'date.date' => 'La date n\'est pas valide.',
                'start_time.date_format' => 'L\'heure de début doit être au format HH:MM.',
                'end_time.date_format' => 'L\'heure de fin doit être au format HH:MM.',
                'end_time.after' => 'L\'heure de fin doit être après l\'heure de début.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'status.string' => 'Le statut doit être une chaîne de caractères.',
                'semester.integer' => 'Le semestre doit être un entier.', 
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $activeSchoolYear = SchoolYear::where('status', 'active')->first();

            if (!$activeSchoolYear) {
                return response()->json([
                    'message' => 'Aucune année scolaire active trouvée.'
                ], 422);
            }

            $exists = Evaluation::where('subject_id', $request->subject_id)
                ->where('group_id', $request->group_id)
                ->where('school_year_id', $activeSchoolYear->id)
                ->where('evaluation_number', $request->evaluation_number)
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'Une évaluation avec ces paramètres existe déjà.'
                ], 422);
            }

            $evaluation = Evaluation::create([
                'teacher_id' => $request->teacher_id,
                'group_id' => $request->group_id,
                'subject_id' => $request->subject_id,
                'school_year_id' => $activeSchoolYear->id,
                'evaluation_number' => $request->evaluation_number,
                'type' => $request->type,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'description' => $request->description,
                'status' => $request->status,
                'semester' => $request->semester,
            ]);

            return response()->json([
                'message' => 'Évaluation bien ajoutée',
                'evaluation' => $evaluation,
            ], 201);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Une erreur est survenue lors de l\'enregistrement de l\'évaluation.',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $evaluation = Evaluation::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'teacher_id' => 'required|exists:teachers,id',
                'group_id' => 'required|exists:groups,id',
                'subject_id' => 'required|exists:subjects,id',
                'evaluation_number' => 'required|integer|in:1,2,3,4',
                'type' => 'nullable|string',
                'date' => 'required|date',
                'start_time' => 'nullable|date_format:H:i',
                'end_time' => 'nullable|date_format:H:i|after:start_time',
                'description' => 'nullable|string',
                'status' => 'nullable|string',
                'semester' => 'required|integer', 
            ], [
                'teacher_id.required' => 'Le champ enseignant est requis.',
                'teacher_id.exists' => 'L\'enseignant sélectionné est invalide.',
                'group_id.required' => 'Le champ groupe est requis.',
                'group_id.exists' => 'Le groupe sélectionné est invalide.',
                'subject_id.required' => 'Le champ sujet est requis.',
                'subject_id.exists' => 'Le sujet sélectionné est invalide.',
                'evaluation_number.required' => 'Le numéro d\'évaluation est requis.',
                'evaluation_number.integer' => 'Le numéro d\'évaluation doit être un entier.',
                'evaluation_number.in' => 'Le numéro d\'évaluation doit être 1, 2, 3 ou 4.',
                'type.string' => 'Le type doit être une chaîne de caractères.',
                'date.required' => 'La date est requise.',
                'date.date' => 'La date n\'est pas valide.',
                'start_time.date_format' => 'L\'heure de début doit être au format HH:MM.',
                'end_time.date_format' => 'L\'heure de fin doit être au format HH:MM.',
                'end_time.after' => 'L\'heure de fin doit être après l\'heure de début.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'status.string' => 'Le statut doit être une chaîne de caractères.',
                'semester.integer' => 'Le semestre doit être un entier.', 
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $activeSchoolYear = SchoolYear::where('status', 'active')->first();
            if (!$activeSchoolYear) {
                return response()->json([
                    'message' => 'Aucune année scolaire active trouvée.'
                ], 422);
            }

            $exists = Evaluation::where('subject_id', $request->subject_id)
                ->where('group_id', $request->group_id)
                ->where('school_year_id', $activeSchoolYear->id)
                ->where('evaluation_number', $request->evaluation_number)
                ->where('id', '<>', $id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'Une évaluation avec ces paramètres existe déjà.'
                ], 422);
            }

            $evaluation->update([
                'teacher_id' => $request->teacher_id,
                'group_id' => $request->group_id,
                'subject_id' => $request->subject_id,
                'school_year_id' => $activeSchoolYear->id,
                'evaluation_number' => $request->evaluation_number,
                'type' => $request->type,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'description' => $request->description,
                'status' => $request->status,
                'semester' => $request->semester,
            ]);

            return response()->json([
                'message' => 'Évaluation mise à jour avec succès',
                'evaluation' => $evaluation
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Évaluation non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour de l\'évaluation : ' . $exception->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $evaluations = Evaluation::findOrFail($id);
            $evaluations->delete();
            return response()->json([
                'message' => 'Evaluation supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Evaluation non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du de l\'Evaluation : ' . $exception->getMessage()
            ], 500);
        }
    }
}