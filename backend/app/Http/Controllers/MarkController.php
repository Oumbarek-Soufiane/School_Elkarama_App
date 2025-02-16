<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MarkController extends Controller
{
    /* public function store(Request $request)
    {
        Log::info($request->all());

        try {
            $validator = Validator::make($request->all(), [
                'evaluation_id' => 'required|exists:evaluations,id',
                'students' => 'required|array',
                'students.*.id' => 'required|exists:students,id',
                'students.*.score' => 'required|numeric|min:0',
                'students.*.comment' => 'nullable|string',
            ], [
                'evaluation_id.required' => 'Le champ évaluation est requis.',
                'evaluation_id.exists' => 'L\'évaluation sélectionnée est invalide.',
                'students.required' => 'Le champ étudiants est requis.',
                'students.array' => 'Le champ étudiants doit être un tableau.',
                'students.*.id.required' => 'Le champ ID de l\'étudiant est requis.',
                'students.*.id.exists' => 'L\'ID de l\'étudiant sélectionné est invalide.',
                'students.*.score.required' => 'Le champ note est requis.',
                'students.*.score.numeric' => 'Le champ note doit être un nombre.',
                'students.*.score.min' => 'Le champ note doit être au moins de :min.',
                'students.*.comment.string' => 'Le champ commentaire doit être une chaîne de caractères.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            foreach ($request->students as $student) {
                $existingMark = Mark::where('evaluation_id', $request->evaluation_id)
                    ->where('student_id', $student['id'])
                    ->first();

                if ($existingMark) {
                    $existingMark->update([
                        'score' => $student['score'],
                        'comment' => $student['comment'],
                    ]);
                } else {
                    Mark::create([
                        'evaluation_id' => $request->evaluation_id,
                        'student_id' => $student['id'],
                        'score' => $student['score'],
                        'comment' => $student['comment'],
                    ]);
                }
            }
            return response()->json(['message' => 'Notes enregistrées ou mises à jour avec succès'], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de l\'enregistrement des notes : ' . $exception->getMessage()
            ], 500);
        }
    }*/

    public function store(Request $request)
    {
        Log::info($request->all());

        try {
            $validator = Validator::make($request->all(), [
                'evaluation_id' => 'required|exists:evaluations,id',
                'students' => 'required|array',
                'students.*.id' => 'required|exists:students,id',
                'students.*.score' => 'nullable|numeric|min:0', // Score peut être nullable
                'students.*.comment' => 'nullable|string',
            ], [
                'evaluation_id.required' => 'Le champ évaluation est requis.',
                'evaluation_id.exists' => "L'évaluation sélectionnée n'est pas valide.",
                'students.required' => 'Le champ étudiants est requis.',
                'students.array' => 'Le champ étudiants doit être un tableau.',
                'students.*.id.required' => "Le champ ID de l'étudiant est requis.",
                'students.*.id.exists' => "L'ID de l'étudiant sélectionné n'est pas valide.",
                'students.*.score.numeric' => 'Le champ note doit être un nombre.',
                'students.*.score.min' => 'Le champ note doit être au moins de :min.',
                'students.*.comment.string' => 'Le champ commentaire doit être une chaîne de caractères.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            foreach ($request->students as $studentData) {
                if (array_key_exists('score', $studentData)) {
                    $existingMark = Mark::where('evaluation_id', $request->evaluation_id)
                        ->where('student_id', $studentData['id'])
                        ->first();

                    if ($studentData['score'] !== null || $studentData['comment'] !== null) {
                        if ($existingMark) {
                            $existingMark->update([
                                'score' => $studentData['score'],
                                'comment' => $studentData['comment'],
                            ]);
                        } else {
                            Mark::create([
                                'evaluation_id' => $request->evaluation_id,
                                'student_id' => $studentData['id'],
                                'score' => $studentData['score'],
                                'comment' => $studentData['comment'],
                            ]);
                        }
                    } elseif ($existingMark) {
                        $existingMark->delete();
                    }
                }
            }

            return response()->json(['message' => 'Notes enregistrées ou mises à jour avec succès'], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de l\'enregistrement des notes : ' . $exception->getMessage()
            ], 500);
        }
    }



    public function getMarksForGroupAndEvaluation(Request $request)
    {
        $groupId = $request->query('group_id');
        $evaluationId = $request->query('evaluation_id');
        try {
            $marks = Mark::whereHas('student', function ($query) use ($groupId) {
                $query->where('group_id', $groupId);
            })
                ->where('evaluation_id', $evaluationId)
                ->with('student')
                ->get();
            return response()->json([
                'marks' => $marks
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des notes: ' . $exception->getMessage()
            ], 500);
        }
    }
}