<?php

namespace App\Http\Controllers;

use App\Models\TeacherGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherGroupController extends Controller
{

    public function assignTeachersTogroup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|integer',
            'teachers' => 'required|array',
            'teachers.*' => 'exists:teachers,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $selectedTeachers = $request->teachers;
            $groupId = $request->group_id;
            $currentAssignments = TeacherGroup::where('group_id', $groupId)->pluck('teacher_id')->toArray();
            $teachersToDelete = array_diff($currentAssignments, $selectedTeachers);
            TeacherGroup::where('group_id', $groupId)
                ->whereIn('teacher_id', $teachersToDelete)
                ->delete();
            foreach ($selectedTeachers as $teacherId) {
                $existingAssignment = TeacherGroup::where('group_id', $groupId)
                    ->where('teacher_id', $teacherId)
                    ->first();
                if (!$existingAssignment) {
                    TeacherGroup::create([
                        'group_id' => $groupId,
                        'teacher_id' => $teacherId,
                    ]);
                }
            }
            return response()->json(['message' => 'Teachers added to group successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function teachersAssignedToGroup($id)
    {
        try {
            $teacherGroups = TeacherGroup::with(['teacher.subjects'])
                ->where('group_id', $id)
                ->get();
            if ($teacherGroups->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune association professeurs-groupes trouvée pour ce groupe',
                    'teacherGroups' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste des professeurs assignés au groupe récupérée avec succès',
                'teacherGroups' => $teacherGroups
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des associations professeurs-groupes : ' . $exception->getMessage()
            ], 500);
        }
    }
}