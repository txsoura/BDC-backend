<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 *  company status enum
 */
final class CompanyStatus extends Enum
{
    const APPROVED = 'approved';
    const PENDENT = 'pendent';
    const BLOCKED = 'blocked';
}
