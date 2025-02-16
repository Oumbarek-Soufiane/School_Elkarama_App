<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubjectController extends Controller
{
    public function index()
    {
        try {
            $subjects = Subject::all();
            if ($subjects->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune matière trouvée',
                    'subjects' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les matières récupérée avec succès',
                'subjects' => $subjects
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des matières : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $subject = Subject::find($id);
            if (!$subject) {
                return response()->json([
                    'message' => 'Matière non trouvée'
                ], 404);
            }
            return response()->json([
                'message' => 'Matière récupérée avec succès',
                'subject' => $subject
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de la matière : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:subjects,name',
                'description' => 'nullable|string',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
                'name.unique' => 'Le champ nom doit être unique.',
                'description.string' => 'Le champ description doit être une chaîne de caractères.',
            ]);

            $subject = Subject::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => 'Matière créée avec succès',
                'subject' => $subject
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la création de la matière : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $subject = Subject::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:subjects,name,' . $id,
                'description' => 'nullable|string',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
                'name.unique' => 'Le champ nom doit être unique.',
                'description.string' => 'Le champ description doit être une chaîne de caractères.',
            ]);

            $subject->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => 'Matière mise à jour avec succès',
                'subject' => $subject
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Matière non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour de la matière : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $subject = Subject::find($id);
            if (!$subject) {
                return response()->json([
                    'message' => 'Matière non trouvée'
                ], 404);
            }
            $subject->delete();
            return response()->json([
                'message' => 'Matière supprimée avec succès'
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de la matière : ' . $exception->getMessage()
            ], 500);
        }
    }
    
}