<?php


namespace App\Repositories;


use App\BaseRepository;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}
