<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Booking;
use App\Support\FixedTrend;
use Carbon\Carbon;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\TrendValue;

class BookingsChart extends ChartWidget
{
    protected static ?string $heading = 'Бронирования по месяцам';

    protected static ?string $maxHeight = '300px';
    protected static ?string $pollingInterval = null;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $data = FixedTrend::model(Booking::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Количество бронирований',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->translatedFormat('F'))
        ];
    }

    public function getDescription(): ?string
    {
        return 'Статистика бронирований за текущий год';
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
        {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return Number.isInteger(value) ? value : null;
                        }
                    }
                }
            }
        }
        JS);
    }
}
