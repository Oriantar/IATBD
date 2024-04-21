<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PetProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class PetProfileController extends Controller
{
    public function index(Post $post)
    {
        $Ppost = Post::where("id", $post->id)->first();
        $images = PetProfile::where("post_id", $Ppost->id)->get();
        $user = User::where("id", $Ppost->user_id)->first();
        return view("pet.index", ["pet" => $post, "images" => $images, 'owner' => $user]);
    }

    public function upload(Post $post, Request $request)
    {
        if ($request->hasFile('media')) {
            $file = $request->file('media');

            $extension = $file->getClientOriginalExtension();

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $isVideo = 0;
            } elseif ($extension == 'mp4' || $extension == 'mov' || $extension == 'avi' || $extension == 'mkv') {
                $isVideo = 1;
            } else {
                return redirect("pet/$post->id");
            }
            $filename = Hash::make(rand(11111, 99999)) . '.' . $request->media->getClientOriginalExtension();
            $request->media->storeAs('images/profile', $filename, 'public');

            PetProfile::create([
                'post_id' => $post->id,
                'media' => $filename,
                'isVideo' => $isVideo,
            ]);



            return redirect("pet/$post->id");
        }
    }
}
