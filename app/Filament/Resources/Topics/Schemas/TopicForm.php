<?php

namespace App\Filament\Resources\Topics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TopicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('slug')
                    ->required()
                    ->unique(),

                Select::make('cover_image_id')
                    ->required()
                    ->relationship('coverImage', 'title')
                    ->searchable()
                    ->preload(),

                Textarea::make('description')
                    ->required(),

                TextInput::make('seo_title'),

                Textarea::make('seo_description'),

                RichEditor::make('content'),

                Toggle::make('is_published')
                    ->default(true),
            ]);
    }
}
