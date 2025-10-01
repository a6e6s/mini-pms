<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TaskStatusColors:string implements HasColor ,HasLabel{

    case PRIMARY = "primary";
    case SECONDARY = "secondary";
    case SUCCESS = "success";
    case DANGER = "danger";
    case WARNING = "warning";
    case INFO = "info";
    case LIGHT = "light";
    case DARK = "dark";


    public function getLabel(): string
    {
        return match ($this) {
            self::PRIMARY => __('Primary'),
            self::SECONDARY => __('Secondary'),
            self::SUCCESS => __('Success'),
            self::DANGER => __('Danger'),
            self::WARNING => __('Warning'),
            self::INFO => __('Info'),
            self::LIGHT => __('Light'),
            self::DARK => __('Dark'),
        };
    }
    public function getColor(): string
    {
        return match ($this) {
            self::PRIMARY => 'primary',
            self::SECONDARY => 'secondary',
            self::SUCCESS => 'success',
            self::DANGER => 'danger',
            self::WARNING => 'warning',
            self::INFO => 'info',
            self::LIGHT => 'light',
            self::DARK => 'dark',
        };
    }

}
