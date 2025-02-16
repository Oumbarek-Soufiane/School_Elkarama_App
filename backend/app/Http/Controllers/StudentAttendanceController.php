<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentAttendanceController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:groups,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'students' => 'required|array',
            'students.*' => 'exists:students,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $teacherId = auth()->id();
        $absentStudents = $request->students;

        $studentsInGroup = Student::where('group_id', $request->group_id)->get();

        foreach ($studentsInGroup as $student) {
            $isAbsent = in_array($student->id, $absentStudents);
            $existingAttendance = StudentAttendance::where('student_id', $student->id)
                ->whereDate('date', $request->date)
                ->first();

            if ($existingAttendance) {
                $existingAttendance->update([
                    'teacher_id' => $teacherId,
                    'subject_id' => $request->subject_id,
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'is_present' => !$isAbsent,
                ]);
            } else {
                StudentAttendance::create([
                    'teacher_id' => $teacherId,
                    'student_id' => $student->id,
                    'subject_id' => $request->subject_id,
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'is_present' => !$isAbsent,
                ]);
            }
        }

        return response()->json(['message' => 'Présence enregistrée ou mise à jour avec succès'], 201);
    }

    public function getAttendanceRecords(Request $request)
    {
        $teacherId = auth()->id();
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $attendanceRecords = StudentAttendance::where('teacher_id', $teacherId)
            ->where('subject_id', $request->subject_id)
            ->whereDate('date', $request->date)
            ->whereTime('start_time', $request->start_time)
            ->whereTime('end_time', $request->end_time)
            ->get();
        return response()->json($attendanceRecords, 200);
    }
}