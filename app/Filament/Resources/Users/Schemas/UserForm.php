<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
// use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
           ->components([
                Section::make(__('app.sections.user_information'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('app.fields.name'))
                            ->required(),
                        TextInput::make('email')
                            ->label(__('app.fields.email_address'))
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),
                        Select::make('role')
                            ->label(__('app.fields.role'))
                            ->options(collect(UserRole::cases())->mapWithKeys(fn($case) => [
                                $case->value => $case->getLabel(),
                            ]))
                            ->required()
                            ->default(UserRole::CLIENT->value),
                        TextInput::make('password')
                            ->label(__('app.fields.password'))
                            ->password()
                            ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                            ->required(fn(string $context): bool => $context === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->maxLength(255)
                            ->minLength(8),
                        TextInput::make('phone')
                            ->label(__('app.fields.phone'))
                            ->maxLength(50),
                        TextInput::make('address')
                            ->label(__('app.fields.address'))
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->label(__('app.fields.active'))
                            ->onIcon('heroicon-o-check-circle')
                            ->offIcon('heroicon-o-x-circle')
                            ->default(true),
                    ])->columns(2),
            ])->columns(1);
    }
}
