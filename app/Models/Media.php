<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'title',
        'path',
        'alt_text',
        'source',
        'photographer',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'cover_image_id');
    }
}