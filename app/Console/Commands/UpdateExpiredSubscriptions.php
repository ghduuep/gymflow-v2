<?php

namespace App\Console\Commands;

use App\Enums\SubscriptionStatus;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

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

        $count = 0;
        
        Subscription::where('status', SubscriptionStatus::ACTIVE)
            ->where('end_date', '<', Carbon::now())
            ->chunkById(100, function ($subscriptions) use (&$count) {
                $count += $subscriptions->count();
                foreach ($subscriptions as $subscription) {
                    $subscription->status = SubscriptionStatus::EXPIRED;
                    $subscription->save();
                }
            });

        if ($count === 0) {
            $this->info('Nenhuma matrícula encontrada.');
            return;
        }

        $this->info("{$count} matrículas foram atualizadas com sucesso.");
    }
}