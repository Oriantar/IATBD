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
use Illuminate\Support\Facades\Storage;




class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        
        $bedragFilter = request('bedrag');
            if (!request('bedrag') > 0)
                $bedragFilter = 10000000000;
        if (request('species') != 'All') {
            $posts = Post::where('species', 'like', '%' . request('species') . '%')->where('pet', 'like', '%' . request('search') . '%')->whereBetween('bedrag', [0, $bedragFilter])->get();
        } else {
            $posts = Post::where('pet', 'like', '%' . request('search') . '%')->whereBetween('bedrag', [0, $bedragFilter])->get();
        }
        if (empty(request('species'))) {
            $posts = Post::All();
        }


        
        return view('posts.index', [
            'posts' => $posts->reverse(),
            'species' => Species::All(),
            'aanvragen' => Aanvraag::where('user_id', Auth()->user()->id)->get(),
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
            'starthuur' => 'required|date|before:eindhuur|after:today',
            'eindhuur' => 'required|date|after:starthuur',
            'species' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/images/posts/', $name);
            $validated['image'] = $name;
        }

        Post::create([
            'user_id' => Auth()->user()->id,
        ] + $validated);
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
            'starthuur' => 'required|date|before:eindhuur|after:today',
            'eindhuur' => 'required|date|after:starthuur',
            'species' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->extension();
            $image->storeAs('public/images/posts/', $name);
            $validated['image'] = $name;
        }

        $post->update($validated);


        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);
        Storage::delete('public/images' . $post->image);
        $post->delete();

        return redirect(route('posts.index'));
    }
}
