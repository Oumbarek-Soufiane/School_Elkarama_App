<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SchoolYearController extends Controller
{
    public function index()
    {
        try {
            $years = SchoolYear::all();
            if ($years->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune année scolaire trouvée',
                    'years' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les années scolaires récupérée avec succès',
                'years' => $years
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des années scolaires : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $year = SchoolYear::find($id);
            if (!$year) {
                return response()->json([
                    'message' => 'Année scolaire non trouvée'
                ], 404);
            }
            return response()->json([
                'message' => 'Année scolaire récupérée avec succès',
                'year' => $year
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de l\'année scolaire : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:school_years,name',
                'description' => 'nullable|string',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
                'name.unique' => 'Le champ nom doit être unique.',
                'description.string' => 'Le champ description doit être une chaîne de caractères.',
            ]);

            $year = SchoolYear::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => 'Année scolaire créée avec succès',
                'year' => $year
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la création de l\'année scolaire : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $year = SchoolYear::findOrFail($id);
            $request->validate([
                'name' => 'required|string|max:255|unique:school_years,name,' . $id,
                'description' => 'nullable|string',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
                'name.unique' => 'Le champ nom doit être unique.',
                'description.string' => 'Le champ description doit être une chaîne de caractères.',
            ]);
            $year->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json([
                'message' => 'Année scolaire mise à jour avec succès',
                'year' => $year
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Année scolaire non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour de l\'année scolaire : ' . $exception->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $year = SchoolYear::find($id);
            if (!$year) {
                return response()->json([
                    'message' => 'Année scolaire non trouvée'
                ], 404);
            }
            $year->delete();
            return response()->json([
                'message' => 'Année scolaire supprimée avec succès'
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de l\'année scolaire : ' . $exception->getMessage()
            ], 500);
        }
    }
}