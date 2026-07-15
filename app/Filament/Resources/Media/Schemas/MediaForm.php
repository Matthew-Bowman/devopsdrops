<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\Image\Image;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('path')
                    ->image()
                    ->disk('public')
                    ->directory('media')
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file): string {
                        $filename = Str::uuid() . '.webp';
                        $relativePath = "media/{$filename}";
                        $destination = storage_path("app/public/{$relativePath}");

                        Image::load($file->getRealPath())
                            ->format('webp')
                            ->quality(85)
                            ->save($destination);

                        return $relativePath;
                    })
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
