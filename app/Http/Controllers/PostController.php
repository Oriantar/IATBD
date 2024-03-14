<?php

namespace App\Http\Controllers;

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
            'species' => 'required|string|max:20'
        ]);

        

        
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
            'species' => 'required|string|max:20'
        ]);  
        
        

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
