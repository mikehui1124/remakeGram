<?php

namespace App\Models;

// Eloquent is an ORM that's included by default within Laravel framework
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //tell Laravel not to guard input data when create post.record    
    protected $guarded = [];

    //to display this default profile.image on index.view if user didn't upload an img
    public function profileImage()
    {
        $imagePath = ($this->image) ?  $this->image : 'profile/WVBrDMjK7eIKqvKsQVUqLyWmt9SnBFOzH0YMqaxt.jpg';
        return '/storage/' . $imagePath;
        //Or return ($this->image) ? '/storage' . $this->image : '/storage/profile/WVBrDMjK7eIKqvKsQVUqLyWmt9SnBFOzH0YMqaxt.jpg';
    }

    public function user()
    {
        //declare this profile.object belongs to a user (hence a profile.obj can fetch its user)
        return $this->belongsTo(User::class);
    }

    //define a profile is followed by many differn users, many-to-many
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
