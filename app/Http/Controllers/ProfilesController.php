<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Profile;


class ProfilesController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(User $user, Profile $profile)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        //?     CACHING 
        $postCount = Cache::remember(
            //*Cachekey = Name displayed in telescope
            //*example : count.posts.3 | (user id = 3)
            'count.posts' . $user->id,
            //*How long must the cache be saved?
            now()->addSeconds(30),

            //*Use the "use" statement to get the $user data
            function() use($user) {
                //*Copied from the original :
                //*$postcount = $user->posts->count();
                return $user->posts->count();
            });
        //?     ---

        $followerCount = Cache::remember(
            'count.followers' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return $user->profile->followers->count();
            });
        
        $followingCount = Cache::remember(
            'count.following' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return $user->following->count();
            }); 
        
        

        return view('profiles.index', compact('user', 'follows' , 'postCount' , 'followerCount' , 'followingCount'));
    }

    public function edit(User $user)
    {
        //*Add this line to show the forbidden page
        $this->authorize('update' , $user->profile);

        return view('profiles.edit', compact('user'));

    }

    public function update(User $user)
    {
        $this->authorize('update' , $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required', 
            'image' => '',
        ]);

        //*If the request has an image
        if(request('image')){
            //*$imagepath = profile/filename.jpg | store = Store it in /public/storage/profile 
            $imagepath = request('image')->store('profile', 'public');
            //*Resize the image and save it in /storage/filename
            $image = Image::make(public_path("storage/{$imagepath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagepath];
        }

        //? Right now, the $data->image is empty, so it will not be saved
        //? Lets overwrite this variable by using array_merge : 
        
        auth()->user()->profile->update(array_merge(
            $data, 
            $imageArray ?? [] 
        ));

        //? The $data->image is now : profile/imagename.jpg

        return redirect("/profile/{$user->id}");
    }
}
