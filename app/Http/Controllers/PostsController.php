<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
// import Image.class from Intervention\Image lib
use Intervention\Image\ImageManagerStatic as Image;

require '../vendor/autoload.php';



class PostsController extends Controller
{
    //middleware requires a autheticated user before he can enter create.php view to create a post
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //pluck user_id.field from profiles.table
        $users = auth()-> user()->following() -> pluck('profiles.user_id');

        // dd($users);

        //to query Post->user() using a batch of user_ids to reduce no. of query to Post.table
        $posts = Post::whereIn('user_id', $users)->with('user')-> orderBy('created_at', 'DESC') ->paginate(3);

        //  dd($posts);

        //$posts = Post::whereIn('user_id', $users)->with('user')-> orderBy('created_at', 'DESC') ->get();
        
       
       
        //compact() pass all posts.records to the $posts.obj of the view
        return view('posts/index', compact('posts'));

    }

    public function create()
    {
        //return create.blade.php, the post.create view
        return view('posts/create');
    }

    // method="post", saves input data to $data.obj
    public function store()
    {
        // valid input data from a form
        $data = request()->validate([
            'another' =>'', //take in remaining fields without making any validation
            'caption' => 'required',
            'image' => ['required', 'image'], //valid that it must be an image
        ]);

        // store upload.image unser /public/storage/upload, save image path
        $imagePath= request('image')->store('upload', 'public');


      

    //get image file from $imagePath and wrap around a Image.class -> fit image to 1000px    
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1100, 1100);
        $image->save();

        // $imagePath is a string 
        auth()->user()-> posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        
        //this fetch the authed user_id and use the posts_relationship to a post for this user
        //auth()->user()-> posts()->create($data);



       return redirect('/profile/' . auth()->user()->id);

        //create new record in Post.table using $data passed by form.submit event        
        // \App\Models\Post::create($data);

        // get all input data from a form.submit event
        // dd(request()->all());       
    }
//this fetch Post::findOrFail($post) directly
    public function show(\App\Models\Post $post)  // $post = Post::findOrFail($post)
    {
        //dd($post);

         // this pass the post.record to 'post' object on show.php view
        return view('posts/show', [
            'post' => $post
        ]);
            
    }
}
