<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index(User $user)
    {
        $Puser = User::where("id", $user->id)->first();
        $images = userProfile::where("user_id", $user->id)->get();
        return view("user.index", ["user" => $Puser, "images" => $images]);
    }

    public function upload(User $user, Request $request)
    {
        if ($request->hasFile('media')) {
            $file = $request->file('media');

            $extension = $file->getClientOriginalExtension();

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $isVideo = 0;
            } elseif ($extension == 'mp4' || $extension == 'mov' || $extension == 'avi' || $extension == 'mkv') {
                $isVideo = 1;
            } else {
                return redirect("user/$user->id");
            }
            $filename = Hash::make(rand(11111, 99999)) . '.' . $request->media->getClientOriginalExtension();
            $request->media->storeAs('images/profile', $filename, 'public');

            UserProfile::create([
                'user_id' => $user->id,
                'media' => $filename,
                'isVideo' => $isVideo,
            ]);



            return redirect("user/$user->id");
        }
    }
}