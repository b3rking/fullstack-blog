<?php

namespace App\Http\Repositories;

use App\Models\Post;

class PostRepository
{
    public function store($data) {
        return Post::create($data);
    }
}