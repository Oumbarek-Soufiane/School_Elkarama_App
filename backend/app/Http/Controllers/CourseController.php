<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'group_id' => 'required|exists:groups,id',
                'subject_id' => 'required|exists:subjects,id',
                'course_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file' => 'required|file|max:2048|mimes:pdf,doc,docx',
                'type' => 'required|string|max:255',
            ], [
                'group_id.required' => 'Le champ groupe est obligatoire.',
                'group_id.exists' => 'Le groupe sélectionné n\'existe pas.',
                'subject_id.required' => 'Le champ matière est obligatoire.',
                'subject_id.exists' => 'La matière sélectionnée n\'existe pas.',
                'course_name.required' => 'Le champ nom de cours est obligatoire.',
                'course_name.string' => 'Le champ nom de cours doit être une chaîne de caractères.',
                'course_name.max' => 'Le champ nom de cours ne doit pas dépasser :max caractères.',
                'description.string' => 'Le champ description doit être une chaîne de caractères.',
                'file.required' => 'Le fichier est obligatoire.',
                'file.file' => 'Le fichier doit être un fichier valide.',
                'file.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
                'file.mimes' => 'Le fichier doit être au format pdf, doc ou docx.',
                'type.required' => 'Le champ type est obligatoire.',
                'type.string' => 'Le champ type doit être une chaîne de caractères.',
                'type.max' => 'Le champ type ne doit pas dépasser :max caractères.',
            ]);

            if ($request->hasFile('file')) {
                $courspath = $request->file('file')->store('courses', 'public');
            } else {
                $courspath = null;
            }

            $course = Course::create([
                'group_id' => $request->group_id,
                'subject_id' => $request->subject_id,
                'teacher_id' => auth()->id(),
                'course_name' => $request->course_name,
                'description' => $request->description,
                'file' => $courspath,
                'type' => $request->type,
            ]);

            return response()->json([
                'message' => 'Le cours a été ajouté avec succès',
                'course' => $course,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de l\'ajout de cours : ' . $exception->getMessage(),
            ], 500);
        }
    }

    public function showCourse($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json([
                'message' => 'Cours récupérée avec succès',
                'course' => $course
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Cous non trouvée avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération du cours : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $request->validate([
                'group_id' => 'required|exists:groups,id',
                'subject_id' => 'required|exists:subjects,id',
                'course_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file' => 'nullable|file|max:2048|mimes:pdf,doc,docx',
                'type' => 'required|string|max:255',
            ], [
                'group_id.required' => 'Le champ groupe est obligatoire.',
                'group_id.exists' => 'Le groupe sélectionné n\'existe pas.',
                'subject_id.required' => 'Le champ matière est obligatoire.',
                'subject_id.exists' => 'La matière sélectionnée n\'existe pas.',
                'course_name.required' => 'Le champ nom de cours est obligatoire.',
                'course_name.string' => 'Le champ nom de cours doit être une chaîne de caractères.',
                'course_name.max' => 'Le champ nom de cours ne doit pas dépasser :max caractères.',
                'description.string' => 'Le champ description doit être une chaîne de caractères.',
                'file.file' => 'Le fichier doit être un fichier valide.',
                'file.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
                'file.mimes' => 'Le fichier doit être au format pdf, doc ou docx.',
                'type.required' => 'Le champ type est obligatoire.',
                'type.string' => 'Le champ type doit être une chaîne de caractères.',
                'type.max' => 'Le champ type ne doit pas dépasser :max caractères.',
            ]);
            if ($course->file && $request->hasFile('file')) {
                Storage::disk('public')->delete($course->file);
            }
            $course->update([
                'group_id' => $request->group_id,
                'subject_id' => $request->subject_id,
                'course_name' => $request->course_name,
                'type' => $request->type,
                'description' => $request->description,
                'file' => $request->hasFile('file') ? $request->file('file')->store('cours', 'public') : $course->file,
            ]);
            return response()->json([
                'message' => 'Le cours a été mis à jour avec succès',
                'course' => $course,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Cours non trouvé',
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour du cours : ' . $exception->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            if ($course->file) {
                Storage::disk('public')->delete($course->file);
            }
            $course->delete();
            return response()->json([
                'message' => 'Cours supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Cours non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du cours : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function groupcours($groupId)
    {
        $courses = Course::where('group_id', $groupId)->get();
        if (!$courses) {
            return response()->json(['message' => 'No courses found'], 404);
        }

        return response()->json(['courses' => $courses], 200);
    }

    public function teacherCourses()
    {
        try {
            $teacherId = auth()->id();
            $courses = Course::with(['subject', 'group'])
                ->where('teacher_id', $teacherId)
                ->get();
            return response()->json([
                'message' => 'Cours récupérés avec succès',
                'courses' => $courses,
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des cours : ' . $exception->getMessage(),
            ], 500);
        }
    }

    public function getStudentCourse()
    {
        $student = auth()->user();
        if (!$student->group_id) {
            return response()->json(['message' => 'Student does not belong to any group'], 404);
        }
        $courses = Course::with(['group', 'subject', 'teacher'])
            ->whereHas('group', function ($query) use ($student) {
                $query->where('id', $student->group_id);
            })
            ->get();

        $coursesWithFiles = [];

        foreach ($courses as $course) {
            if (Storage::exists($course->file)) {
                $course->file_url = Storage::url($course->file);
            } else {
                $course->file_url = null;
            }

            $coursesWithFiles[] = $course;
        }

        if (empty($coursesWithFiles)) {
            return response()->json(['message' => 'No courses found', 'courses' => []]);
        }

        return response()->json(['courses' => $coursesWithFiles], 200);
    }
}