<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;


class ExpensesController extends Controller
{
    public function index(): Response
    {
        $month = Carbon::now()->month;

        $expenses = Expense::where('user_id', '=', $this->auth_user()->id)
            ->whereMonth('purchase_day', $month)
            ->orderby('purchase_day')
            ->get();

        return Inertia::render('Expenses/Index', [
            'expenses' => $expenses,
        ]);
    }


    public function create(): Response
    {
        return Inertia::render('Expenses/Create');
    }


    public function store(StoreExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $request->user()
            ->expenses()
            ->create($request->all())
            ->save();

        return to_route('expenses.index');
    }


    public function show(Expense $expense): Response
    {
        $this->authorize('show', $expense);
        return Inertia::render('Expenses/Show', [
            'expense' => $expense,
        ]);
    }


    public function edit(Expense $expense)
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


    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();

        return to_route('expenses.index');
    }
}
