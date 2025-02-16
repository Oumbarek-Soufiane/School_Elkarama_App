<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Filiere;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $filieres = Filiere::all();
        $subjects = [];
        $filliereRequested = "";
        return view("subjectSelect", compact("filliereRequested", "filieres", "subjects"));
    }

    public function list(Request $request)
    {
        $subjects = [];
        $filliereRequested = "";
        $filieres = Filiere::all();
        if ($request->filiere != "") {
            $filliereRequested = $request->filiere;
            $subjects = Filiere::find($filliereRequested)->modules;
            $filliereRequested = Filiere::all()->where("id", $filliereRequested)->pluck('designation')->first();
        }
        return view("subjectSelect", compact("filliereRequested", "subjects", "filieres"));
    }
}
