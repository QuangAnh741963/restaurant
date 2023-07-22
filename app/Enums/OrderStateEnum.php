<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStateEnum extends Enum
{
    const START = 1;
    const SUCCESS = 2;
    const PAYMENT = 3;
    const DONE = 4;
}
