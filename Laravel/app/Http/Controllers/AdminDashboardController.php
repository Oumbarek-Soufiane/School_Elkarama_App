<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Professeur;
use App\Models\Tuteur;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $filieres = Filiere::get();
        $professeurs = Professeur::limit(4)->orderBy("id", "desc")->get();
        $etudiants = Etudiant::limit(4)->orderBy("id", "desc")->get();
        $parents = Tuteur::limit(4)->orderBy("id", "desc")->get();
        return view("Admin.Dashboard", compact("filieres", "professeurs", "etudiants", "parents"));
    }
}
