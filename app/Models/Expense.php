<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_day',
        'title',
        'price',
        'memo',
        'status',
        'share_rate',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeGetExpenses($query, $request)
    {
        if(!is_null($request->year)) {
            $year  = $request->year;
            $month = $request->month;
        }
 
        $expenses = Expense::where('user_id', '=', \Auth::user()->id)
            ->whereYear('purchase_day', $year)
            ->whereMonth('purchase_day', $month)
            ->orderby('purchase_day')
            ->get();

        return response()->json([
            'expenses' => $expenses,
        ]);
    }

}
