<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel, HasColor
{
    case ADMIN = 'admin';
    case CLIENT = 'client';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => __('Admin'),
            self::CLIENT => __('Client'),
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
            self::CLIENT => 'success',
        };
    }
}
