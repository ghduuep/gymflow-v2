<?php

namespace App\Models;

use App\Enums\RevenueCategory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    /**
     @var array
     */

    protected $casts = [
        'value' => 'decimal:2',
        'category' => RevenueCategory::class,
    ];

    protected $fillable = [
        'name',
        'description',
        'category',
        'value',
    ];
}
