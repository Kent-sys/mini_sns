<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(string $name){
        $user = User::where('name', $name)->first();
        $articles = $user->articles->sortByDesc('created_at');
        return view('users.show',['user' => $user, 'articles' => $articles]);

    }

    public function likes(string $name){
        $user = User::where('name', $name)->first();
        $articles = $user->likes->sortByDesc('created_at');
        return view('users.likes',['user' => $user, 'articles' => $articles]);

    }
    //フォローしているユーザーの一覧表示
    public function followings(string $name){
        $user = User::where('name', $name)->first();
        $followings = $user->following->sortByDesc('created_at');
        return view('users.followings',['user' => $user, 'followings' => $followings]);
    }
    //フォローされているユーザーの一覧表示
    public function followers(string $name){
        $user = User::where('name', $name)->first();
        $followers = $user->followers->sortByDesc('created_at');
        return view('users.followers',['user' => $user, 'followers' => $followers]);
    }

    //フォロー機能のメソッド
    public function follow(Request $request, string $name){
        $user = User::where('name', $name)->first();
        if($user->id === $request->user()->id){
            return abort('404', 'Cannot follow yourself.');
        }
        $request->user()->following()->detach($user);
        $request->user()->following()->attach($user);

        return ['name' => $name];
    }
    //フォロー解除のメソッド
    public function unfollow(Request $request, string $name){
        $user = User::where('name', $name)->first();
        if($user->id === $request->user()->id){
            return abort('404', 'Cannot follow yourself.');
        }
        $request->user()->following()->detach($user);

        return ['name' => $name];
    }
}
