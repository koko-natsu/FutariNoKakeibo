<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_day',
        'title',
        'price',
        'memo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
