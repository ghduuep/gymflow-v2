<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    /** 
    @var array
    */

    protected $casts = [
        'status' => SubscriptionStatus::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = [
        'student_id',
        'plan_id',
        'status',
        'start_date',
        'end_date'
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_subscription');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
