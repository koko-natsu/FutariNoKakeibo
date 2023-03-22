<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
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
            'purchase_day' => $this->faker->date('Y_m_d'),
            'title' => $this->faker->title(),
            'price' => $this->faker->randomNumber(5, false),
            'memo'  => $this->faker->realText(50),
            'created_at' =>  $this->faker->dateTimeThisDecade('+2 years'),
        ];
    }
}
