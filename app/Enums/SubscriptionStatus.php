<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 *  subscription status enum
 */
final class SubscriptionStatus extends Enum
{
    const ACTIVE = 'active';
    const PENDENT = 'pendent';
    const DEACTIVATED = 'deactivated';
}
