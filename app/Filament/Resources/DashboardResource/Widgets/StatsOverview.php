<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Booking;
use App\Models\Excursion;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected ?string $heading = 'Analytics';
    protected ?string $description = 'An overview of some analytics.';
    protected static ?string $pollingInterval = '60s';
    protected function getStats(): array
    {
        return [
            Stat::make('Пользователей', User::query()->count())
                ->description('Общее количество зарегистрированных пользователей')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Экскурсий', Excursion::query()->count())
                ->description('Активных экскурсий на платформе')
                ->descriptionIcon('heroicon-m-map')
                ->color('info'),

            Stat::make('Бронирований', Booking::query()->count())
                ->description('Общее количество бронирований')
                ->descriptionIcon('heroicon-m-bookmark')
                ->color('primary'),
        ];
    }
}
