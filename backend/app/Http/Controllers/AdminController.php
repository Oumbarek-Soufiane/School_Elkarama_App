<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $admins = User::all();
            if ($admins->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun administrateur trouvé',
                    'admins' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les administrateurs récupérée avec succès',
                'admins' => $admins
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des administrateurs : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $admin = User::findOrFail($id);
            return response()->json([
                'message' => 'Administrateur récupéré avec succès',
                'admin' => $admin
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Administrateur non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de l\'administrateur : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $admin = User::findOrFail($id);

            $request->validate([
                'cin' => 'required|string|max:255|unique:users,cin,' . $id,
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'phone' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'role' => 'required|in:admin,super_admin',
            ], [
                'cin.required' => 'Le champ CIN est requis.',
                'cin.unique' => 'Ce CIN est déjà utilisé.',
                'first_name.required' => 'Le champ prénom est requis.',
                'last_name.required' => 'Le champ nom de famille est requis.',
                'date_of_birth.required' => 'Le champ date de naissance est requis.',
                'gender.required' => 'Le champ sexe est requis.',
                'email.required' => 'Le champ email est requis.',
                'email.unique' => 'Cet email est déjà utilisé.',
                'phone.required' => 'Le champ téléphone est requis.',
                'address.required' => 'Le champ adresse est requis.',
                'role.required' => 'Le champ rôle est requis.',
                'role.in' => 'Le rôle doit être admin ou super_admin.',
            ]);

            if ($request->hasFile('image')) {
                if ($admin->image) {
                    Storage::disk('public')->delete($admin->image);
                }
                $imagePath = $request->file('image')->store('users', 'public');
                $admin->image = $imagePath;
            }

            $admin->update([
                'cin' => $request->cin,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
            ]);

            return response()->json([
                'message' => 'Admin mis à jour avec succès',
                'admin' => $admin
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Admin non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour de l\'admin : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $admin = User::findOrFail($id);
            if ($admin->role === 'super_admin') {
                return response()->json([
                    'message' => 'Vous ne pouvez pas supprimer un super admin.'
                ], 403);
            }

            if ($admin->image) {
                Storage::disk('public')->delete($admin->image);
            }

            $admin->delete();

            return response()->json([
                'message' => 'Admin supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Admin non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de l\'admin : ' . $exception->getMessage()
            ], 500);
        }
    }
}