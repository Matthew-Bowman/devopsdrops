<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'seo_title',
        'seo_description',
        'content',
        'is_published',
        'cover_image_id',
    ];


    public function articles()
    {
        return $this->belongsToMany(
            Article::class
        );
    }

    public function coverImage()
    {
        return $this->belongsTo(Media::class, 'cover_image_id');
    }
}
