<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $uniqueId = uniqid() . time();
        $users = User::cursor();
        if(!auth()->user()) {
            abort(404);
        }

        return view("create_group", compact("users", "uniqueId"));
    }

    public function invite(Group $group) {
        $invitation = request()->user_id;
        $user_id = explode("-", $invitation)[1];
        try {
            $group->users()->attach($user_id);
            return [
                "status" => true,
                "id" => $invitation
            ];
        } catch(\Exception $e) {
            return [
                "status" => false,
                "message" => "Error!"
            ];
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function chatroom(Group $group) {
        
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if(!$user) return true;
        $user_id = $user->id;
        $group_name = $request->group_name;

        if(!$group_name) return [
            "status" => false
        ];

        $uniqid = uniqid() . time();

        $group = Group::create([
            "group_name" => $group_name,
            "unique_id" => $uniqid
        ]);

        $admin = User::find($user_id);
        $group->users()->attach(
            $admin->id,
            [
                "status" => 1
            ]
        );

        return [
            "status" => true,
            "id" => $uniqid
        ];

    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
