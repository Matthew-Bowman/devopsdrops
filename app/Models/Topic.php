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
    ];


    public function articles()
    {
        return $this->belongsToMany(
            Article::class
        );
    }
}
