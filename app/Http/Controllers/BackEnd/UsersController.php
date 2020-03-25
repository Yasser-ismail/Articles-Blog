<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Users\Store;
use App\Http\Requests\BackEnd\Users\Update;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UsersController extends BackEndController
{
    public $role;

    public function __construct(UserRepository $repository, RoleRepository $role)
    {
        parent::__construct($repository);
        $this->role = $role;
    }

    protected $with = ['role'];


    protected function append()
    {

        return [
            'roles' => $this->role->all(),
        ];
    }

    protected $storeRequestFile = Store::class;

    protected $updateRequestFile = Update::class;


    public function deleteNotification($id)
    {
        Auth::user()->notifications()->where('id', $id)->delete();

        return view('backend.layouts.notifications');
    }

}
