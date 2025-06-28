<?php

namespace App\Enums;

enum PaymentMethod: string {
    case PIX = 'pix';
    case BOLETO = 'boleto';
    case CREDIT_CARD = 'credit_card';
    case DEBIT_CARD = 'debit_card';
    CASE OFFLINE = 'offline';
}