<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image',
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
}
