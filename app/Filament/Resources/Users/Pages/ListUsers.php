<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    /**
     * create user tabs filter for active and inactive users
     */
    public function getTabs(): array
    {
        return [
            'All' => Tab::make()->label(__('app.filters.all')),
            'Active' => Tab::make()->label(__('app.filters.active'))
                ->query(fn ($query) => $query->where('is_active', true))
                ->badge(fn () => $this->table?->getQuery()->where('is_active', true)->count() ?? 0)
                ->badgeColor('success'),
            'Inactive' => Tab::make()->label(__('app.filters.inactive'))
                ->query(fn ($query) => $query->where('is_active', false))
                ->badge(fn () => $this->table?->getQuery()->where('is_active', false)->count() ?? 0)
                ->badgeColor('danger'),
        ];
    }
}
