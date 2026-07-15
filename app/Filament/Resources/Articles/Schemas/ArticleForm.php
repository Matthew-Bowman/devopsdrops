<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;

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

				Select::make('tags')
					->relationship('tags', 'name')
					->multiple()
					->searchable()
					->preload()
					->required()
					->minItems(1)
					->createOptionForm([
						TextInput::make('name')
							->required()
							->unique('tags', 'name'),
					]),

				Select::make('primary_topic_id')
					->label('Primary Topic')
					->relationship('primaryTopic', 'name')
					->searchable()
					->preload()
					->required(),

				CheckboxList::make('topics')
					->label('Additional Topics')
					->relationship('topics', 'name'),

				Select::make('cover_image_id')
					->required()
					->relationship('coverImage', 'title')
					->searchable()
					->preload(),

				DateTimePicker::make('published_at')
					->required(),

				Textarea::make('excerpt'),

				RichEditor::make('content')
					->required(),
			]);
	}
}
