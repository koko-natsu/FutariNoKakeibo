<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Family>
 */
class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $household_head = 2;

    public function definition()
    {
        return [
            'family_name' => $this->faker->name(),
            'household_head' => self::$household_head++,
        ];
    }


}
