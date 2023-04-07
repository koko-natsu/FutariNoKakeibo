<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Expense;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;


class ExpensesController extends Controller
{
    public function index() : Response
    {
    
        $now = Carbon::now();
        $year  = $now->year;
        $month = $now->month;

        $expenses = Expense::where('user_id', '=', $this->auth_user()->id)
            ->whereYear('purchase_day', $year)
            ->whereMonth('purchase_day', $month)
            ->orderby('purchase_day')
            ->get();

        return Inertia::render('Expenses/Index', [
            'expenses' => $expenses,
            'date' => $now,
        ]);
    }


    public function create(): Response
    {
        return Inertia::render('Expenses/Create');
    }


    public function store(StoreExpenseRequest $request, Expense $expense): RedirectResponse
    {
        if($request->user()->is(\Auth::user())) {
            $expense->fill($request->all())->save();
        }

        return to_route('expenses.index');
    }


    public function show(Expense $expense)
    {
        // $this->authorize('show', $expense);
        // return Inertia::render('Expenses/Show', [
        //     'expense' => $expense,
        // ]);
    }


    public function edit(Expense $expense): Response
    {
        $this->authorize('edit', $expense);
        return Inertia::render('Expenses/Edit', [
            'expense' => $expense,
        ]);
    }


    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $this->authorize('update', $expense);
        $expense->update($request->all());

        return to_route('expenses.index');
    }


    public function destroy(Expense $expense): RedirectResponse
    {
        $this->authorize('delete', $expense);
        $expense->delete();

        return to_route('expenses.index');
    }
}
