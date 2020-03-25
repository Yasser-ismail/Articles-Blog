<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
      'name', 'role_id',
    ];

    public function users() {
       return $this->hasMany('App\Role');
    }
}
