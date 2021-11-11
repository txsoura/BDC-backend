<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 *  company user role enum
 */
final class CompanyUserRole extends Enum
{
    const OWNER = 'owner';
    const ADMIN = 'admin';
    const MEMBER = 'member';
}
