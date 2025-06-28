<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     @var array
     */

    protected $casts = [
        'priority' => TaskPriority::class,
    ];

    protected $fillable = [
        'name',
        'description',
        'completed',
        'priority',
        'active',
    ];
}
