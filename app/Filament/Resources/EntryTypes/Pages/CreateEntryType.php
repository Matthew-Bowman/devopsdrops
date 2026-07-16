<?php

namespace App\Filament\Resources\EntryTypes\Pages;

use App\Filament\Resources\EntryTypes\EntryTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEntryType extends CreateRecord
{
    protected static string $resource = EntryTypeResource::class;
}
