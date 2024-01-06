<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return true; // Allow all users to view posts
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Post $post)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Post $post)
    {
        return $user->role === 'admin';
    }
}
