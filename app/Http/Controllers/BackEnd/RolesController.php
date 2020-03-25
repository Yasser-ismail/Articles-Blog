<?php

namespace App\Http\Controllers\BackEnd;


use App\Repositories\RoleRepository;

class RolesController extends BackEndController
{
    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);
    }
}
