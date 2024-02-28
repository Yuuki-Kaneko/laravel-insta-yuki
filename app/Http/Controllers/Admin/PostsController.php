<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function index(Request $request) {

        if($request->search){
            //search data
            $all_posts = $this->post->where('description', 'like', '%'.$request->search.'%')->paginate(5);
            //SELECT * FROM posts WHERE descripription like '%searchword%'
            // -- search for posts where description contains searchword
        }else{
            $all_posts = $this->post->latest()->withTrashed()->paginate(5);
        }
            
        return view('admin.posts.index')->with('all_posts', $all_posts)
                                        ->with('search', $request->search);
        }
        

    public function hidden($id) {
        $this->post->destroy($id);

        return redirect()->back();
    }

    public function unhide($id) {
        $this->post->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }
}
