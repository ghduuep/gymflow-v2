<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
