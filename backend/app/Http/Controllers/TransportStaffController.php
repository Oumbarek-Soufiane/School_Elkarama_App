<?php

namespace App\Http\Controllers;

use App\Models\TransportStaff;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Log;

class TransportStaffController extends Controller
{
    public function index()
    {
        try {
            $staff = TransportStaff::with('bus')->get();
            if ($staff->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun personnel de transport trouvé',
                    'staff' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tout le personnel de transport récupérée avec succès',
                'staff' => $staff
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération du personnel de transport : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $staff = TransportStaff::findOrFail($id);
            return response()->json([
                'message' => 'Personnel de transport récupéré avec succès',
                'staff' => $staff
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Personnel de transport non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération du personnel de transport : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info($request->all());

        try {
            $request->validate([
                'bus_id' => 'nullable|exists:buses,id',
                'cin' => 'required|string|max:255|unique:transport_staff,cin',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:transport_staff,email',
                'phone_number' => 'required|string|max:20',
                'nationality' => 'required|string|max:255',
                'role' => 'required|in:driver,assistant',
            ], [
                'cin.required' => 'Le champ CIN est requis.',
                'cin.unique' => 'Le CIN doit être unique.',
                'first_name.required' => 'Le champ prénom est requis.',
                'last_name.required' => 'Le champ nom de famille est requis.',
                'date_of_birth.required' => 'Le champ date de naissance est requis.',
                'gender.required' => 'Le champ sexe est requis.',
                'address.required' => 'Le champ adresse est requis.',
                'email.required' => 'Le champ email est requis.',
                'email.unique' => 'L\'email doit être unique.',
                'phone_number.required' => 'Le champ numéro de téléphone est requis.',
                'nationality.required' => 'Le champ nationalité est requis.',
                'role.required' => 'Le champ rôle est requis.',
            ]);

            $staff = TransportStaff::create($request->all());

            return response()->json([
                'message' => 'Personnel de transport créé avec succès',
                'staff' => $staff
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la création du personnel de transport : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $staff = TransportStaff::findOrFail($id);

            $request->validate([
                'bus_id' => 'nullable|exists:buses,id',
                'cin' => 'required|string|max:255|unique:transport_staff,cin,' . $id,
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:transport_staff,email,' . $id,
                'phone_number' => 'required|string|max:20',
                'nationality' => 'required|string|max:255',
                'role' => 'required|string|max:255',
            ], [
                'cin.required' => 'Le champ CIN est requis.',
                'cin.unique' => 'Le CIN doit être unique.',
                'first_name.required' => 'Le champ prénom est requis.',
                'last_name.required' => 'Le champ nom de famille est requis.',
                'date_of_birth.required' => 'Le champ date de naissance est requis.',
                'gender.required' => 'Le champ sexe est requis.',
                'address.required' => 'Le champ adresse est requis.',
                'email.required' => 'Le champ email est requis.',
                'email.unique' => 'L\'email doit être unique.',
                'phone_number.required' => 'Le champ numéro de téléphone est requis.',
                'nationality.required' => 'Le champ nationalité est requis.',
                'role.required' => 'Le champ rôle est requis.',
            ]);

            $staff->update($request->all());

            return response()->json([
                'message' => 'Personnel de transport mis à jour avec succès',
                'staff' => $staff
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Personnel de transport non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour du personnel de transport : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $staff = TransportStaff::findOrFail($id);
            $staff->delete();
            return response()->json([
                'message' => 'Personnel de transport supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Personnel de transport non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du personnel de transport : ' . $exception->getMessage()
            ], 500);
        }
    }
}