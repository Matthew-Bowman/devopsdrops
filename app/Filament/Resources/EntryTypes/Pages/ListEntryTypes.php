<?php

namespace App\Filament\Resources\EntryTypes\Pages;

use App\Filament\Resources\EntryTypes\EntryTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEntryTypes extends ListRecords
{
    protected static string $resource = EntryTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
