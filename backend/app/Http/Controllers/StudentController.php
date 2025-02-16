<?php

namespace App\Http\Controllers;

use App\Mail\StudentAndGuardianCredentialsMail;
use App\Models\Group;
use App\Models\Student;
use App\Models\Guardian;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_first_name' => 'required|string|max:255',
            'student_last_name' => 'required|string|max:255',
            'student_date_of_birth' => 'required|date',
            'student_city_of_birth' => 'required|string|max:255',
            'student_country_of_birth' => 'required|string|max:255',
            'student_gender' => 'required|in:male,female',
            'student_address' => 'required|string|max:255',
            'student_phone_number' => [
                'nullable',
                'string',
                'regex:/^(06|07)[0-9]{8}$/',
                'max:20',
            ],
            'student_nationality' => 'required|string|max:255',
            'needs_transportation' => 'required|boolean',
            'student_illnesses' => 'nullable|string',
            'study_troubles' => 'required|boolean',
            'study_troubles_description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'guardian_first_name' => 'required|string|max:255',
            'guardian_last_name' => 'required|string|max:255',
            'guardian_cin' => 'required|string|max:255|unique:guardians',
            'guardian_email' => 'required|string|email|max:255|unique:guardians',
            'guardian_phone' => [
                'required',
                'string',
                'regex:/^(06|07)[0-9]{8}$/',
                'max:20',
                'unique:guardians',
            ],
            'guardian_address' => 'required|string|max:255',
            'guardian_gender' => 'required|in:male,female',
            'guardian_nationality' => 'required|string|max:255',
            'guardian_relationship' => 'required|string|max:255',
            'second_guardian_first_name' => 'nullable|string|max:255',
            'second_guardian_last_name' => 'nullable|string|max:255',
            'second_guardian_cin' => 'nullable|string|max:255|unique:guardians,second_guardian_cin',
            'second_guardian_email' => 'nullable|string|email|max:255|unique:guardians,second_guardian_email',
            'second_guardian_phone' => [
                'nullable',
                'string',
                'regex:/^(06|07)[0-9]{8}$/',
                'max:20',
                'unique:guardians,second_guardian_phone',
            ],
            'second_guardian_address' => 'nullable|string|max:255',
            'second_guardian_gender' => 'nullable|in:male,female',
            'second_guardian_nationality' => 'nullable|string|max:255',
            'second_guardian_relationship' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $guardian_password = $this->generatePassword($request->guardian_first_name);
        $student_password = $this->generatePassword($request->student_first_name);

        $guardian = Guardian::create([
            'guardian_first_name' => $request->guardian_first_name,
            'guardian_last_name' => $request->guardian_last_name,
            'guardian_cin' => $request->guardian_cin,
            'guardian_email' => $request->guardian_email,
            'guardian_password' => Hash::make($guardian_password),
            'guardian_phone' => $request->guardian_phone,
            'guardian_address' => $request->guardian_address,
            'guardian_gender' => $request->guardian_gender,
            'guardian_nationality' => $request->guardian_nationality,
            'guardian_relationship' => $request->guardian_relationship,
            'second_guardian_first_name' => $request->second_guardian_first_name,
            'second_guardian_last_name' => $request->second_guardian_last_name,
            'second_guardian_cin' => $request->second_guardian_cin,
            'second_guardian_email' => $request->second_guardian_email,
            'second_guardian_phone' => $request->second_guardian_phone,
            'second_guardian_address' => $request->second_guardian_address,
            'second_guardian_gender' => $request->second_guardian_gender,
            'second_guardian_nationality' => $request->second_guardian_nationality,
            'second_guardian_relationship' => $request->second_guardian_relationship,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students', 'public');
        } else {
            $imagePath = null;
        }

        $student_email = $this->generateUniqueEmail($request->student_first_name, $request->student_last_name);

        $student = Student::create([
            'guardian_id' => $guardian->id,
            'section_id' => $request->section_id,
            'group_id' => $request->group_id,
            'cne' => $request->cne,
            'student_first_name' => $request->student_first_name,
            'student_last_name' => $request->student_last_name,
            'student_date_of_birth' => $request->student_date_of_birth,
            'student_city_of_birth' => $request->student_city_of_birth,
            'student_country_of_birth' => $request->student_country_of_birth,
            'student_gender' => $request->student_gender,
            'student_address' => $request->student_address,
            'student_email' => $student_email,
            'student_password' => Hash::make($student_password),
            'student_phone_number' => $request->student_phone_number,
            'student_nationality' => $request->student_nationality,
            'needs_transportation' => $request->needs_transportation,
            'student_illnesses' => $request->student_illnesses,
            'study_troubles' => $request->study_troubles,
            'study_troubles_description' => $request->study_troubles_description,
            'image' => $imagePath,
        ]);

        Mail::to($request->guardian_email)->send(new StudentAndGuardianCredentialsMail(
            $request->student_first_name,
            $student_email,
            $student_password,
            $request->guardian_first_name,
            $request->guardian_email,
            $guardian_password
        ));

        return response()->json([
            'message' => 'Student and guardian created successfully',
            'student' => $student,
            'guardian' => $guardian,
            'guardian_password' => $guardian_password,
            'student_password' => $student_password
        ], 201);
    }

    private function generateUniqueEmail($firstName, $lastName)
    {
        $emailBase = strtolower($firstName . '.' . $lastName);
        $emailDomain = '@alkarama.ma';
        $email = $emailBase . $emailDomain;

        $counter = 1;
        while (Student::where('student_email', $email)->exists() || Guardian::where('guardian_email', $email)->exists()) {
            $email = $emailBase . $counter . $emailDomain;
            $counter++;
        }

        return $email;
    }

    private function generatePassword($firstName)
    {
        return strtolower($firstName) . '@123';
    }

    public function index()
    {
        try {
            $students = Student::with('guardian', 'section', 'group')->get();
            if ($students->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun étudiant trouvé',
                    'students' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les étudiants récupérée avec succès',
                'students' => $students
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des étudiants : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $student = Student::with(['guardian', 'section', 'group', 'absences.subject'])->findOrFail($id);
            return response()->json([
                'message' => 'Détails de l\'étudiant récupérés avec succès',
                'student' => $student
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Étudiant non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des détails de l\'étudiant : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return response()->json([
                'message' => 'Étudiant supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Étudiant non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de l\'étudiant : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function assignStudentToGroup(Request $request)
    {
        try {
            $groupId = $request->input('group_id');
            $studentIds = $request->input('students', []);
            $request->validate([
                'group_id' => 'required|integer|exists:groups,id',
                'students' => 'required|array',
                'students.*' => 'integer|exists:students,id',
            ]);
            $group = Group::findOrFail($groupId);
            $currentStudentCount = Student::where('group_id', $groupId)->count();
            $newStudentCount = count($studentIds);

            if ($currentStudentCount + $newStudentCount > $group->capacity) {
                return response()->json([
                    'message' => 'La capacité du groupe sera dépassée.',
                ], 422);
            }
            Student::whereIn('id', $studentIds)->update(['group_id' => $groupId]);
            return response()->json(['message' => 'Les étudiants ont été assignés au groupe avec succès.'], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Groupe non trouvé avec l\'identifiant ' . $groupId,
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de l\'assignation des étudiants au groupe : ' . $exception->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'section_id' => 'required|exists:sections,id',
            'group_id' => 'required|exists:groups,id',
            'cne' => 'required|string|max:255',
            'student_first_name' => 'required|string|max:255',
            'student_last_name' => 'required|string|max:255',
            'student_address' => 'required|string|max:255',
            'student_phone_number' => [
                'nullable',
                'string',
                'regex:/^(06|07)[0-9]{8}$/',
                'max:10',
            ],
            'needs_transportation' => 'required|boolean',
            'student_illnesses' => 'nullable|string',
            'study_troubles' => 'required|boolean',
            'study_troubles_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'section_id.required' => 'Le champ section est requis.',
            'section_id.exists' => 'La section sélectionnée est invalide.',
            'group_id.required' => 'Le champ groupe est requis.',
            'group_id.exists' => 'Le groupe sélectionné est invalide.',
            'cne.required' => 'Le champ CNE est requis.',
            'cne.string' => 'Le champ CNE doit être une chaîne de caractères.',
            'cne.max' => 'Le champ CNE ne doit pas dépasser :max caractères.',
            'student_first_name.required' => 'Le champ prénom est requis.',
            'student_first_name.string' => 'Le champ prénom doit être une chaîne de caractères.',
            'student_first_name.max' => 'Le champ prénom ne doit pas dépasser :max caractères.',
            'student_last_name.required' => 'Le champ nom est requis.',
            'student_last_name.string' => 'Le champ nom doit être une chaîne de caractères.',
            'student_last_name.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
            'student_address.required' => 'Le champ adresse est requis.',
            'student_address.string' => 'Le champ adresse doit être une chaîne de caractères.',
            'student_address.max' => 'Le champ adresse ne doit pas dépasser :max caractères.',
            'student_phone_number.regex' => 'Le numéro de téléphone doit commencer par 06 ou 07 et être suivi de 8 chiffres.',
            'student_phone_number.max' => 'Le numéro de téléphone ne doit pas dépasser :max caractères.',
            'needs_transportation.required' => 'Le champ besoin de transport est requis.',
            'needs_transportation.boolean' => 'Le champ besoin de transport doit être un booléen.',
            'student_illnesses.string' => 'Le champ maladies doit être une chaîne de caractères.',
            'study_troubles.required' => 'Le champ difficultés d\'étude est requis.',
            'study_troubles.boolean' => 'Le champ difficultés d\'étude doit être un booléen.',
            'study_troubles_description.string' => 'Le champ description des difficultés d\'étude doit être une chaîne de caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Le fichier doit être de type :mimes.',
            'image.max' => 'Le fichier ne doit pas dépasser :max kilo-octets.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student = Student::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students', 'public');
            $student->image = $imagePath;
        }
        $student->update([
            'section_id' => $request->section_id,
            'group_id' => $request->group_id,
            'cne' => $request->cne,
            'student_first_name' => $request->student_first_name,
            'student_last_name' => $request->student_last_name,
            'student_date_of_birth' => $request->student_date_of_birth,
            'student_phone_number' => $request->student_phone_number,
            'student_address' => $request->student_address,
            'needs_transportation' => $request->needs_transportation,
            'student_illnesses' => $request->student_illnesses,
            'study_troubles' => $request->study_troubles,
            'study_troubles_description' => $request->study_troubles_description,
        ]);

        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student,
        ], 200);
    }



    public function resetpassword(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'student_email' => 'required|email',
                'student_password' => 'required|string|min:8',
            ], [
                'student_email.required' => 'L\'adresse e-mail est obligatoire',
                'student_email.email' => 'L\'adresse e-mail doit être valide',
                'student_password.required' => 'Le mot de passe est obligatoire',
                'student_password.min' => 'Le mot de passe doit comporter au moins 8 caractères',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $student = Student::findOrFail($id);

            if ($request->student_email === $student->student_email) {
                $student->student_password = Hash::make($request->student_password);
                $student->save();

                return response()->json([
                    'message' => 'Mot de passe mis à jour avec succès',
                ], 201);
            } else {
                return response()->json([
                    'message' => 'L\'adresse e-mail ne correspond pas à celle de l\'étudiant',
                ], 422);
            }
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Étudiant introuvable avec l\'ID ' . $id,
            ], 404);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $exception->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour du mot de passe : ' . $exception->getMessage(),
            ], 500);
        }
    }

    /*public function showmarks()
    {
        try {
            $student = Auth::user();

            // $evaluations=$student->load('group', 'section', 'evaluations.subject', 'evaluations.marks');
            $student->load([
                'group',
                'section',
                'evaluations.subject',
                'evaluations.marks',
                'section.subjects' 
            ]);
            foreach ($student->evaluations as $evaluation) {
                $subject = $evaluation->subject;
                $section = $student->section;
                
                $subjectInSection = $section->subjects->where('id', $subject->id)->first();
                if ($subjectInSection) {
                    $coefficient = $subjectInSection->pivot->coefficient;
                    $evaluation->subject->coefficient = $coefficient;
                } else {
                    $evaluation->subject->coefficient = 'N/A'; 
                }
            }
            return response()->json([
                'message' => 'Notes de l\'élève récupérées avec succès',
                'evaluations' => $student,
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Élève non trouvé',
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des notes de l\'élève : ' . $exception->getMessage()
            ], 500);
        }
    }*/




    public function showMarks()
    {
        try {
            $student = Auth::user();
    
            // Charger les évaluations avec les matières associées et les notes
            $student->load([
                'evaluations.subject',
                'evaluations.marks'
            ]);
    
            // Parcourir les évaluations pour ajouter le coefficient de la matière si elle est trouvée dans la section
            foreach ($student->evaluations as $evaluation) {
                $subject = $evaluation->subject;
                $section = $student->section;
    
                $subjectInSection = $section->subjects->where('id', $subject->id)->first();
                if ($subjectInSection) {
                    $coefficient = $subjectInSection->pivot->coefficient;
                    $subject->coefficient = $coefficient;
                } else {
                    $subject->coefficient = 'N/A';
                }
            }
    
            return response()->json([
                'message' => 'Notes de l\'élève récupérées avec succès',
                'evaluations' => $student->evaluations,
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Élève non trouvé',
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des notes de l\'élève : ' . $exception->getMessage()
            ], 500);
        }
    }
    
}