<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\gate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Events\UserSubscribed;
// use App\Http\Requests\StorepostRequest;
// use App\Http\Requests\UpdatepostRequest;

class PostController extends Controller implements HasMiddleware
{

    // middleware function
    public static function middleware(): array
    {
        return [
            
            new Middleware('auth', only: ['store']),
            new Middleware('auth', except: ['index','show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // event(new UserSubscribed(' Ali'));
        $posts = Post::Latest()->paginate(6);

        // dd($posts);        
        return view('posts.index' ,['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        // dd('ok');
        // validation
        $fields = $request->validate([
            'title' => ['required','max:255'],
            'body' => ['required'],
            'image'=>['nullable','file','max:3000','mimes:png,jpg,webp,JFIF']
        ]);
       
        // store image if exist
        $path = null;
        if($request -> hasFile('image')){
           $path =  Storage::disk('public')->put('posts_images',$request->image);
        //    dd($path);
        }
        
        // dd('ok');
        // create post 
        Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);
        //  Post::create([ 'user_id' => Auth::id(),...$fields ] );
        // Auth::user()->posts()->create($fields);

        // redirect to dashboard
        // return redirect()->route('posts.index');
        return back()->with('success', 'your post was created!');
        // dd('ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return view('posts.show',['post'=> $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        gate::authorize('modify',$post);
        return view('posts.edit', ['post'=>$post]);
        // redriect 

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
         // validation
         $fields = $request->validate([
            'title' => ['required','max:255'],
            'body' => ['required'],
            'image'=>['nullable','file','max:3000','mimes:png,jpg,webp,JFIF']
        ]);
       
        $path = $post->image ?? null;
        if($request -> hasFile('image')){
            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
           $path =  Storage::disk('public')->put('posts_images',$request->image);
        //    dd($path);
        }
        // dd('ok');
        // update post  
         $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);
        // Auth::user()->posts()->create($fields);

        // redirect to dashboard
       
        return redirect()->route('dashboard')->with('success', 'your post was update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        if($post-> image){
            Storage::disk('public')->delete($post->image);
        }
        // dd('ok');
        $post->delete();
        // retrun
        return back()->with('delete',"your post was deleted");
    }
}
