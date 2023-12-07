<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // create custom view
    public function create() {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(3);
        return view('create', compact('posts'));
    }

    // post create
    public function postCreate(Request $req){
        
        $data = $this->getPostData($req);
        Post::create($data);
        return back()->with(["insertsuccess" => "Created post successfully."]);
    }

    // post delete
    public function postDelete($id){
        Post::where('id', $id)->delete();
        return back()->with(["deletesuccess" => "Deleted successfully"]);
    }

    // post update
    public function postUpdate($id){
        $data = Post::where('id', $id)->get()->toArray();
        // dd($data);
        return view('update', compact('data'));
    }

    // edit page
    public function editPage($id){
        $data = Post::where('id', $id)->get()->toArray();
        // dd($data);
        return view('edit', compact('data'));
    }

    // post update now
    public function update(Request $req){
        $data = $this->getPostData($req);
        $id = $req->postId;
        Post::where('id', $id)->update($data);
        // dd($data, $id);
        return redirect()->route('post#createPage')->with(["updatesuccess" => "Updated successfully!"]);
    }

    // get post data
    private function getPostData($req): array{
        $arr = [
            'title' => $req->postTitle,
            'desc' => $req->postDesc
        ];
        return $arr;
    }
}
