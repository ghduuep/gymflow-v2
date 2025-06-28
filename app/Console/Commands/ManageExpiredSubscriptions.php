<?php

namespace App\Console\Commands;

use App\Enums\SubscriptionStatus;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ManageExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-expired-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica e atualiza o status de matrículas expiradas, enviando os links de pagamento.';

    /**
     * Execute the console command.
     */
    public function handle(PaymentServiceInterface $paymentService): void
    {
        $this->info('A procurar por matrículas expiradas...');

        
        $expiredSubscriptions = Subscription::where('status', SubscriptionStatus::EXPIRED).get();

        if($expiredSubscriptions->isEmpty()) {
            $this->info('Nenhuma matrícula expirada encontrada.');
            return;
        }

        foreach($expiredSubscriptions as $subscription) {
            try {
                $checkoutSession = $paymentService->createCheckoutSession($subscription);

                $subscription->student->notify(new RenewalPaymentNotification($checkoutSession->url));

                $this->info("Link de renovação enviado para: {$subscription->student->name}");
            } catch(\Exception $e) {
                Log::error("Falha ao gerar o link para matrícula: #{$subscription->id}") . $e->getMessage();
            }
        }
    
        $this->info("{$count} matrículas foram atualizadas com sucesso e envio de links de renovação realizado.");
    }
}