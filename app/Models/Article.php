<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function coverImage()
    {
        return $this->belongsTo(Media::class, 'cover_image_id');
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content));

        return max(1, ceil($words / 200));
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function searchableAs()
    {
        return app()->environment('production')
            ? 'articles'
            : 'dev_articles';
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,

            'excerpt' => $this->excerpt,

            'content' => strip_tags($this->content),

            'tags' => $this->tags
                ->pluck('name')
                ->implode(' '),

            'image' => $this->coverImage?->alt_text,
        ];
    }
}
