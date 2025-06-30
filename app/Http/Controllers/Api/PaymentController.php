<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Interfaces\PaymentGatewayInterface;

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