<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function update(User $user, Article $article): bool
    {
        return $user->role === 'admin';
    }
}
