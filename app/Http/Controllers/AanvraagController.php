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

    public function edit(Aanvraag $thisAanvraag, Post $post)
    {
        $thisAanvraag->accepted = 1;
        $thisAanvraag->save();

        $post->isReview = 1;
        $post->save();

        return redirect('dashboard');
    }

    public function destroy(Aanvraag $aanvraag)
    {

        $aanvraag->delete();
        return redirect('dashboard');
    }

    public function review(Request $request, Post $post)
    {
        $post->Review = $request->Review    ;
        $post->save();
            
            
        
        return redirect(route('dashboard'));
    }
}
