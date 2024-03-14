<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    
    public function index(): View
    {
        $users = User::All();
        return view('users.index', ['users' => $users]);
    }

    public function block(User $user){
        if($user->isBlocked == 0){
            $user->update(['isBlocked' => 1]);
        }
        else{
            $user->update(['isBlocked' => 0]);
        }
        
        return redirect(route('users.index'));
    }
    
    public function admin(User $user){
        if($user->isAdmin == 0){
            $user->update(['isAdmin' => 1]);
        }
        else{
            $user->update(['isAdmin' => 0]);
        }
        
        return redirect(route('users.index'));
    }
}
