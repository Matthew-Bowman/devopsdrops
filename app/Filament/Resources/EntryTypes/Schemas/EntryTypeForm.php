<?php

namespace App\Filament\Resources\EntryTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EntryTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
            ]);
    }
}
