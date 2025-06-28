<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CancelOverdueSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancel-overdue-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Altera o status de expirado para cancelado em matrículas com mais de 7 dias de expiração';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Procurando por matrículas expiradas há mais de 7 dias.');

        $cancellationDate = now()->subDays(7);

        $subscriptionsToCancel = Subscription::where('status', SubscriptionStatus::EXPIRED)
        ->where('end_date', '<', $cancellationDate)
        ->get();

        if($subscriptionsToCancel->isEmpty()) {
            $this->info('Nenhuma matrícula para cancelar encontrada.');
            return;
        }

        foreach($subscriptionsToCancel as $subscription) {
            $subscription->status = SubscriptionStatus::CANCELLED;
            $subscription->save();
            Log::info("Matrícula #{$subscription->id} do aluno {$subscription->student->name} foi cancelada por inatividade.");
        }

        $this->info("Processo concluído. {$subscriptionsToCancel->count()} matrículas foram canceladas.");
    }
}
