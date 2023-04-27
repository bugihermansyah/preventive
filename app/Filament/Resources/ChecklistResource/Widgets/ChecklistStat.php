<?php

namespace App\Filament\Resources\ChecklistResource\Widgets;

use App\Models\Checklist;
use App\Models\Location;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ChecklistStat extends BaseWidget
{
    // protected static string $view = 'filament.resources.checklist-resource.widgets.checklist-stat';

    protected function getCards(): array
    {
        $isMonthNow =  Carbon::now()->month;
        $isYearNow = Carbon::now()->year;
        $isMonthLast =  Carbon::now()->subMonth(1);
        $isYearLast = Carbon::now()->subYear(1);
        $totalChecklist = Checklist::whereMonth('created_at', $isMonthNow)
                            ->whereYear('created_at', $isYearNow)
                            ->count();
        $totalChecklistLastMonth = Checklist::whereMonth('created_at', $isMonthLast)
                            ->whereYear('created_at', $isYearLast)
                            ->count();
        $totalLocation = Location::all()->count();
        return [
            Card::make('Progress '.Carbon::now()->copy()->subMonth(1)->format('F Y'), round($totalChecklistLastMonth/$totalLocation*100).' %'),
            Card::make('Progress '.Carbon::now()->format('F Y'), round($totalChecklist/$totalLocation*100).' %'),
            Card::make('Total Location', $totalLocation),
        ];
    }
}
