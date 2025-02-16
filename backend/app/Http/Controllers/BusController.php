<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class BusController extends Controller
{
    public function index()
    {
        try {
            $buses = Bus::all();
            if ($buses->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun bus trouvé',
                    'buses' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les bus récupérée avec succès',
                'buses' => $buses
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des bus : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $bus = Bus::findOrFail($id);
            return response()->json([
                'message' => 'Bus récupéré avec succès',
                'bus' => $bus
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Bus non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération du bus : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'registration_number' => 'required|string|max:255|unique:buses,registration_number',
                'seating_capacity' => 'required|integer',
            ], [
                'registration_number.required' => 'Le champ numéro d\'immatriculation est requis.',
                'registration_number.string' => 'Le champ numéro d\'immatriculation doit être une chaîne de caractères.',
                'registration_number.max' => 'Le champ numéro d\'immatriculation ne doit pas dépasser :max caractères.',
                'registration_number.unique' => 'Le numéro d\'immatriculation doit être unique.',
                'seating_capacity.required' => 'La capacité de sièges est requise.',
                'seating_capacity.integer' => 'La capacité de sièges doit être un nombre entier.',
            ]);

            $bus = Bus::create([
                'registration_number' => $request->registration_number,
                'seating_capacity' => $request->seating_capacity,
            ]);

            return response()->json([
                'message' => 'Bus créé avec succès',
                'bus' => $bus
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la création du bus : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $bus = Bus::findOrFail($id);

            $request->validate([
                'registration_number' => 'required|string|max:255|unique:buses,registration_number,' . $id,
                'seating_capacity' => 'required|integer',
            ], [
                'registration_number.required' => 'Le champ numéro d\'immatriculation est requis.',
                'registration_number.string' => 'Le champ numéro d\'immatriculation doit être une chaîne de caractères.',
                'registration_number.max' => 'Le champ numéro d\'immatriculation ne doit pas dépasser :max caractères.',
                'registration_number.unique' => 'Le numéro d\'immatriculation doit être unique.',
                'seating_capacity.required' => 'La capacité de sièges est requise.',
                'seating_capacity.integer' => 'La capacité de sièges doit être un nombre entier.',
            ]);

            $bus->update([
                'registration_number' => $request->registration_number,
                'seating_capacity' => $request->seating_capacity,
            ]);

            return response()->json([
                'message' => 'Bus mis à jour avec succès',
                'bus' => $bus
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Bus non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour du bus : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $bus = Bus::findOrFail($id);
            $bus->delete();
            return response()->json([
                'message' => 'Bus supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Bus non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du bus : ' . $exception->getMessage()
            ], 500);
        }
    }
}