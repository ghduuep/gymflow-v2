<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    //
    /**
     @var array
     */

    protected $fillable = [
        'name',
        'cpf',
        'phone',
        'email',
        'birth_date',
        'active',
    ];

    protected $with = ['address'];

    public function subscriptions(): hasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
