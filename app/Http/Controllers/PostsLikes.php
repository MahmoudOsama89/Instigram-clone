<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostsLikes extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function like(Post $post){
        auth()->user()->liked()->toggle($post);
        return redirect("/p/{$post->id}");
    }
}
