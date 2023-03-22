<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Expense;

class ExpensesControllerTest extends TestCase
{
    use RefreshDatabase;

    function setUp() :void
    {
        parent::setUp();

        $this->seed([
            UserSeeder::class,
        ]);

        User::factory(10)->create();
        Expense::factory(100)->create();

        $this->post('login', [
            'email' => 'test@test.com',
            'password' => '1234',
        ]);
    }

    /**
     * Index
     */
    function testGetIndexPage()
    {
        $this->get('expenses')
            ->assertOk();
    }

    /**
     * Create
     */
    function testGetCreatePage()
    {
        $this->get('expenses/create')
            ->assertOk();
    }


    /**
     * Store
     */
    function testRegisterNewExpense()
    {
        $response = $this->post('expenses', [
            'user_id' => 1,
            'purchase_day' => '2002-10-03',
            'title' => 'test',
            'price' => 20000,
            'memo'  => 'testdayo',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect('expenses');

        $this->assertDatabaseCount('expenses', 101);
    }

    function testVerficationOfInvalidData()
    {
        $response = $this->post('expenses', [
            'user_id' => 1,
            'purchase_day' => '',
            'title' => '',
            'price' => '',
            'memo'  => str_repeat('a', 256),
        ]);

        $response->assertInvalid([
            'purchase_day' => "購入日は必ず指定してください。",
            'title' => "商品名は必ず指定してください。",
            'price' => "金額は必ず指定してください。",
            'memo' => "メモは、255文字以下で指定してください。",
        ]);
    }

    function testVerficationOfDifferentUser()
    {
        $response = $this->post('expenses', [
            'user_id' => 2,
            'purchase_day' => '',
            'title' => '',
            'price' => '',
            'memo'  => str_repeat('a', 256),
        ]);

        $response->assertInvalid([
            'purchase_day' => "購入日は必ず指定してください。",
            'title' => "商品名は必ず指定してください。",
            'price' => "金額は必ず指定してください。",
            'memo' => "メモは、255文字以下で指定してください。",
        ]);

        $this->assertDatabaseCount('expenses', 100);
    }

    /**
     * UnLoggedInUserの検証
     */
    function testVerficationOfUnLoggedInUsers()
    {
        $this->assertAuthenticated();
        $this->post('logout');
        $this->assertGuest();

        // Index
        $this->get('expenses')
            ->assertRedirect('login');
        
        // Create
        $this->get('expenses/create')
            ->assertRedirect('login');

        // Store
        $response = $this->post('expenses', [
            'user_id' => 1,
            'purchase_day' => '2002-10-02',
            'title' => 'test',
            'price' => 20000,
            'memo'  => 'testdayo',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('login');
        $this->assertDatabaseCount('expenses', 100);
    }
}
