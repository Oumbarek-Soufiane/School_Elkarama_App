<?php

namespace App\Http\Controllers;

use App\Mail\TeacherCredentialsMail;
use App\Models\Evaluation;
use App\Models\SchoolYear;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_cin' => 'required|string|max:255|unique:teachers',
            'teacher_first_name' => 'required|string|max:255',
            'teacher_last_name' => 'required|string|max:255',
            'teacher_date_of_birth' => 'required|date',
            'teacher_place_of_birth' => 'required|string|max:255',
            'teacher_gender' => 'required|in:male,female',
            'teacher_address' => 'required|string|max:255',
            'teacher_email' => 'required|string|email|max:255|unique:teachers',
            'teacher_phone_number' => 'required|string|max:10|unique:teachers',
            'teacher_nationality' => 'nullable|string|max:255',
            'teacher_diploma' => 'nullable',
            'teacher_image' => 'nullable|image',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $teacher_password = $this->generatePassword($request->teacher_first_name);

        if ($request->hasFile('teacher_image')) {
            $imagePath = $request->file('teacher_image')->store('teachers', 'public');
        } else {
            $imagePath = null;
        }

        $teacher = Teacher::create([
            'teacher_cin' => $request->teacher_cin,
            'teacher_first_name' => $request->teacher_first_name,
            'teacher_last_name' => $request->teacher_last_name,
            'teacher_date_of_birth' => $request->teacher_date_of_birth,
            'teacher_place_of_birth' => $request->teacher_place_of_birth,
            'teacher_gender' => $request->teacher_gender,
            'teacher_address' => $request->teacher_address,
            'teacher_email' => $request->teacher_email,
            'teacher_password' => Hash::make($teacher_password),
            'teacher_phone_number' => $request->teacher_phone_number,
            'teacher_nationality' => $request->teacher_nationality,
            'teacher_diploma' => $request->teacher_diploma,
            'teacher_image' => $imagePath,
        ]);
        $teacher->subjects()->attach($request->subjects);

        Mail::to($request->teacher_email)->send(new TeacherCredentialsMail(
            $request->teacher_first_name,
            $request->teacher_last_name,
            $request->teacher_email,
            $teacher_password,
        ));

        return response()->json([
            'message' => 'Teacher created successfully',
            'teacher' => $teacher,
        ], 201);
    }

    private function generatePassword($firstName)
    {
        return strtolower($firstName) . '@123';
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'teacher_cin' => 'required|string|max:255|unique:teachers,teacher_cin,' . $id,
            'teacher_first_name' => 'required|string|max:255',
            'teacher_last_name' => 'required|string|max:255',
            'teacher_date_of_birth' => 'required|date',
            'teacher_place_of_birth' => 'required|string|max:255',
            'teacher_gender' => 'required|in:male,female',
            'teacher_address' => 'required|string|max:255',
            'teacher_email' => 'required|string|email|max:255|unique:teachers,teacher_email,' . $id,
            'teacher_phone_number' => 'required|string|max:10',
            'teacher_nationality' => 'nullable|string|max:255',
            'teacher_diploma' => 'nullable',
            'teacher_image' => 'nullable|image',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $teacher = Teacher::findOrFail($id);

        $teacher->teacher_cin = $request->teacher_cin;
        $teacher->teacher_first_name = $request->teacher_first_name;
        $teacher->teacher_last_name = $request->teacher_last_name;
        $teacher->teacher_date_of_birth = $request->teacher_date_of_birth;
        $teacher->teacher_place_of_birth = $request->teacher_place_of_birth;
        $teacher->teacher_gender = $request->teacher_gender;
        $teacher->teacher_address = $request->teacher_address;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->teacher_phone_number = $request->teacher_phone_number;
        $teacher->teacher_nationality = $request->teacher_nationality;
        $teacher->teacher_diploma = $request->teacher_diploma;

        if ($request->hasFile('teacher_image')) {
            $imagePath = $request->file('teacher_image')->store('teachers', 'public');
            $teacher->teacher_image = $imagePath;
        }

        $teacher->save();

        $teacher->subjects()->sync($request->subjects);

        return response()->json([
            'message' => 'Teacher updated successfully',
            'teacher' => $teacher,
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $student = Teacher::findOrFail($id);
            $student->delete();
            return response()->json([
                'message' => 'Professeur supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Professeur non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du Professeur : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function list()
    {
        $teachers = Teacher::with('subjects')->get();
        if (!$teachers) {
            return response()->json(['message' => 'No teachers found'], 404);
        }

        return response()->json(['teachers' => $teachers], 200);
    }

    public function show($id)
    {
        $teacher = Teacher::with('subjects')->findOrFail($id);
        if (!$teacher) {
            return response()->json(['message' => 'teacher not found'], 404);
        }
        return response()->json([
            'teacher' => $teacher,
        ], 200);
    }

    public function teacherGroups()
    {
        try {
            $teacherId = Auth::user()->id;
            $teacher = Teacher::find($teacherId);
            if (!$teacher) {
                return response()->json([
                    'message' => 'Professeur non trouvé',
                    'groups' => []
                ], 200);
            }
            $groups = $teacher->groups()->with('section')->get();
            if ($groups->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun groupe trouvé pour ce professeur',
                    'groups' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste des groupes récupérée avec succès',
                'groups' => $groups
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des groupes : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function teacherSubjects()
    {
        try {
            $teacherId = Auth::user()->id;
            $teacher = Teacher::find($teacherId);

            if (!$teacher) {
                return response()->json([
                    'message' => 'Professeur non trouvé',
                    'subjects' => []
                ], 200);
            }

            $subjects = $teacher->subjects;

            if ($subjects->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune matière trouvée pour ce professeur',
                    'subjects' => []
                ], 200);
            }

            return response()->json([
                'message' => 'Liste des matières récupérée avec succès',
                'subjects' => $subjects
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des matières : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function teacherEvaluations()
    {
        try {
            $teacherId = Auth::user()->id;
            $teacher = Teacher::find($teacherId);
            if (!$teacher) {
                return response()->json([
                    'message' => 'Professeur non trouvé',
                    'evaluations' => []
                ], 200);
            }
            $activeSchoolYear = SchoolYear::where('status', 'active')->first();
            if (!$activeSchoolYear) {
                return response()->json([
                    'message' => 'Aucune année scolaire active trouvée',
                    'evaluations' => []
                ], 200);
            }
            $evaluations = Evaluation::where('teacher_id', $teacherId)
                ->where('school_year_id', $activeSchoolYear->id)
                ->with(['group', 'subject']) 
                ->get();
            if ($evaluations->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune évaluation trouvée pour ce professeur dans l\'année scolaire active',
                    'evaluations' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste des évaluations récupérée avec succès',
                'evaluations' => $evaluations
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des évaluations : ' . $exception->getMessage()
            ], 500);
        }
    }
}