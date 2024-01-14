<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image'];

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_posts', 'post_id', 'user_id')->withTimestamps();
    }

}
