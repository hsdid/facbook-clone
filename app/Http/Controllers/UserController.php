<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;

class UserController extends Controller
{
    public function addToFriend(Request $request){
        
        $friend_id = $request->user_id;
        $current_id = $request->current_id;
        
        $friend_name = User::select('name')->where('id',$friend_id)->get();
       

        $friend = new Friend;
        $friend->user_id = $current_id;
        $friend->friend_id = $friend_id;
        $friend->save();
        
        
        return response()->json([
            //'user_id' => $friend_id,
            //'current_id' => $current_id,
            'msg' => 'you are friend with '.$friend_name[0]->name
        ]);
       
    }

    public function removeFriend(Request $request){

        $friend_id = $request->friend_id;
        $current_id = $request->current_id;


        // if(Friend::where('friend_id',$friend_id)->where('user_id',$current_id)->delete()){

        //     $msg = 'friend removed';
        // } else {
        //     $msg =
        // }
        $user = Friend::where('friend_id',$friend_id)->where('user_id',$current_id)->delete();

        

        return response()->json([
            'msg' => 'user removed'
        ]);
    }

    public function show($id){

        $user = User::findOrFail($id);
        

        
        return response()->json([
            'user' => $user
        ]);
    }
    
    
  
}
