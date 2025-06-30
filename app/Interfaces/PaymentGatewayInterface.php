<?php

namespace App\Interfaces;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function createPaymentIntent(Subscription $subscription): Payment;

    public function handleWebhook(Request $request): void;
}