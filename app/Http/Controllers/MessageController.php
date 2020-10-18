<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Friend;
use App\Models\Chat;
use DB;

class MessageController extends Controller
{
    
    public function store(Request $request){
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $message = $request->message;
        $req = $request;

        $msg = new Chat;
        $msg->sender_id = $sender_id;
        $msg->receiver_id = $receiver_id;
        $msg->message = $message;
        if($msg->save()){
            $msg = 'message is sended';
        } else {
            $msg = 'msg cant be send';
        }

        return response()->json([
            'receiver' => $receiver_id,
            'sender' => $sender_id,
            'message' => $message,
            'msg' => $msg
            
        ]);

    }

    public function showMsg(Request $request){
       
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;

        // $msg = Chat::where('sender_id',$sender_id)->where('receiver_id',$receiver_id)->orderBy('created_at','desc')->get();

        $msg = DB::select("SELECT * FROM chats WHERE (sender_id = '$sender_id' AND receiver_id= '$receiver_id') OR  (sender_id = '$receiver_id' AND receiver_id= '$sender_id')");
         
      


        // $msg = Chat::where(function ($query) {
        //     $query->where('gender', 'Male')
        //         ->where('age', '>=', 18);
        // })->orWhere(function($query) {
        //     $query->where('gender', 'Female')
        //         ->where('age', '>=', 65);	
        // })

        
        return response()->json([
            'receiver' => $receiver_id,
            'sender' => $sender_id,
            'msg' => $msg,
            //'msg1' => $msg1
        ]);
    }
}
