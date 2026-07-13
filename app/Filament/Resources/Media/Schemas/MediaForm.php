<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('path')
                    ->image()
                    ->directory('media')
                    ->disk('public')
                    ->required(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('alt_text')
                    ->maxLength(255),

                TextInput::make('source')
                    ->maxLength(255),

                TextInput::make('photographer')
                    ->maxLength(255),

                TagsInput::make('tags'),
            ]);
    }
}
