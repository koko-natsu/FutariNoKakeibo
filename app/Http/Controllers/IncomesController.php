<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $now = Carbon::now();
        $year  = $now->year;
        $month = $now->month;

        $incomes = \Auth::user()->incomes()
            ->whereYear('receive_date', $year)
            ->whereMonth('receive_date', $month)
            ->orderby('receive_date')
            ->get();

        return Inertia::render('Incomes/Index', [
            'incomes' => $incomes,
            'date' => $now,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return Inertia::render('Incomes/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncomeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomeRequest $request, Income $income): RedirectResponse
    {
        if($request->user()->is(\Auth::user())) {
            $income->fill($request->all())->save();
        }

        return to_route('incomes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income): Response
    {
        return Inertia::render('Incomes/Edit', [
            'income' => $income,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomeRequest  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomeRequest $request, Income $income): RedirectResponse
    {
        $this->authorize('update', $income);
        $income->update($request->all());

        return to_route('incomes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income): RedirectResponse
    {
        $this->authorize('delete', $income);
        $income->delete();

        return to_route('incomes.index');
    }
}
