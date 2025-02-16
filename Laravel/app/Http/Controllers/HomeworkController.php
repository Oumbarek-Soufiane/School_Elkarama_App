<?php

namespace App\Http\Controllers;

use App\Models\Devoir;
use App\Models\Tp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class HomeworkController extends Controller
{
    public function index(Request $request)
    {
        $professeur_id = auth()->user()->professeur->id;
        $results = [];
        $tp_prof_authenticated = [];
        if ($professeur_id) {
            $tp_prof_authenticated  = Tp::where('professeur_id', $professeur_id)
                ->where('groupe_id', $request->group)
                ->orderBy('created_at', 'desc')
                ->get();

            if (!empty($tp_prof_authenticated) && isset($tp_prof_authenticated)) {
                foreach ($tp_prof_authenticated as $tp) {
                    $devoir = Devoir::where("tp_id", $tp->id)->orderBy('created_at', 'desc')
                        ->get();
                    if (!$devoir->isEmpty()) {
                        $results[$tp->id] = $devoir;
                    }
                }
                return view('homework', compact('results'));
            }
        } else {
            return abort(403, 'Access Denied');
        }
    }
}
