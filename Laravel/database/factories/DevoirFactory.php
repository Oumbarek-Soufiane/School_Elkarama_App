<?php

namespace Database\Factories;

use App\Models\Tp;
use App\Models\Etudiant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Devoir>
 */
class DevoirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $tps = DB::table('tps')->get();
        $tpsCount = DB::table('tps')->count();

        for ($etudiant = 1; $etudiant <= 160; $etudiant++) {
            $currentEtudiantGroupeId = DB::table('etudiants')->where('id', $etudiant)->value('groupe_id');
            $groupeTps = DB::table('tps')->where('groupe_id', $currentEtudiantGroupeId)->get();

            foreach ($groupeTps as $currentTp) {
                $sujet = Str::studly(str_replace('.', '', Str::studly(str_replace(' ', '', $currentTp->sujet))));

                if($etudiant == 160 && $currentTp == $groupeTps->last()) {
                    $lastTp = $groupeTps->last();
                    return [
                        'tp_id' => optional($lastTp)->id + 1,
                        'etudiant_id' => 160,
                        'reponses' => "devoir.pdf",
                        "created_at" => now(),
                        "updated_at" => null,
                    ];
                }

                DB::table("devoirs")->insert([
                    'tp_id' => $currentTp->id,
                    'etudiant_id' => $etudiant,
                    'reponses' => "/devoir.pdf",
                    "created_at" => now(),
                    "updated_at" => null,

                ]);

            }
        }
        return [
            // Just In case, because definition function should return an arry
        ];
    }
}
