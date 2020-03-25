<?php


namespace App\Repositories;


use App\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function __construct(Post $post)
    {
        $this->model = $post;
    }
}
