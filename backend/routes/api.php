<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\GuardianAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionSubjectController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentBusController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherGroupController;
use App\Http\Controllers\TransportStaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth Users Routes
Route::prefix('admin')->group(function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', ['uses' => 'login', 'as' => 'admin.login']);
        Route::middleware('auth:api')->get('user', 'user');
        Route::middleware('auth:api')->post('logout', 'logout');
    });
});

// Check admin token
Route::middleware('auth:api')->get('/check-token-admin', function () {
    return response()->json(['message' => 'Le jeton est valide'], 200);
});

// Check admin token and role
Route::middleware('auth:api')->get('/check-admin-role', function (Request $request) {
    $user = $request->user();
    if (!$user) {
        return response()->json(['message' => 'Utilisateur non authentifié'], 401);
    }
    $role = $user->role;
    if ($role === 'admin' || $role === 'super_admin') {
        return response()->json(['message' => 'Le jeton est valide', 'role' => $role], 200);
    } else {
        return response()->json(['message' => 'L\'utilisateur n\'a pas les permissions nécessaires'], 403);
    }
});

// Auth Teacher Routes
Route::prefix('teacher')->group(function () {
    Route::controller(TeacherAuthController::class)->group(function () {
        Route::post('login', ['uses' => 'login', 'as' => 'teacher.login']);
        Route::middleware('auth:teacher')->get('user', 'user');
        Route::middleware('auth:teacher')->post('logout', 'logout');
    });
});

// Check teacher token
Route::middleware('auth:teacher')->get('/check-token-teacher', function () {
    return response()->json(['message' => 'Le jeton est valide'], 200);
});

// Auth Student Routes
Route::prefix('student')->group(function () {
    Route::controller(StudentAuthController::class)->group(function () {
        Route::post('login', ['uses' => 'login', 'as' => 'student.login']);
        Route::middleware('auth:student')->get('user', 'user');
        Route::middleware('auth:student')->post('logout', 'logout');
    });
});

// Check student token
Route::middleware('auth:student')->get('/check-token-student', function () {
    return response()->json(['message' => 'Le jeton est valide'], 200);
});

// Auth Guardian Routes
Route::prefix('guardian')->group(function () {
    Route::controller(GuardianAuthController::class)->group(function () {
        Route::post('login', ['uses' => 'login', 'as' => 'guardian.login']);
        Route::middleware('auth:guardian')->get('user', 'user');
        Route::middleware('auth:guardian')->post('logout', 'logout');
    });
});

// Check student token
Route::middleware('auth:guardian')->get('/check-token-guardian', function () {
    return response()->json(['message' => 'Le jeton est valide'], 200);
});

// School Years Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(SchoolYearController::class)->group(function () {
        Route::get('school-years', 'index');
        Route::get('school-years/{id}', 'show');
        Route::post('school-years', 'store');
        Route::put('school-years/{id}', 'update');
        Route::delete('school-years/{id}', 'destroy');
    });
});

// Student School Years Routes
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::controller(SchoolYearController::class)->group(function () {
        Route::get('school-years', 'index');
    });
});

// Level Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(LevelController::class)->group(function () {
        Route::get('levels', 'index');
        Route::get('levels/{id}', 'show');
        Route::post('levels', 'store');
        Route::put('levels/{id}', 'update');
        Route::delete('levels/{id}', 'destroy');
    });
});

// Subject Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(SubjectController::class)->group(function () {
        Route::get('subjects', 'index');
        Route::get('subjects/{id}', 'show');
        Route::post('subjects', 'store');
        Route::put('subjects/{id}', 'update');
        Route::delete('subjects/{id}', 'destroy');
    });
});

// ClassRoom Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(ClassRoomController::class)->group(function () {
        Route::get('class-rooms', 'index');
        Route::get('class-rooms/{id}', 'show');
        Route::post('class-rooms', 'store');
        Route::put('class-rooms/{id}', 'update');
        Route::delete('class-rooms/{id}', 'destroy');
    });
});

// Section Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(SectionController::class)->group(function () {
        Route::get('sections', 'index');
        Route::get('sections/{id}', 'show');
        Route::post('sections', 'store');
        Route::put('sections/{id}', 'update');
        Route::delete('sections/{id}', 'destroy');
    });
});

// Group Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(GroupController::class)->group(function () {
        Route::get('groups', 'index');
        Route::get('groups/{id}', 'show');
        Route::post('groups', 'store');
        Route::put('groups/{id}', 'update');
        Route::delete('groups/{id}', 'destroy');
    });
});

// Student Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(StudentController::class)->group(function () {
        Route::get('students', 'index');
        Route::get('students/{id}', 'show');
        Route::post('students', 'store');
        Route::put('students/{id}', 'update');
        Route::delete('students/{id}', 'destroy');
        Route::post('assign/student/group', 'assignStudentTogroup');
        Route::post('reset/password/{id}', 'resetpassword');
    });
});

