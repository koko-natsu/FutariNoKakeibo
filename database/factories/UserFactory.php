<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Family;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    private static $fakeCount = 1;
    private static $fakeFamilyId = 1;

    public function definition()
    {
        $familyId = $this->createFamilyPair();

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'family_id' => $familyId,
        ];
    }

    private function createFamilyPair()
    {
        if(self::$fakeCount != 2)
        {
            self::$fakeCount++;
            self::$fakeFamilyId;
        }
        else
        {
            self::$fakeCount = 1;
            self::$fakeFamilyId++;
        }
        return self::$fakeFamilyId;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
