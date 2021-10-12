<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 *  construction status enum
 */
final class ConstructionStatus extends Enum
{
    const PENDENT = 'pendent';
    const CANCELED = 'canceled';
    const STARTED = 'started';
    const PAUSED = 'paused';
    const ABANDONED = 'abandoned';
    const FINALIZED = 'finalized';
}
