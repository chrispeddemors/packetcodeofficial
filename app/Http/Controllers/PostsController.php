<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Intervention\Image\ImageManagerStatic as Image;



class PostsController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
    }

    
    public function index()
    {
        //* Get all the users im following -> 
        //* then only get the user_id from profiles table
        //* And save it to $users
        //? Returns the user_id's that i'm following
        $users = auth()->user()->following()->pluck('profiles.user_id');

        //? Returns all the posts of the users i'm following
        //* WhereIn = only get the posts where the user_id = $user->user_id (above)
        //* Latest()= Show the posts in reverse order (new->old)

        $posts =Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        //*Caption and image are mandatory + the file must be an image format
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        //*Get the imagepath + store the image in the folder
        $imagepath = request('image')->store('uploads', 'public');
        //*Re-size the image
        $image = Image::make(public_path("storage/{$imagepath}"))->fit(1200, 1200);
        $image->save();

        //*Post it to the database
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagepath,
        ]);


        //*Return the view
        return redirect('profile/' .auth()->user()->id);
    }

    public function show(Post $post, User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        return view ('posts.show', compact('post', 'user', 'follows'));
    }


}

