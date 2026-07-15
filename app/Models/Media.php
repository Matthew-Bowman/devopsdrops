<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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


    public function url(string $size = 'N'): string
    {
        $size = strtoupper($size);

        abort_unless(
            in_array($size, ['S', 'M', 'L', 'N']),
            400
        );

        $path = $this->path;

        if ($size !== 'N') {
            $info = pathinfo($path);

            $path = $info['dirname'] . '/' .
                $info['filename'] . '-' . $size .
                '.' . $info['extension'];
        }

        return Storage::url($path);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'cover_image_id');
    }
}
