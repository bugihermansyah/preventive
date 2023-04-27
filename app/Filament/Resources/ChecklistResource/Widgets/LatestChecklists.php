<?php

namespace App\Filament\Resources\ChecklistResource\Widgets;

use App\Models\Checklist;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestChecklists extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Checklist::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('location.name'),
            Tables\Columns\TextColumn::make('user.name'),
            Tables\Columns\TextColumn::make('created_at')->since(),
        ];
    }

    protected function getTableRecordsPerPageSelectOptions(): array 
    {
        return [10, 25];
    } 
}
