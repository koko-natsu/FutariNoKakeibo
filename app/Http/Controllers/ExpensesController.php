<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Inertia\Inertia;
use App\Http\Requests\StoreExpenseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExpensesController extends Controller
{

    public function index()
    {
        $expense = Expense::where('user_id', '=', Auth::id())
            ->get();

        return Inertia::render('Expenses/Index', [
            'expenses' => $expense,
        ]);
    }


    public function create()
    {
        return Inertia::render('Expenses/Create', [
            'user_id' => Auth::id(),
        ]);
    }


    public function store(StoreExpenseRequest $request, Expense $expense)
    {
        if($expense->isAuth($request))
        {
            $expense->fill($request->all())->save();
        }

        return to_route('expenses.index');
    }


    public function show(Expense $expense)
    {
        if($expense->user_id == Auth::id()) {
            return Inertia::render('Expenses/Show', [
                'expense' => $expense,
            ]);
        } else {
            return to_route('expenses.index');
        }
    }


    public function edit(Expense $expense)
    {
        //
    }


    public function update(Request $request, $id)
    {
        
    }


    public function destroy($id)
    {
        //
    }
}
