<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Response;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     //return users you can add (without your friend and and yourself)
    public function index(Request $request)
    {   
        $current_id = $request->current_id;
        
        // //all suers 
        // $all_users = User::all('id');

        // $users_id = array();

        // foreach ($all_users as $obj){
        //    array_push($users_id,$obj->id);
        // }

        // // user friends
        // $user_friends = Friend::select('friend_id')->where('user_id',$current_id)->get();
        
        // $friends_id = [$current_id];

        // foreach ($user_friends as $obj){
        //     array_push($friends_id,$obj->friend_id);
        //  }
         
        // //diff two list
        // $users_id_add = array_diff($users_id,$friends_id);
        
        // //take users that are dont friend with user
        // $users_to_add = User::findMany($users_id_add);

        $users = User::all();

        return response()->json([
           
           
            'users' => $users
            

        ]);
      
       
    }

    public function showFriends(Request $request){

        $ids = array();

        $current_user = $request->current_id;

        $friends_id = Friend::select('friend_id')->where('user_id',$current_user)->get();

        $friends = User::whereIn('id',$friends_id)->get();

        foreach ($friends_id as $id){
            array_push($ids,$id->friend_id);
        }
        //$friends_id = $friends_id[0]->friend_id;

        return response()->json([
            'friends_id' => $ids,
            'friends' => $friends
        ]);
    }


   
}
