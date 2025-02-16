<?php

namespace App\Http\Controllers;

use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherAttendanceController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teachers' => 'required|array',
            'teachers.*.id' => 'required|exists:students,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'teachers.*.is_present' => 'sometimes|boolean', 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        foreach ($request->teachers as $teacher) {
            $existingAttendance = TeacherAttendance::where('teacher_id', $teacher['id'])
                                ->whereDate('date', $request->date)
                                ->first();

            if ($existingAttendance) {
                $existingAttendance->update([
                    'is_present' => $teacher['is_present'] ?? $existingAttendance->is_present, 
                    'end_time' => $request->end_time,
                    'start_time' => $request->start_time,
                ]);
            } else {
                TeacherAttendance::create([
                    'teacher_id' => $teacher['id'],
                    'user_id' => auth()->id(),
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'is_present' => $teacher['is_present'] ?? true, 
                ]);
            }
        }

        return response()->json(['message' => 'Attendance stored or updated successfully'], 201);
    }
}
