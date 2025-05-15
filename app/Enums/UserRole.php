<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';
    case GUIDE = 'guide';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Администратор',
            self::CLIENT => 'Клиент',
            self::GUIDE => 'Гид',
        };
    }

}
