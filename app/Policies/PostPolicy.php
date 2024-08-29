<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\post;
use App\Models\User;

class PostPolicy
{
    public function modify(User $user, Post $post): bool{
        return $user->id === $post->user_id;
    }
}
