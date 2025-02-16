<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function profil(Request $request)
    {
        $user = User::findOrFail($request["user_id"]);
        return view('Profil', compact("user"));
    }

    public function inviteView()
    {
        $filieres = Filiere::all();
        return view('register', compact("filieres"));
    }


    public function inviteStore(Request $request)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . "." . $file->extension();
            $request->photo->move(public_path('/img/Invites'), $fileName);

            $invite = Invite::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'filiereActuelle' => $request->filiereActuelle,
                'dateNaissance' => $request->dateNaissance,
                'numeroTelephone' => $request->numeroTelephone,
                'genre' => $request->genre,
                'situationFamiliale' => $request->situationFamiliale,
                'filiere_id' => $request->filiere_id,
                'moyenneDernierAnnee' => $request->moyenneDernierAnnee,
                'photo' => '/Invites/' . $fileName,
                'created_at' => now(),
                'couvertureMedicale' => $request->couvertureMedicale,
            ]);

            if ($invite) {
                return redirect()->back();
            } else {
                return back()->with("message", "Something wrong with adding new Invite");
            }
        }
        return back()->with("message", "Something wrong with adding new Invite");
    }

    public function login()
    {
        if (auth()->user()) {
            return redirect(auth()->user()->role);
        }
        return view("login");
    }
    public function verifyLogin(Request $request)
    {
        $request->validate([
            'email' => 'bail|required',
            'password' => 'bail|required'
        ]);

        $attemp = Auth::attempt($request->only("email", "password"));
        if ($attemp) {
            $request->session()->regenerate();
            return redirect(auth()->user()->role);
        }
        return redirect()->route("login")->with("error", "Invalid email or password !");
    }
    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect("/login");
    }
}
