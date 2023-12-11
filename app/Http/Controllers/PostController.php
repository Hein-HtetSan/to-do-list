<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    // create custom view
    public function create() {
        // $posts = Post::orderBy('updated_at', 'desc')->paginate(3);

        $posts = Post::when(request('searchKey'), function($query){
                    $key = request('searchKey');
                    $query->where('title', 'like', '%'.$key.'%');
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(4);

        return view('create', compact('posts'));
    }

    // post create
    public function postCreate(Request $req){
        $this->validation($req);
        $data = $this->getPostData($req);
        // store image 
        if($req->hasfile('postImage')){
            $filename = uniqid() .'_'. $req->file('postImage')->getClientOriginalName(); // filename with unique
            $req->file('postImage')->storeas('myImage', $filename);
            $data["image"] = $filename;
        }
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
        $this->validation($req);
        $data = $this->getPostData($req);
        $id = $req->postId;
        Post::where('id', $id)->update($data);
        return redirect()->route('post#createPage')->with(["updatesuccess" => "Updated successfully!"]);
    }

    // get post data
    private function getPostData($req): array{
        $arr = [
            'title' => $req->postTitle,
            'desc' => $req->postDesc,
            'price' => $req->postFee,
            'address' => $req->postAddress,
            'rating' => $req->postRating,
        ];
        return $arr;
    }

    // validation
    private function validation($req){
        $validationRule = [
            'postTitle' => 'required|min:5|unique:posts,title,'.$req->postId,
            'postDesc' => 'required',
            'postAddress' => 'required',
            'postFee' => 'required',
            'postRating' => 'required',
            'postImage' => 'mimes:jpg,png,jpeg|file'
        ];

        $validationMessage = [
            'postTitle.required' => 'Post title field is empty!',
            'postDesc.required' => 'Post description field is empty!',
            'postTitle.min' => 'Post title need 5 minimum number of charater!',
            'postTitle.unique' => 'Post title has been taken!',
            'postFee.required' => 'Post field is empty',
            'postAddress.required' => 'Post Address is empty',
            'postRating.required' => 'Post Rating is empty',
            'postImage.mimes' => 'Not supported format',
            'postImage.file' => 'Must be file type'
        ];
        
        Validator::make($req->all(),$validationRule,$validationMessage)->validate();
    }
}
