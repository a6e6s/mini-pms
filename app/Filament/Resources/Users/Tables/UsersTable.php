<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('app.fields.name'))
                    ->searchable(isIndividual: true)
                    ->sortable(),
                TextColumn::make('phone')
                    ->label(__('app.fields.phone'))
                    ->searchable(isIndividual: true)
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('app.fields.email_address'))
                    ->searchable(isIndividual: true),
                TextColumn::make('roles.name')
                    ->label(__('app.fields.user_role'))
                    ->formatStateUsing(fn($record) => __($record->roles[0]->name))
                    ->badge(),
                ToggleColumn::make('is_active')
                    ->label(__('app.fields.active'))
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle'),
                TextColumn::make('created_at')
                    ->label(__('app.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('app.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('Activate')
                        ->label(__('app.actions.activate'))
                        ->action(fn($records) => $records->each->update(['is_active' => true]))
                        ->requiresConfirmation()
                        ->icon("heroicon-o-check-circle")
                        ->color('success'),
                    BulkAction::make('deactivate')
                        ->label(__('app.actions.deactivate'))
                        ->action(fn($records) => $records->each->update(['is_active' => false]))
                        ->requiresConfirmation()
                        ->icon("heroicon-o-x-circle")
                        ->color('warning'),
                ]),
            ])
            ->paginated([25, 50, 100]) // dropdown choices
            ->defaultPaginationPageOption(25); // default value
    }
}
