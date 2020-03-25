<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\RepositoryContract;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{

    protected $model;
    public function __construct(RepositoryContract $repository)
    {
        $this->model = $repository;
    }
}
