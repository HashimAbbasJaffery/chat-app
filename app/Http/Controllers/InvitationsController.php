<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class InvitationsController extends Controller
{
    public function index(User $user) {
        $invitations = $user->groups();
        return view("invitations");
    }
}
