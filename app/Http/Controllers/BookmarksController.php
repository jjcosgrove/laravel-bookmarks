<?php

namespace Bookmarks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Bookmarks\Http\Requests;
use Bookmarks\Services;
use Bookmarks\Bookmark;
use Bookmarks\Tag;

use Auth;
use DB;

class BookmarksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //grab this user's bookmarks and any public bookmarks
        $bookmarks = Bookmark::where('user_id','=', Auth::user()->id)
            ->orWhere('private','=', false)
            ->orderBy('created_at','DESC')
            ->orderBy('name','ASC')
            ->get();

        //grab only the tags that this user has permission to see
        $tags = new Collection();
        foreach($bookmarks as $bookmark) {
            $tags_as_string = "";
            $these_tags = new Collection();
            foreach($bookmark->tags()->get() as $tag) {
                $tags->push($tag);
                $these_tags->push($tag->name);
               
            }
            $tags_as_string = rtrim(implode(', ', $these_tags->sort()->toArray()),',');
            //$tags_as_string = $tags_as_string,',');
            $bookmark['tags'] = $bookmark['tags']->sortBy('name');
            $bookmark['tags_as_string'] = $tags_as_string;
        }
        $tags = $tags->sortBy('name')->unique('name');

        //for stats
        $untagged_count = $bookmarks->filter(function($item) {
            return $item->tags()->count() == 0;
        })->count();

        //total count
        $all_bm_count = $bookmarks->count();

        //public only count
        $public_bm_count = Bookmark::where('private','=',false)
            ->count();

        //private only count
        $private_bm_count = Bookmark::where('user_id','=',Auth::user()->id)
            ->where('private','=', true)
            ->count();

        //for any actions, lets grab the messages
        $message = \Session::get('message') ? \Session::get('message') : array();

        //render with all of the necassary data
        return view('dashboard')->with(array(
            'bookmarks' => $bookmarks,
            'tags' => $tags,
            'stats' => array (
                'untagged_count' => $untagged_count,
                'all_bm_count' => $all_bm_count,
                'public_bm_count' => $public_bm_count,
                'private_bm_count' => $private_bm_count
            ),
            'message' => $message
        ));
    }

    public function addBookmark(Request $request)
    {
        //scope
        $current_user = Auth::user();
        
        //create a new bookmark and associate with current user
        $bookmark = new Bookmark;
        $bookmark->user()->associate($current_user->id);

        //configure the bookmark
        $bookmark->name = $request->name;
        $bookmark->url = $request->url;
        $bookmark->private = $request->private == 'on' ? true : false;

        //save it
        $bookmark->save();

        //if there are tags assigned...
        if(!empty($request->tags)) {

            //lets make an array of the tags
            $tags = array();
            $in_tags = explode(',',$request->tags);

            //and associate each one to the current bookmark
            foreach($in_tags as $in_tag) {
                $tag = Tag::firstOrNew([
                    'name' => $in_tag,
                    'user_id' => $current_user->id
                ]);
                $tag->user()->associate($current_user->id);
                $tag->save();
                array_push($tags,$tag);
            }

            //save the tags
            $bookmark->tags()->saveMany($tags);
        }

        //all is well, so pass back a message
        $message = array(
            'status' => 'OK', 
            'message' => 'Bookmark added!'
        );

        //redirect to the dashboard view with the message
        return redirect('dashboard')
            ->with('message',$message);

    }

    public function updateBookmark(Request $request)
    {
        //scope
        $current_user = Auth::user();
        
        //grab the bookmark the user wishes to edit
        $bookmark = Bookmark::where([
            'user_id' => $current_user->id,
            'id' => $request->id
        ])->first();

        //update the bookmark
        $bookmark->name = $request->name;
        $bookmark->url = $request->url;
        $bookmark->private = $request->private == 'on' ? true : false;

        //save it
        $bookmark->save();

        //if there are tags assigned...
        if(!empty($request->tags)) {

            //lets make an array of the tags
            $tags = array();
            $in_tags = explode(',',$request->tags);

            //and associate each one to the current bookmark
            foreach($in_tags as $in_tag) {
                $tag = Tag::firstOrNew([
                    'name' => $in_tag,
                    'user_id' => $current_user->id
                ]);
                $tag->user()->associate($current_user->id);
                $tag->save();
                array_push($tags,$tag);
            }

            //save the tags
            $bookmark->tags()->detach();
            $bookmark->tags()->saveMany($tags);
        } else {
            //user removed all tags
            $bookmark->tags()->detach();
        }

        //all is well, so pass back a message
        $message = array(
            'status' => 'OK', 
            'message' => 'Bookmark updated!'
        );

        //redirect to the dashboard view with the message
        return redirect('dashboard')
            ->with('message',$message);
    }

    public function deleteBookmark(Request $request)
    {
        //grab the desired bookmark
        $bookmark_to_delete = Bookmark::where('user_id','=', Auth::user()->id)
            ->find($request->bm_id);

        //for response message
        $message = array();

        //if this user does not own the bookmark, fail and return
        if(!count($bookmark_to_delete)) {
            $message = array(
            'status' => 'Error',
            'message' => 'That bookmark cannot be removed! You are not the owner!'
        );

        //user owns the bookmark, so lets proceed and delete it
        } else {
            $bookmark_to_delete->delete();
            $message = array(
                'status' => 'OK',
                'message' => 'Bookmark with name: '. $bookmark_to_delete->name .' removed!'
            );
        }
        
        //redirect to the dashboard view with the message
        return redirect('dashboard')
            ->with('message',$message);
    }
}
