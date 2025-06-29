<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;

class StripePaymentService implements PaymentGatewayInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createCheckoutSession(Subscription $subscription): CheckoutSession
    {
        return CheckoutSession::create([
            'payment_method_types' => ['card', 'boleto', 'pix'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => "Renovação Plano " . $subscription->plan->name,
                    ],
                    'unit_amount' => $subscription->plan->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => config('URL_SUCCESS_NEXTJS'),
            'cancel_url' => config('URL_CANCEL_NEXTJS'),
            'metadata' => [
                'subscription_id' => $subscription->id,
            ],
        ]);
    }

    public function handleWebhook(Request $request): void
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $secret);
        } catch (\Exception $e) {
            throw new \Exception('Assinatura de webhook inválida.');
        }

        if($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $this->handleSuccessfulCheckout($session);
        }
    }

    public function handleSuccessfulCheckout(CheckoutSession $session): void
    {
        $subscriptionId = $session->metadata->subscription_id;
        $subscription = Subscription::find($subscriptionId);

        if(!$subscription) {
            Log::error("Webhook da Stripe: Matrícula #{$subscriptionId} não encontrada.");
            return;
        }

        Payment::create([
            'subscription_id' => $subscription->id,
            'value' => $session->amount_total / 100,
            'status' => PaymentStatus::APPROVED,
            'provider' => 'stripe',
            'provider_payment_id' => $session->payment_intent,

        ]);

        $subscription->status = SubscriptionStatus::ACTIVE;
        $subscription->start_date = now();
        $subscription->end_date = now()->addMonths($subscription->plan->duration_months);
        $subscription->save();

        Log::info("Matrícula #{$subscriptionId} renovada com sucesso via Stripe Checkout.");
    }
}