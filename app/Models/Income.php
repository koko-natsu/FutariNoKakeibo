<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receive_date',
        'title',
        'price',
        'memo',
    ];

    public function user(): relation
    {
        return $this->belongsTo(User::class);
    }

    /**
     * FIXME: getExpenseと同じ処理なので、共通化が必要
     */
    public function scopeGetIncomes($query, $request): JsonResponse
    {
        if(!is_null($request->year)) {
            $year  = $request->year;
            $month = $request->month;
        }
 
        $incomes = Income::where('user_id', '=', \Auth::user()->id)
            ->whereYear('receive_date', $year)
            ->whereMonth('receive_date', $month)
            ->orderby('receive_date')
            ->get();

        return response()->json([
            'incomes' => $incomes,
        ]);
    }
}
