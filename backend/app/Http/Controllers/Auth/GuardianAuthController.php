<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuardianAuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $guardian = Guardian::where('guardian_email', $request->email)->first();
            if ($guardian && Hash::check($request->password, $guardian->guardian_password)) {
                $token = $guardian->createToken('app')->accessToken;

                $cookie = cookie('authToken', $token, 60 * 24 * 30, null, null, true, true);
                return response([
                    'message' => "Connexion réussie",
                    'token' => $token,
                    'guardian' => $guardian,
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

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }
}