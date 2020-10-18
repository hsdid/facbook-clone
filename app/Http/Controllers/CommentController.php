<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Comment;

use DB;

class CommentController extends Controller
{
    public function add_comment(Request $request){
        
        $user_id = $request->user_id;
        $article_id = $request->article_id;
        $text = $request->text;

        $comment = new Comment;
        $comment->user_id = $user_id;
        $comment->article_id = $article_id;
        $comment->text = $text;
        $comment->save();

        return response()->json([

            'msg' => 'comment added'
        ]);

    }

    public function get_comment(Request $request){

        $article_id = $request->article_id;

        //$comments = Comment::where('article_id',$article_id)->get();
        //$comments = Comment::all();

        //$comments = DB::select("SELECT * FROM comments WHERE article_id = '$article_id' ");

        $comments = DB::select("SELECT c.id ,c.user_id ,c.article_id ,c.text, c.created_at, u.name 
        FROM comments AS c 
        INNER JOIN users AS u
        ON c.user_id = u.id WHERE article_id = '$article_id'
        ORDER BY c.created_at DESC");

        return response()->json([

            'comments' => $comments,
            'article_id' => $article_id
        
        ]);

    }


}
