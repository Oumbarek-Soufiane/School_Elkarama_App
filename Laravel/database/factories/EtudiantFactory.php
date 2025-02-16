<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    private static $counter = 89;
    private static $groupe = 8;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$counter++;
        if(self::$groupe == 1){
            self::$groupe=2;
        }
        elseif(self::$groupe == 2){
            self::$groupe=3;
        }
        elseif(self::$groupe == 3){
            self::$groupe=4;
        }
        elseif(self::$groupe == 4){
            self::$groupe=5;
        }
        elseif(self::$groupe == 5){
            self::$groupe=6;
        }
        elseif(self::$groupe == 6){
            self::$groupe=7;
        }
        elseif(self::$groupe == 7){
            self::$groupe=8;
        }
        elseif(self::$groupe == 8){
            self::$groupe=1;
        }

        return [
            'user_id' => self::$counter,
            'groupe_id' => self::$groupe,
        ];
    }
}
