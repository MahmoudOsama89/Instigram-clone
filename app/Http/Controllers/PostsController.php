<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;
class PostsController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function create(){
        return view("posts.create");
    }


    public function comment(Post $post){
        if(auth()->user()){
            $data = request()->validate(["comment"=>"required"]);
            $post->comments()->create(array_merge($data,["user_id"=>auth()->user()->id]));
            //dd($de);
            return redirect("/p/{$post->id}");
        }
    }

    public function index(){
        $users = auth()->user()->following->pluck("user_id")->toArray();
        //$userIds = array_pluk($users,"Profile.user_id");
        sort($users);   
        $posts = Post::whereIn("user_id",$users)->with("user")->latest()->cursorPaginate(4);
        return view("posts.index",compact("posts"));
    }
    public function store(){
        $data = request()->validate(["caption"=>"required","image"=>["required","image"]]);
        $imagePath = request("image")->store("uploads","public");
        //dd(public_path("storage/{$imagePath}"));
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        auth()->user()->posts()->create([
            "caption"=>$data["caption"],
            "image"=>$imagePath
        ]);
        return redirect("/profile/".auth()->user()->id);
        
    }

    public function show(\App\Models\Post $post){
        $comments = $post->comments;
        $isLiked = auth()->user()->liked()->with("User")->where("post_id",$post->id)->exists();
        if($isLiked){
            $isLiked = "unlike";
        }else{
            $isLiked = "like";
        }

        //$notAuthComments = $post->comments()->with("User")->where('user_id', '!=' , auth()->user()->id)->toArray();
        //$comments = array_merge($comments,$notAuthComments);
        //dd($notAuthComments);
        return view("posts.show",compact("post","comments","isLiked"));
    }
}
