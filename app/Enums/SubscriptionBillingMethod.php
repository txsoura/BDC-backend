<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 *  subscription billing method enum
 */
final class SubscriptionBillingMethod extends Enum
{
    const CASH = 'cash';
    const CARD = 'card';
    const PIX = 'pix';
    const BOLETO = 'boleto';
}
