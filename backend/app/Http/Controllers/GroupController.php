<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    public function index()
    {
        try {
            $groups = Group::with(['section', 'section.level'])->get();
            if ($groups->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun groupe trouvé',
                    'groups' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les groupes récupérée avec succès',
                'groups' => $groups
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des groupes : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $group = Group::with('section')->findOrFail($id);
            return response()->json([
                'message' => 'Groupe récupéré avec succès',
                'group' => $group
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Groupe non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération du groupe : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info($request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:groups,name',
                'section_id' => 'required|exists:sections,id',
                'description' => 'nullable|string',
                'capacity' => 'nullable|integer',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
                'name.unique' => 'Le nom du groupe doit être unique.',
                'section_id.required' => 'Le champ section est requis.',
                'section_id.exists' => 'La section spécifiée n\'existe pas.',
                'capacity.integer' => 'La capacité doit être un nombre entier.',
            ]);

            $group = Group::create([
                'name' => $request->name,
                'section_id' => $request->section_id,
                'description' => $request->description,
                'capacity' => $request->capacity,
            ]);

            return response()->json([
                'message' => 'Groupe créé avec succès',
                'group' => $group
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la création du groupe : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $group = Group::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:groups,name,' . $id,
                'section_id' => 'required|exists:sections,id',
                'description' => 'nullable|string',
                'capacity' => 'nullable|integer',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
                'name.unique' => 'Le nom du groupe doit être unique.',
                'section_id.required' => 'Le champ section est requis.',
                'section_id.exists' => 'La section spécifiée n\'existe pas.',
                'capacity.integer' => 'La capacité doit être un nombre entier.',
            ]);

            $group->update([
                'name' => $request->name,
                'section_id' => $request->section_id,
                'description' => $request->description,
                'capacity' => $request->capacity,
            ]);

            return response()->json([
                'message' => 'Groupe mis à jour avec succès',
                'group' => $group
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Groupe non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour du groupe : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $group = Group::findOrFail($id);
            $group->delete();
            return response()->json([
                'message' => 'Groupe supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Groupe non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du groupe : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function getGroupStudents($id)
    {
        try {
            $group = Group::findOrFail($id);
            $students = $group->students;
            return response()->json([
                'message' => 'Étudiants récupérés avec succès.',
                'students' => $students
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Groupe non trouvé avec l\'ID ' . $id
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des étudiants : ' . $exception->getMessage()
            ], 500);
        }
    }
}