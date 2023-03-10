<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        // $user->followers()->attach(auth()->user()->id);

        Follower::create([
            'user_id' => $user->id,
            'follower_id' => auth()->user()->id,
        ]);

        return back();
    }

    public function destroy(User $user){
        Follower::where('follower_id',auth()->user()->id)->where('user_id',$user->id)->delete();
        return back();
    }
}
