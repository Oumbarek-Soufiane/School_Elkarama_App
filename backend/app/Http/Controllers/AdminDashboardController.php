<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Group;
use App\Models\ClassRoom;
use App\Models\Bus;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $studentsCount = Student::count();
        $teachersCount = Teacher::count();
        $adminsCount = User::count();
        $groupsCount = Group::count();
        $classRoomsCount = ClassRoom::count();
        $busesCount = Bus::count();

        return response()->json([
            'studentsCount' => $studentsCount,
            'teachersCount' => $teachersCount,
            'adminsCount' => $adminsCount,
            'groupsCount' => $groupsCount,
            'classRoomsCount' => $classRoomsCount,
            'busesCount' => $busesCount,
        ]);
    }
}