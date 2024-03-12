<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Validator;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('posts.index', [
            'posts' => Post::with('user')->latest()->get(),
    ]);
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
    public function store(Request $request): RedirectResponse
    {
        
        $validated = $request->validate([
            'pet' => 'required|string|max:20',
            'message' => 'required|string|max:255',
            'bedrag' => 'required|numeric|min:0',
            'starthuur' => 'required|date',
            'eindhuur' => 'required|date',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ]);

        

        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = rand(11111, 99999).'.'.$request->image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->storeAs('images',$filename,'public');
            $validated['image'] = $filename;
        }
        $request->user()->posts()->create($validated);


        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'pet' => 'required|string|max:20',
            'message' => 'required|string|max:255',
            'bedrag' => 'required|numeric|min:0',
            'starthuur' => 'required|date',
            'eindhuur' => 'required|date',
            'image' => 'required|mimes:jpeg,bmp,webp,png|size:20000'
        ]);
        if($request->hasFile('image')){
            $filename = rand(11111, 99999).'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('images',$filename,'public');
            $post->update(['image'=>$filename]);}

        
        

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);
 
        $post->delete();
 
        return redirect(route('posts.index'));
    }
}
