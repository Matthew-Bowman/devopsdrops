<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'entry_type_id',
        'parent_entry_id',
        'topic_id',
        'published_at',
    ];


    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }


    public function entryType()
    {
        return $this->belongsTo(EntryType::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    public function relatedEntries()
    {
        return $this->belongsToMany(
            Entry::class,
            'entry_relations',
            'entry_id',
            'related_entry_id'
        );
    }

    public function ancestors()
    {
        $ancestors = collect();

        $entry = $this->parent;

        while ($entry) {
            $ancestors->prepend($entry);
            $entry = $entry->parent;
        }

        return $ancestors;
    }

    public function parent()
    {
        return $this->belongsTo(
            Entry::class,
            'parent_entry_id'
        );
    }


    public function children()
    {
        return $this->hasMany(
            Entry::class,
            'parent_entry_id'
        );
    }

    protected $casts = [
        'published_at' => 'datetime',
        'published' => 'boolean',
    ];
}
