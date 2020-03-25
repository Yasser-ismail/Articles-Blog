<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'body', 'average_rating', 'count_rating'
    ];

    //relations

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function rates()
    {
        return $this->hasMany('App\Models\Rate');
    }

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }
}
