<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Groupe;
use App\Models\Invite;
use App\Models\Tuteur;
use App\Models\Filiere;
use App\Models\Etudiant;
use App\Models\NumGroupe;
use App\Models\Professeur;
use App\Models\GroupeDetail;
use App\Models\TuteurDetail;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list(Request $request)
    {
        $roleAuth = auth()->user()->role;
        $role = substr($request["role"], 0, -1);
        $lists = app("App\\Models\\$role")::select("users.*", $role . "s.*")
            ->join("users", "users.id", $role . "s.user_id")->paginate(8);
        $role = $lists[0]->role;
        // dd($role);
        return view("Admin.list", compact("lists", "role", 'roleAuth'));
    }

    public function create(Request $request)
    {
        $etudiants = [];
        $filieres = Filiere::all();
        $groupes = Groupe::all();
        if ($request["role"] == "tuteur") {
            $etudiantsHasParent = TuteurDetail::all()->pluck('etudiant_id');
            $etudiants = Etudiant::selectRaw("etudiants.*")->join("tuteur_details as t", "etudiants.id", "t.etudiant_id")
                ->havingRaw("count(t.tuteur_id)<=1")->groupBy("etudiants.id")->get();
            return view('Admin.create', compact('etudiants'));
            // return view('Admin.create', compact('filieres', 'groupes', 'etudiants'));
        }
        if ($request["role"] == "professeur") {
            return view('Admin.create', compact('filieres', 'groupes'));
        }
        if ($request["role"] == "etudiant") {
            return view('Admin.create', compact('filieres', 'groupes'));
        }
    }

    public function store(Request $request, $role)
    {
        $currentRole = ucfirst($role . 's');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . "." . $file->extension();
            $request->photo->move(public_path('/img/' . $currentRole), $fileName);

            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'dateNaissance' => $request->dateNaissance,
                'numeroTelephone' => $request->numeroTelephone,
                'genre' => $request->genre,
                'situationFamiliale' => $request->situationFamiliale,
                'photo' => '/' . $currentRole . '/' . $fileName,
            ]);

            if ($user) {
                $user_id = $user->id;
                if ($role == 'etudiant') {
                    $numGroupe = NumGroupe::all()->where('filiere_id', $request->filiere_id)->first();
                    $groupe_A_Affecter = 0;
                    $groupesFiliere = array_values(Groupe::all()->where('filiere_id', $request->filiere_id)->toArray());
                    if ($numGroupe->a_affecter == 0) {
                        $groupe_A_Affecter = $groupesFiliere[0]['id'];
                    } else {
                        $groupe_A_Affecter = $groupesFiliere[1]['id'];
                    }

                    $etudiant = Etudiant::create([
                        'user_id' => $user_id,
                        'groupe_id' => $groupe_A_Affecter,
                        'couvertureMedicale' => $request->couvertureMedicale,
                    ]);

                    if ($etudiant) {
                        if ($numGroupe->a_affecter == 0) {
                            $numGroupe->update([
                                'a_affecter' => 1,
                            ]);
                        } else {
                            $numGroupe->update([
                                'a_affecter' => 0,
                            ]);
                        }
                    }
                    return redirect()->route('edit', ['role' => $role, 'id' => $etudiant->id]);
                } elseif ($role == 'tuteur') {

                    $tuteur = Tuteur::create([
                        'user_id' => $user_id,
                    ]);

                    if ($tuteur) {
                        foreach ($request->etudiant_id as $element) {
                            TuteurDetail::create([
                                'tuteur_id' => $tuteur->id,
                                'etudiant_id' => $element,
                            ]);
                        }
                    }
                    return redirect()->route('edit', ['role' => $role, 'id' => $tuteur->id]);
                } elseif ($role == 'professeur') {
                    $filiereForPro = Filiere::find($request->filiere_id);
                    $professeur = Professeur::create([
                        'user_id' => $user_id,
                        'diplome' => $request->diplome,
                        'salaire' => $request->salaire,
                        'dateEmbauche' => $request->dateEmbauche,
                    ]);
                    if ($professeur) {
                        foreach ($filiereForPro->groupes as $element) {
                            GroupeDetail::create([
                                'professeur_id' => $professeur->id,
                                'groupe_id' => $element->id,
                            ]);
                        }
                    }
                    return redirect()->route('edit', ['role' => $role, 'id' => $professeur->id]);
                }
            } else {
                return response()->json(['message' => 'User not created']);
            }
        } else {
            return response()->json(['message' => 'Photo Required']);
        }
    }


    public function edit(Request $request, $role, $id)
    {
        $etudiants = [];
        $filieres = Filiere::all();
        $groupes = Groupe::all();
        if ($request["role"] == "tuteur") {
            $tuteur = Tuteur::find($id);
            $tuteurDetail = TuteurDetail::all()->where("tuteur_id", $id)->pluck('etudiant_id')->toArray();
            $etudiants = Etudiant::all();
            return view('Admin.edit', compact('etudiants', 'tuteur', 'tuteurDetail'));
        }
        if ($request["role"] == "professeur") {
            $professeur = Professeur::find($id);
            return view('Admin.edit', compact('filieres', 'groupes', 'professeur'));
        }
        if ($request["role"] == "etudiant") {
            $etudiant = Etudiant::find($id);
            return view('Admin.edit', compact('filieres', 'groupes', 'etudiant'));
        }
    }

    public function update(Request $request, $role, $id)
    {
        $currentRole = ucfirst($role . 's');
        $userIdOfCurrentRole = 0;
        if ($role == "etudiant") {
            $userIdOfCurrentRole = Etudiant::find($id);
            $etudiant = $userIdOfCurrentRole;
        } elseif ($role == "tuteur") {
            $userIdOfCurrentRole = Tuteur::find($id);
            $tuteur = $userIdOfCurrentRole;
        } elseif ($role == "professeur") {
            $userIdOfCurrentRole = Professeur::find($id);
            $professeur = $userIdOfCurrentRole;
        }

        $user = User::find($userIdOfCurrentRole->user_id);
        if ($user) {
            if ($request->hasFile('photo')) {
                if (file_exists(public_path('/img/' . $user->photo))) {
                    File::delete(public_path('/img/' . $user->photo));
                }
                $file = $request->file('photo');
                $fileName = time() . "." . $file->extension();
                $request->photo->move(public_path('/img/' . $currentRole), $fileName);
                if ($request->password) {
                    $user->update([
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role' => $request->role,
                        'dateNaissance' => $request->dateNaissance,
                        'numeroTelephone' => $request->numeroTelephone,
                        'genre' => $request->genre,
                        'situationFamiliale' => $request->situationFamiliale,
                        'photo' => '/' . $currentRole . '/' . $fileName,
                    ]);
                } else {
                    $user->update([
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'email' => $request->email,
                        'role' => $request->role,
                        'dateNaissance' => $request->dateNaissance,
                        'numeroTelephone' => $request->numeroTelephone,
                        'genre' => $request->genre,
                        'situationFamiliale' => $request->situationFamiliale,
                        'photo' => '/' . $currentRole . '/' . $fileName,
                    ]);
                }
            } else {
                if ($request->password) {
                    $user->update([
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role' => $request->role,
                        'dateNaissance' => $request->dateNaissance,
                        'numeroTelephone' => $request->numeroTelephone,
                        'genre' => $request->genre,
                        'situationFamiliale' => $request->situationFamiliale,
                    ]);
                } else {
                    $user->update([
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'email' => $request->email,
                        'role' => $request->role,
                        'dateNaissance' => $request->dateNaissance,
                        'numeroTelephone' => $request->numeroTelephone,
                        'genre' => $request->genre,
                        'situationFamiliale' => $request->situationFamiliale,
                    ]);
                }
            }

            if ($role == 'etudiant') {
                $numGroupe = NumGroupe::all()->where('filiere_id', $request->filiere_id)->first();
                $groupe_A_Affecter = 0;
                $groupesFiliere = array_values(Groupe::all()->where('filiere_id', $request->filiere_id)->toArray());
                if ($numGroupe->a_affecter == 0) {
                    $groupe_A_Affecter = $groupesFiliere[0]['id'];
                } else {
                    $groupe_A_Affecter = $groupesFiliere[1]['id'];
                }

                $etudiant->update([
                    'groupe_id' => $groupe_A_Affecter,
                    'couvertureMedicale' => $request->couvertureMedicale,
                ]);

                if ($etudiant) {
                    if ($numGroupe->a_affecter == 0) {
                        $numGroupe->update([
                            'a_affecter' => 1,
                        ]);
                    } else {
                        $numGroupe->update([
                            'a_affecter' => 0,
                        ]);
                    }
                }
                return redirect()->route('edit', ['role' => $role, 'id' => $etudiant->id]);
            } elseif ($role == 'tuteur') {
                if ($tuteur) {
                    TuteurDetail::where('tuteur_id', $tuteur->id)->delete();
                    foreach ($request->etudiant_id as $element) {
                        DB::table('tuteur_details')->insert([
                            'tuteur_id' => $tuteur->id,
                            'etudiant_id' => $element,
                        ]);
                    }
                }
                return redirect()->route('edit', ['role' => $role, 'id' => $tuteur->id]);
            } elseif ($role == 'professeur') {
                $filiereForPro = Filiere::find($request->filiere_id);
                $professeur->update([
                    'diplome' => $request->diplome,
                    'salaire' => $request->salaire,
                    'dateEmbauche' => $request->dateEmbauche,
                ]);
                if ($professeur) {
                    GroupeDetail::where('professeur_id', $professeur->id)->delete();
                    foreach ($filiereForPro->groupes as $element) {
                        GroupeDetail::create([
                            'professeur_id' => $professeur->id,
                            'groupe_id' => $element->id,
                        ]);
                    }
                }

                return redirect()->route('edit', ['role' => $role, 'id' => $professeur->id]);
            }
        } else {
            return response()->json(['message' => 'User Note Found']);
        }
    }

    /*-----------------------------------------------Invites---------------------------------------------*/
    public function listInvites(Request $request)
    {
        $invites = Invite::orderBy('created_at', 'desc')->get();

        return view("Admin.invites", compact('invites'));
    }

    public function acceptInviteForm(Request $request, $invite_id)
    {
        $invite = Invite::find($invite_id);
        $filieres = Filiere::all();
        $groupes = Groupe::all();

        // dd($invite);
        $user = (object)[
            "nom" => $invite->nom,
            "prenom" => $invite->prenom,
            "email" => $invite->email,
            "password" => Hash::make('password'),
            "role" => 'etudiant',
            "dateNaissance" => $invite->dateNaissance,
            "numeroTelephone" => $invite->numeroTelephone,
            "genre" => $invite->genre,
            "situationFamiliale" => $invite->situationFamiliale,
            "filiere_id" => $invite->filiere_id,
            "couvertureMedicale" => $invite->couvertureMedicale,
            "invitePhoto" => $invite->photo,
        ];
        // dd($user);
        // return redirect()->route('/admin/create/etudiant');
        // return view("Admin.invites", compact('user'));
        return view("Admin.addInvite", compact('user', 'invite_id', 'filieres', 'groupes'));
    }


    public function acceptInviteSubmit(Request $request, $invite_id)
    {
        $role = 'etudiant';
        $currentRole = ucfirst($role . 's');
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . "." . $file->extension();
            $file->move(public_path('/img/' . $currentRole), $fileName);
            $photoPath = '/' . $currentRole . '/' . $fileName;
        } else {
            // Use the invitePhoto as default if photo is not choosed
            // invitePhoto is the photo uploaded by the invite
            $filePath = $request->invitePhoto;
            $fileName = pathinfo($filePath, PATHINFO_BASENAME);
            // dd($request->invitePhoto);
            if (File::exists($filePath)) {
                $file = new UploadedFile($filePath, $fileName);
                $fileRename = time() . "." . $file->extension();
                file_put_contents($fileRename, public_path('img/'));
                File::copy($filePath, public_path('/img/' . $currentRole . '/' . $fileRename));
                File::delete(public_path($fileRename));
                $photoPath = '/' . $currentRole . '/' . $fileRename;
                File::delete($filePath);
            } else {
                return response()->json(['message' => 'Image Required']);
            }
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'dateNaissance' => $request->dateNaissance,
            'numeroTelephone' => $request->numeroTelephone,
            'genre' => $request->genre,
            'situationFamiliale' => $request->situationFamiliale,
            'photo' => $photoPath,
            'email_verified_at' => now(),
        ]);

        if ($user) {
            $user_id = $user->id;
            if ($role == 'etudiant') {
                $numGroupe = NumGroupe::all()->where('filiere_id', $request->filiere_id)->first();
                $groupe_A_Affecter = 0;
                $groupesFiliere = array_values(Groupe::all()->where('filiere_id', $request->filiere_id)->toArray());
                if ($numGroupe->a_affecter == 0) {
                    $groupe_A_Affecter = $groupesFiliere[0]['id'];
                } else {
                    $groupe_A_Affecter = $groupesFiliere[1]['id'];
                }

                $etudiant = Etudiant::create([
                    'user_id' => $user_id,
                    'groupe_id' => $groupe_A_Affecter,
                    'couvertureMedicale' => $request->couvertureMedicale,
                ]);

                if ($etudiant) {
                    if ($numGroupe->a_affecter == 0) {
                        $numGroupe->update([
                            'a_affecter' => 1,
                        ]);
                    } else {
                        $numGroupe->update([
                            'a_affecter' => 0,
                        ]);
                    }
                }
                Invite::destroy($invite_id);
                return redirect()->route('edit', ['role' => $role, 'id' => $etudiant->id]);
            }
        } else {
            return response()->json(['message' => 'User not created']);
        }



        return view("Admin.addInvite", compact('user', 'invite_id', 'filieres', 'groupes'));
    }

    public function declineInvites(Request $request, $invite_id)
    {
        $invite = Invite::find($invite_id);
        if (File::exists(public_path('img' . $invite->photo))) {
            File::delete(public_path('img' . $invite->photo));
        }
        Invite::destroy($invite_id);
        return redirect()->back();
    }

    /*-----------------------------------------------/Invites---------------------------------------------*/

    /*---------------------------------------Delete StudentsProfessors-------------------*/
    public function delete($role, $id)
    {


        $dynamicRedirectedRole = $role . 's';
        // dd($dynamicModel);
        $dynamicModel = ucfirst($role);
        $SelectedPerson =  app("App\\Models\\$dynamicModel")::select("*")
            ->join("users", "users.id", '=', $role . 's' . '.user_id')
            ->where($role . 's' . '.id', '=', $id)->get();
        foreach ($SelectedPerson as $Person) {
            $nom = $Person->nom;
            $prenom = $Person->prenom;
        }
        app("App\\Models\\$dynamicModel")::destroy($id);


        if ($role == 'professeur') {
            return redirect()->route('list', ['role' => $dynamicRedirectedRole])->with("success", " Teacher $nom $prenom  deleted succesfully !");
        }
        if ($role == 'etudiant') {
            return redirect()->route('list', ['role' => $dynamicRedirectedRole])->with("success", " Student $nom $prenom  deleted succesfully !");
        }
        if ($role == 'tuteur') {
            return redirect()->route('list', ['role' => $dynamicRedirectedRole])->with("success", " Parent $nom $prenom  deleted succesfully !");
        }
    }
}
