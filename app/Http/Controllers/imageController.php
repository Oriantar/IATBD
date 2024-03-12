<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
class imageController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('Dashboard');
    }

    public function upload(Request $request){

        if($request->hasFile('image')){
            $filename = Hash::make(rand(11111,99999)).'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('images',$filename,'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        return redirect()->back();
    }


}
