<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherAuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $teacher = Teacher::where('teacher_email', $request->email)->first();
            if ($teacher && Hash::check($request->password, $teacher->teacher_password)) {
                $token = $teacher->createToken('app')->accessToken;

                $cookie = cookie('authToken', $token, 60 * 24 * 30, null, null, true, true);
                return response([
                    'message' => "Connexion réussie",
                    'token' => $token,
                    'teacher' => $teacher
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