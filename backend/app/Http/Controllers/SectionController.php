<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class SectionController extends Controller
{
    public function index()
    {
        try {
            $sections = Section::with('level')->get();

            if ($sections->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune classe trouvée',
                    'sections' => []
                ], 200);
            }

            return response()->json([
                'message' => 'Liste de toutes les classes récupérée avec succès',
                'sections' => $sections
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des classes : ' . $exception->getMessage()
            ], 500);
        }
    }


    public function show($id)
    {
        try {
            $section = Section::findOrFail($id);
            return response()->json([
                'message' => 'classe récupérée avec succès',
                'section' => $section
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Classe non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de la classe : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:sections,name',
                'level_id' => 'required|exists:levels,id',
                'description' => 'nullable|string',
                'school_fees_per_month' => 'nullable|numeric',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
                'name.unique' => 'Le nom de la classe doit être unique.',
                'level_id.required' => 'Le champ niveau est requis.',
                'level_id.exists' => 'Le niveau spécifié n\'existe pas.',
                'school_fees_per_month.numeric' => 'Les frais de scolarité doivent être un nombre.',
            ]);

            $section = Section::create([
                'name' => $request->name,
                'level_id' => $request->level_id,
                'description' => $request->description,
                'school_fees_per_month' => $request->school_fees_per_month,
            ]);

            return response()->json([
                'message' => 'la Classe créée avec succès',
                'section' => $section
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la création de la classe : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $section = Section::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:sections,name,' . $id,
                'level_id' => 'required|exists:levels,id',
                'description' => 'nullable|string',
                'school_fees_per_month' => 'nullable|numeric',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
                'name.unique' => 'Le nom de la classe doit être unique.',
                'level_id.required' => 'Le champ niveau est requis.',
                'level_id.exists' => 'Le niveau spécifié n\'existe pas.',
                'school_fees_per_month.numeric' => 'Les frais de scolarité doivent être un nombre.',
            ]);

            $section->update([
                'name' => $request->name,
                'level_id' => $request->level_id,
                'description' => $request->description,
                'school_fees_per_month' => $request->school_fees_per_month,
            ]);

            return response()->json([
                'message' => 'la classe mise à jour avec succès',
                'section' => $section
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'la classe non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour de la classe : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->delete();
            return response()->json([
                'message' => 'classe supprimée avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'classe non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de la classe : ' . $exception->getMessage()
            ], 500);
        }
    }
}