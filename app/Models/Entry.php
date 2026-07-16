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
        'topic_id',
        'published',
    ];


    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }


    public function type()
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
}
