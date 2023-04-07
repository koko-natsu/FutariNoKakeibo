<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Expense;
use App\Models\Income;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')
    ->get('/getExpenses', function (Request $request) {
    return Expense::getExpenses($request);
});

Route::middleware('auth:sanctum')
    ->get('/getIncomes', function (Request $request) {
    return Income::getIncomes($request);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
