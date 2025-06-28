namespace App\Enums;

enum SubscriptionStatus: string
{
    case ACTIVE = 'ACTIVE';
    case PAUSED = 'PAUSED';
    case EXPIRED = 'EXPIRED';
    case CANCELLED = 'CANCELLED';
    case PENDIND_PAYMENT = 'PENDIND_PAYMENT';
}