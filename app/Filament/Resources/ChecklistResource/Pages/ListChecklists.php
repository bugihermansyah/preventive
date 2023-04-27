<?php

namespace App\Filament\Resources\ChecklistResource\Pages;

use App\Filament\Resources\ChecklistResource;
use App\Models\Checklist;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
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
        if (User::with('head') == 'head'){
            return Checklist::all();
        }else{
            return Checklist::where('user_id', auth()->user()->id);
        }
    }
}
