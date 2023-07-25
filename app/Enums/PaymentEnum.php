<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentEnum extends Enum
{
    const CASH = 'CASH';
    const ONLINE_BANKING = 'ONLINE_BANKING';
}
