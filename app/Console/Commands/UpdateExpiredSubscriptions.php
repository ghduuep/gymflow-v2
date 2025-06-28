<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateExpiredSubscriptions extends Command
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
    protected $description = 'Verifica e atualiza o status de matrículas expiradas.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('A procurar por matrículas expiradas...');

        $expiredSubscriptions = Subscription::where('status', SubscriptionStatus::ACTIVE)
        ->where('end_date', '<', Carbon::now())
        ->get();

        if($expiredSubscriptions->isEmpty()) {
            $this->info('Nenhuma matrícula expirada encontrada.');
            return;
        }

        $this->info("Encontradas {$expiredSubscriptions->count()} matrículas para expirar.");

        foreach($expiredSubscriptions as $subscription) {
            $subscription->status = SubscriptionStatus::EXPIRED;
            $subscription->save();
    }

    $this->info('Matrículas atualizadas com sucesso.');
}
}