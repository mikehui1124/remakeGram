<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //same as $user= User::findOrFail($user)
    //$user is the user appearing on index.view, ie. the user being followed
    public function store(User $user)
    {
        //attach a relation to $user.profile
        return auth()->user()->following()->toggle($user ->profile);
    }
}
