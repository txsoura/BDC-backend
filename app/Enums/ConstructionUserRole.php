<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 *  construction user role enum
 */
final class ConstructionUserRole extends Enum
{
    const OWNER = 'owner';
    const MANAGER = 'manager';
    const ENGINEER = 'engineer';
    const VIEWER = 'viewer';
    const ARCHITECT = 'architect';
    const INVESTOR = 'investor';
}
