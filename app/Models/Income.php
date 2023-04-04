<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isAuth($request)
    {
        return $request->user_id == Auth::id();
    }
}
