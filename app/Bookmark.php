<?php

namespace Bookmarks;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmarks';

    //belongs to one user
    public function user()
    {
        return $this->belongsTo('Bookmarks\User');
    }

    //has many tags
    public function tags()
    {
        return $this->belongsToMany('Bookmarks\Tag');
    }
}