<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
	    ->components([
	        TextInput::make('title')
        	    ->required(),

	        TextInput::make('slug')
	            ->required()
	            ->unique(ignoreRecord: true),

	        Textarea::make('excerpt'),

	        RichEditor::make('content')
	            ->required(),

	        FileUpload::make('cover_image'),

	        DateTimePicker::make('published_at'),
	    ]);
    }
}
