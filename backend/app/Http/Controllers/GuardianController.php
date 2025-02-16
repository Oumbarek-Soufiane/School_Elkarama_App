<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GuardianController extends Controller
{
    public function index()
    {
        try {
            $guardians = Guardian::all();
            if ($guardians->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun tuteur trouvé',
                    'guardians' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les tuteurs récupérée avec succès',
                'guardians' => $guardians
            ], 200);
        } catch (
            Exception
            $exception
        ) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des tuteurs : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $guardian = Guardian::with('students')->findOrFail($id);
            return response()->json([
                'message' => 'Gardien récupéré avec succès',
                'guardian' => $guardian
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Gardien non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération du gardien : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        Log::info($request->all());
        try {
            $guardian = Guardian::findOrFail($id);

            $request->validate([
                'guardian_cin' => 'required|string|max:255|unique:guardians,guardian_cin,' . $id,
                'guardian_first_name' => 'required|string|max:255',
                'guardian_last_name' => 'required|string|max:255',
                'guardian_email' => 'required|email|max:255|unique:guardians,guardian_email,' . $id,
                'guardian_password' => 'required|string|min:8',
                'guardian_phone' => 'required|string|max:20|unique:guardians,guardian_phone,' . $id,
                'guardian_address' => 'required|string|max:255',
                'guardian_gender' => 'required|in:male,female',
                'guardian_nationality' => 'required|string|max:255',
                'guardian_relationship' => 'required|string|max:255',
                'second_guardian_cin' => 'nullable|string|max:255|unique:guardians,second_guardian_cin,' . $id,
                'second_guardian_first_name' => 'nullable|string|max:255',
                'second_guardian_last_name' => 'nullable|string|max:255',
                'second_guardian_email' => 'nullable|email|max:255',
                'second_guardian_phone' => 'nullable|string|max:20|unique:guardians,second_guardian_phone,' . $id,
                'second_guardian_address' => 'nullable|string|max:255',
                'second_guardian_gender' => 'nullable|in:male,female',
                'second_guardian_nationality' => 'nullable|string|max:255',
                'second_guardian_relationship' => 'nullable|string|max:255',
            ], [
                'guardian_cin.required' => 'Le champ CIN est requis.',
                'guardian_cin.string' => 'Le champ CIN doit être une chaîne de caractères.',
                'guardian_cin.max' => 'Le champ CIN ne doit pas dépasser :max caractères.',
                'guardian_cin.unique' => 'Le CIN doit être unique.',
                'guardian_first_name.required' => 'Le prénom est requis.',
                'guardian_last_name.required' => 'Le nom de famille est requis.',
                'guardian_email.required' => 'L\'email est requis.',
                'guardian_email.email' => 'L\'email doit être valide.',
                'guardian_email.unique' => 'L\'email doit être unique.',
                'guardian_password.required' => 'Le mot de passe est requis.',
                'guardian_password.min' => 'Le mot de passe doit avoir au moins :min caractères.',
                'guardian_phone.required' => 'Le numéro de téléphone est requis.',
                'guardian_phone.unique' => 'Le numéro de téléphone doit être unique.',
                'guardian_gender.in' => 'Le sexe doit être parmi :values.',
                'second_guardian_cin.unique' => 'Le CIN du second tuteur doit être unique.',
                'second_guardian_phone.unique' => 'Le numéro de téléphone du second tuteur doit être unique.',
            ]);

            $guardian->update([
                'guardian_cin' => $request->guardian_cin,
                'guardian_first_name' => $request->guardian_first_name,
                'guardian_last_name' => $request->guardian_last_name,
                'guardian_email' => $request->guardian_email,
                'guardian_password' => Hash::make($request->guardian_password),
                'guardian_phone' => $request->guardian_phone,
                'guardian_address' => $request->guardian_address,
                'guardian_gender' => $request->guardian_gender,
                'guardian_nationality' => $request->guardian_nationality,
                'guardian_relationship' => $request->guardian_relationship,
                'second_guardian_cin' => $request->second_guardian_cin,
                'second_guardian_first_name' => $request->second_guardian_first_name,
                'second_guardian_last_name' => $request->second_guardian_last_name,
                'second_guardian_email' => $request->second_guardian_email,
                'second_guardian_phone' => $request->second_guardian_phone,
                'second_guardian_address' => $request->second_guardian_address,
                'second_guardian_gender' => $request->second_guardian_gender,
                'second_guardian_nationality' => $request->second_guardian_nationality,
                'second_guardian_relationship' => $request->second_guardian_relationship,
            ]);

            return response()->json([
                'message' => 'Tuteur mis à jour avec succès',
                'guardian' => $guardian
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Tuteur non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour du tuteur : ' . $exception->getMessage()
            ], 500);
        }
    }
    public function showchild(Request $request)
    {
    try {
        $schoolYearId = $request->input('school_year_id'); 
       

        $guardian = Guardian::with([
            'students.section',
            'students.group',
            'students.attendances',
            'students.evaluations' => function ($query) use ($schoolYearId) {
                $query->where('school_year_id', $schoolYearId)->with('marks');
            }
        ])->where('id', auth()->id())->firstOrFail();

        return response()->json([
            'message' => 'Gardien récupéré avec succès',
            'guardian' => $guardian,
        ], 200);
    } catch (ModelNotFoundException $exception) {
        return response()->json([
            'message' => 'Gardien non trouvé avec l\'identifiant ' 
        ], 404);
    } catch (Exception $exception) {
        return response()->json([
            'message' => 'Erreur lors de la récupération du gardien : ' . $exception->getMessage()
        ], 500);
    }
}

}