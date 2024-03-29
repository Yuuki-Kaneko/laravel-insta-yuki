<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\user;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $post;
    private $user;

    public function __construct(Post $post, User $user) {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->search){

            //search data
            $home_posts = $this->post->where('description', 'like', '%'.$request->search.'%')->get();
            //SELECT * FROM posts WHERE descripription like '%searchword%'
            // -- search for posts where description contains searchword

        }else{
        //all posts, with newest/latest posts first
        $all_posts = $this->post->latest()->get();

        $home_posts = [];
        foreach($all_posts as $post) {
            if($post->user->isFollowed() || $post->user->id == Auth::user()->id) {
                $home_posts [] = $post;
            }
        }
        }

        return view('user.home')->with('all_posts', $home_posts)
                                ->with('suggested_users', $this->getSuggestedUsers())
                                ->with('search', $request->search);
    }

    public function getSuggestedUsers() {
        $all_users = $this->user->all()->except(Auth::user()->id);

        $suggested_users = [];
        $count = 0;
        foreach($all_users as $user) {
            if(!$user->isFollowed() && $count < 10) {
                $suggested_users []= $user;
                $count++; //$count = $count +1
            }
        }

        return $suggested_users;
    }

    public function suggested(Request $request) {
        if($request->search){
            $suggested_users = $this->user->where('name', 'like', '%'.$request->search.'%')->get()->except(Auth::user()->id);

        } else {
            $all_users = $this->user->all()->except(Auth::user()->id);
            $suggested_users = [];
            foreach($all_users as $user) {
                if(!$user->isFollowed()) {
                    $suggested_users []= $user;
                }
            }
        }

        return view('user.suggested')->with('suggested_users', $suggested_users);
    }
}
