<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     @var array
     */

    protected $casts = [
        'category'=> ExpenseCategory::class,
        'value' => 'decimal:2',
    ];
    
    protected $fillable = [
        'name',
        'description',
        'category',
        'value',
        'paid',
        'active',
    ];
}
