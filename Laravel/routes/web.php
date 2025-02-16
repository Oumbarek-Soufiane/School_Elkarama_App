<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\TeacherDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
    * Admin : Dashboard, ListInvites, Lists (Filieres, Matieres, Etudiants, Professeurs, Parents, Absences, Notes), Ajoute (Professeur, Etudiant, Parent), Profils, Schedules.
    * Professeurs : Dashboard, Lists (Etudiants, Absences, Notes), Ajoute (Tp, Absences), Profils, Schedules.
    * Etudiants : Dashboard, Les Notes, Absences, Profil, ListTps, Devoirs, Schedules.
    * Parents : Dashboard, LeurEtudiants(Les Notes, Absences), LeurEtudiants(Schedules), LeurEtudiants(Devoirs).
    * Invites : Home, Register.
*/

/* Home */
Route::view("/", "welcome")->name("home");

/* Register Routes */
Route::get('/register', [AuthController::class, 'inviteView'])->name('register');
Route::post('/register', [AuthController::class, 'inviteStore'])->name('register');

/* Login Routes */
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'verifyLogin'])->name('login');

Route::middleware('auth')->group(function () {

    /*
    * Admin Routes -------------------------------------------------------------------------------------------------------------------------
    */
    Route::middleware("role:admin")->group(function () {
        // Dashboard
        Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        // List Par Role
        Route::get('/list/{role}', [AdminController::class, 'list'])->prefix("admin")->name('list');
        // Crée, Editer et Supprimer Par Role
        Route::get('/create/{role}', [AdminController::class, 'create'])->prefix("admin")->name('create');
        Route::get('/edit/{role}/{id}', [AdminController::class, 'edit'])->prefix("admin")->name('edit');
        Route::put('/{role}/{id}', [AdminController::class, 'update'])->prefix("admin")->name('update');
        Route::post('/{role}', [AdminController::class, 'store'])->prefix("admin")->name('store');
        Route::get('/delete/{role}/{id}', [AdminController::class,'delete'])->prefix('admin')->name('destroy');
        // Supprimer Professeur
        Route::delete('/professeur/{id}', [AdminController::class, 'deleteProfesseur'])->prefix("admin")->name('professeur.delete');
        // Invites
        Route::get('/invites/list', [AdminController::class, 'listInvites'])->prefix("admin")->name('admin.listInvites');
        Route::get('/invites/{invite_id}/accept', [AdminController::class, 'acceptInviteForm'])->prefix("admin")->name('admin.acceptInviteForm');
        Route::post('/invites/{invite_id}/accept', [AdminController::class, 'acceptInviteSubmit'])->prefix("admin")->name('admin.acceptInviteSubmit');
        Route::delete('/invites/{invite_id}/decline', [AdminController::class, 'declineInvites'])->prefix("admin")->name('admin.declineInvites');
        // Schedules
        Route::get('admin/schedules', [StudentController::class, 'emploiDuTemps'])->name('admin.emploiDuTemps');
        Route::post('/schedules', [StudentController::class, 'formEmploiDuTemps'])->name('etudiant.formEmploiDuTemps');
    });


    /*
    * Professeur Routes -------------------------------------------------------------------------------------------------------------------------
    */
    Route::middleware("role:professeur")->group(function () {
        // Dashboard
        Route::get('/professeur', [TeacherDashboardController::class, 'index'])->name('professeur.dashboard');
        // Absences
        Route::get('/absences/{module}/{groupe}/{date?}', [TeacherController::class, 'absenceView'])->prefix("professeur")->name('professeur.absenceView');
        Route::post('/absences/{module}/{groupe}/{date?}', [TeacherController::class, 'createAbsence'])->prefix("professeur")->name('professeur.createAbsence');
        // Notes
        Route::get('/note/create/{groupe_id}/{module_id}', [TeacherController::class, 'createNote'])->prefix("professeur")->name('professeur.createNote');
        Route::post('/note/create/{groupe_id}/{module_id}', [TeacherController::class, 'storeNote'])->prefix("professeur")->name('professeur.storeNote');

        Route::get('/note', [TeacherController::class, 'notes'])->prefix("professeur")->name('professeur.notes');
        Route::post('/note', [TeacherController::class, 'formNote'])->prefix("professeur")->name('professeur.formNote');
        // List des Groupes et des Etudiants
        Route::get('/groups', [GroupController::class, 'index'])->prefix("professeur")->name('professeur.listGroup');
        Route::get('/list/etudiants', [TeacherController::class, 'etudiants'])->prefix("professeur")->name('professeur.etudiants.list');
        // TPs
        Route::get('/tp/create', [TeacherController::class, 'createTp'])->prefix("professeur")->name('tp.create');
        Route::post('/tp', [TeacherController::class, 'storeTp'])->prefix("professeur")->name('tp.store');
        Route::get('professeur/tp/list/{groupe_id}', [TeacherController::class, 'listTp'])->name('tp.list');

        //to show a group's homeworks
        Route::get('professeur/tp/list/', [TeacherController::class, 'formListTp'])->name('tp.formList');
        Route::post('professeur/tp/list/', [TeacherController::class, 'formStoreListTp'])->name('tp.storelist');


        // HomeWorks
        Route::post('/homeworks', [HomeworkController::class, 'index'])->prefix("professeur")->name('professeur.index_homeworks');
        // Schedules
        Route::get('professeur/schedule', [StudentController::class, 'emploiDuTemps'])->name('professeur.emploiDuTemps');
    });


    /*
    * Etudiant Routes -------------------------------------------------------------------------------------------------------------------------
    */
    Route::middleware("role:etudiant")->group(function () {
        Route::get('/etudiant', [StudentController::class, 'index'])->name('etudiant.dashboard');
        Route::get('etudiant/notes', [StudentController::class, 'notes'])->name('etudiant.notes');
        Route::get('etudiant/absences', [StudentController::class, 'absences'])->name('etudiant.absences');
        Route::get('etudiant/schedule', [StudentController::class, 'emploiDuTemps'])->name('etudiant.emploiDuTemps');
        Route::get('etudiant/tp/list/{groupe_id}', [TeacherController::class, 'listTp'])->name('etudiant.tp.list');
        Route::get('etudiant/devoirs', [StudentController::class, 'etudiantDevoir'])->name('etudiant.devoir.show');
        Route::delete('etudiant/devoir/delete/{devoir_id}', [StudentController::class, 'etudiantDevoirDelete'])->name('etudiant.devoir.delete');
        Route::post('etudiant/tp/submit/{tp_id}', [StudentController::class, 'submitHomework'])->name('etudiant.tp.submitHomework');
    });

    /*
    * Parent Routes -------------------------------------------------------------------------------------------------------------------------
    */
    // Absences et Notes
    Route::middleware("role:tuteur")->group(function () {
        Route::get('/tuteur', [ParentController::class, 'index'])->name('tuteur.dashboard');
        Route::get('tuteur/notes', [ParentController::class, 'notes'])->name('tuteur.notes');
        Route::get('tuteur/absences', [ParentController::class, 'absences'])->name('tuteur.absences');
        Route::get('tuteur/schedules', [StudentController::class, 'emploiDuTemps'])->name('tuteur.emploiDuTemps');
        Route::get('tuteur/tp/list/{tuteur_id}', [ParentController::class, 'listTp'])->name('tuteur.tp.list');

    });

    /*
    * Common Routes -------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('/profil/{user_id}', [AuthController::class, 'profil'])->name('profil');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    /*
    ???
    */
    Route::post('/module', [SubjectController::class, 'list'])->name('listModel');
    Route::post('/subject', [SubjectController::class, 'list'])->name('listSubject');

});
