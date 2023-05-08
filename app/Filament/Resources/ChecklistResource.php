<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChecklistResource\Pages;
use App\Filament\Resources\ChecklistResource\RelationManagers;
use App\Models\Checklist;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChecklistResource extends Resource
{
    protected static ?string $model = Checklist::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Group::make()
                ->schema([
                    Card::make()
                        ->schema([
                            Forms\Components\Select::make('location_id')
                                ->label('Location')
                                ->options(Location::where('user_id', auth()->user()->id)
                                                            ->pluck('name', 'locations.id'))
                                ->searchable(),
                            Forms\Components\Hidden::make('user_id')
                                ->default(auth()->user()->id)
                                ->required(),
                            DatePicker::make('date')
                                ->required(),
                            Forms\Components\Toggle::make('is_sign')
                                ->default(true)
                                ->required(),
                            Forms\Components\Toggle::make('is_photo')
                                ->default(true)
                                ->required(),
                        ],)
                ])
                ->columnSpan(['lg' => 2]),
            Group::make()
                ->schema([
                    Card::make()
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('attachments')
                                ->multiple()
                                ->enableDownload()
                                ->enableOpen()
                                ->enableReordering()
                                ->preserveFilenames()
                                ->removeUploadedFileButtonPosition('right')
                                ->acceptedFileTypes(['application/pdf'])
                                ->required(),
                        ]),
                    Card::make()
                        ->schema([
                            Forms\Components\Placeholder::make('created_at')
                                ->label('Created at')
                                ->content(fn (Checklist $record): ?string => $record->created_at?->diffForHumans()),
        
                            Forms\Components\Placeholder::make('updated_at')
                                ->label('Last modified at')
                                ->content(fn (Checklist $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Checklist $record) => $record === null),
                ])
                ->columnSpan(['lg' => 1]),
        ])
        ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('location.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->searchable()
                    ->date(),
                Tables\Columns\IconColumn::make('is_sign')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_photo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChecklists::route('/'),
            'create' => Pages\CreateChecklist::route('/create'),
            'edit' => Pages\EditChecklist::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
