<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Log;

class ClassRoomController extends Controller
{
    public function index()
    {
        try {
            $rooms = ClassRoom::all();
            if ($rooms->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune salle trouvée',
                    'rooms' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les salles récupérée avec succès',
                'rooms' => $rooms
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des salles : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $room = ClassRoom::findOrFail($id);
            return response()->json([
                'message' => 'Salle récupérée avec succès',
                'room' => $room
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Salle non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de la salle : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info($request->all());
        
        try {
            $request->validate([
                'number' => 'required|string|max:255|unique:class_rooms,number',
                'description' => 'nullable|string',
                'capacity' => 'nullable|integer',
                'type' => 'nullable|string|in:classroom,amphitheater,gym,lab,office',
                'availability' => 'boolean',
            ], [
                'number.required' => 'Le champ numéro est requis.',
                'number.string' => 'Le champ numéro doit être une chaîne de caractères.',
                'number.max' => 'Le champ numéro ne doit pas dépasser :max caractères.',
                'number.unique' => 'Le numéro de salle doit être unique.',
                'capacity.integer' => 'La capacité doit être un nombre entier.',
                'type.in' => 'Le type de salle doit être parmi :values.',
                'availability.boolean' => 'Le champ disponibilité doit être un booléen.',
            ]);

            $room = ClassRoom::create([
                'number' => $request->number,
                'description' => $request->description,
                'capacity' => $request->capacity,
                'type' => $request->type,
                'availability' => $request->availability ?? true,
            ]);

            return response()->json([
                'message' => 'Salle créée avec succès',
                'room' => $room
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la création de la salle : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $room = ClassRoom::findOrFail($id);

            $request->validate([
                'number' => 'required|string|max:255|unique:class_rooms,number,' . $id,
                'description' => 'nullable|string',
                'capacity' => 'nullable|integer',
                'type' => 'nullable|string|in:classroom,amphitheater,gym,lab,office',
                'availability' => 'boolean',
            ], [
                'number.required' => 'Le champ numéro est requis.',
                'number.string' => 'Le champ numéro doit être une chaîne de caractères.',
                'number.max' => 'Le champ numéro ne doit pas dépasser :max caractères.',
                'number.unique' => 'Le numéro de salle doit être unique.',
                'capacity.integer' => 'La capacité doit être un nombre entier.',
                'type.in' => 'Le type de salle doit être parmi :values.',
                'availability.boolean' => 'Le champ disponibilité doit être un booléen.',
            ]);

            $room->update([
                'number' => $request->number,
                'description' => $request->description,
                'capacity' => $request->capacity,
                'type' => $request->type,
                'availability' => $request->availability ?? true,
            ]);

            return response()->json([
                'message' => 'Salle mise à jour avec succès',
                'room' => $room
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Salle non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour de la salle : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $room = ClassRoom::findOrFail($id);
            $room->delete();
            return response()->json([
                'message' => 'Salle supprimée avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Salle non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de la salle : ' . $exception->getMessage()
            ], 500);
        }
    }
}