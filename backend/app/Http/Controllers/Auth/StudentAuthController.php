<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $student = Student::where('student_email', $request->email)->first();
            if ($student && Hash::check($request->password, $student->student_password)) {
                $token = $student->createToken('app')->accessToken;
                $cookie = cookie('authToken', $token, 60 * 24 * 30, null, null, true, true);
                return response([
                    'message' => "Connexion réussie",
                    'token' => $token,
                    'student' => $student
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
