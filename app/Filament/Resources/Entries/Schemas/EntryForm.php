<?php

namespace App\Filament\Resources\Entries\Schemas;

use App\Models\Entry;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EntryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Select::make('parent_entry_id')
                    ->label('Parent Entry')
                    ->options(function ($record) {

                        return Entry::query()
                            ->where('id', '!=', $record?->id)
                            ->pluck('title', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Textarea::make('excerpt')
                    ->default(null)
                    ->columnSpanFull(),
                Section::make('Content')
                    ->schema([
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull(),
                Select::make('topic_id')
                    ->label('Topic')
                    ->relationship('topic', 'name'),
                Select::make('entry_type_id')
                    ->required()
                    ->relationship('entryType', 'name')
                    ->searchable()
                    ->preload(),
                Toggle::make('published')
                    ->required(),
                DateTimePicker::make('published_at'),
            ]);
    }
}
