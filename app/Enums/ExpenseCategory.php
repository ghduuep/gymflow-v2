namespace App\Enums;

enum ExpenseCategory: string
{
    case EQUIPMENT = 'EQUIPMENT';
    case SALARY = 'SALARY';
    case MAINTENANCE = 'MAINTENANCE';
    case MARKETING = 'MARKETING';
    case BILLS = 'BILLS';
    case SUPPLIES = 'SUPPLIES'
    case OTHERS = 'OTHERS';
}