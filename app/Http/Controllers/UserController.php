<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::whereNot("id", auth()->user()->id)->cursor();

        return view("users", compact( "users" ));
    }
}
