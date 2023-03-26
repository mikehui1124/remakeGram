<?php
// ProfileController to fetch a profile.record according to a user.id (ie $user var)
namespace App\Http\Controllers;

// locate namespace of User.class
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as Image;


use function PHPUnit\Framework\assertNotFalse;

class ProfilesController extends Controller
{
    public function index($user)
    {
        //get the user.record of $user.string by finding User table
        $user = User::findOrFail($user);


        // $follows = ( auth()->user()->following[1]);
       
        //user()->following returns an arr of followed profiles (NOT ->following() )
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
       
       //count.posts.{user_id} gives unique key of the cache for each user 
       $postCount = Cache::remember(
                                    'count.posts' .$user->id,
                                    now()->addSeconds(30), 
                                    function() use ($user){
                                        return $user->posts->count();
                                    });

       $followersCount = Cache::remember(
                                        'count.followers' .$user->id,
                                        now()->addSecond(30),
                                        function() use ($user){
                                            return $user->profile->followers->count();
                                        });



       $followingCount = Cache::remember(
                                        'count.following' .$user->id,
                                        now()->addSecond(30),
                                        function () use ($user) {
                                            return $user-> following ->count();
                                        });

    //    $postCount = $user->posts->count();
    //    $followersCount = $user-> profile->followers->count();
    //    $followingCount = $user-> following ->count();


        // return index.blade.php, the profile view
        // this pass the user.record to 'user' object on home.php view
        return view('profiles/index', [
            'user'=> $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
        ]);
    }

    public function edit(\App\Models\User $user)
    {
        //this protect the edit/update routes from being hit by unauthed user
        $this-> authorize('update', $user->profile);
        return view('profiles/edit', [
            'user' => $user,
        ]);
    }

    public function update(\App\Models\User $user)    
    {
        $this-> authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '', //take in image.field without validation
        ]);

        //if user upload an image file from the update.form
        if (request('image')) {
            //step1: store upload.image inside a modified path: /public/storage/profile, that's accessible to view
            $imagePath= request('image')->store('profile', 'public');                     
            //step2: trim image edge and fit in 1000px
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            
            //def new array that set the 'image' field to $imagePath
            $imageArray= ['image' => $imagePath];

        } 
        // else {
        //     $imagePath = 'profile/WVBrDMjK7eIKqvKsQVUqLyWmt9SnBFOzH0YMqaxt.jpg';
        // }    
                
        //force only the authed user can run update(data)
        auth()-> user()->profile()-> update(array_merge(
            $data,
            $imageArray ?? []
            //if user didn't upload an img, then set $imageArr to [] so it dun tamper $data.image field            
            
        ));

        // auth()-> user()->profile()-> update(array_merge(
        //     $data,
        //     ['image' => $imagePath]
        //     //this overwrites image.field in $data from a default.path to the modified $imagePath
        // ));    


        return redirect("/profile/{$user->id}");

        //$user ->profile() ->update($data);

    }
}
