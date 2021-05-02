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
