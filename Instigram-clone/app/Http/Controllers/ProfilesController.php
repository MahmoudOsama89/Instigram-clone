<?php

namespace App\Http\Controllers;
//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
     public function index(User $user)
    {
        //$user = User::findOrFail($user);
        //dd($user);
        $follows = (auth()->user()) ? auth()->user()->following()->where(
           "profile_id",$user->profile->id)->exists()   : false;
        $userPosts = Cache::remember("count.posts.".$user->id,now()->addSeconds(30),function() use($user){
            return $user->posts->count();
        });
        $profileFollower = Cache::remember("profile.followers.".$user->profile->id,now()->addSeconds(30),function() use($user){
            return $user->profile->followers->count();
        });
        $userFollowing  = Cache::remember("user.folloing.".$user->id,now()->addSeconds(30),function() use($user){
            return $user->following->count();
        });
        return view('profiles.index',compact("user","follows","userPosts","profileFollower","userFollowing"));
    }

    public function edit(User $user){
        return view("profiles.edit",compact("user"));
    }

    public function mahmoud(){
        return view("tmp");
    }
    
    public function update(User $user){
        $this->authorize("update",$user->profile);
        $data = request()->validate([
            "title"=>"required",
            "description"=>"required",
            "url"=>"url",
            "image"=>"image"
        ]);

        if(request("image")){
            $imagePath = request("image")->store("profile","public");
            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ["image"=>$imagePath];
        }
        auth()->user()->profile()->update(array_merge($data,$imageArray ?? []));
        return redirect("/profile/".auth()->user()->id);
    }
}
