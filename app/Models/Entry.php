<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Entry extends Model
{
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'entry_type_id',
        'parent_entry_id',
        'topic_id',
        'published_at',
        'published',
        'sort_order',
    ];


    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function childrenRecursive()
    {
        return $this->children()
            ->where('published', true)
            ->with('childrenRecursive');
    }

    public function entryType()
    {
        return $this->belongsTo(EntryType::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    public function exploreEntries()
    {
        $entries = collect();

        // Children first
        $entries = $entries->merge(
            $this->children()
                ->where('published', true)
                ->orderBy('sort_order')
                ->limit(3)
                ->get()
        );

        // Next siblings
        if ($entries->count() < 3 && $this->parent_entry_id) {
            $entries = $entries->merge(
                Entry::where('parent_entry_id', $this->parent_entry_id)
                    ->where('id', '!=', $this->id)
                    ->where('sort_order', '>', $this->sort_order)
                    ->where('published', true)
                    ->orderBy('sort_order')
                    ->limit(3 - $entries->count())
                    ->get()
            );
        }

        // Parent as final fallback
        if ($entries->count() < 3 && $this->parent) {
            $entries->push($this->parent);
        }

        return $entries;
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
        )
            ->orderBy('sort_order')
            ->orderBy('title');
    }

    protected $casts = [
        'published_at' => 'datetime',
        'published' => 'boolean',
    ];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => strip_tags($this->content),

            'topic' => $this->topic?->name,

            'parent' => $this->parent?->title,

            'ancestors' => $this->ancestors()
                ->pluck('title')
                ->implode(' '),

            'published' => $this->published_at !== null,
        ];
    }
}
