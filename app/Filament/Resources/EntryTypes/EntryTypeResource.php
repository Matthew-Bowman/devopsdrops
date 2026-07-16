<?php

namespace App\Filament\Resources\EntryTypes;

use App\Filament\Resources\EntryTypes\Pages\CreateEntryType;
use App\Filament\Resources\EntryTypes\Pages\EditEntryType;
use App\Filament\Resources\EntryTypes\Pages\ListEntryTypes;
use App\Filament\Resources\EntryTypes\Schemas\EntryTypeForm;
use App\Filament\Resources\EntryTypes\Tables\EntryTypesTable;
use App\Models\EntryType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EntryTypeResource extends Resource
{
    protected static ?string $model = EntryType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return EntryTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EntryTypesTable::configure($table);
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
            'index' => ListEntryTypes::route('/'),
            'create' => CreateEntryType::route('/create'),
            'edit' => EditEntryType::route('/{record}/edit'),
        ];
    }
}
