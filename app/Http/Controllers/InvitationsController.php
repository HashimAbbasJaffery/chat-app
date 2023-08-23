<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;

class InvitationsController extends Controller
{
    public function index(User $user) {
        $groups = $user->where("id", $user->id)->groupsWithStatus(0)->get()->pluck("groups");
        return view("invitations", compact( "groups" ));
    }

    public function accept(Group $group) {
        $id = auth()->user()->id;
        $user = User::where("id", $id)->first();
        $update = $user->groups()
                ->updateExistingPivot(
                    $group->id,
                    [
                        "status" => 1
                    ]
                );

        return redirect()->back();
    }
    public function reject(Group $group) {
        $id = auth()->user()->id;
        $user = User::where("id", $id)->first();
        $delete = $user->groups()->detach($group->id);

        return redirect()->back();
    }
}
