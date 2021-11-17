<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 *  stock status enum
 */
final class StockStatus extends Enum
{
    const PENDENT = 'pendent';
    const CANCELED = 'canceled';
    const RECEIVED = 'received';
    const WITHDRAWN = 'withdrawn';
}
