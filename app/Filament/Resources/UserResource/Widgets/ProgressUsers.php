<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use App\Models\Location;
use App\Models\Checklist;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProgressUsers extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return User::query();

    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name'),
            // Tables\Columns\TextColumn::make('progress'),
            // Tables\Columns\TextColumn::make('checklist_count')
            //                         ->counts('checklist')
            //                         ->label('Progress'),
            // Tables\Columns\TextColumn::make('location_count')
            //                         ->counts('location')
            //                         ->label('Target'),
            // Tables\Columns\TextColumn::make('%')
            //                         ->getStateUsing(function (User $record): float {
            //                             return $record->checklist_count / $record->location_count * 100;
            //                         }),
        ];
    }

    protected function isTablePaginationEnabled(): bool 
    {
        return false;
    }
}
