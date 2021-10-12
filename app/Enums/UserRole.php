<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 *  user role enum
 */
final class UserRole extends Enum
{
    const ADMIN = 'admin';
    const USER = 'user';
}
