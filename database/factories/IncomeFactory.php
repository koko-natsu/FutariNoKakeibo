<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, User::count()),
            'receive_date' => $this->faker->dateTimeThisYear('+1 years'),
            'title' => $this->faker->word(),
            'price' => $this->faker->randomNumber(5, false),
            'memo'  => $this->faker->sentence(),
            'created_at' =>  $this->faker->dateTimeThisYear(),
        ];
    }
}
