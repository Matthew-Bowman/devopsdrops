<?php

namespace App\Filament\Resources\Entries\RelationManagers;

use App\Filament\Resources\Entries\EntryResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;

class ChildrenRelationManager extends RelationManager
{
    protected static string $relationship = 'children';

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('parent')
                    ->label(fn() => '← ' . ($this->ownerRecord->parent?->title ?? 'No parent'))
                    ->url(
                        fn() => $this->ownerRecord->parent
                            ? EntryResource::getUrl('edit', [
                                'record' => $this->ownerRecord->parent,
                            ])
                            : null
                    ),
            ])
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('title')
                    ->url(fn($record) => EntryResource::getUrl('edit', [
                        'record' => $record,
                    ]))
                    ->openUrlInNewTab(false),

                TextColumn::make('sort_order'),
            ]);
    }
}
