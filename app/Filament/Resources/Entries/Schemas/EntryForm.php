<?php

namespace App\Filament\Resources\Entries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
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
                Textarea::make('excerpt')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('entry_type_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('topic_id')
                    ->numeric()
                    ->default(null),
                Toggle::make('published')
                    ->required(),
                DateTimePicker::make('published_at'),
            ]);
    }
}
