<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Expense;

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
            'purchase_day' => $this->faker->dateTimeThisYear(),
            'title' => $this->faker->company(),
            'price' => $this->faker->randomNumber(5, false),
            'memo'  => $this->faker->sentence(),
            'status' => rand(0, 1),
            'created_at' =>  $this->faker->dateTimeThisYear(),
        ];
    }

    public function configure()
    {
        /**
         * statusの値がtrueの場合、ランダムな数値を保存する
         */
        return $this->afterCreating(function (Expense $expense) {
            $numbers = range(10, 100, 5);
            if($expense->status == 1) {
                $key = array_rand($numbers);
                $expense->share_rate = $numbers[$key];
                $expense->save();
            }
        });
    }

}
