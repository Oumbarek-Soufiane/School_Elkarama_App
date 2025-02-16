<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // for($i = 1,$m = 1;$i <= 160;$m++) {
        //     DB::table("notes")->insert([
        //         "id" => null,
        //         "etudiant_id" => $i,
        //         "module_id" => $m,
        //         "controle_1" => fake()->randomElement([13,15,17,20,14.50,18.25,13.75,19.75]),
        //         "controle_2" => fake()->randomElement([13,15,17,20,14.50,18.25,13.75,19.75]),
        //         "exam" => fake()->randomElement([13,15,17,20,14.50,18.25,13.75,19.75]),
        //         "created_at" => now(),
        //         "updated_at" => null
        //     ]);

        //     // etudiant from 1 to 40
        //     if($i >= 1 && $i <= 40) {
        //         if($m == 4) { // Keep same student until all modules are rated,
        //             $m = 0;
        //             $i++;
        //         }
        //         if($i == 41) {
        //             $m = 4;
        //         }
        //     }

        //     // etudiant from 41 to 80
        //     elseif($i >= 41 && $i <= 80) {
        //         if($m == 8) {
        //             $m = 4;
        //             $i++;
        //         }
        //         if($i == 81) {
        //             $m = 8;
        //         }
        //     }

        //     // etudiant from 81 to 120
        //     elseif($i >= 81 && $i <= 120) {
        //         if($m == 12) {
        //             $m = 8;
        //             $i++;
        //         }
        //         if($i == 121) {
        //             $m = 12;
        //         }
        //     }

        //     // etudiant from 121 to 160
        //     elseif($i >= 121 && $i <= 160) {
        //         if($m == 16) {
        //             $m = 12;
        //             $i++;
        //         }
        //         if($i == 160 && $m == 15) {
        //             break;
        //         }
        //     }
        // }
        // return [
        //     "id" => null,
        //     "etudiant_id" => 160,
        //     "module_id" => 16,
        //     "controle_1" => fake()->randomElement([13,15,17,20]),
        //     "controle_2" => fake()->randomElement([13,15,17,20]),
        //     "exam" => fake()->randomElement([13,15,17,20]),
        //     "created_at" => now(),
        //     "updated_at" => null
        // ];
    }
}
