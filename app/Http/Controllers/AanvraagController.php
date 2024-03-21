<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aanvraag;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;


class AanvraagController extends Controller
{
    public function store(Post $post): RedirectResponse
    {
        Aanvraag::create([
            'user_id' => Auth()->user()->id,
            'post_id' => $post->id,
        ]);
        //$request->user()->posts()->create($validated);

        return redirect(route('posts.index'));
    }
}
