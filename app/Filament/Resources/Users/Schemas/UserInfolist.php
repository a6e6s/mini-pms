<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('app.sections.user_details'))
                    ->schema([
                        TextEntry::make('id')->label(__('app.fields.user_id')),
                        TextEntry::make('name')->label(__('app.fields.full_name')),
                        TextEntry::make('email')->label(__('app.fields.email')),
                        TextEntry::make('address')
                            ->label(__('app.fields.address')),
                        TextEntry::make('phone')
                            ->label(__('app.fields.phone_number')),
                        TextEntry::make('role')
                            ->label(__('app.fields.role'))
                            ->badge(),
                        IconEntry::make('is_active')
                            ->label(__('app.fields.active'))
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->label(__('app.fields.registered_at'))
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label(__('app.fields.last_updated'))
                            ->dateTime(),
                    ])->columns(2)


            ])->columns(1);
    }
}
