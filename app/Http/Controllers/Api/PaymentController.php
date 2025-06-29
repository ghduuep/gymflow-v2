<?php

class PaymentController extends Controller
{
    public function __construct(private PaymentGatewayInterface $paymentService)
    {}

    public function handleWebhook(Request $request): JsonResponse
    {
        try {
        $this->paymentService->handleWebhook($request);
        return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            return response()->json(['error', $e->getMessage()], 400);
        }
    }
}