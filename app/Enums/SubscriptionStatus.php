<?php

namespace App\Enums;

enum SubscriptionStatus: string
{
    case ACTIVE = 'ACTIVE';
    case PAUSED = 'PAUSED';
    case EXPIRED = 'EXPIRED';
    case CANCELLED = 'CANCELLED';
    case PENDING_PAYMENT = 'PENDING_PAYMENT';
}