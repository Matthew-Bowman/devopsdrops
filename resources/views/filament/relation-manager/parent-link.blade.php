<div class="mb-4">
    <a
        href="{{ \App\Filament\Resources\Entries\EntryResource::getUrl('edit', ['record' => $parent]) }}"
        class="text-primary-600 hover:underline font-semibold">
        ← {{ $parent->title }}
    </a>
</div>