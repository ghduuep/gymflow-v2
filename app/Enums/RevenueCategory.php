<?php

namespace App\Enums;

enum RevenueCategory: string
{
    case PRODUCTS = 'PRODUCTS';
    case SERVICES = 'SERVICES';
    case EVENTS = 'EVENTS';
    case ADVERTISING = 'ADVERTISING';
    case OTHER = 'OTHER';
}