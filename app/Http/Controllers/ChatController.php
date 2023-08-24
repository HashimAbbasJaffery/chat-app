<?php

namespace App\Http\Controllers;

use App\Events\GroupChatEvent;
use Illuminate\Http\Request;
use App\Events\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChatController extends Controller
{
    public function message() {
        $sender_id = (int)request()->get("sender_id");
        $reciever_id = (int)request()->get("reciever_id");
        
        $userIds = [ $sender_id, $reciever_id ];
        sort($userIds);


        $message = request()->get("message");
        $user = User::find($sender_id);
        event( new Message($sender_id, $reciever_id, $user->name, $message) );
    }

    public function groupMessage() {
        $reciever_id = request()->get("reciever_id");
        $sender_id = request()->get("sender_id");
        
        $user = User::find($sender_id);

        $message = request()->get("message");
        event( new GroupChatEvent( $user->name, $reciever_id, $message ) );    
    }
}
