<?php

namespace App\Filament\Resources\ChecklistResource\Pages;

use App\Filament\Resources\ChecklistResource;
use App\Models\Checklist;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ListChecklists extends ListRecords
{
    protected static string $resource = ChecklistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin'))
        {
            return Checklist::query();
        }

        if (auth()->user()->hasRole('staff'))
        {
            return Checklist::query()->where('user_id', auth()->user()->id);
        }
    }
}
