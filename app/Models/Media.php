<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public function posts()
    {
        return $this->hasMany(Article::class, 'cover_image_id');
    }
}
