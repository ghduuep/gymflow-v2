<?php

namespace App\Enums;

enum TaskPriority: string
{
    case HIGH = 'HIGH';
    case MEDIUM = 'MEDIUM';
    case LOW = 'LOW';
}