<?php

namespace App\Http\Controllers;

use App\Models\Aanvraag;    
use App\Models\Post;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;




class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        

        return view('posts.index', [
            'posts' => Post::with('user')->latest()->get(),
            'species' => Species::All(),
            'aanvragen' => Aanvraag::All(),
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
            'species' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->extension();
            $image->storeAs('public/images/posts/', $name);
        }

        Post::create([
            'pet' => $request->input('pet'),
            'message' => $request->input('message'),
            'bedrag' => $request->input('bedrag'),
            'starthuur' => $request->input('starthuur'),
            'eindhuur' => $request->input('eindhuur'),
            'species' => $request->input('species'),
            'image' => $name ?? null,
            'user_id' => Auth()->user()->id,
        ]);
        //$request->user()->posts()->create($validated);

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
            'species' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);  
        
        if($request->hasFile('image')){
            Storage::delete('public/images/posts'.$post->image);
            $image = $request->file('image');
            $name = time().'.'.$image->extension();
            $vaildated['image'] = $name;
            $image->storeAs('public/images/posts', $name);
        }
        


        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);
        Storage::delete('public/images'.$post->image);
        $post->delete();
        
        return redirect(route('posts.index'));
    }
}
