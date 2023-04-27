<?php
 
namespace App\Filament\Pages;

use App\Filament\Resources\ChecklistResource\Widgets\ChecklistStat;
use App\Filament\Resources\ChecklistResource\Widgets\LatestChecklists;
use App\Filament\Resources\UserResource\Widgets\ProgressUsers;
use Filament\Pages\Dashboard as BasePage;
 
class Dashboard extends BasePage
{
    protected function getWidgets(): array
    {
        return [
            ChecklistStat::class,
            LatestChecklists::class,
            ProgressUsers::class,
        ];
    }
}