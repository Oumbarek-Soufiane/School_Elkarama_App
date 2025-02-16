<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentBusController extends Controller
{
    public function index()
    {
        try {
            $students = Student::where('needs_transportation', true)->with('buses','guardian')->get();

            if ($students->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun étudiant nécessitant un transport trouvé',
                    'students' => []
                ], 200);
            }

            return response()->json([
                'message' => 'Liste de tous les étudiants nécessitant un transport récupérée avec succès',
                'students' => $students
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des étudiants nécessitant un transport : ' . $exception->getMessage()
            ], 500);
        }
    }
}