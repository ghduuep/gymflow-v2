<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PaymentStatus;
use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'value',
        'status',
        'payment_method',
        'provider',
        'provider_payment_id',
        'qr_code_64',
        'qr_code_url',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
        'payment_method' => PaymentMethod::class,
        'value' => 'decimal:2',
        'qr_code_64' => 'base64',
        'qr_code_url' => 'url',
    ];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function student(): HasOneThrough
    {
        return $this->hasOneThrough(
            Student::class,
            Subscription::class,
            'id',
            'id',
            'subscription_id',
            'student_id',
        );
    }

    public function plan(): HasOneThrough
    {
        return $this->hasOneThrough(
            Plan::class,
            Subscription::class,
            'id',
            'id',
            'subscription_id',
            'plan_id',
        );
    }
}
