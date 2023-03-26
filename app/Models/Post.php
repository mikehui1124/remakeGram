<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //tell Laravel not to guard input data when create post.record    
    protected $guarded = [];

    public function user()
    {        
        //declare this post.object belongs to a user (hence a post.obj can fetch its user)
        return $this->belongsTo(User::class);
    }
}

