<?php


namespace App\Repositories;


use App\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

}
