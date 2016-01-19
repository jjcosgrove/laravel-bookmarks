<?php

namespace Bookmarks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use Auth;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = array('name');

    //belongs to one user
    public function user()
    {
        return $this->belongsTo('Bookmarks\User');
    }

    //belongs to many bookmarks (which can each have many tags)
    public function bookmarks()
    {
        return $this->belongsToMany('Bookmarks\Bookmark');
    }

    //help function to get visible bookmarks count for a given tag
    //i.e. only those bookmarks this user has permission to view
    public function visible_bookmarks_count()
    {
        $this_tag_name = $this->name;        
        $bookmarks = new Collection();
        $all_bookmarks = Bookmark::where('user_id','=', Auth::user()->id)
            ->orWhere('private','=', false)
            ->get();

        //iterate through all of the potential bookmarks
        foreach($all_bookmarks as $bookmark) {
            $tags = $bookmark->tags()->get();
            foreach($tags as $tag) {
                if($tag->name == $this_tag_name){
                    //user is allowed to see this one so add to collection
                    $bookmarks->push($bookmark);
                    break;
                }
            }
        }

        //done
        return $bookmarks->unique('id')
            ->count();
    }
}
