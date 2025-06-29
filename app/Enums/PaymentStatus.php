<?php

namespace App\Enums;

enum PaymentStatus: string {
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case CANCELLED = 'cancelled';
    case REJECTED = 'rejected';
    case IN_PROCESS = 'in_process';
}