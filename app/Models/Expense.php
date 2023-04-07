<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'purchase_day',
        'title',
        'price',
        'memo',
        'status',
        'share_rate',
    ];


    public function user(): relation
    {
        return $this->belongsTo(User::class);
    }

     /**
     * FIXME: getIncomesと同じ処理なので、共通化が必要
     */
    public function scopeGetExpenses($query, $request): JsonResponse
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
