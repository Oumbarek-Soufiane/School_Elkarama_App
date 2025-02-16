<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminCredentialsMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminAuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'cin' => 'required|string|max:255|unique:users,cin',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'phone' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'role' => 'required|in:admin,super_admin',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                'image.image' => 'Le fichier doit être une image.',
                'image.mimes' => 'L\'image doit être de type :jpeg, :png, :jpg, :gif.',
                'image.max' => 'L\'image ne doit pas dépasser 2MB.',
            ]);

            $password = $this->generatePassword($request->first_name);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('users', 'public');
            } else {
                $imagePath = null;
            }

            $user = User::create([
                'cin' => $request->cin,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => Hash::make($password),
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
                'image' => $imagePath,
            ]);

            Mail::to($request->email)->send(new AdminCredentialsMail(
                $request->first_name,
                $request->last_name,
                $request->email,
                $password
            ));

            return response()->json([
                'message' => 'Utilisateur enregistré avec succès',
                'user' => $user
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    private function generatePassword($firstName)
    {
        return strtolower($firstName) . '@123';
    }

    public function login(Request $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                $cookie = cookie('authToken', $token, 60 * 24 * 30, null, null, true, true);
                return response([
                    'message' => "Connexion réussie",
                    'token' => $token,
                    'user' => $user
                ])->withCookie($cookie);
            }
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 401);
        }
        return response([
            'message' => 'Adresse e-mail ou mot de passe invalide'
        ], 400);
    }

    public function user()
    {
        try {
            if (Auth::check()) {
                return Auth::user();
            } else {
                return response()->json(['error' => 'Token manquant ou invalide'], 401);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }
}