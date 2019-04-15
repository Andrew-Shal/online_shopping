<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AccountStatus extends Enum
{
    const __default = self::PREACTIVE;

    const PREACTIVE = 'NEW';
    const ACTIVE = 'ACTIVE';
    const INACTIVE = 'INACTIVE';
}
