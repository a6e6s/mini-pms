<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasColor, HasLabel
{
    case ADMIN = 'admin';
    case USER = 'user';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => __('Admin'),
            self::USER => __('User'),
        };
    }

    public function label(): string
    {
        return $this->getLabel();
    }

    public function getColor(): string
    {
        return match ($this) {
            self::ADMIN => 'primary',
            self::USER => 'success',
        };
    }
}
