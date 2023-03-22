<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'purchase_day',
        'title',
        'price',
        'memo',
    ];

    public function isAuth($request)
    {
        return $request->user_id == Auth::id();
    }
}
