<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Plan extends Model
{
    /**
     @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_months',
        'active',
    ];
    
    public function subscriptions(): hasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
