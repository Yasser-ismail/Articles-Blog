<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Comments\Store;
use App\Http\Requests\BackEnd\Comments\Update;
use App\Repositories\CommentRepository;

class CommentsController extends BackEndController
{
    public function __construct(CommentRepository $repository)
    {
        parent::__construct($repository);
    }

    protected $storeRequestFile = Store::class;

    protected $updateRequestFile = Update::class;


}