// Teacher Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(TeacherController::class)->group(function () {
        Route::get('teachers', 'list');
        Route::get('teachers/{id}', 'show');
        Route::post('teachers', 'store');
        Route::put('teachers/{id}', 'update');
        Route::delete('teachers/{id}', 'destroy');
    });
});

// Bus Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(BusController::class)->group(function () {
        Route::get('buses', 'index');
        Route::get('buses/{id}', 'show');
        Route::post('buses', 'store');
        Route::put('buses/{id}', 'update');
        Route::delete('buses/{id}', 'destroy');
    });
});

// Staff Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(TransportStaffController::class)->group(function () {
        Route::get('transport-staff', 'index');
        Route::get('transport-staff/{id}', 'show');
        Route::post('transport-staff', 'store');
        Route::put('transport-staff/{id}', 'update');
        Route::delete('transport-staff/{id}', 'destroy');
    });
});

// Student Bus Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(StudentBusController::class)->group(function () {
        Route::get('students/need/transportation', 'index');
    });
});

// Evaluation Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(EvaluationController::class)->group(function () {
        Route::get('evaluations', 'index');
        Route::get('evaluations/{id}', 'show');
        Route::post('evaluations', 'store');
        Route::put('evaluations/{id}', 'update');
        Route::delete('evaluations/{id}', 'destroy');
    });
});

// Guardian Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(GuardianController::class)->group(function () {
        Route::get('guardians', 'index');
        Route::get('guardians/{id}', 'show');
        Route::put('guardians/{id}', 'update');
    });
});

// Section Subject Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(SectionSubjectController::class)->group(function () {
        Route::post('sectionsubject',  'store');
        Route::get('sections/{section_id}/subjects', 'index');
        Route::delete('sectionsubject/{id}', 'destroy');
    });
});

// Teacher Group Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(TeacherGroupController::class)->group(function () {
        Route::post('assign/teacher/group',  'assignTeachersTogroup');
        Route::get('teachers/assignd/group/{id}', 'teachersAssignedToGroup');
    });
});

// Users (Admins) Routes
Route::prefix('admin')->middleware(['auth:api', 'check.role:super_admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('admins', 'index');
        Route::get('admins/{id}', 'show');
        Route::put('admins/{id}', 'update');
        Route::delete('admins/{id}', 'destroy');
    });
});

// Teacher Goups / Subjects / evaluations
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::controller(TeacherController::class)->group(function () {
        Route::get('groups', 'teacherGroups');
        Route::get('subjects', 'teacherSubjects');
        Route::get('evaluations', 'teacherEvaluations');
    });
});

// Students Group Route
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::controller(GroupController::class)->group(function () {
        Route::get('students/group/{id}', 'getGroupStudents');
    });
});

// Teacher Student marks
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::controller(MarkController::class)->group(function () {
        Route::post('students/marks', 'store');
        Route::get('students/marks', 'getMarksForGroupAndEvaluation');
    });
});

//Abscencs Student
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::controller(StudentAttendanceController::class)->group(function () {
        Route::post('students/attendances', 'store');
        Route::get('students/attendance-records', 'getAttendanceRecords');
    });
});

// courses 
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::controller(CourseController::class)->group(function () {
        Route::post('courses', 'store');
        Route::get('courses', 'teacherCourses');
        Route::get('courses/{id}', 'showCourse');
        Route::put('courses/{id}', 'update');
        Route::delete('courses/{id}', 'destroy');
        Route::get('groupcours/{groupId}', 'groupcours');
        Route::get('coursprof', 'coursprof');
    });
});

//Show child parent
Route::prefix('guardian')->middleware('auth:guardian')->group(function () {
    Route::controller(GuardianController::class)->group(function () {
        Route::get('showchild', 'showchild');
    });
});

//atendencs teachers
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(TeacherAttendanceController::class)->group(function () {
        Route::post('attendances', 'store');
    });
});

//marks authentify students 
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::controller(StudentController::class)->group(function () {
        Route::get('marks', 'showmarks');
    });
    Route::controller(CourseController::class)->group(function () {
        Route::get('cours', 'getStudentCourse');
    });
    Route::controller(StudentAttendanceController::class)->group(function () {
        Route::get('absences', 'getAttendanceRecords');
    });

});

//send message 
Route::controller(ContactController::class)->group(function () {
    Route::post('contact', 'store');
});

//contact 
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(ContactController::class)->group(function () {
        Route::get('contacts', 'list');
        Route::delete('contacts/{id}', 'destroy');
    });
});

//Dashboard 
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('dashboard', 'dashboard');
    });
});