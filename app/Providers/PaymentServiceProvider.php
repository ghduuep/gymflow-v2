<?php

namespace App\Providers;

class PaymentServiceProvider extends AppServiceProvider {

    public function register(): void
    {
        $this->app->bind(PaymentGatewayInterface::class, StripePaymentService::class);
    }
}