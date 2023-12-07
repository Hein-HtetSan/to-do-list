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
        $posts = Post::orderBy('updated_at', 'desc')->paginate(3);
        return view('create', compact('posts'));
    }

    // post create
    public function postCreate(Request $req){
        $this->validation($req);
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
        return view('edit', compact('data'));
    }

    // post update now
    public function update(Request $req){
        $this->validation($req);
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

    // validation
    private function validation($req){
        $validationRule = [
            'postTitle' => 'required|min:5|unique:posts,title',
            'postDesc' => 'required'
        ];

        $validationMessage = [
            'postTitle.required' => 'post title ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postDesc.required' => 'post description ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postTitle.min' => 'အနည်းဆုံး ၅ လုံးရှိရန် လိုအပ်ပါသည်။',
            'postTitle.unique' => 'ခေါင်းစဥ် တူနေပါသည်။'
        ];
        
        Validator::make($req->all(),$validationRule,$validationMessage)->validate();
    }
}
