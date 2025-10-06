<?php

namespace App\Providers\Filament;

use App\Http\Middleware\SetLocale;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use App\Filament\Widgets\ProjectsStatsWidget;
use App\Filament\Widgets\ProjectProgressWidget;
use App\Filament\Widgets\TaskStatusesChartWidget;
use App\Filament\Widgets\ProjectsByStatusTableWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors(['primary' => Color::Green,'secondary'=> Color::Blue])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->renderHook('panels::topbar.end', fn() => view('filament.language-switcher'))
            ->maxContentWidth(Width::Full)
            ->collapsedSidebarWidth('true')

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                ProjectsStatsWidget::class,
                TaskStatusesChartWidget::class,
                ProjectsByStatusTableWidget::class,
                ProjectProgressWidget::class,
            ])
            ->navigationItems([
                NavigationItem::make('Kanban Board')
                    ->label(__('app.navigation.kanban_board'))
                    ->url(fn() => route('filament.admin.resources.tasks.kanban'))
                    ->icon(Heroicon::OutlinedViewColumns)
                    ->group(__('app.navigation.tasks'))
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.tasks.kanban'))
                // hide when user doesn't have permission
                    ->visible(fn(): bool => auth()->user()->can('ViewAny:Task'))
                    ->sort(1),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                SetLocale::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
