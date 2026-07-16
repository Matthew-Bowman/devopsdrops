<?php

namespace App\Filament\Resources\EntryTypes\Pages;

use App\Filament\Resources\EntryTypes\EntryTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEntryType extends EditRecord
{
    protected static string $resource = EntryTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
