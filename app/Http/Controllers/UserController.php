<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {

        if(!auth()->user()) return redirect()->route("login");
        $user_id = auth()->user()->id;

        $users = User::whereNot("id", auth()->user()->id)->cursor();
        $groups = User::where("id", $user_id)->groupsWithStatus(1)->get()->pluck("groups");
        
        return view("users", compact( "users", "groups" ));
    }
    
}
