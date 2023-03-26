<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //this create a initial profile when a new user register to our app
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user-> profile() ->create([
                'title' => $user -> username,

            ]);

            Mail::to ($user->email)-> send(new \App\Mail\NewUserWelcomeMail());
        });
    }


    public function posts()
    {
    //declare this user has many related post.obj (hence a user can fetch its posts)
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC'); // order Posts by 'ceated at'
    }

    public function profile()
    {
    //declare this user has a related profile.obj (hence a user.obj can fetch its profile)
        return $this->hasOne(Profile::class);
    }
    //define a user is following many differn profiles, many-to-many
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }


}
