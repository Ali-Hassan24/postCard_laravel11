<?php

namespace App\Http\Controllers;

use App\Models\post;  // Use the Post model
use App\Models\User;
use Illuminate\Http\Request;
// use App\Http\Controllers\user;
use Illuminate\Support\Facades\Auth;
use App\Controllers\PostController;
use Illuminate\Database\Eloquent\Relations\HasMany;
class DashboardController extends Controller
{
    public function index()
    {
        
        $posts = Auth::user()->posts()->paginate(4);
        // $posts = Post::all();
        // dd($posts);
        
        // Pass posts to the dashboard view
        return view('users.dashboard', ['posts' => $posts]);
    }

    public function userPosts(user $user){
        // dd($user->posts);
        $userPosts = $user->posts()->latest()->paginate(6);
        return view('users.posts', [
            'posts'=> $userPosts,
            'user'=> $user
        ]);
    }
}
