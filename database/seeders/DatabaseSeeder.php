<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\User;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Family;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    protected $oddNumber = 1;
    protected $evenNubmer = 2;

    public function run()
    {
        
        $this->call([
            FamilySeeder::class,
            UserSeeder::class,
            ExpenseSeeder::class,
            IncomeSeeder::class,
        ]);
        
        Family::factory(50)->create();

        User::factory()
            ->count(50)
            ->hasExpenses(100)
            ->hasIncomes(100)
            ->create();
        }
        
    }
